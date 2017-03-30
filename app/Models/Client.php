<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function projects()
    {
        return $this->hasMany('People\Models\ClientProject');
    }

    public function address()
    {
        return $this->hasOne('People\Models\Address');
    }
}
