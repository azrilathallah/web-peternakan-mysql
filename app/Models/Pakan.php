<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pakan extends Model
{
    protected $table = 'pakan';
    protected $primaryKey = 'id_pakan';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'jumlah_pakan', 'penggunaan_pakan', 'sisa_pakan'];
}
