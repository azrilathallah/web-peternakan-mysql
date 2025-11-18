<?php

namespace App\Filament\Resources\Laporans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class LaporanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('periode')
                    ->options(['Harian' => 'Harian', 'Mingguan' => 'Mingguan', 'Bulanan' => 'Bulanan', '' => ''])
                    ->required(),
            ]);
    }
}
