<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AkademikRolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'akademik']);

        // Resource models yang boleh diakses penuh oleh akademik
        // Nama permission sesuai Shield (CamelCase → lowercase::word)
        $models = [
            'teacher',                      // GuruResource (model Teacher)
            'student',                      // SiswaResource (model Student)
            'ortu',
            'akademik::staff',
            'kelas',
            'tahun::ajaran',
            'mata::pelajaran',
            'stream',
            'kurikulum',
            'capaian::pembelajaran',
            'alur::tujuan::pembelajaran',
            'tujuan::pembelajaran',
            'modul::ajar',
            'tugas',
            'ruangan',
            'jadwal::pelajaran',
        ];

        $actions = ['view', 'view_any', 'create', 'update', 'delete', 'delete_any', 'restore', 'restore_any', 'force_delete', 'force_delete_any', 'reorder'];

        $permissionNames = [];
        foreach ($models as $model) {
            foreach ($actions as $action) {
                $permissionNames[] = "{$action}_{$model}";
            }
        }

        // Buat permission yang belum ada, lalu assign semua ke role akademik
        foreach ($permissionNames as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        $permissions = Permission::whereIn('name', $permissionNames)->where('guard_name', 'web')->get();
        $role->syncPermissions($permissions);

        $this->command->info("Assigned " . $permissions->count() . " permissions to role 'akademik'");
    }
}