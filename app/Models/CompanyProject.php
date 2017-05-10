<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProject extends Model
{
    public function resources()
    {
        return $this->hasMany('People\Models\Resource');
    }
}
