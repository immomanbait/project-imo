<?php

use App\Http\Controllers\admin\HotSpotController;
use App\Http\Controllers\admin\KecamatanController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\KategoriController;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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
    return view('welcome');
});

Route::view('home', 'home')->middleware('auth');

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dataLokasi', [wisataController::class, 'index']);
Route::get('/dataUlasan', [ulasanController::class, 'index']);



Route::post('login-post', [AdminController::class, 'login']);

Route::prefix('administrator')->group(function () {
    // Middleware untuk memastikan hanya admin yang dapat mengakses route ini
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/home', [AdminController::class, 'index']);

    Route::resource('/kategori', KategoriController::class);
    Route::resource('/wisata', WisataController::class);
    Route::resource('/ulasan', UlasanController::class);





        // CRUD Kecamatan
    Route::get('/kecamatan-view', [KecamatanController::class, 'viewKecamatan']);
    Route::match(['get', 'post'], '/kecamatan-add', [KecamatanController::class, 'addKecamatan']);
    Route::match(['get', 'post'], '/kecamatan-edit/{id}', [KecamatanController::class, 'editKecamatan']);
    Route::delete('/kecamatan-del/{id}', [KecamatanController::class, 'delKecamatan']);

        // View Maps
    Route::get('/kecamatan-view-maps', [KecamatanController::class, 'viewMapsKecamatan']);

        // CRUD HotSpot
    Route::get('/hotspot-view', [HotSpotController::class, 'viewHotspot']);
    Route::match(['get', 'post'], '/hotspot-add', [HotSpotController::class, 'addHotspot']);
    Route::delete('/hotspot-del/{id}', [HotSpotController::class, 'delHotspot']);
    Route::match(['get', 'post'], '/hotspot-edit/{id}', [HotSpotController::class, 'editHotspot']);
    Route::get('/hotspot-view-maps', [HotSpotController::class, 'viewMapsHotspot']);
   
    });
});
