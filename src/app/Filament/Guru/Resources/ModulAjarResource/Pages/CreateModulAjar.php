<?php

namespace App\Filament\Guru\Resources\ModulAjarResource\Pages;

use App\Filament\Guru\Resources\ModulAjarResource;
use App\Models\Teacher;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Concerns\HasWizard;

class CreateModulAjar extends CreateRecord
{
    use HasWizard;

    protected static string $resource = ModulAjarResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();
        $data['teacher_id'] = $teacher?->id;
        return $data;
    }
}