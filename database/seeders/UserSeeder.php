<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123456),
            'remember_token' => Str::random(10),
            'phone'=>'1234567890'
        ]);
    }
}
