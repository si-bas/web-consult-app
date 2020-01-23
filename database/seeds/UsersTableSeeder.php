<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

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
            'email' => 'umum.saifi@gmail.com', 
            'password' => 'default',
            'verified_at' => Carbon::now()->toDateTimeString()
        ]);
        $admin->attachRole('admin');
    }
}
