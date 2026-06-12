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
use App\Http\Controllers\PerfilController;

//Frontend

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

Route::get('/perfil', [PerfilController::class, 'index'])->middleware('auth');

Route::put('/perfil/password', [PerfilController::class, 'actualizarPassword'])
    ->middleware('auth')
    ->name('profile.update.password');

Route::put('/perfil/datos-facturacion', [PerfilController::class, 'actualizarDatosFacturacion'])
    ->middleware('auth')
    ->name('perfil.facturacion.actualizar');

//Admin

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get(
        '/admin',
        [AdminController::class, 'dashboard']
    );

    Route::get('/admin/ventas', [AdminController::class, 'historialVentas'])->name('admin.ventas.index');
    
    Route::get('/admin/clientes/{id}', [AdminController::class, 'verCliente'])->name('admin.cliente.historial');
   
    // LISTAR PRODUCTOS
    Route::get(
        '/admin/productos',
        [AdminController::class, 'productos']
    );

    // CREAR PRODUCTO
    Route::get(
        '/admin/productos/crear',
        [AdminController::class, 'crearProducto']
    );

    Route::post(
        '/admin/productos',
        [AdminController::class, 'guardarProducto']
    );

    // EDITAR PRODUCTO
    Route::get(
        '/admin/productos/{id}/editar',
        [AdminController::class, 'editarProducto']
    );

    Route::put(
        '/admin/productos/{id}',
        [AdminController::class, 'actualizarProducto']
    );

    // BAJA LÓGICA
    Route::get(
    '/admin/productos/baja',
    [AdminController::class, 'vistaBajaProducto']
    )->name('admin.productos.baja');

    Route::post(
    '/admin/productos/baja',
    [AdminController::class, 'darDeBajaProducto']
    )->name('admin.productos.darBaja');

    // CONTACTOS
    Route::get(
        '/admin/contactos',
        [AdminController::class, 'contactos']
    );

    Route::post(
        '/admin/contactos/{id}/alternar-leido', 
        [App\Http\Controllers\AdminController::class, 'alternarLeido'])->name('admin.contactos.alternar');

});

//Carrito

Route::post('/carrito/agregar/{tipo}/{id}',
    [CarritoController::class, 'agregar']);

Route::get('/carrito/eliminar/{clave}',
    [CarritoController::class, 'eliminar']);

Route::get('/finalizar-compra',
    [CarritoController::class, 'finalizar']);

Route::post('/procesar-compra',
    [CarritoController::class, 'procesarCompra']);

Route::get('/carrito/sumar/{clave}',
    [CarritoController::class, 'sumar']);

Route::get('/carrito/restar/{clave}',
    [CarritoController::class, 'restar']);

Route::get('/compra-exitosa',
    [CarritoController::class, 'exito']);

Route::get('/carrito/vaciar',
    [CarritoController::class, 'vaciar']);

Route::get('/comprobante/{id}',
    [CarritoController::class, 'comprobante'])->middleware('auth');

//Catálogo

Route::get('/catalogo',
    [CatalogoController::class, 'catalogocompleto']);

Route::get('/catalogo/{tipo}',
    [CatalogoController::class, 'categoria']);

Route::get('/catalogo/{tipo}/{id}',
    [CatalogoController::class, 'detalle']);

//Empresa

Route::get('/empresa',
    [EmpresaController::class, 'empresa']);

Route::get('/comercializacion',
    [ComercializacionController::class, 'comercializacion']);

//Formularios

Route::post('/contacto',
    [ContactoController::class, 'store_contact']);

Route::post('/registro',
    [RegistroController::class, 'store_registro']);

Route::post('/iniciosesion',
    [InicioSesionController::class, 'iniciosesion']);

Route::get('/login', function () {
    return redirect('/iniciosesion');
})->name('login');

Route::post('/logout',
    [InicioSesionController::class, 'logout'])
    ->name('logout');

Route::post(
    '/admin/productos/reactivar',
    [AdminController::class, 'reactivarProducto']
);
