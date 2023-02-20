<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Opcion extends Eloquent
{
    protected $collection = 'opciones';
    protected $primaryKey = '_id';

    protected $fillable = [
        '_id', 'nom_opcion', 'desc_opcion', 'app_establec', 'app_miembro', 'estado', 'creado_e', 'actualizado_e'
    ];

    public $timestamps = false;
}
