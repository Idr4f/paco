<?php

namespace App;
use App\User;
use App\Rol;
use App\Establecimiento;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserRolEstablecimiento extends Eloquent
{
    protected $collection = 'usuario_rol_establecimiento';
    protected $primaryKey = '_id';

    protected $fillable = [
        '_id', 'id_usuario', 'id_rol', 'id_establecimiento', 'num_inmueble', 'creado_e', 'actualizado_e'
    ];

    public function user(){
        return $this ->hasOne('App/User', 'id_usuario');
    }

    public function rol(){
        return $this->hasOne('App/Rol', 'id_rol');
    }

    public function establecimiento(){
        return $this->hasOne('App/Establecimiento', 'id_establecimiento');
    }

    public $timestamps = false;
}
