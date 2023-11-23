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

Route::middleware(['auth:sanctum', 'checkRole:doctor,administrator,manager'])->group(function() {
    Route::get("/clients", "App\Http\Controllers\ClientController@getAllClients");
    Route::get("/softdeletedclients", "App\Http\Controllers\ClientController@getSoftDeletedClients");
    Route::post("/clients", "App\Http\Controllers\ClientController@createClient");
    Route::delete("/clients/{id}", "App\Http\Controllers\ClientController@deleteClient");
    Route::delete("/clients/{id}/force", "App\Http\Controllers\ClientController@forceDeleteClient");
    Route::post("/clients/{id}/restore", "App\Http\Controllers\ClientController@restoreClient");
    Route::put("/clients/{id}", "App\Http\Controllers\ClientController@updateClient");
});
Route::middleware('auth:sanctum')->get("/clients/{id}", "App\Http\Controllers\ClientController@getClientById");
Route::middleware('auth:sanctum')->post("/clients/{id}/image", "App\Http\Controllers\ClientController@uploadImage");	
Route::get("/clients/{id}/image", "App\Http\Controllers\ClientController@serveImage");
Route::post("/login", "App\Http\Controllers\UserController@login");
Route::post("register", "App\Http\Controllers\UserController@register");
Route::post("/forgot-password", "App\Http\Controllers\UserController@forgotPassword");
Route::middleware('auth:sanctum')->post("/register", "App\Http\Controllers\UserController@register");

// Route to handle notes for a specific client
Route::middleware(['auth:sanctum', 'checkRole:doctor,administrator'])->group(function() {
    Route::prefix('/clients/{client_id}')->group(function () {
        Route::post('/notes', 'App\Http\Controllers\NoteController@store');
        Route::get('/notes', 'App\Http\Controllers\NoteController@index');
        Route::put('/notes/{note}', 'App\Http\Controllers\NoteController@update');  
        Route::delete('/notes/{note}', 'App\Http\Controllers\NoteController@destroy');
    });
});

Route::middleware(['auth:sanctum', 'checkRole:doctor, administrator'])->group(function() {
    Route::prefix('/agenda')->group(function () {
        Route::post('/agenda','App\Http\Controllers\ConsultController@store');
        Route::get('/agenda','App\Http\Controllers\ConsultController@index');
        Route::put('/agenda/{consult}','App\Http\Controllers\ConsultController@update');
        Route::delete('/agenda/{consult}', 'App\Http\Controllers\ConsultController@destroy');
    });
});

Route::middleware(['auth:sanctum', 'checkRole:manager'])->group(function() {
    Route::prefix('/whitelist')->group(function () {
        Route::post('/whitelist','App\Http\Controllers\WhitelistController@store');
        Route::get('/whitelist','App\Http\Controllers\WhitelistController@getAllWhitelistedEmails');
        Route::delete('/whitelist/{whitelist}', 'App\Http\Controllers\WhitelistController@destroy');
    });
});