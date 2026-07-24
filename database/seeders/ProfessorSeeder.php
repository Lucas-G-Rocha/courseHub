<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::where('email', 'joao@example.com')->firstOrFail();
        $faker = Faker::create();
        $professorUser = User::whereHas('role', function($query){
            $query->where('name', 'professor');
        })->where('email', '!=', 'joao@example.com')->get();

        Professor::create([
            'name' => 'João Silva',
            'email' => 'joao.silva@example.com',
            'bio' => 'Professor especializado em desenvolvimento web e PHP.',
            'user_id' => $user->id,
        ]);

        Professor::create([
            'name' => 'Maria Santos',
            'email' => 'maria.santos@example.com',
            'bio' => 'Desenvolvedora e professora com experiência em Laravel e bancos de dados.',
        ]);

        Professor::create([
            'name' => 'Carlos Oliveira',
            'email' => 'carlos.oliveira@example.com',
            'bio' => 'Professor especializado em programação orientada a objetos e arquitetura de software.',
        ]);

        Professor::create([
            'name' => 'Ana Costa',
            'email' => 'ana.costa@example.com',
            'bio' => 'Professora com foco em desenvolvimento backend e APIs REST.',
        ]);

        Professor::create([
            'name' => 'Rafael Almeida',
            'email' => 'rafael.almeida@example.com',
            'bio' => 'Professor especializado em bancos de dados, SQL e modelagem de sistemas.',
        ]);

        foreach ($professorUser as $user) {
            Professor::create([
                'name' => $user->name,
                'email' => $user->email,
                'bio' => $faker->date('Y-m-d', '-18 years'),
                'user_id' => $user->id
            ]);
        }
    }
}
