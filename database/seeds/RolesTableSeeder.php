<?php

use Illuminate\Database\Seeder;

# Models
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "name" => 'admin',
            "display_name" => 'Administrator',
            "description" => 'Admin Sistem',
        ]);

        Role::create([
            "name" => 'lecturer',
            "display_name" => 'Dosen',
            "description" => null
        ]);

        Role::create([
            "name" => 'student',
            "description" => null
        ]);
    }
}
