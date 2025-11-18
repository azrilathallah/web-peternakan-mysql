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
}
