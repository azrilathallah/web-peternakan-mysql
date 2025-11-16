<?php

namespace App\Filament\Resources\Pakans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PakanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('jumlah_pakan')
                    ->required()
                    ->numeric(),
                TextInput::make('penggunaan_pakan')
                    ->required()
                    ->numeric(),
                TextInput::make('sisa_pakan')
                    ->required()
                    ->numeric(),
            ]);
    }
}
