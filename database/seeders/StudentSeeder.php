<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
        $studentsUser = User::whereHas('role', function($query){
            $query->where('name', 'student');
        })->where('id', '!=', "$user->id")->get();
        
        $faker = Faker::create();

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

        foreach($studentsUser as $user){
            Student::create([
                'name' => $user->name,
                'email' => $user->email,
                'birth_date' => $faker->date('Y-m-d', '-18 years'),
                'user_id' => $user->id
            ]);
        }


    }
}

