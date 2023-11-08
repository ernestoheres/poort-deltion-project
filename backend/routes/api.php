<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\middleware\CheckRole;

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


Route::middleware('auth:sanctum')->get("/clients", "App\Http\Controllers\ClientController@getAllClients");
Route::middleware('auth:sanctum')->get("/clients/{id}", "App\Http\Controllers\ClientController@getClientById");
Route::middleware('auth:sanctum')->get("/softdeletedclients", "App\Http\Controllers\ClientController@getSoftDeletedClients");
Route::middleware('auth:sanctum')->post("/clients", "App\Http\Controllers\ClientController@createClient");
Route::middleware('auth:sanctum')->delete("/clients/{id}", "App\Http\Controllers\ClientController@deleteClient");
Route::middleware('auth:sanctum')->post("/clients/{id}/restore", "App\Http\Controllers\ClientController@restoreClient");
Route::middleware('auth:sanctum')->put("/clients/{id}", "App\Http\Controllers\ClientController@updateClient");
Route::get("/clients/{id}/image", "App\Http\Controllers\ClientController@serveImage");
Route::post("/login", "App\Http\Controllers\UserController@login");
Route::middleware('auth:sanctum')->post("/register", "App\Http\Controllers\UserController@register");
