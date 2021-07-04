<?php

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
    return redirect('beranda');
});

// Route::get('/', 'LandingPageController@index');
// Route::get('single_blog', 'SingleBlogController@index');

Auth::routes();

Route::get('beranda', 'BerandaController@index');

//barang
Route::get('barang', 'BarangController@index');
Route::post('simpan_barang', 'BarangController@simpan');
Route::post('ubah_barang/{id}', 'BarangController@ubah');
Route::get('hapus_barang/{id}', 'BarangController@hapus');

Route::get('pelanggan', 'PelangganController@index');
Route::post('simpan_pelanggan', 'PelangganController@simpan');
Route::post('ubah_pelanggan/{id}', 'PelangganController@ubah');
Route::get('hapus_pelanggan/{id}', 'PelangganController@hapus');

Route::get('satuan', 'SatuanController@index');
Route::post('simpan_satuan', 'SatuanController@simpan');
Route::post('ubah_satuan/{id}', 'SatuanController@ubah');
Route::get('hapus_satuan/{id}', 'SatuanController@hapus');

Route::get('pengguna', 'PenggunaController@index');
Route::post('simpan_pengguna', 'PenggunaController@simpan');
Route::post('ubah_pengguna/{id}', 'PenggunaController@ubah');
Route::get('hapus_pengguna/{id}', 'PenggunaController@hapus');
Route::post('ubah_sandi/{id}', 'PenggunaController@ubahSandi');

Route::get('barang_keluar', 'TransaksiController@index');
Route::post('simpan_Transaksi', 'TransaksiController@simpan');
Route::get('hapus_transaksi/{kode}', 'TransaksiController@hapus');
Route::post('update_transaksi/{kode}', 'TransaksiController@update');
Route::get('cetak_faktur_pajak/{kode}', 'TransaksiController@cetakFakturPajak');

Route::get('barang_masuk', 'TransaksiController@barangMasuk');
Route::post('simpan_barang_masuk', 'TransaksiController@simpanBarangMasuk');
Route::get('hapus_barang_masuk/{id}', 'TransaksiController@hapusBarangMasuk');
Route::post('ubah_barang_masuk/{id}', 'TransaksiController@ubahBarangMasuk');

Route::get('surat_jalan', 'SuratJalanController@index');
Route::post('simpan_surat_jalan', 'SuratJalanController@simpan');
Route::get('hapus_surat_jalan/{kode}', 'SuratJalanController@hapus');
Route::post('update_surat_jalan/{kode}', 'SuratJalanController@ubah');
Route::get('cetak_surat_jalan/{kode}', 'SuratJalanController@cetakSuratJalan');
