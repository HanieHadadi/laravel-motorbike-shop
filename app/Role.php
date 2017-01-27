<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $en_name
 * @property string $fa_name
 * @property boolean $is_admin
 * @property string $created_at
 * @property string $updated_at
 */
class Role extends Model
{

     CONST ROLE_ADMIN  = 1;
     CONST ROLE_MEMBER = 2;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'role';

    /**
     * @var array
     */
    protected $fillable = ['en_name', 'fa_name', 'is_admin', 'created_at', 'updated_at'];

    /**
     * The users that belong to the role.
     */
     public function users()
    {
        return $this->belongsToMany('App\User','cross_user_role','role_id','user_id');
    }
}
