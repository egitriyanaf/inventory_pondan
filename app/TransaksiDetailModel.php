<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetailModel extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
    	'item_barang',
    	'qty',
    	'unit_price',
    	'disc',
    	'tax',
    	'amount',
        'kode_transaksi'
    ];
    public $timestamps = false;
    public $incrementing = false;
}
