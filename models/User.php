<?php

/**
 * Description of User
 *
 * @author Yamada Yoseigi
 */

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Cartalyst\Sentry\Users\Eloquent\User {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');


        
    /*////////////////////////////// Scope //////////////////////////////*/
    public function scopeSelectJoinUsergroup($query) {
        return $query->select(
            'users_groups.group_id',
            'users_groups.user_id',
            'users.id',
            'users.email',
            'users.first_name',
            'users.last_name',
            'users.created_at',
            'users.updated_at'
        );
    }


}

