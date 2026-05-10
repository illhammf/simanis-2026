<?php

namespace App\Filament\Siswa\Pages;

use App\Models\Student;
use Filament\Pages\Page;

class LearningPathPage extends Page
{
    protected static ?string $navigationLabel = 'Learning Pathway';
    protected static ?string $navigationIcon  = 'heroicon-o-map';
    protected static ?int    $navigationSort  = 6;
    protected static string  $view            = 'filament.siswa.pages.learning-path';

    public function getViewData(): array
    {
        /** @var Student|null $student */
        $student = Student::where('user_id', auth()->id())
            ->with(['stream.milestones', 'kelas.tahunAjaran'])
            ->first();

        $currentSem = $this->getCurrentSemester($student);

        return compact('student', 'currentSem');
    }

    private function getCurrentSemester(?Student $student): int
    {
        if (! $student || ! $student->kelas) {
            return 1;
        }

        $kelasNama = $student->kelas->nama ?? '';

        // Ambil angka dari nama kelas (7A, 8B, 10 IPA 1 → 7,8,10)
        preg_match('/(\d+)/', $kelasNama, $m);
        $grade = (int) ($m[1] ?? 0);

        // Semester ganjil awal tiap jenjang
        $base = match (true) {
            in_array($grade, [7, 10])  => 1,
            in_array($grade, [8, 11])  => 3,
            in_array($grade, [9, 12])  => 5,
            default                    => 1,
        };

        // Deteksi genap dari tahun ajaran
        $taName  = strtolower($student->kelas->tahunAjaran?->nama ?? '');
        $isGenap = str_contains($taName, 'genap') || str_contains($taName, 'semester 2')
                   || str_contains($taName, 'sem 2');

        return $isGenap ? $base + 1 : $base;
    }
}