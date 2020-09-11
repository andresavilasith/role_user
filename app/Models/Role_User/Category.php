<?php

namespace App\Models\Role_User;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function permissions()
    {
        return $this->hasMany('App\Models\Role_User\Permission');
    }
}
