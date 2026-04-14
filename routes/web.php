<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;


Route::get('/', function () {
    return view('frontend.inicio');
});

Route::get('/contacto', function () {
    return view('frontend.contacto');
});

Route::get('/terminosyusos', function () {
    return view('frontend.terminosyusos');
});


Route::post('/contacto', [ContactoController::class, 'procesar']);