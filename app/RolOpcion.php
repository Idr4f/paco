<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RolOpcion extends Eloquent
{
    protected $collection = 'rol_opciones';
    protected $primaryKey = '_id';

    protected $fillable = [
        '_id', 'id_rol', 'id_opcion', 'creacion', 'lectura', 'modificacion', 'eliminacion', 'estado', 'creado_e', 'actualizado_e'
    ];

    public function rol() {
        return $this->hasOne('App\Rol', 'id_rol');
    }

    public function opcion() {
        return $this->hasOne('App\Opcion', 'id_rol', '_id');
    }

    public $timestamps = false;
}
