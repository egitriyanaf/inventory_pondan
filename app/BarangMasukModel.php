<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $primarykey = 'id';
    protected $fillable = ['kode_barang','qty','tanggal'];
    public $timestamps = false;
}
