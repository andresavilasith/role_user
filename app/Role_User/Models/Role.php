<?php

namespace App\Role_User\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded=[];
    
    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Role_User\Models\Permission')->withTimestamps();
    }
}
