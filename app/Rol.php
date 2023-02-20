<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Rol extends Eloquent
{
    protected $collection = 'roles';
    protected $primaryKey = '_id';

    protected $fillable = [
        '_id', 'nom_rol', 'desc_rol', 'estado', 'creado_e', 'actualizado_e'
    ];

    // Relación
    public function opcion() {
        return $this->hasOne('App\Opcion', '_id');
    }

    public $timestamps = false;

}
