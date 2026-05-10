<?php

namespace App\Filament\Akademik\Resources\TahunAjaranResource\Pages;

use App\Filament\Akademik\Resources\TahunAjaranResource;
use App\Models\TahunAjaran;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTahunAjaran extends EditRecord
{
    protected static string $resource = TahunAjaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Jika is_aktif = true, nonaktifkan semua tahun ajaran lain
        if (!empty($data['is_aktif'])) {
            TahunAjaran::query()
                ->where('id', '!=', $this->record->id)
                ->update(['is_aktif' => false]);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}