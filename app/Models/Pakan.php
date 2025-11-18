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
}
