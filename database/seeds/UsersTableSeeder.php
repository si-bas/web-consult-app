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
            'password' => Hash::make('default'),
        ]);
        $admin->attachRole('admin');

        $lecturer = User::create([
            'name' => 'Contoh Akun Dosen', 
            'email' => 'dosen@app.com', 
            'password' => Hash::make('default'),
        ]);
        $lecturer->attachRole('lecturer');

        $student = User::create([
            'name' => 'Contoh Akun Mahasiswa', 
            'email' => 'mahasiswa@app.com', 
            'password' => Hash::make('default'),
        ]);
        $student->attachRole('student');
    }
}
