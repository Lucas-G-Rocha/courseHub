<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $user = User::where('email', 'maria@example.com')->firstOrFail();

        Student::create([
            'name' => 'Maria Santos',
            'email' => 'maria.santos@example.com',
            'birth_date' => '2002-05-15',
            'user_id' => $user->id,
        ]);

        Student::create([
            'name' => 'Pedro Almeida',
            'email' => 'pedro.almeida@example.com',
            'birth_date' => '2001-08-22',
        ]);

        Student::create([
            'name' => 'Lucas Oliveira',
            'email' => 'lucas.oliveira@example.com',
            'birth_date' => '2003-01-10',
        ]);

        Student::create([
            'name' => 'Ana Costa',
            'email' => 'ana.costa@example.com',
            'birth_date' => '2000-11-03',
        ]);

        Student::create([
            'name' => 'Rafael Souza',
            'email' => 'rafael.souza@example.com',
            'birth_date' => '2002-07-28',
        ]);
    }
}

