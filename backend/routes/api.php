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
Route::delete("/clients/{id}", "App\Http\Controllers\ClientController@deleteClient");

Route::middleware(['auth:sanctum', 'checkRole:doctor,administrator'])->group(function() {
    Route::get("/clients", "App\Http\Controllers\ClientController@getAllClients");
    Route::get("/softdeletedclients", "App\Http\Controllers\ClientController@getSoftDeletedClients");
    Route::post("/clients", "App\Http\Controllers\ClientController@createClient");
    Route::post("/clients/{id}/restore", "App\Http\Controllers\ClientController@restoreClient");
    Route::put("/clients/{id}", "App\Http\Controllers\ClientController@updateClient");

});
Route::middleware('auth:sanctum')->get("/clients/{id}", "App\Http\Controllers\ClientController@getClientById");

Route::get("/clients/{id}/image", "App\Http\Controllers\ClientController@serveImage");
Route::post("/login", "App\Http\Controllers\UserController@login");
Route::middleware('auth:sanctum')->post("/register", "App\Http\Controllers\UserController@register");

Route::post("/notes", "App\Http\Controllers\NoteController@store");
Route::get('/notes', 'App\Http\Controllers\NoteController@index');
Route::delete('/notes', 'App\Http\Controllers\NoteController@destroy');
