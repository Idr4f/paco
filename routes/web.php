<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true, 'register' => false]);

Route::group([
    'middleware' => 'admin', 'web'
], function(){

    Route::get('/', 'App\Http\Controllers\inicioController@index')->name('inicio');

    // Rutas usuarios
    Route::get('/agregar-usuario', 'App\Http\Controllers\UsuariosController@AgregarUsuarioForm')->name('agregar-usuario');
    Route::post('/agregar-usuario/guardar', 'App\Http\Controllers\UsuariosController@AgregarUsuarioFormGuardar')->name('agregar-usuario-guardar');

    Route::get('/editar-usuario/{id_usuario}', 'App\Http\Controllers\UsuariosController@EditarUsuarioForm')->name('editar-usuario');
    Route::put('/editar-usuario/{id_usuario}/guardar', 'App\Http\Controllers\UsuariosController@EditarUsuarioFormGuardar')->name('editar-usuario-guardar');

    Route::get('/consultar-usuario', 'App\Http\Controllers\UsuariosController@ConsultarUsuario')->name('consultar-usuario');
    Route::get('/consultar-establecimiento-usuario', 'App\Http\Controllers\UsuariosController@ConsultarEstablecimientoUsuario')->name('consultar-establecimiento-usuario');
    Route::get('/autocomplete-usuario', 'App\Http\Controllers\UsuariosController@autocompleteusuario')->name('autocompleteusuario');

    Route::get('/datos-usuario/{usuario?}', 'App\Http\Controllers\UsuariosController@DatosUsuario')->name('datos-usuario');
    Route::put('/datos-usuario/modificar-nombre/{usuario?}', 'App\Http\Controllers\UsuariosController@ModNombre')->name('modificar-nombre-usuario');
    Route::put('/datos-usuario/modificar-correo/{usuario?}', 'App\Http\Controllers\UsuariosController@ModCorreo')->name('modificar-correo-usuario');
    Route::put('/datos-usuario/modificar-estado/{usuario?}', 'App\Http\Controllers\UsuariosController@ModEstado')->name('modificar-estado-usuario');
    Route::put('/datos-usuario/modificar-contrasena/{usuario?}', 'App\Http\Controllers\UsuariosController@ModContrasena')->name('modificar-contrasena-usuario');

    Route::get('/establecimiento-usuario/{usuario?}', 'App\Http\Controllers\UsuariosController@DatosEstablecimiento')->name('establecimiento-usuario');
    Route::post('/opciones-rol/agregar-rol-establec/{id_usuario?}/{email?}', 'App\Http\Controllers\UsuariosController@AgregarRolEstablec')->name('agregar-rol-establec');
    Route::put('/establecimiento-usuario/modificar-rol-establec/{id_rol_establec?}/{email?}', 'App\Http\Controllers\UsuariosController@ModRolEstablec')->name('modificar-rol-establec');
    Route::delete('/opciones-rol/eliminar-rol-establec/{id_rol_establec?}/{email?}', 'App\Http\Controllers\UsuariosController@EliminarRolEstablec')->name('eliminar-rol-establec');
    Route::put('/establecimiento-usuario/modificar-rol/{id_rol_establec?}/{email?}', 'App\Http\Controllers\UsuariosController@ModRol')->name('modificar-rol-usuario');
    Route::put('/establecimiento-usuario/modificar-establecimiento/{id_rol_establec?}/{email?}', 'App\Http\Controllers\UsuariosController@ModEstablecimiento')->name('modificar-establecimiento-usuario');

    Route::get('/consultar-usuarios', 'App\Http\Controllers\UsuariosController@ConsultarUsuarios')->name('consultar-usuarios');

    // Rutas roles
    Route::get('/agregar-rol', 'App\Http\Controllers\RolesController@AgregarRolForm')->name('agregar-rol');
    Route::post('/agregar-rol/guardar', 'App\Http\Controllers\RolesController@AgregarRolFormGuardar')->name('agregar-rol-guardar');

    Route::get('/editar-rol/{id_rol}', 'App\Http\Controllers\RolesController@EditarRolForm')->name('editar-rol');
    Route::put('/editar-rol/{id_rol}/guardar', 'App\Http\Controllers\RolesController@EditarRolFormGuardar')->name('editar-rol-guardar');

    Route::get('/consultar-rol', 'App\Http\Controllers\RolesController@ConsultarRol')->name('consultar-rol');
    Route::get('/consultar-rol-opciones', 'App\Http\Controllers\RolesController@ConsultarRolOpciones')->name('consultar-rol-opciones');
    Route::get('/autocomplete-rol', 'App\Http\Controllers\RolesController@autocompleterol')->name('autocompleterol');

    Route::get('/datos-rol/{rol?}', 'App\Http\Controllers\RolesController@DatosRol')->name('datos-rol');
    Route::put('/datos-rol/modificar-nombre/{rol?}', 'App\Http\Controllers\RolesController@ModNombre')->name('modificar-nombre-rol');
    Route::put('/datos-rol/modificar-descripcion/{rol?}', 'App\Http\Controllers\RolesController@ModDesc')->name('modificar-descripcion-rol');
    Route::put('/datos-rol/modificar-estado/{rol?}', 'App\Http\Controllers\RolesController@ModEstado')->name('modificar-estado-rol');

    Route::get('/opciones-rol/{rol?}', 'App\Http\Controllers\RolesController@OpcionesRol')->name('opciones-rol');
    Route::put('/opciones-rol/modificar-rol-opcion/{rol?}/{nom_rol?}', 'App\Http\Controllers\RolesController@ModConfigRolOpcion')->name('modificar-rol-opcion');
    Route::post('/opciones-rol/agregar-rol-opcion/{rol?}/{nom_rol?}', 'App\Http\Controllers\RolesController@AgregarOpcRol')->name('agregar-rol-opcion');
    Route::delete('/opciones-rol/eliminar-rol-opcion/{rol?}/{nom_rol?}', 'App\Http\Controllers\RolesController@EliminarOpcRol')->name('eliminar-rol-opcion');

    Route::get('/consultar-roles', 'App\Http\Controllers\RolesController@ConsultarRoles')->name('consultar-roles');

    // Rutas opciones
    Route::get('/agregar-opcion', 'App\Http\Controllers\OpcionesController@AgregarOpcionForm')->name('agregar-opcion');
    Route::post('/agregar-opcion/guardar', 'App\Http\Controllers\OpcionesController@AgregarOpcionFormGuardar')->name('agregar-opcion-guardar');

    Route::get('/editar-opcion/{id_opcion}', 'App\Http\Controllers\OpcionesController@EditarOpcionForm')->name('editar-opcion');
    Route::put('/editar-opcion/{id_opcion}/guardar', 'App\Http\Controllers\OpcionesController@EditarOpcionFormGuardar')->name('editar-opcion-guardar');

    Route::get('/consultar-opcion', 'App\Http\Controllers\OpcionesController@ConsultarOpcion')->name('consultar-opcion');
    Route::get('/autocomplete-opcion', 'App\Http\Controllers\OpcionesController@autocompleteopcion')->name('autocompleteopcion');

    Route::get('/datos-opcion/{opcion?}', 'App\Http\Controllers\OpcionesController@DatosOpcion')->name('datos-opcion');
    Route::put('/datos-opcion/modificar-nombre/{opcion?}', 'App\Http\Controllers\OpcionesController@ModNombre')->name('modificar-nombre-opcion');
    Route::put('/datos-opcion/modificar-descripcion/{opcion?}', 'App\Http\Controllers\OpcionesController@ModDesc')->name('modificar-descripcion-opcion');
    Route::put('/datos-opcion/modificar-appestabl/{opcion?}', 'App\Http\Controllers\OpcionesController@ModAppEstabl')->name('modificar-appestabl-opcion');
    Route::put('/datos-opcion/modificar-appmiemb/{opcion?}', 'App\Http\Controllers\OpcionesController@ModAppMiemb')->name('modificar-appmiemb-opcion');
    Route::put('/datos-opcion/modificar-estado/{opcion?}', 'App\Http\Controllers\OpcionesController@ModEstado')->name('modificar-estado-opcion');

    Route::get('/consultar-opciones', 'App\Http\Controllers\OpcionesController@ConsultarOpciones')->name('consultar-opciones');

    // Rutas establecimientos
    Route::get('/agregar-establecimiento', 'App\Http\Controllers\EstablecimientosController@AgregarEstablecimientoForm')->name('agregar-establecimiento');
    Route::post('/agregar-establecimiento/guardar', 'App\Http\Controllers\EstablecimientosController@AgregarEstablecimientoFormGuardar')->name('agregar-establecimiento-guardar');

    Route::get('/editar-establecimiento/{id_establ}', 'App\Http\Controllers\EstablecimientosController@EditarEstablecimientoForm')->name('editar-establecimiento');
    Route::put('/editar-establecimiento/{id_establ}/guardar', 'App\Http\Controllers\EstablecimientosController@EditarEstablecimientoFormGuardar')->name('editar-establecimiento-guardar');

    Route::get('/consultar-establecimiento', 'App\Http\Controllers\EstablecimientosController@ConsultarEstablecimiento')->name('consultar-establecimiento');
    Route::get('/autocomplete-establecimiento', 'App\Http\Controllers\EstablecimientosController@autocompleteestablecimiento')->name('autocompleteestablecimiento');

    Route::get('/datos-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@DatosEstablecimiento')->name('datos-establecimiento');
    Route::put('/datos-establecimiento/modificar-codigo-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModCodEstabl')->name('modificar-codigo-establecimiento');
    Route::put('/datos-establecimiento/modificar-nombre-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModNom')->name('modificar-nombre-establecimiento');
    Route::put('/datos-establecimiento/modificar-nombre-corto-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModNomCorto')->name('modificar-nombre-corto-establecimiento');
    Route::put('/datos-establecimiento/modificar-nombre-administrador-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModNomAdmin')->name('modificar-nombre-administrador-establecimiento');
    Route::put('/datos-establecimiento/modificar-telefono-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModTel')->name('modificar-telefono-establecimiento');
    Route::put('/datos-establecimiento/modificar-celular-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModCel')->name('modificar-celular-establecimiento');
    Route::put('/datos-establecimiento/modificar-direccion-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModDir')->name('modificar-direccion-establecimiento');
    Route::put('/datos-establecimiento/modificar-correo-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModCorreo')->name('modificar-correo-establecimiento');
    Route::put('/datos-establecimiento/modificar-tipo-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModTipEstabl')->name('modificar-tipo-establecimiento');
    Route::put('/datos-establecimiento/modificar-estado-establecimiento/{establecimiento?}', 'App\Http\Controllers\EstablecimientosController@ModEstado')->name('modificar-estado-establecimiento');

    Route::get('/consultar-establecimientos', 'App\Http\Controllers\EstablecimientosController@ConsultarEstablecimientos')->name('consultar-establecimientos');


});
