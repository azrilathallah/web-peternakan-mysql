<?php

namespace App\Filament\Resources\Pakans\Pages;

use App\Filament\Resources\Pakans\PakanResource;
use App\Models\Kandang;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPakan extends EditRecord
{
    protected static string $resource = PakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $kandang = Kandang::find($data['kandang_id']);

        $data['konsumsi_pakan'] = ($data['pemberian_pakan'] - $data['sisa_pakan']) / $kandang->populasi;

        return $data;
    }
}
