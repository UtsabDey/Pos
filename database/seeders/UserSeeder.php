<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'id' => 1,
            ],
            [
                'name' => 'Admin',
                'is_admin' => '1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ]);
    }
}
