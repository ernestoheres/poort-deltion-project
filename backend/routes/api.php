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


Route::get("/clients", "App\Http\Controllers\ClientController@getAllClients")->middleware(CheckRole::class . ":doctor, administator");
Route::get("/clients/{id}", "App\Http\Controllers\ClientController@getClientById")->middleware(CheckRole::class . ":doctor, administator, client");
Route::get("/softdeletedclients", "App\Http\Controllers\ClientController@getSoftDeletedClients")->middleware(CheckRole::class . ":doctor, administator");
Route::post("/clients", "App\Http\Controllers\ClientController@createClient")->middleware(CheckRole::class . ":doctor, administator");
Route::delete("/clients/{id}", "App\Http\Controllers\ClientController@deleteClient")->middleware(CheckRole::class . ":doctor, administator");
Route::post("/clients/{id}/restore", "App\Http\Controllers\ClientController@restoreClient")->middleware(CheckRole::class . ":doctor, administator");
Route::put("/clients/{id}", "App\Http\Controllers\ClientController@updateClient")->middleware(CheckRole::class . ":doctor, administator");
Route::get("/clients/{id}/image", "App\Http\Controllers\ClientController@serveImage")->middleware(CheckRole::class . ":doctor, administator, client");
Route::post("/login", "App\Http\Controllers\UserController@login");
Route::post("/register", "App\Http\Controllers\UserController@register")->middleware(CheckRole::class . ":doctor, administator");
