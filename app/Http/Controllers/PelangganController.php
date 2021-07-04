<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PelangganModel;
use DB;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = PelangganModel::all();
    	$no = 1;

    	return view('pelanggan', [
    		'data' => $data,
    		'no' => $no
    	]);
    }

    public function simpan(Request $r)
    {
    	$tambah = new PelangganModel();
    	$tambah->nama = $r['nama'];
    	$tambah->telp = $r['telp'];
    	$tambah->email = $r['email'];
    	$tambah->alamat = $r['alamat'];
    	$tambah->save();

    	return back()->with('sukses','Tambah data berhasil!');
    }

    public function ubah(Request $r, $id)
    {
    	PelangganModel::where('id',$id)->update([
    		'nama' => $r['nama'],
    		'telp' => $r['telp'],
    		'email' => $r['email'],
    		'alamat' => $r['alamat']
    	]);

    	return back()->with('sukses','Berhasil ubah data!');
    }

    public function hapus($id)
    {
    	PelangganModel::where('id', $id)->delete();

    	return back()->with('sukses','Berhasil hapus data!');
    }
}
