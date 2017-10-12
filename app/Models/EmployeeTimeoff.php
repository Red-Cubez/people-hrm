<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTimeoff extends Model
{
     public function employee() {
        return $this->belongsTo('People\Models\Employee');
    }
}
