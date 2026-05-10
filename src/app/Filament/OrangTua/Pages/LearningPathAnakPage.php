<?php

namespace App\Filament\OrangTua\Pages;

use App\Models\Ortu;
use App\Models\Student;
use Filament\Pages\Page;

class LearningPathAnakPage extends Page
{
    protected static ?string $navigationLabel = 'Learning Pathway Anak';
    protected static ?string $navigationIcon  = 'heroicon-o-map';
    protected static ?int    $navigationSort  = 5;
    protected static string  $view            = 'filament.ortu.pages.learning-path-anak';

    public function getViewData(): array
    {
        $ortu  = Ortu::where('user_id', auth()->id())->first();

        /** @var Student|null $student */
        $student = $ortu?->siswa;

        if ($student) {
            $student->load(['stream.milestones', 'kelas.tahunAjaran']);
        }

        $currentSem = $this->getCurrentSemester($student);

        return compact('student', 'currentSem');
    }

    private function getCurrentSemester(?Student $student): int
    {
        if (! $student || ! $student->kelas) {
            return 1;
        }

        $kelasNama = $student->kelas->nama ?? '';

        preg_match('/(\d+)/', $kelasNama, $m);
        $grade = (int) ($m[1] ?? 0);

        $base = match (true) {
            in_array($grade, [7, 10])  => 1,
            in_array($grade, [8, 11])  => 3,
            in_array($grade, [9, 12])  => 5,
            default                    => 1,
        };

        $taName  = strtolower($student->kelas->tahunAjaran?->nama ?? '');
        $isGenap = str_contains($taName, 'genap') || str_contains($taName, 'semester 2')
                   || str_contains($taName, 'sem 2');

        return $isGenap ? $base + 1 : $base;
    }
}