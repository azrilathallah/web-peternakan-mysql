<?php

namespace App\Filament\Resources\Pakans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PakanForm
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
                TextInput::make('pemberian_pakan')
                    ->required()
                    ->numeric(),
                TextInput::make('sisa_pakan')
                    ->required()
                    ->numeric(),
            ]);
    }
}
