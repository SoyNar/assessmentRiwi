<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $patient= Role::create(['name'=> 'patient']);
        $medical=  Role::create(['name'=> 'medical']);
        $admin= Role::create(['name'=> 'admin']);

        /**
         * crear todos los permisos en un array
         */
        $permissions = [
            'user.create', 'user.destroy', 'user.edit', 'user.show',
            'appoinment.schedule', 'appoinment.cancel', 'appoinment.edit', 'appoinment.show',
            'role.create', 'role.destroy', 'role.edit', 'role.show',
            'appoinment.assigned','edit.schedule, schedule.show','appoinment_history.show'
        ];
        /**
         * crear los permisos y buscarlos en la base de datos
         */
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /**
         * Asignando permisos a cada rol
         */
        $admin->syncPermissions($permissions);


        $$patient->syncPermissions([
            'appoinment.create',
            'appoinment.edit',
            'appoinment.show',
        ]);

        $medical->syncPermissions([
            'appoinment.show',
            'appoinment.assigned',
            'edit.schedule,
            schedule.show',
            'appoinment.cancel'
        ]);

    }


}
