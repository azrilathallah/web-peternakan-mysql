<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable implements HasName
{
    use Notifiable;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    public $timestamps = false;

    protected $fillable = ['nama', 'username', 'password'];
    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getFilamentName(): string
    {
        return $this->nama;
    }
}
