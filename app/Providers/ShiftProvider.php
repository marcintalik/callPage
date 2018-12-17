<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DateFormatCreator\DateFormatCreator;
use App\Services\ShiftSorter\ShiftSorter;

class ShiftProvider extends ServiceProvider {

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('App\Services\DateFormatCreator\DateFormatCreatorInterface', function ($app) {
            return new DateFormatCreator();
        });

        $this->app->bind('App\Services\ShiftSorter\ShiftSorterInterface', function ($app) {
            return new ShiftSorter($fData = []);
        });
    }

}
