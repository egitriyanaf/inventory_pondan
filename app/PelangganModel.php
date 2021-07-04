<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primarykey = 'id';
    protected $fillable = ['nama','alamat','telp','email'];
    public $timestamps = false;
}
