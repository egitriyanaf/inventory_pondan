<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarangModel;
use App\PelangganModel;
use App\TransaksiModel;
use App\TransaksiDetailModel;
use App\BarangMasukModel;
use DB;
use PDF;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = TransaksiModel::all();
        
        $detail = DB::select("SELECT a.*, b.desc, c.satuan FROM transaksi_detail a LEFT JOIN barang b ON a.item_barang = b.item LEFT JOIN satuan c ON b.id_satuan = c.id
        ");
        
        $barang = DB::select("select a.item, a.desc, b.satuan, a.unit_price from barang a inner join satuan b on a.id_satuan = b.id order by a.item");
        $pelanggan = PelangganModel::all();
    	$no = 1;

    	return view('transaksi', [
    		'data' => $data,
            'barang' => $barang,
            'pelanggan' => $pelanggan,
            'detail' => $detail,
    		'no' => $no
    	]);
    }

    public function simpan(Request $r)
    {

        $tambah = new TransaksiModel();
        $tambah->kode = $r['invoice_number']; 
        $tambah->po_no = $r['po_number']; 
        $tambah->invoice_date = $r['invoice_date']; 
        $tambah->ship_via = $r['ship_via']; 
        $tambah->terms = $r['terms']; 
        $tambah->due_date = $r['due_date']; 
        $tambah->ship_date = $r['ship_date']; 
        $tambah->currency = $r['currency']; 
        $tambah->no_faktur = $r['faktur_pajak']; 
        $tambah->bill_to = $r['bill_to']; 
        $tambah->kode_pelanggan = $r['ship_to'];
        $tambah->ppn = $r['ppn'];
        $tambah->save();


        for ($i=0; $i < count($r['item']); $i++) { 
            $tambahDetail = new TransaksiDetailModel();       
            $tambahDetail->item_barang = $r['item'][$i];        
            $tambahDetail->qty = $r['qty'][$i];        
            $tambahDetail->unit_price = $r['unit_price'][$i];        
            $tambahDetail->disc = $r['disc'][$i];        
            $tambahDetail->tax = $r['tax'][$i];        
            $tambahDetail->amount = $r['amount'][$i];        
            $tambahDetail->kode_transaksi = $r['invoice_number'];        
            $tambahDetail->save();        
        }

        return back()->with('sukses','Tambah Data Berhasil');
    }

    public function hapus($kode)
    {
        // $data = collect(DB::select("select * from transaksi where kode = '".$kode."'"))->first();

        $del = TransaksiModel::where('kode', $kode)->delete();
        $del2 = TransaksiDetailModel::where('kode_transaksi', $kode)->delete();

        return back()->with('sukses','Berhasil hapus data!');
    }

    public function update(Request $r, $kode)
    {
        TransaksiModel::where('kode', $kode)->update([
            'kode' => $r['invoice_number'], 
            'po_no' => $r['po_number'], 
            'invoice_date' => $r['invoice_date'], 
            'ship_via' => $r['ship_via'], 
            'terms' => $r['terms'], 
            'due_date' => $r['due_date'], 
            'ship_date' => $r['ship_date'], 
            'currency' => $r['currency'], 
            'no_faktur' => $r['faktur_pajak'], 
            'bill_to' => $r['bill_to'], 
            'kode_pelanggan' => $r['ship_to'],
            'ppn' => $r['ppn']
        ]);

        $del = TransaksiDetailModel::where('kode_transaksi', $kode)->delete();

        for ($i=0; $i < count($r['item']); $i++) { 
            $tambahDetail = new TransaksiDetailModel();
                    
            $tambahDetail->item_barang = $r['item'][$i];        
            $tambahDetail->qty = $r['qty'][$i];        
            $tambahDetail->unit_price = $r['unit_price'][$i];        
            $tambahDetail->disc = $r['disc'][$i];        
            $tambahDetail->tax = $r['tax'][$i];        
            $tambahDetail->amount = $r['amount'][$i];        
            $tambahDetail->kode_transaksi = $r['invoice_number'];        
            $tambahDetail->save();        
        }

        return back()->with('sukses','Ubah Data Berhasil');
    }

    public function cetakFakturPajak($kode)
    {
        $no = 1;

        $data = collect(\DB::select("SELECT a.*, b.nama, b.alamat FROM transaksi a LEFT JOIN pelanggan b ON a.kode_pelanggan = b.id where a.kode = '".$kode."'"))->first();

        $detail = DB::select("SELECT a.*, b.item, b.desc, c.satuan FROM transaksi_detail a LEFT JOIN barang b ON a.item_barang = b.item LEFT JOIN satuan c ON b.id_satuan = c.id where a.kode_transaksi = '".$kode."'");

        $subtotal = 0;
        $disc = 0;

        foreach ($detail as $d) {
            $subtotal += $d->amount;
            $disc += $d->disc;
        }

        $disc = ($disc * 0.01) * $subtotal;
        $totsubdisc = $subtotal - $disc;


        $pdf = PDF::loadView('pdf.faktur_pajak', [
            'data' => $data, 
            'detail' => $detail, 
            'no' => $no,
            'subtotal' => $subtotal,
            'disc' => $disc,
            'totsubdisc' => $totsubdisc
        ]);

        return $pdf->stream();
    }

    public function barangMasuk()
    {
        $data = DB::select("SELECT a.*, b.desc, c.satuan FROM barang_masuk a LEFT JOIN barang b ON a.kode_barang = b.item LEFT JOIN satuan c ON b.id_satuan = c.id ORDER BY a.tanggal");
        $barang = DB::select("select a.item, a.desc, b.satuan, a.unit_price from barang a inner join satuan b on a.id_satuan = b.id order by a.item");
        $no = 1;

        return view('barang_masuk', [
            'data' => $data,
            'no' => $no,
            'barang' => $barang
        ]);
    }

    public function simpanBarangMasuk(Request $r)
    {
        $tambah = new BarangMasukModel();
        $tambah->kode_barang = $r['nama_barang'];
        $tambah->qty = $r['qty'];
        $tambah->tanggal = $r['tanggal'];
        $tambah->save();

        $getBarang = collect(DB::select("select * from barang where item = '".$r['nama_barang']."'"))->first();

        $new_qty = $r['qty'] + $getBarang->qty;
        ;
        BarangModel::where('item', $r['nama_barang'])->update([
            'qty' => $new_qty, 
        ]);

        return back()->with('sukses','Tambah data berhasil!');
    }

    public function hapusBarangMasuk($id)
    {
        $getBarangMasuk = collect(DB::select("select * from barang_masuk where id = '".$id."'"))->first();
        $getBarang = collect(DB::select("select * from barang where item = '".$getBarangMasuk->kode_barang."'"))->first();
        
        $new_qty = $getBarang->qty - $getBarangMasuk->qty;

        BarangModel::where('item', $getBarangMasuk->kode_barang)->update([
            'qty' => $new_qty
        ]);

        $del = BarangMasukModel::where('id', $id)->delete();

        return back()->with('sukses','Berhasil hapus data!');
    }

    public function ubahBarangMasuk(Request $r, $id)
    {

        $getBarangMasuk = collect(DB::select("select * from barang_masuk where id = '".$id."'"))->first();
        $getBarang = collect(DB::select("select * from barang where item = '".$getBarangMasuk->kode_barang."'"))->first();

        $temp_qty = $getBarang->qty - $getBarangMasuk->qty;
        $new_qty = $temp_qty + $r['qty'];

        BarangModel::where('item', $getBarangMasuk->kode_barang)->update([
            'qty' => $new_qty
        ]);

        BarangMasukModel::where('id', $id)->update([
            'kode_barang' => $r['nama_barang'],
            'qty' => $r['qty']
        ]);

        return back()->with('sukses','Berhasil ubah data!');
    }
}
