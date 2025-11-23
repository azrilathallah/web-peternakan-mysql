<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mortalitas extends Model
{
    protected $table = 'mortalitas';
    protected $primaryKey = 'id_mortalitas';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'jumlah_mati', 'penyebab', 'kandang_id'];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'kandang_id', 'id_kandang');
    }

    protected static function booted()
    {
        static::created(function ($mortalitas) {
            $kandang = $mortalitas->kandang;

            if ($kandang) {
                $kandang->jumlah_puyuh = max(0, $kandang->jumlah_puyuh - $mortalitas->jumlah_mati);
                $kandang->save();
            }
        });

        static::updated(function ($mortalitas) {
            $kandang = $mortalitas->kandang;

            if ($kandang) {
                $difference = $mortalitas->jumlah_mati - $mortalitas->getOriginal('jumlah_mati');

                $kandang->jumlah_puyuh = max(0, $kandang->jumlah_puyuh - $difference);
                $kandang->save();
            }
        });

        static::deleted(function ($mortalitas) {
            $kandang = $mortalitas->kandang;

            if ($kandang) {
                $kandang->jumlah_puyuh += $mortalitas->jumlah_mati;
                $kandang->save();
            }
        });
    }
}
