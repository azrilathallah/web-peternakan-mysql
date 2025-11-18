<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduksiTelur extends Model
{
    protected $table = 'produksi_telur';
    protected $primaryKey = 'id_produksi';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'jumlah_telur', 'kandang_id'];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'kandang_id', 'id_kandang');
    }
}
