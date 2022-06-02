<?php

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

Auth::routes([
    'register' => false
]);

//back-end
Route::get('/', 'HomeController@home')->name('home');
Route::get('/daftar', 'HomeController@daftar')->name('daftar');
Route::post('/daftar/simpan', 'HomeController@storeUser')->name('daftar.simpan');
Route::get('/shop', 'HomeController@produk')->name('shop');
Route::get('/tentang', 'HomeController@tentangKami')->name('tentang');
Route::get('/shop/shop-detail/{id}', 'HomeController@produkDetail')->name('shop-detail');
Route::get('/akun-saya', 'HomeController@userAccount')->middleware('auth')->name('akun-saya');
Route::get('/edit-akun', 'HomeController@editProfile')->middleware('auth')->name('edit-akun');
Route::post('/edit-akun', 'HomeController@updateProfile')->middleware('auth')->name('update-akun');
Route::get('/add-ulasan/{id_produk}', 'HomeController@addUlasan')->middleware('auth')->name('add-ulasan');
Route::post('/store-ulasan', 'HomeController@storeUlasan')->middleware('auth')->name('ulasan.store');
Route::get('/transaksi-saya', 'HomeController@transaksi')->middleware('auth')->name('transaksi-saya');
Route::get('/bukti-bayar/{id_trans}', 'HomeController@buktiBayar')->middleware('auth')->name('bukti-bayar');
Route::post('/bukti-bayar/simpan', 'HomeController@buktiBayarStore')->middleware('auth')->name('bukti-bayar.store');
Route::get('/detail-transaksi/{id}', 'HomeController@detailTransaksi')->middleware('auth')->name('detail-transaksi');
Route::get('/dashboard', 'HomeController@dashboard')->middleware('auth')->name('dashboard');


Route::group([
    'prefix' => 'setting',
    'middleware' => ['auth']
], function () {
    Route::get('', [\App\Http\Controllers\Back\SettingController::class, 'index'])->name('setting.index');
    Route::post('setting', [\App\Http\Controllers\Back\SettingController::class, 'store'])->name('setting.store');
});

Route::get('/pegawai', 'Back\PegawaiController@index')->middleware('auth')->name('pegawai');
Route::group([
    'prefix' => 'pegawai',
    'middleware' => 'auth'
], function () {
    Route::get('data', [\App\Http\Controllers\Back\PegawaiController::class, 'data'])->name('pegawai.data');
   /* Route::get('create-multi', [\App\Http\Controllers\Back\PegawaiController::class, 'createMulti'])->name('pegawai.create-multi');
    Route::post('store-multi', [\App\Http\Controllers\Back\PegawaiController::class, 'storeMulti'])->name('pegawai.store-multi');*/
    Route::get('trash', [\App\Http\Controllers\Back\PegawaiController::class, 'trash'])->name('pegawai.trash');
    Route::post('restore/{pegawai}', [\App\Http\Controllers\Back\PegawaiController::class, 'restore'])->name('pegawai.restore');
});
Route::resource('pegawai', 'Back\PegawaiController')->middleware('auth');

Route::get('/kategori', 'Back\KategoriController@index')->middleware('auth')->name('kategori');
Route::group([
    'prefix' => 'kategori',
    'middleware' => 'auth'
], function () {
    Route::get('data', [\App\Http\Controllers\Back\KategoriController::class, 'data'])->name('kategori.data');
    Route::get('trash', [\App\Http\Controllers\Back\KategoriController::class, 'trash'])->name('kategori.trash');
    Route::post('restore/{kategori}', [\App\Http\Controllers\Back\KategoriController::class, 'restore'])->name('kategori.restore');
});
Route::resource('kategori', 'Back\KategoriController')->middleware('auth');

Route::get('/supplier', 'Back\SupplierController@index')->middleware('auth')->name('supplier');
Route::group([
    'prefix' => 'supplier',
    'middleware' => 'auth'
], function () {
    Route::get('data', [\App\Http\Controllers\Back\SupplierController::class, 'data'])->name('supplier.data');
    Route::get('trash', [\App\Http\Controllers\Back\SupplierController::class, 'trash'])->name('supplier.trash');
    Route::post('restore/{supplier}', [\App\Http\Controllers\Back\SupplierController::class, 'restore'])->name('supplier.restore');
});
Route::resource('supplier', 'Back\SupplierController')->middleware('auth');

Route::get('/produk', 'Back\ProdukController@index')->middleware('auth')->name('produk');
Route::group([
    'prefix' => 'produk',
    'middleware' => 'auth'
], function () {
    Route::get('data', [\App\Http\Controllers\Back\ProdukController::class, 'data'])->name('produk.data');
    Route::get('data-dashboard', [\App\Http\Controllers\Back\ProdukController::class, 'dataDashboard'])->name('produk.data-dashboard');
    Route::get('trash', [\App\Http\Controllers\Back\ProdukController::class, 'trash'])->name('produk.trash');
    Route::post('restore/{produk}', [\App\Http\Controllers\Back\ProdukController::class, 'restore'])->name('produk.restore');
});
Route::resource('produk', 'Back\ProdukController')->middleware('auth');

Route::get('/keranjang', 'KeranjangController@index')->middleware('auth')->name('keranjang');
Route::group([
    'prefix' => 'keranjang',
    'middleware' => 'auth'
], function () {
    Route::get('checkout', [\App\Http\Controllers\KeranjangController::class, 'checkout'])->name('keranjang.checkout');
    Route::get('data', [\App\Http\Controllers\KeranjangController::class, 'data'])->name('keranjang.data');
    Route::get('trash', [\App\Http\Controllers\KeranjangController::class, 'trash'])->name('keranjang.trash');
    Route::get('hapus/{id}', [\App\Http\Controllers\KeranjangController::class, 'hapus'])->name('keranjang.hapus');
    Route::post('restore/{keranjang}', [\App\Http\Controllers\KeranjangController::class, 'restore'])->name('keranjang.restore');
});
Route::resource('keranjang', 'KeranjangController')->middleware('auth');

Route::get('/transaksi', 'Back\TransaksiController@index')->middleware('auth')->name('transaksi');
Route::group([
    'prefix' => 'transaksi',
    'middleware' => 'auth'
], function () {
    Route::get('laporan', [\App\Http\Controllers\Back\TransaksiController::class, 'cetakLaporan'])->name('transaksi.laporan');
    Route::get('data', [\App\Http\Controllers\Back\TransaksiController::class, 'data'])->name('transaksi.data');
    Route::get('trash', [\App\Http\Controllers\Back\TransaksiController::class, 'trash'])->name('transaksi.trash');
    Route::post('restore/{transaksi}', [\App\Http\Controllers\Back\TransaksiController::class, 'restore'])->name('transaksi.restore');
});
Route::resource('transaksi', 'Back\TransaksiController')->middleware('auth');

Route::get('/pembelian', 'Back\PembelianController@index')->middleware('auth')->name('pembelian');
Route::group([
    'prefix' => 'pembelian',
    'middleware' => 'auth'
], function () {
    Route::get('laporan', [\App\Http\Controllers\Back\PembelianController::class, 'cetakLaporan'])->name('pembelian.laporan');
    Route::get('data', [\App\Http\Controllers\Back\PembelianController::class, 'data'])->name('pembelian.data');
    Route::get('trash', [\App\Http\Controllers\Back\PembelianController::class, 'trash'])->name('pembelian.trash');
    Route::post('restore/{pembelian}', [\App\Http\Controllers\Back\PembelianController::class, 'restore'])->name('pembelian.restore');
});
Route::resource('pembelian', 'Back\PembelianController')->middleware('auth');





