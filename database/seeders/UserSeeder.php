<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin = Role::where('name', 'admin')->firstOrFail();
        $professor = Role::where('name', 'professor')->firstOrFail();
        $student = Role::where('name', 'student')->firstOrFail();

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $admin->id,
        ]);

        User::create([
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => Hash::make('password'),
            'role_id' => $professor->id,
        ]);

        User::create([
            'name' => 'Maria Santos',
            'email' => 'maria@example.com',
            'password' => Hash::make('password'),
            'role_id' => $student->id,
        ]);

    }
}
