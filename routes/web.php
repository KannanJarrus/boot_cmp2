<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
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
    return view('welcome');
});

Route::get('login', function(){
    return view('login');
});

Route::post('user', [loginController::class,'login']);
Route::get('profile',function(){
    return view('profile');
});

Route::get('logout',[logoutController::class,'logout']);

Route::get('crud', [CRUDController::class, 'index']);
Route::get('crud/create', [CRUDController::class, 'create']);
Route::post('crud', [CRUDController::class, 'index']);
Route::get('crud/{id}', [CRUDController::class, 'show']);
Route::get('crud/{id}/edit', [CRUDController::class, 'edit']);
Route::delete('crud/{id}', [CRUDController::class, 'destroy']);
Route::post('crud/flash', [CRUDController::class, 'flash']);
