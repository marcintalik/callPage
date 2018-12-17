<?php

use Faker\Generator as Faker;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | This directory should contain each of the model factory definitions for
  | your application. Factories provide a convenient way to generate new
  | model instances for testing / seeding your application's database.
  |
 */

$factory->define(App\Models\Shift::class, function (Faker $faker) {
    $startShiftDate = $faker->dateTimeBetween('now', 'now + 3 months')->format('Y-m-d H:00:00');
    $endShiftDate = $faker->dateTimeBetween($startShiftDate, $startShiftDate . '+8 hours')->format('Y-m-d H:00:00');
    $dS = intval(substr($startShiftDate, 8, 2));
    $dE = intval(substr($endShiftDate, 8, 2));
    $hS = intval(ltrim((substr($startShiftDate, 11, 2)), '0'));
    $hE = intval(ltrim((substr($endShiftDate, 11, 2)), '0'));

    do {
        $employee = Employee::inRandomOrder()->get()->first();
        if (!$employee) {
            $employee = factory(App\Models\Employee::class)->create();
        }
        $shifts = DB::table('shifts')
                        ->where('employee_id', $employee->id)
                        ->whereDate('shift_start', $startShiftDate)->get();
    } while (!$shifts->isEmpty());
 

    if ($dS != $dE || $hS >= $hE) {
        $startShiftDate = substr($startShiftDate, 0, 10) . ' 08:00:00';
        $endShiftDate = substr($startShiftDate, 0, 10) . ' 16:00:00';
    }
    return [
        'shift_start' => $startShiftDate,
        'shift_end' => $endShiftDate,
        'employee_id' => $employee->id
    ];
});
