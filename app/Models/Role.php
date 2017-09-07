<?php 
namespace People\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	 public function users() {
        return $this->belongsToMany('People\Models\User');
    }
}