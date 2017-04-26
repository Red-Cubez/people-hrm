<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	public function departments()
    {
        return $this->belongsToMany('People\Models\Department')->withTimestamps();
    }
}
