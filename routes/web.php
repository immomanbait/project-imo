<?php

use App\Http\Controllers\admin\HotSpotController;
use App\Http\Controllers\admin\KecamatanController;
use App\Http\Controllers\wisataController;
use App\Http\Controllers\admin\ulasanController;
use App\Http\Controllers\admin\kategoriController;

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


    //Cek User
    // if (auth()->user()->hasRole('user')) {
    //   return 'Oke';
    // }


    // Sungkronus atau Update Roles
    // auth()->user()->assignRole('admin', 'user');
    // auth()->user()->syncRoles(['user']);

    //Permision user

    // $user = auth()->user();
    // $role = Role::find(1);
    // dd($user);
    // $user->givePermissionTo('delete post');
    // $role->revokePermissionTo('edit post');
    // $role->syncPermissions(['delete post', 'edit post', 'view post', 'add post']);
    // dd($role->hasAnyPermission(['delete post', 'edit post']));
    // dd($user->can('delete post'));
});

Route::view('home', 'home')->middleware('auth');

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dataLokasi', [wisataController::class, 'index']);
Route::get('/dataUlasan', [ulasanController::class, 'index']);
Route::get('/dataKategori', [kategoriController::class, 'index']);




// Route::group(['middleware' => ['role:admin']], function () {
//     Route::get('/admin', [AdminController::class, 'index']);
//     //
// });

// Route::match(['get', 'post'], '/administrator', 'admin\adminController@login');
Route::post('login-post', [AdminController::class, 'login']);
Route::prefix('administrator')->group(function () {
    // Middleware untuk memastikan hanya admin yang dapat mengakses route ini
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/home', [AdminController::class, 'index']);

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

        // View Maps HotSpot
        Route::get('/hotspot-view-maps', [HotSpotController::class, 'viewMapsHotspot']);
    });
});
