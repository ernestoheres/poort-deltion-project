<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/clients", "App\Http\Controllers\ClientController@getAllClients");
Route::get("/clients/{id}", "App\Http\Controllers\ClientController@getClientById");
Route::post("/clients", "App\Http\Controllers\ClientController@createClient");
Route::get("/clients/{id}/image", "App\Http\Controllers\ClientController@serveImage");
