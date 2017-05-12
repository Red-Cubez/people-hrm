<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProjectResource extends Model {
	public function employee() {
		return $this->belongsTo('People\Models\Employee');
	}

	public function companyProject() {
		return $this->belongsTo('People\Models\CompanyProject');
	}

}
