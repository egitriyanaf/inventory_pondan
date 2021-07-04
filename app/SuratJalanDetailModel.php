<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratJalanDetailModel extends Model
{
    protected $table = 'surat_jalan_detail';
    protected $primarykey = 'id';
    protected $fillable = ['item','qty','expired_date','serial_number','delivery_no'];
    public $timestamps = false;
}
