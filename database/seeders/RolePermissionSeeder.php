<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
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

        $admin->permissions()->sync(
            Permission::all()
        );
        $professor->permissions()->sync([
            Permission::where('name', 'read_professor')->firstOrFail()->id,
            Permission::where('name', 'update_professor')->firstOrFail()->id,
            Permission::where('name', 'create_course')->firstOrFail()->id,
            Permission::where('name', 'read_course')->firstOrFail()->id,
            Permission::where('name', 'update_course')->firstOrFail()->id,
            Permission::where('name', 'delete_course')->firstOrFail()->id,

            Permission::where('name', 'create_lesson')->firstOrFail()->id,
            Permission::where('name', 'read_lesson')->firstOrFail()->id,
            Permission::where('name', 'update_lesson')->firstOrFail()->id,
            Permission::where('name', 'delete_lesson')->firstOrFail()->id,

            Permission::where('name', 'create_enrollment')->firstOrFail()->id,
            Permission::where('name', 'read_enrollment')->firstOrFail()->id,
            Permission::where('name', 'delete_enrollment')->firstOrFail()->id
        ]);

        $student->permissions()->sync([
            Permission::where('name', 'read_lesson')->firstOrFail()->id,
            Permission::where('name', 'read_course')->firstOrFail()->id,

            Permission::where('name', 'create_enrollment')->firstOrFail()->id,
            Permission::where('name', 'delete_enrollment')->firstOrFail()->id,
            Permission::where('name', 'read_enrollment')->firstOrFail()->id,
            Permission::where('name', 'update_enrollment')->firstOrFail()->id,
            Permission::where('name', 'read_professor')->firstOrFail()->id,
            Permission::where('name', 'read_student')->firstOrFail()->id,
            Permission::where('name', 'update_student')->firstOrFail()->id

        ]);


    }
}
