<?php

namespace App\Models\Role_User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded=[];
    
    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Role_User\Permission')->withTimestamps();
    }
}
