<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatuanModel extends Model
{
    protected $table = 'satuan';
    protected $primarykey = 'id';
    protected $fillable = ['satuan'];
    public $timestamps = false;
}
