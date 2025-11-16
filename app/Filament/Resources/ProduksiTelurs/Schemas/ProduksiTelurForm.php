<?php

namespace App\Filament\Resources\ProduksiTelurs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProduksiTelurForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('jumlah_telur')
                    ->tel()
                    ->required()
                    ->numeric(),
            ]);
    }
}
