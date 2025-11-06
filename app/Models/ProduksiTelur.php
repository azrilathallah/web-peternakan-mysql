<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduksiTelur extends Model
{
    protected $table = 'produksi_telur';
    protected $primaryKey = 'id_produksi';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'jumlah_telur'];
}
