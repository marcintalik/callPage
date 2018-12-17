<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Employee extends Model {

    public $timestamps = true;
    
    protected $fillable = ['name'];

    /**
     * Get the shifts for the employee.
     */
    public function shifts() {
        return $this->hasMany('App\Models\Shift');
    }

}
