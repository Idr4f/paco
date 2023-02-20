<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Establecimiento extends Eloquent
{
    protected $collection = 'establecimientos';
    protected $primaryKey = '_id';

    protected $fillable = [
        'cod_establec', 'nom_establec', 'nom_corto_establec', 'nom_administrador', 'telefono', 'celular', 'direccion', 'correo', 'tipo_establec', 'estado', 'creado_e', 'actualizado_e'
    ];

    public $timestamps = false;
}
