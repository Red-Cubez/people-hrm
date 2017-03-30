<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function resources()
    {
        return $this->hasMany('People\Models\Resource');
    }
}
