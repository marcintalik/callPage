<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Employee;
use App\Services\DateFormatCreator\DateFormatCreatorInterface;
use App\Services\ShiftSorter\ShiftSorterInterface;
use Illuminate\Support\Facades\DB;


/**
 * Controller class of shifts objects.                                
 *
 * @author marcintalik
 */
class ShiftController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $shifts = Shift::all()->sortBy('shift_start');
        return view('shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $employees = Employee::all();
        if ($employees->isEmpty()) {
            return redirect('/shifts')->with('error', 'There is no one who can take a shift. Please, create an employee first');
        }
        return view('shift.create', compact('employees'));
    }

    /**
     * Search shifts from database
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Services\DateFormatCreator\DateFormatCreatorInterface $DateFormatCreatorInterface
     * @param \App\Services\ShiftSorter\ShiftSorterInterface $shiftSorterInterface
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, DateFormatCreatorInterface $DateFormatCreatorInterface, ShiftSorterInterface $shiftSorterInterface) {
        $rules = [
            'number_of_days' => 'required',
            'shift_date' => 'required'
        ];
        $this->validate($request, $rules);
        $date = $DateFormatCreatorInterface->changeToDateFormat($request->get('shift_date').':00:00');
        $endDate = $DateFormatCreatorInterface->addDays($date, $request->get('number_of_days'));
        $startDate = $DateFormatCreatorInterface->changeToDateFormat($request->get('shift_date').':00:00');
        $shifts = DB::table('shifts')
                        ->whereBetween('shift_start', [$startDate, $endDate])->orderByRaw('shift_start')->get();
       
        $json = $shiftSorterInterface->sort($shifts);
        $data=[$json,$request->get('shift_date'),$request->get('number_of_days')];
        return view('index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'shift_owner' => 'required',
            'shift_date' => 'required',
            'shift_start' => 'required|greater_than_hour|one_day_shift_for_employee',
            'shift_end' => 'required',
        ];
        $customMessages = [
            'greater_than_hour' => 'Shit should starts befor it ends :)',
            'one_day_shift_for_employee'=> 'One employee can have only one shift per day'
        ];

        $this->validate($request, $rules, $customMessages);
        $shift_start = date_create_from_format('d/m/Y:H:i:00', $request->get('shift_date') . ':' . $request->get('shift_start') . ':00');
        $shift_end = date_create_from_format('d/m/Y:H:i:00', $request->get('shift_date') . ':' . $request->get('shift_end') . ':00');
        $shift = new Shift([
            'shift_start' => $shift_start,
            'shift_end' => $shift_end,
            'employee_id' => $request->get('shift_owner')
        ]);
        $shift->save();
        return redirect('/shifts')->with('success', 'Shift has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $employees = Employee::all();
        $shift = Shift::find($id);
        return view('shift.edit', compact(['employees', 'shift']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = [
            'shift_owner' => 'required',
            'shift_date' => 'required',
            'shift_start' => 'required|greater_than_hour',
            'shift_end' => 'required'
        ];
        $customMessages = [
            'greater_than_hour' => 'Shift should starts befor it ends :)'
        ];
        $this->validate($request, $rules, $customMessages);
        $shift_start = date_create_from_format('d/m/Y:H:i:00', $request->get('shift_date') . ':' . $request->get('shift_start') . ':00');
        $shift_end = date_create_from_format('d/m/Y:H:i:00', $request->get('shift_date') . ':' . $request->get('shift_end') . ':00');
        $shift = Shift::find($id);
        $shift->shift_start = $shift_start;
        $shift->shift_end = $shift_end;
        $shift->employee_id = $request->get('shift_owner');
        $shift->save();
        return redirect('/shifts')->with('success', 'Shift has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $shift = Shift::find($id);
        $shift->delete();
        return redirect('/shifts')->with('success', 'Shift has been deleted Successfully');
    }

}
