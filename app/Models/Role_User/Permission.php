<?php

namespace App\Models\Role_User;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Role_User\Category', 'category_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role_User\Role')->withTimestamps();
    }
}
