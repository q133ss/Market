<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $roles = [
            'admin' => 'Админ',
            'customer' => 'Покупатель',
            'seller' => 'Продавец'
        ];

        foreach ($roles as $key => $role){
            \App\Models\Role::create(['tech_name' => $key, 'name' => $role]);
        }

        \App\Models\User::create([
            'email' => 'admin@email.net',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
    }
}
