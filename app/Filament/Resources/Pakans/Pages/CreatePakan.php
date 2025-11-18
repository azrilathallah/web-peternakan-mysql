<?php

namespace App\Filament\Resources\Pakans\Pages;

use App\Filament\Resources\Pakans\PakanResource;
use App\Models\Kandang;
use Filament\Resources\Pages\CreateRecord;

class CreatePakan extends CreateRecord
{
    protected static string $resource = PakanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $kandang = Kandang::find($data['kandang_id']);

        $data['konsumsi_pakan'] = ($data['pemberian_pakan'] - $data['sisa_pakan']) / $kandang->populasi;

        return $data;
    }
}
