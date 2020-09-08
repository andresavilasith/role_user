<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
//$usera=Usuario Autenticado
//$user= Usuario a modificar

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $usera
     * @return mixed
     */
    public function viewAny(User $usera)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $usera
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $usera, User $user, $perm = null)
    {
        //si el permiso es fullaccess
        if ($usera->havePermission($perm[0])) {
            return true;
        } else //si descarta fullaccess y user.show entonces comprueba que el usuario 
            //logueado sea igual al usuario registrado para poder mostrar  
            if ($usera->havePermission($perm[1])) {

                return $usera->id === $user->id;
            }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $usera
     * @return mixed
     */
    public function create(User $usera)
    {
        return $usera->id > 0;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $usera
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $usera, User $user, $perm = null)
    {
        //si el permiso es fullaccess
        if ($usera->havePermission($perm[0])) {
            return true;
        } else //si descarta fullaccess y user.show entonces comprueba que el usuario 
            //logueado sea igual al usuario registrado para poder mostrar  
            if ($usera->havePermission($perm[1])) {

                return $usera->id === $user->id;
            }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $usera
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $usera, User $user)
    {
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $usera
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $usera, User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $usera
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $usera, User $user)
    {
        //
    }
}
