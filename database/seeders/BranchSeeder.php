<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $branches = [
        // Company 1
        ['company_id' => 1, 'name' => 'Another 1 Branch', 'email' => 'branch1@another.com', 'country_code' => '60', 'phone' => '126103085', 'address' => 'Petaling Jaya, Malaysia'],
        ['company_id' => 1, 'name' => 'Another 2 Branch', 'email' => 'branch2@another.com', 'country_code' => '60', 'phone' => '126103086', 'address' => 'Shah Alam, Malaysia'],

        // Company 2
        ['company_id' => 2, 'name' => 'Bright Solutions HQ', 'email' => 'hq@brightsolutions.com', 'country_code' => '60', 'phone' => '123456780', 'address' => 'Bukit Bintang, KL'],
        ['company_id' => 2, 'name' => 'Bright Solutions Penang', 'email' => 'penang@brightsolutions.com', 'country_code' => '60', 'phone' => '123456781', 'address' => 'Georgetown, Penang'],
        ['company_id' => 2, 'name' => 'Bright Solutions JB', 'email' => 'jb@brightsolutions.com', 'country_code' => '60', 'phone' => '123456782', 'address' => 'Johor Bahru, Malaysia'],
        ['company_id' => 2, 'name' => 'Bright Solutions Sabah', 'email' => 'sabah@brightsolutions.com', 'country_code' => '60', 'phone' => '123456783', 'address' => 'Kota Kinabalu, Sabah'],

        // Company 3
        ['company_id' => 3, 'name' => 'Tech Innovators Central', 'email' => 'central@techinnovators.com', 'country_code' => '65', 'phone' => '987654320', 'address' => 'Orchard Road, Singapore'],
        ['company_id' => 3, 'name' => 'Tech Innovators East', 'email' => 'east@techinnovators.com', 'country_code' => '65', 'phone' => '987654321', 'address' => 'Tampines, Singapore'],
        ['company_id' => 3, 'name' => 'Tech Innovators West', 'email' => 'west@techinnovators.com', 'country_code' => '65', 'phone' => '987654322', 'address' => 'Jurong, Singapore'],

        // Company 4
        ['company_id' => 4, 'name' => 'Global Ventures SF', 'email' => 'sf@globalventures.com', 'country_code' => '1', 'phone' => '4155552671', 'address' => 'Market Street, San Francisco'],
        ['company_id' => 4, 'name' => 'Global Ventures NY', 'email' => 'ny@globalventures.com', 'country_code' => '1', 'phone' => '2125552671', 'address' => '5th Avenue, New York'],

        // Company 5
        ['company_id' => 5, 'name' => 'Apex Systems London', 'email' => 'london@apexsystems.com', 'country_code' => '44', 'phone' => '2071234567', 'address' => 'Baker Street, London'],
        ['company_id' => 5, 'name' => 'Apex Systems Manchester', 'email' => 'manchester@apexsystems.com', 'country_code' => '44', 'phone' => '1612345678', 'address' => 'Piccadilly, Manchester'],
    ];

    foreach ($branches as $branch) {
        Branch::create($branch);
    }
}
}
