<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectResource extends Model {
	public function employee() {
		return $this->belongsTo('People\Models\Employee');
	}
	public function clientProject() {
		return $this->belongsTo('People\Models\ClientProject');
	}
}
