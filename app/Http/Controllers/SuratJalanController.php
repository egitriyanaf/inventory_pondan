<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PelangganModel;
use App\SuratJalanModel;
use App\SuratJalanDetailModel;
use PDF;

class SuratJalanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$no = 1;
    	$data = DB::select("SELECT a.*, b.nama, b.alamat FROM surat_jalan a LEFT JOIN pelanggan b ON a.id_pelanggan = b.id ORDER BY a.delivery_date DESC");
    	$pelanggan = PelangganModel::all();
    	$nomorpo = DB::select("SELECT po_no FROM transaksi GROUP BY po_no ORDER BY po_no DESC");
    	$barang = DB::select("select a.item, a.desc, b.satuan, a.unit_price from barang a inner join satuan b on a.id_satuan = b.id order by a.item");
    	$detail = DB::select("SELECT a.*, b.desc, c.satuan FROM surat_jalan_detail a LEFT JOIN barang b ON a.item = b.item LEFT JOIN satuan c ON b.id_satuan = c.id
        ");

    	return view('surat_jalan', [
    		'data' => $data,
    		'pelanggan' => $pelanggan,
    		'barang' => $barang,
    		'no' => $no,
    		'detail' => $detail,
    		'nomorpo' => $nomorpo
    	]);
    }

    public function simpan(Request $r)
    {
    	$tambah = new SuratJalanModel();
    	$tambah->delivery_no = $r['delivery_no'];
    	$tambah->delivery_date = $r['delivery_date'];
    	$tambah->po_no = $r['po_no'];
    	$tambah->ship_via = $r['ship_via'];
    	$tambah->desc = $r['desc'];
    	$tambah->bill_to = $r['bill_to'];
    	$tambah->id_pelanggan = $r['ship_to'];
    	$tambah->save();

    	for ($i=0; $i < count($r['item']); $i++) {
    		$tambahDetail = new SuratJalanDetailModel(); 
    		$tambahDetail->item = $r['item'][$i];
    		$tambahDetail->qty = $r['qty'][$i];
    		$tambahDetail->expired_date = $r['expired_date'][$i];
    		$tambahDetail->serial_number = $r['serial_number'][$i];
    		$tambahDetail->delivery_no = $r['delivery_no'];
    		$tambahDetail->save();
    	}

    	return back()->with('sukses','Berhasil tambah data!');
    }

    public function hapus($kode)
    {
    
        $del = SuratJalanModel::where('delivery_no', $kode)->delete();
        $del2 = SuratJalanDetailModel::where('delivery_no', $kode)->delete();

        return back()->with('sukses','Berhasil hapus data!');
    }

    public function ubah(Request $r, $kode)
    {
    	SuratJalanModel::where('delivery_no', $kode)->update([
            'delivery_no' => $r['delivery_no'],
	    	'delivery_date' => $r['delivery_date'],
	    	'po_no' => $r['po_no'],
	    	'ship_via' => $r['ship_via'],
	    	'desc' => $r['desc'],
	    	'bill_to' => $r['bill_to'],
	    	'id_pelanggan' => $r['ship_to']
        ]);

        $del = SuratJalanDetailModel::where('delivery_no', $kode)->delete();

        for ($i=0; $i < count($r['item']); $i++) {
    		$tambahDetail = new SuratJalanDetailModel(); 
    		$tambahDetail->item = $r['item'][$i];
    		$tambahDetail->qty = $r['qty'][$i];
    		$tambahDetail->expired_date = $r['expired_date'][$i];
    		$tambahDetail->serial_number = $r['serial_number'][$i];
    		$tambahDetail->delivery_no = $r['delivery_no'];
    		$tambahDetail->save();
    	}

        return back()->with('sukses','Ubah Data Berhasil');
    }

    public function cetakSuratJalan($kode)
    {
    	$data = collect(DB::select("SELECT a.*, b.nama, b.alamat FROM surat_jalan a LEFT JOIN pelanggan b ON a.id_pelanggan = b.id WHERE delivery_no = '".$kode."'"))->first();

    	$detail = DB::select("SELECT a.*, b.desc, c.satuan FROM surat_jalan_detail a LEFT JOIN barang b ON a.item = b.item LEFT JOIN satuan c ON b.id_satuan = c.id where a.delivery_no = '".$kode."'");
    	$no = 1;

    	$total = 0;

    	foreach ($detail as $d) {
    		$total += $d->qty;	
    	}

        $pdf = PDF::loadView('pdf.surat_jalan', [
            'data' => $data,
            'detail' => $detail,
            'total' => $total,
            'no' => $no
        ]);

        return $pdf->stream();
    }
}
