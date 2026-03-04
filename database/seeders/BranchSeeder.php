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
        $company = Company::first();

        $branch = Branch::create([
            'company_id' => $company->id,
            'name' => 'City Travelers',
            'email' => 'admin@alphia.com',
            'country_code' => '60',
            'phone' => '126103085',
            'address' => 'Petaling Jaya',
        ]);
    }
}
