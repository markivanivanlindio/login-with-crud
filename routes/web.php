<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function (){
    Route::resource('/users', UserController::class);
});

/////////////////////////////////////////////////////////////////////////
Route::get('register-user', [UserController::class, 'region_index']);
Route::post('api/fetch-provinces', [UserController::class, 'fetchProvince']);
Route::post('api/fetch-cities', [UserController::class, 'fetchCity']);
Route::post('api/fetch-barangays', [UserController::class, 'fetchBarangay']);



