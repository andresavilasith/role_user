<?php

namespace App\Role_User\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function permissions()
    {
        return $this->hasMany('App\Role_User\Models\Permission');
    }
}
