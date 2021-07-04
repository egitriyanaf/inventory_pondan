<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BarangModel;
use App\PelangganModel;
use App\SatuanModel;
use App\TransaksiModel;
use App\BarangMasukModel;
use App\SuratJalanModel;


class BerandaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $barang = BarangModel::all();
        $pelanggan = PelangganModel::all();
        $satuan = SatuanModel::all();
        $transaksi = TransaksiModel::all();
        $barangMasuk = BarangMasukModel::all();
        $suratJalan = SuratJalanModel::all();
        $pengguna = User::all();
        
        return view('beranda', [
            'barang' => $barang,
            'satuan' => $satuan,
            'transaksi' => $transaksi,
            'barangMasuk' => $barangMasuk,
            'suratJalan' => $suratJalan,
            'pengguna' => $pengguna,
            'pelanggan' => $pelanggan
        ]);
    }
}
