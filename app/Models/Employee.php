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
}
