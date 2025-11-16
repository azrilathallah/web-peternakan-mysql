<?php

namespace App\Filament\Resources\Kandangs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KandangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lokasi')
                    ->options(['Kandang_Atas' => 'Kandang  atas', 'Kandang_Bawah' => 'Kandang  bawah'])
                    ->required(),
                TextInput::make('kapasitas')
                    ->required()
                    ->numeric(),
                TextInput::make('populasi')
                    ->required()
                    ->numeric(),
            ]);
    }
}
