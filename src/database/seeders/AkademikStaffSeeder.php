<?php

namespace Database\Seeders;

use App\Models\AkademikStaff;
use App\Models\User;
use Illuminate\Database\Seeder;

class AkademikStaffSeeder extends Seeder
{
    public function run(): void
    {
        // NIA 3 digit
        $staff = AkademikStaff::updateOrCreate(
            ['name' => 'Staff Akademik'],
            ['nia' => 'NIA-001', 'jabatan' => 'Staff Akademik']
        );

        $user = User::where('username', 'NIA-001')->first();
        if ($user && ! $staff->user_id) {
            $staff->update(['user_id' => $user->id]);
        }
    }
}