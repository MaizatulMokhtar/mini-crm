<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = Branch::first();

        $user = User::create([
            'name' => 'Maizatul Aqma Mokhtar',
            'email' => 'maizatulmokhtar85@alphia.com',
            'password' => Hash::make('Alphia1234'),
            'role_id' => '4',
        ]);

        Employee::create([
            'user_id'   => $user->id,
            'branch_id' => $branch->id,
            'full_name' => 'Maizatul Aqma Mokhtar',
            'first_name' => 'Maizatul',
            'middle_name' => 'Aqma',
            'last_name' => 'Mokhtar',
            'email' => 'maizatulmokhtar85@alphia.com',
            'country_code' => '60',
            'phone' => '126103085',
            'position' => 'Junior Developer',
        ]);
    }
}
