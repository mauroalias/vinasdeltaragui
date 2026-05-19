<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ComercializacionController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\InicioSesionController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('frontend.inicio');
});

Route::get('/contacto', function () {
    return view('frontend.contacto');
});

Route::get('/terminosyusos', function () {
    return view('frontend.terminosyusos');
});

Route::get('/registro', function () {
    return view('frontend.registro');
});

Route::get('/iniciosesion', function () {
    return view('frontend.iniciosesion');
});

Route::post('/newsletter', function () {

    return view('frontend.exito', [
        'titulo' => 'Suscripción exitosa',
        'mensaje' => 'Gracias por suscribirte. Te enviaremos novedades y promociones a tu correo.'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard']);
    Route::get('/admin/productos', [AdminController::class, 'productos']);
    Route::get('/admin/productos/crear', [AdminController::class, 'crearProducto']);
    Route::post('/admin/productos', [AdminController::class, 'guardarProducto']);
    Route::get('/admin/contactos', [AdminController::class, 'contactos']);
});

Route::post('/carrito/agregar/{tipo}/{id}', [CarritoController::class, 'agregar']);

Route::get('/carrito/eliminar/{clave}', [CarritoController::class, 'eliminar']);

Route::get('/finalizar-compra', [CarritoController::class, 'finalizar']);

Route::get('/catalogo/{tipo}/{id}', [CatalogoController::class, 'detalle']);

Route::get('/catalogo', [CatalogoController::class, 'catalogocompleto']);

Route::get('/catalogo/{tipo}', [CatalogoController::class, 'categoria']);

Route::get('/empresa', [EmpresaController::class, 'empresa']);

Route::get('/comercializacion', [ComercializacionController::class, 'comercializacion']);

Route::post('/contacto', [ContactoController::class, 'store_contact']);

Route::post('/registro', [RegistroController::class, 'store_registro']);

Route::post('/iniciosesion', [InicioSesionController::class, 'iniciosesion']);

Route::post('/logout', [InicioSesionController::class, 'logout'])
    ->name('logout');

Route::get('/perfil', function () {

    return view('frontend.perfil');

})->middleware('auth');

