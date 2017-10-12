<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	public function employees()
    {
        return $this->belongsToMany('People\Models\Employee')->withTimestamps();
    }
     public function company() {
        return $this->belongsTo('People\Models\Company');
    }
}