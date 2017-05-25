<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
	public function address() {
		return $this->hasOne('People\Models\CompanyAddress');
	}

	public function employees() {
		return $this->hasMany('People\Models\Employee');
	}

	public function projects() {
		return $this->hasMany('People\Models\CompanyProject');
	}

	public function clients() {
		return $this->hasMany('People\Models\Client');
	}

	public function departments() {
		return $this->hasMany('People\Models\Department');
	}

//    public function holidays() {
//        return $this->hasMany('People\Models\CompanyHoliday');
//    }
}
