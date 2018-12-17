<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model {

    protected $fillable = ['shift_start', 'shift_end', 'employee_id'];

    /**
     * Get the employee that owns the shift.
     */
    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }

}
