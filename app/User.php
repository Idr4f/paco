<?php

namespace App;

use Illuminate\Notifications\notificable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use notificable;

    protected $collection = 'users';
    protected $primaryKey = 'id';

    protected $filliable = [
        '_id', 'email', 'nombre', 'password', 'estado', 'creado_e', 'acrualizado_e'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public $timestamps = false;
}
