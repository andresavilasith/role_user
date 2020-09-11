<?php

namespace App\Models\Traits;

trait UserTrait
{
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role_User\Role')->withTimestamps();
    }

    public function havePermission($permission)
    {

        foreach ($this->roles as $role) {
            if ($role->full_access == 'yes') {
                //return 'true full-access yes';
                return true;
            }
            foreach ($role->permissions as $perm) {
                if ($perm->slug == $permission) {
                    //return 'acceso a slug es decir al permiso';
                    return true;
                }
            }
            return false;
        }
    }
}
