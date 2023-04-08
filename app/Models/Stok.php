<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table="stok";
    protected $primarykey="id";
    protected $fillable=['id','nama_barang','jumlah_barang','stok_awal','stok_akhir'];
    public $timestamps = false;
}

