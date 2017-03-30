<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {
	public function employee() {
		return $this->hasOne('People\Models\Employee');
	}

	public function project() {
		return $this->belongsTo('People\Models\Project');
	}
}
