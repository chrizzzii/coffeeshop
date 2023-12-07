<?php

use App\Http\Controllers\Welcome;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Pesanan;
use App\Http\Controllers\User;

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

Route::get('/', [Welcome::class, 'index']);
Route::get('/about', [Welcome::class, 'about']);


Route::get('/loginadmin', [Admin::class, 'showLoginForm']);
Route::post('/loginadmin', [Admin::class, 'login']);

Route::get('/admin/dashboardadmin', [Admin::class, 'showDashboard']);
Route::get('/admin/dashboardadminsoftdelete', [Admin::class, 'showSoftdelete']);
Route::get('/admin/logout', [Admin::class, 'logout']);

Route::get('/admin/tambahproduk', [Admin::class, 'tambahproduk']);
Route::post('/admin/simpanproduk', [Admin::class, 'simpanproduk']);

Route::get('/admin/editproduk/{id}', [Admin::class, 'editProduct']);
Route::post('/admin/updateproduct/{id}', [Admin::class, 'updateProduct']);

Route::get('/admin/softdelete/{id}', [Admin::class, 'softdelete']);
Route::get('/admin/restore/{id}', [Admin::class, 'restore']);
Route::get('/admin/harddelete/{id}', [Admin::class, 'harddelete']);



Route::get('/pengguna/tambahuser', [User::class, 'tambahuser']);
Route::post('/pengguna/terimauser', [User::class, 'terimauser']);

Route::get('/loginuser', [User::class, 'showLoginForm']);
Route::post('/loginuser', [User::class, 'login']);
Route::post('/user/hapususer', [User::class, 'hapususer']);

Route::get('/user/edituser', [User::class, 'showEditForm']);
Route::post('/user/edituser', [User::class, 'editUser']);

Route::get('/user/dashboarduser', [User::class, 'showDashboard']);
Route::get('/user/logout', [User::class, 'logout']);


Route::get('/order/createpesanan', [Pesanan::class, 'showCreatePesananForm']);
Route::post('/order/tambahpesanan', [Pesanan::class, 'tambahPesanan']);
Route::post('/order/hapuspesanan', [Pesanan::class, 'hapusPesanan']);
