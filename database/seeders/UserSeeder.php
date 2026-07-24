<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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

        $faker = Faker::create();

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

        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'role_id' => $professor->id,
            ]);
        }

        for ($i = 0; $i < 40; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'role_id' => $student->id,
            ]);
        }

    }
}
