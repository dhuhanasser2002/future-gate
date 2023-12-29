<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'Dhuha Nasser',
            'email'=> 'dhuha2002@test.com',
            'password'=>Hash::make('password'),
            'image' => '1703619670.jpg',
            'is_admin' => true,
            
        ]);
    }
}
