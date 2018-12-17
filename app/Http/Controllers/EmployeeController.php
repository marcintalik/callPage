<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;


/**
 * Controller class of employyes objects.                                
 *
 * @author marcintalik
 */
class EmployeeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'employee_name' => 'required'
        ]);
        $employee = new Employee([
            'name' => $request->get('employee_name')
        ]);
        $employee->save();
        return redirect('/employees')->with('success', 'Employee has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $employee = Employee::find($id);
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'employee_name' => 'required'
        ]);
        $employee = Employee::find($id);
        $employee->name = $request->get('employee_name');
        $employee->save();
        return redirect('/employees')->with('success', 'Employee has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('/employees')->with('success', 'Employee has been deleted Successfully');
    }

}
