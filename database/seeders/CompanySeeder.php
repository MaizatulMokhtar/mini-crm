<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Alphia Ventures Sdn Bhd',
            'email' => 'admin@alphia.com',
            'password' => Hash::make('Alphia1234'),
            'role_id' => '2',
        ]);

        $company = Company::create([
            'user_id' => $user->id,
            'name' => 'Alphia Ventures Sdn Bhd',
            'email' => 'admin@alphia.com',
            'country_code' => '60',
            'phone' => '126103085',
            'address' => 'The Strand Mall',
            'website' => 'it@alphia.net',
        ]);
    }
}
