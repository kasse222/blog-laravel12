<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'message' => 'Bienvenue sur l’API Blog Laravel 12 🚀',
        'status' => 'OK'
    ]);
});


Route::get('/api/documentation', function () {
    $json = File::get(storage_path('api-docs/api-docs.json'));
    return response($json, 200)->header('Content-Type', 'application/json');
});

Route::get('/docs', function () {
    return response()->file(storage_path('api-docs/api-docs.json'));
});
