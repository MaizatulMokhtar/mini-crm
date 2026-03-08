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
        $companies = [
            [
                'name' => 'Another Company Sdn Bhd',
                'email' => 'admin@admin.com',
                'role_id' => '2',
                'country_code' => '60',
                'phone' => '126103085',
                'address' => 'Kg New Zealand, Malaysia',
                'website' => 'www.another.com',
            ],
            [
                'name' => 'Bright Solutions Sdn Bhd',
                'email' => 'admin@brightsolutions.com',
                'role_id' => '2',
                'country_code' => '60',
                'phone' => '123456789',
                'address' => 'Jalan Bukit Bintang, Kuala Lumpur, Malaysia',
                'website' => 'www.brightsolutions.com',
            ],
            [
                'name' => 'Tech Innovators Pte Ltd',
                'email' => 'admin@techinnovators.com',
                'role_id' => '2',
                'country_code' => '65',
                'phone' => '987654321',
                'address' => 'Orchard Road, Singapore',
                'website' => 'www.techinnovators.com',
            ],
            [
                'name' => 'Global Ventures Corp',
                'email' => 'admin@globalventures.com',
                'role_id' => '2',
                'country_code' => '1',
                'phone' => '4155552671',
                'address' => 'Market Street, San Francisco, USA',
                'website' => 'www.globalventures.com',
            ],
            [
                'name' => 'Apex Systems LLC',
                'email' => 'admin@apexsystems.com',
                'role_id' => '2',
                'country_code' => '44',
                'phone' => '2071234567',
                'address' => 'Baker Street, London, UK',
                'website' => 'www.apexsystems.com',
            ],
        ];

        foreach ($companies as $index => $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role_id' => $data['role_id'],
            ]);

            Company::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'country_code' => $data['country_code'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'website' => $data['website'],
            ]);
        }
    }
}
