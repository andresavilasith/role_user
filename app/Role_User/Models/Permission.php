<?php

namespace App\Role_User\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Role_User\Models\Category', 'category_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role_User\Models\Role')->withTimestamps();
    }
}
