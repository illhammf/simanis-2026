<?php

namespace App\Filament\Akademik\Resources\TahunAjaranResource\Pages;

use App\Filament\Akademik\Resources\TahunAjaranResource;
use App\Models\TahunAjaran;
use Filament\Resources\Pages\CreateRecord;

class CreateTahunAjaran extends CreateRecord
{
    protected static string $resource = TahunAjaranResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika is_aktif = true, nonaktifkan semua tahun ajaran lain
        if (!empty($data['is_aktif'])) {
            TahunAjaran::query()->update(['is_aktif' => false]);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}