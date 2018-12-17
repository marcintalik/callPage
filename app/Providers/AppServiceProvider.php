<?php

namespace App\Providers;

use Validator;
use Redirect;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Validator::extend('greater_than_hour', function($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            $shift_start = $data['shift_start'];
            $shift_end = $data['shift_end'];
            return ($shift_start < $shift_end);
        });
        Validator::extend('one_day_shift_for_employee', function($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            $shift_date = $data['shift_date'];
            $shift_date_proper_format = substr($shift_date, 6, 4) . '-' . substr($shift_date, 3, 2) . '-' . substr($shift_date, 0, 2);
            $employee_id = $data['shift_owner'];
            $shifts = DB::table('shifts')
                    ->where('employee_id',$employee_id)
                        ->whereDate('shift_start', $shift_date_proper_format)->get();
            return $shifts->isEmpty();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
