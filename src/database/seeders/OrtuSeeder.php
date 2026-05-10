<?php

namespace Database\Seeders;

use App\Models\Ortu;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrtuSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::where('nis', 'NIS-000001')->first();

        // NIO 5 digit
        $ortu = Ortu::updateOrCreate(
            ['email' => 'ortu@admin.com'],
            [
                'nio'        => 'NIO-00001',
                'name'       => 'Soleman',
                'phone'      => '081234567890',
                'student_id' => $student?->id,
            ]
        );

        $user = User::where('username', 'NIO-00001')->first();
        if ($user && ! $ortu->user_id) {
            $ortu->update(['user_id' => $user->id]);
        }
    }
}