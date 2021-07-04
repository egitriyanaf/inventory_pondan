<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SatuanModel;
use DB;

class SatuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = SatuanModel::all();
    	$no = 1;

    	return view('satuan', [
    		'data' => $data,
    		'no' => $no
    	]);
    }

    public function simpan(Request $r)
    {
    	$tambah = new SatuanModel();
    	$tambah->satuan = $r['satuan'];
    	$tambah->save();

    	return back()->with('sukses','Simpan data berhasil!');
    }

    public function ubah(Request $r, $id)
    {
    	SatuanModel::where('id',$id)->update([
    		'satuan' => $r['satuan']
    	]);

    	return back()->with('sukses','Ubah data berhasil!');
    }

    public function hapus($id)
    {
    	SatuanModel::where('id', $id)->delete();
    	
    	return back()->with('sukses','Hapus data berhasil!');
    }
}
