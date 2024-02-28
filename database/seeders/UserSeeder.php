<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = [];
        $users[0] = User::create([
            'name' => 'RH Rony',
            'email' => 'rhrony0009@gmail.com',
            'mobile' => '01839096877',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
            'batch_id' => 4,
        ]);
    }
}
