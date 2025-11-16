<?php

namespace App\Filament\Resources\Mortalitas\Pages;

use App\Filament\Resources\Mortalitas\MortalitasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMortalitas extends EditRecord
{
    protected static string $resource = MortalitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
