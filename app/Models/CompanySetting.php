<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model {

	
    public function company() {
        return $this->hasOne('People\Models\Company');
    }
}
