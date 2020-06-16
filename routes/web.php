<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect('login');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');
    
    Route::get('/chart', 'HomeController@getChartData');
    Route::get('/profile', 'HomeController@profile');
    Route::post('/profile', 'HomeController@updateProfile');

    Route::get('/setting', 'HomeController@setting');
    Route::post('/setting', 'HomeController@updateSetting');
    
    Route::group(['middleware' => 'permission:produk_show'], function () {
        Route::get('/produk', 'ProdukController@index');
        Route::get('/produk/tambah', 'ProdukController@tambah')->middleware('permission:produk_add');
        Route::post('/produk', 'ProdukController@simpan');
        Route::put('/produk/{id}', 'ProdukController@update')->middleware('permission:produk_edit');
        Route::get('/produk/{id}', 'ProdukController@edit');
        Route::get('/produkharga/{id}', 'ProdukController@formharga');
        Route::put('/produkharga/{id}', 'ProdukController@tambahharga');
        Route::delete('/produk/{id}', 'ProdukController@hapus')->middleware('permission:produk_delete');;
        Route::delete('/produkharga/{id}', 'ProdukController@hapusHarga');
    });
   
    Route::group(['middleware' => 'permission:transaksi_show'], function () {
        Route::get('/transaksi', 'TransaksiController@index');
        Route::post('/transaksi', 'TransaksiController@saveTransaksi');
        Route::get('/transaksi/{id}', 'TransaksiController@detailTransaksi');
        Route::get('/transaksi/proses/{id}', 'TransaksiController@prosesTransaksi');
        Route::get('/transaksi/pengembalian/{id}', 'TransaksiController@prosesPengembalian');
        Route::get('/transaksi/pembatalan/{id}', 'TransaksiController@prosesPembatalan');
        Route::get('/transaksi/print/{id}', 'TransaksiController@printTransaksi');
        Route::delete('/transaksi/hapus/{id}', 'TransaksiController@hapusTransaksi');
    });

    Route::get('/form-transaksi', 'TransaksiController@formTransaksi')->middleware('can:transaksi_add');
    
    Route::get('/laporan', 'LaporanController@index');
    Route::post('/laporan', 'LaporanController@generatePDF');

    Route::resource('user', 'UserController');

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index');
        Route::post('/', 'RoleController@add');
        Route::delete('/{id}', 'RoleController@delete');
        Route::get('/permission/{id}', 'RoleController@showPermission');
        Route::put('/permission/{id}', 'RoleController@assignPermissionToRole');
        Route::post('/permission', 'RoleController@addNewPermission');
    });


    Route::resource('pelanggan', 'PelangganController')->except(['show', 'update', 'create'])->middleware('permission:pelanggan_show');
});
