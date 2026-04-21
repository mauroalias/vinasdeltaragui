<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ComercializacionController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\InicioSesionController;

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

Route::get('/comercializacion', function () {
    return view('frontend.comercializacion');
});


Route::get('/empresa', [EmpresaController::class, 'empresa']);
Route::post('/contacto', [ContactoController::class, 'procesar']);
Route::post('/registro', [RegistroController::class, 'registro']);
Route::post('/iniciosesion', [InicioSesionController::class, 'iniciosesion']);
Route::get('/comercializacion', [ComercializacionController::class, 'comercializacion']);
