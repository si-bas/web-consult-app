<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

# Models
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrator', 
            'email' => 'admin@app.com', 
            'password' => 'default',
        ]);
        $admin->attachRole('admin');

        $lecturer = User::create([
            'name' => 'Contoh Akun Dosen', 
            'email' => 'dosen@app.com', 
            'password' => 'default',
        ]);
        $lecturer->attachRole('lecturer');

        $student = User::create([
            'name' => 'Contoh Akun Mahasiswa', 
            'email' => 'mahasiswa@app.com', 
            'password' => 'default',
        ]);
        $student->attachRole('student');
    }
}
