<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primarykey = 'id';
    protected $fillable = ['item','desc','qty','id_satuan','unit_price','disc','tax','amount'];
    public $timestamps = false;
}
