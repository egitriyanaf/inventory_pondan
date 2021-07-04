<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;

class PenggunaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = User::all();
    	$no = 1;

    	return view('pengguna', [
    		'data' => $data,
    		'no' => $no
    	]);
    }
    public function simpan(Request $r)
    {
    	User::create([
            'name' => $r['name'],
            'email' => $r['username'],
            'level' => $r['level'],
            'password' => Hash::make($r['password'])
        ]);

    	return back()->with('sukses','Tambah data berhasil!');
    }

    public function ubah(Request $r, $id)
    {
        User::where('id', $id)->update([
            'name' => $r['name'],
            'email' => $r['username'],
            'level' => $r['level']
        ]);

        return back()->with('sukses','Berhasil ubah data!');
    }

    public function hapus($id)
    {
    	User::where('id',$id)->delete();
    	
    	return back()->with('sukses','Hapus data berhasil!');
    }

    public function ubahSandi(Request $r, $id)
    {
        User::where('id', $id)->update([
            'password' => Hash::make($r['password'])
        ]);

        return back()->with('sukses','Berhasil ubah kata sandi!');
    }
}
