<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primarykey = 'kode';
    protected $fillable = [
    	'po_no',
    	'invoice_date',
    	'ship_via',
    	'terms',
    	'due_date',
    	'ship_date',
    	'currency',
    	'no_faktur',
    	'bill_to',
    	'kode_pelanggan',
        'ppn'
    ];
    public $timestamps = false;
    public $incrementing = false;
}
