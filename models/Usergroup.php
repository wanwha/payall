<?php


use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usergroup extends Cartalyst\Sentry\Users\Eloquent\User {

	
    protected $table = 'users_groups';
    public $timestamps = false;


}