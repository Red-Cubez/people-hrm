<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	public function departments() {
		return $this->belongsToMany('People\Models\Department')->withTimestamps();

	}
	public function address() {
		return $this->hasOne('People\Models\EmployeeAddress');
	}
    public function jobTitle() {
        return $this->belongsTo('People\Models\JobTitle');
    }
    public function company() {
        return $this->belongsTo('People\Models\Company');
    }
    public function timesheets() {
        return $this->hasMany('People\Models\EmployeeTimesheet');
    }
    public function timeoffs() {
        return $this->hasMany('People\Models\EmployeeTimeoff');
    }
    public function user() {
        return $this->hasOne('People\Models\User');
    }
}
