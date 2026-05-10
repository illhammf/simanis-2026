<?php

namespace App\Filament\Guru\Resources\InputNilaiResource\Pages;

use App\Filament\Guru\Resources\InputNilaiResource;
use App\Models\Teacher;
use Filament\Resources\Pages\CreateRecord;

class CreateInputNilai extends CreateRecord
{
    protected static string $resource = InputNilaiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();
        $data['teacher_id'] = $teacher?->id;
        return $data;
    }
}