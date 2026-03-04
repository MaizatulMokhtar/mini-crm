<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@xperts.com',
            'password' => Hash::make('Xperts1234'),
            'role_id' => '1',
        ]);
    }
}
