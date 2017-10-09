<?php
namespace People\Models;

use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends EntrustRole
{
    use EntrustRoleTrait;

    public function users()
    {
        return $this->belongsToMany('People\Models\User');
    }
}
