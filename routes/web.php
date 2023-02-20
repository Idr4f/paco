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

    Route::get('/', 'inicioController@index')->name('inicio');

    // Rutas usuarios
    Route::get('/agregar-usuario', 'UsuariosController@AgregarUsuarioForm')->name('agregar-usuario');
    Route::post('/agregar-usuario/guardar', 'UsuariosController@AgregarUsuarioFormGuardar')->name('agregar-usuario-guardar');

    Route::get('/editar-usuario/{id_usuario}', 'UsuariosController@EditarUsuarioForm')->name('editar-usuario');
    Route::put('/editar-usuario/{id_usuario}/guardar', 'UsuariosController@EditarUsuarioFormGuardar')->name('editar-usuario-guardar');

    Route::get('/consultar-usuario', 'UsuariosController@ConsultarUsuario')->name('consultar-usuario');
    Route::get('/consultar-establecimiento-usuario', 'UsuariosController@ConsultarEstablecimientoUsuario')->name('consultar-establecimiento-usuario');
    Route::get('/autocomplete-usuario', 'UsuariosController@autocompleteusuario')->name('autocompleteusuario');

    Route::get('/datos-usuario/{usuario?}', 'UsuariosController@DatosUsuario')->name('datos-usuario');
    Route::put('/datos-usuario/modificar-nombre/{usuario?}', 'UsuariosController@ModNombre')->name('modificar-nombre-usuario');
    Route::put('/datos-usuario/modificar-correo/{usuario?}', 'UsuariosController@ModCorreo')->name('modificar-correo-usuario');
    Route::put('/datos-usuario/modificar-estado/{usuario?}', 'UsuariosController@ModEstado')->name('modificar-estado-usuario');

    Route::get('/establecimiento-usuario/{usuario?}', 'UsuariosController@DatosEstablecimiento')->name('establecimiento-usuario');
    Route::post('/opciones-rol/agregar-rol-establec/{id_usuario?}/{email?}', 'UsuariosController@AgregarRolEstablec')->name('agregar-rol-establec');
    Route::put('/establecimiento-usuario/modificar-rol-establec/{id_rol_establec?}/{email?}', 'UsuariosController@ModRolEstablec')->name('modificar-rol-establec');
    Route::delete('/opciones-rol/eliminar-rol-establec/{id_rol_establec?}/{email?}', 'UsuariosController@EliminarRolEstablec')->name('eliminar-rol-establec');
    Route::put('/establecimiento-usuario/modificar-rol/{id_rol_establec?}/{email?}', 'UsuariosController@ModRol')->name('modificar-rol-usuario');
    Route::put('/establecimiento-usuario/modificar-establecimiento/{id_rol_establec?}/{email?}', 'UsuariosController@ModEstablecimiento')->name('modificar-establecimiento-usuario');

    Route::get('/consultar-usuarios', 'UsuariosController@ConsultarUsuarios')->name('consultar-usuarios');

    // Rutas roles
    Route::get('/agregar-rol', 'RolesController@AgregarRolForm')->name('agregar-rol');
    Route::post('/agregar-rol/guardar', 'RolesController@AgregarRolFormGuardar')->name('agregar-rol-guardar');

    Route::get('/editar-rol/{id_rol}', 'RolesController@EditarRolForm')->name('editar-rol');
    Route::put('/editar-rol/{id_rol}/guardar', 'RolesController@EditarRolFormGuardar')->name('editar-rol-guardar');

    Route::get('/consultar-rol', 'RolesController@ConsultarRol')->name('consultar-rol');
    Route::get('/consultar-rol-opciones', 'RolesController@ConsultarRolOpciones')->name('consultar-rol-opciones');
    Route::get('/autocomplete-rol', 'RolesController@autocompleterol')->name('autocompleterol');

    Route::get('/datos-rol/{rol?}', 'RolesController@DatosRol')->name('datos-rol');
    Route::put('/datos-rol/modificar-nombre/{rol?}', 'RolesController@ModNombre')->name('modificar-nombre-rol');
    Route::put('/datos-rol/modificar-descripcion/{rol?}', 'RolesController@ModDesc')->name('modificar-descripcion-rol');
    Route::put('/datos-rol/modificar-estado/{rol?}', 'RolesController@ModEstado')->name('modificar-estado-rol');

    Route::get('/opciones-rol/{rol?}', 'RolesController@OpcionesRol')->name('opciones-rol');
    Route::put('/opciones-rol/modificar-rol-opcion/{rol?}/{nom_rol?}', 'RolesController@ModConfigRolOpcion')->name('modificar-rol-opcion');
    Route::post('/opciones-rol/agregar-rol-opcion/{rol?}/{nom_rol?}', 'RolesController@AgregarOpcRol')->name('agregar-rol-opcion');
    Route::delete('/opciones-rol/eliminar-rol-opcion/{rol?}/{nom_rol?}', 'RolesController@EliminarOpcRol')->name('eliminar-rol-opcion');

    Route::get('/consultar-roles', 'RolesController@ConsultarRoles')->name('consultar-roles');

    // Rutas opciones
    Route::get('/agregar-opcion', 'OpcionesController@AgregarOpcionForm')->name('agregar-opcion');
    Route::post('/agregar-opcion/guardar', 'OpcionesController@AgregarOpcionFormGuardar')->name('agregar-opcion-guardar');

    Route::get('/editar-opcion/{id_opcion}', 'OpcionesController@EditarOpcionForm')->name('editar-opcion');
    Route::put('/editar-opcion/{id_opcion}/guardar', 'OpcionesController@EditarOpcionFormGuardar')->name('editar-opcion-guardar');

    Route::get('/consultar-opcion', 'OpcionesController@ConsultarOpcion')->name('consultar-opcion');
    Route::get('/autocomplete-opcion', 'OpcionesController@autocompleteopcion')->name('autocompleteopcion');

    Route::get('/datos-opcion/{opcion?}', 'OpcionesController@DatosOpcion')->name('datos-opcion');
    Route::put('/datos-opcion/modificar-nombre/{opcion?}', 'OpcionesController@ModNombre')->name('modificar-nombre-opcion');
    Route::put('/datos-opcion/modificar-descripcion/{opcion?}', 'OpcionesController@ModDesc')->name('modificar-descripcion-opcion');
    Route::put('/datos-opcion/modificar-appestabl/{opcion?}', 'OpcionesController@ModAppEstabl')->name('modificar-appestabl-opcion');
    Route::put('/datos-opcion/modificar-appmiemb/{opcion?}', 'OpcionesController@ModAppMiemb')->name('modificar-appmiemb-opcion');
    Route::put('/datos-opcion/modificar-estado/{opcion?}', 'OpcionesController@ModEstado')->name('modificar-estado-opcion');

    Route::get('/consultar-opciones', 'OpcionesController@ConsultarOpciones')->name('consultar-opciones');

    // Rutas establecimientos
    Route::get('/agregar-establecimiento', 'EstablecimientosController@AgregarEstablecimientoForm')->name('agregar-establecimiento');
    Route::post('/agregar-establecimiento/guardar', 'EstablecimientosController@AgregarEstablecimientoFormGuardar')->name('agregar-establecimiento-guardar');

    Route::get('/editar-establecimiento/{id_establ}', 'EstablecimientosController@EditarEstablecimientoForm')->name('editar-establecimiento');
    Route::put('/editar-establecimiento/{id_establ}/guardar', 'EstablecimientosController@EditarEstablecimientoFormGuardar')->name('editar-establecimiento-guardar');

    Route::get('/consultar-establecimiento', 'EstablecimientosController@ConsultarEstablecimiento')->name('consultar-establecimiento');
    Route::get('/autocomplete-establecimiento', 'EstablecimientosController@autocompleteestablecimiento')->name('autocompleteestablecimiento');

    Route::get('/datos-establecimiento/{establecimiento?}', 'EstablecimientosController@DatosEstablecimiento')->name('datos-establecimiento');
    Route::put('/datos-establecimiento/modificar-codigo-establecimiento/{establecimiento?}', 'EstablecimientosController@ModCodEstabl')->name('modificar-codigo-establecimiento');
    Route::put('/datos-establecimiento/modificar-nombre-establecimiento/{establecimiento?}', 'EstablecimientosController@ModNom')->name('modificar-nombre-establecimiento');
    Route::put('/datos-establecimiento/modificar-nombre-corto-establecimiento/{establecimiento?}', 'EstablecimientosController@ModNomCorto')->name('modificar-nombre-corto-establecimiento');
    Route::put('/datos-establecimiento/modificar-nombre-administrador-establecimiento/{establecimiento?}', 'EstablecimientosController@ModNomAdmin')->name('modificar-nombre-administrador-establecimiento');
    Route::put('/datos-establecimiento/modificar-telefono-establecimiento/{establecimiento?}', 'EstablecimientosController@ModTel')->name('modificar-telefono-establecimiento');
    Route::put('/datos-establecimiento/modificar-celular-establecimiento/{establecimiento?}', 'EstablecimientosController@ModCel')->name('modificar-celular-establecimiento');
    Route::put('/datos-establecimiento/modificar-direccion-establecimiento/{establecimiento?}', 'EstablecimientosController@ModDir')->name('modificar-direccion-establecimiento');
    Route::put('/datos-establecimiento/modificar-correo-establecimiento/{establecimiento?}', 'EstablecimientosController@ModCorreo')->name('modificar-correo-establecimiento');
    Route::put('/datos-establecimiento/modificar-tipo-establecimiento/{establecimiento?}', 'EstablecimientosController@ModTipEstabl')->name('modificar-tipo-establecimiento');
    Route::put('/datos-establecimiento/modificar-estado-establecimiento/{establecimiento?}', 'EstablecimientosController@ModEstado')->name('modificar-estado-establecimiento');

    Route::get('/consultar-establecimientos', 'EstablecimientosController@ConsultarEstablecimientos')->name('consultar-establecimientos');


});
