<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduksiTelur extends Model
{
    protected $table = 'produksi_telur';
    protected $primaryKey = 'id_produksi';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'telur_ok','telur_bs', 'total_telur', 'berat', 'rata_rata', 'kandang_id'];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'kandang_id', 'id_kandang');
    }

    protected static function booted()
    {
        static::saving(function ($telur) {
            $telur->total_telur = $telur->telur_ok + $telur->telur_bs;

            if ($telur->total_telur > 0) {
                $telur->rata_rata = ($telur->berat * 1000) / $telur->total_telur;
            } else {
                $telur->rata_rata = 0;
            }
        });
    }
}
