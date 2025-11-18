<?php

namespace App\Filament\Resources\Mortalitas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MortalitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kandang_id')
                    ->label('Kandang')
                    ->relationship('kandang', 'lokasi') 
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('jumlah_mati')
                    ->required()
                    ->numeric(),
                TextInput::make('penyebab')
                    ->required(),
            ]);
    }
}
