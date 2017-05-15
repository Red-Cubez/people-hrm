<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProject extends Model {
	public function resources() {
		return $this->hasMany('People\Models\CompanyProjectResource');
	}

	public function company() {
		return $this->belongsTo('People\Models\Company');
	}
}
