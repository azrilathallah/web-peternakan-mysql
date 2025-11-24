<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'periode',
        'data_laporan',
    ];

    protected $casts = [
        'data_laporan' => 'array',
    ];
}
