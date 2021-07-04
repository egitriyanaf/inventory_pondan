<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratJalanModel extends Model
{
    protected $table = 'surat_jalan';
    protected $primarykey = 'id';
    protected $fillable = ['delivery_no','delivery_date','po_no','ship_via','desc','bill_to','id_pelanggan'];
    public $timestamps = false;
}
