<?php

namespace App\Filament\Resources\Pakans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PakansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kandang.lokasi')
                    ->label('Kandang')
                    ->sortable(),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('pemberian_pakan')
                    ->label('Pemberian Pakan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sisa_pakan')
                    ->label('Sisa Pakan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('konsumsi_pakan')
                    ->label('Konsumsi Pakan')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
