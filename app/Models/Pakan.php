<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pakan extends Model
{
    protected $table = 'pakan';
    protected $primaryKey = 'id_pakan';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'konsumsi_pakan', 'pemberian_pakan', 'sisa_pakan', 'kandang_id'];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'kandang_id', 'id_kandang');
    }

    protected static function booted()
    {
        static::saving(function ($pakan) {
            $jumlah_puyuh = $pakan->kandang->jumlah_puyuh ?? 0;

            $selisih = $pakan->pemberian_pakan - $pakan->sisa_pakan;

            if ($jumlah_puyuh > 0) {
                $pakan->konsumsi_pakan = $selisih / $jumlah_puyuh;
            } else {
                $pakan->konsumsi_pakan = 0;
            }
        });
    }
}
