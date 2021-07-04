<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarangModel;
use App\SatuanModel;
use DB;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = DB::select("select a.*, b.satuan from barang a left join satuan b on a.id_satuan = b.id order by a.id desc");
    	$satuan = SatuanModel::all()->sortBy('satuan');
    	$no = 1;

    	return view('barang', [
    		'data' => $data,
    		'satuan' => $satuan,
    		'no' => $no
    	]);
    }

    public function simpan(Request $r)
    {
    	$tambah = new BarangModel();
    	$tambah->item = $r['item'];
    	$tambah->desc = $r['deskripsi'];
    	$tambah->qty = $r['qty'];
    	$tambah->id_satuan = $r['satuan'];
    	$tambah->unit_price = $r['harga'];
    	// $tambah->disc = $r['disc'];
    	// $tambah->tax = $r['tax'];
    	// $tambah->amount = $r['amount'];
    	$tambah->save();

    	return back()->with('sukses','Berhasil tambah data!');
    }

    public function ubah(Request $r, $id)
    {
    	BarangModel::where('id', $id)->update([
	        'item' => $r['item'],
	        'desc' => $r['deskripsi'],
	        'qty' => $r['qty'],
	        'id_satuan' => $r['satuan'],
	        'unit_price' => $r['harga']
	    ]);

	    return back()->with('sukses','Berhasil ubah data!');
    }

    public function hapus($id)
    {
        $del = BarangModel::where('id', $id)->delete();

        return back()->with('sukses','Berhasil hapus data!');
    }
}
