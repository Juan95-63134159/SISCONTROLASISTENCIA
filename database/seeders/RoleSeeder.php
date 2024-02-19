<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CREACION DE ROLES
        //El sistema va a tener 2 roles, puedes crear mas:
        // Administrador
        $admin = Role::create(['name' => 'admin']);
        // Secretaria
        $secretaria = Role::create(['name' => 'secretaria']);
        // ASIGNAR LAS VISTAS 
        $permission = Permission::create(['name' => 'index'])->syncRoles([$admin,$secretaria]);
        $permission = Permission::create(['name' => 'reportes'])->syncRoles([$admin,$secretaria]);
        $permission = Permission::create(['name' => 'pdf'])->syncRoles([$admin,$secretaria]);
        $permission = Permission::create(['name' => 'pdf_fechas'])->syncRoles([$admin,$secretaria]);
        $permission = Permission::create(['name' => 'home'])->syncRoles([$admin,$secretaria]);
        $permission = Permission::create(['name' => 'miembros'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'ministerios'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'usuarios'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'asistencias'])->syncRoles([$admin,$secretaria]);

        // ASIGNANDO ROLES
        User::find(1)->assignRole($admin);
        User::find(2)->assignRole($secretaria);
    }
}
