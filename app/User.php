<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The roles that belong to the user.
     */
     public function roles()
    {
        return $this->belongsToMany('App\Role','cross_user_role','user_id','role_id');
    }

    public function isAdmin()
    {
        $all_roles = $this->roles()->get();
        foreach ($all_roles as $role_key => $role) {
            if($role->is_admin == 1){
                return true;
            }
        }

        return false;
      //  $this->roles()->sy
    }

}
