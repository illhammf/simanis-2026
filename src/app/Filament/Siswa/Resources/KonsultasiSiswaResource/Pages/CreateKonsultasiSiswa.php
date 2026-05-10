<?php

namespace App\Filament\Siswa\Resources\KonsultasiSiswaResource\Pages;

use App\Filament\Siswa\Resources\KonsultasiSiswaResource;
use App\Models\Student;
use Filament\Resources\Pages\CreateRecord;

class CreateKonsultasiSiswa extends CreateRecord
{
    protected static string $resource = KonsultasiSiswaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $student = Student::where('user_id', auth()->id())->first();

        // Auto-assign wali kelas sebagai penerima
        $teacher = $student?->kelas?->waliKelas;

        $data['student_id'] = $student?->id;
        $data['teacher_id'] = $teacher?->id;
        $data['status']     = 'pending';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}