<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTimesheet extends Model
{
    public function employee() {
        return $this->belongsTo('People\Models\EmployeeTimesheet');
    }
    protected $casts = [
        'billableWeeklyTimeSheet' => 'array',
        'nonBillableWeeklyTimeSheet' => 'array',
    ];
}
