<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == 1) {
            // Superadmin sees everything
            $data = [
                'totalCompanies'  => Company::count(),
                'totalBranches'   => Branch::count(),
                'totalEmployees'  => Employee::count(),
                'totalUsers'      => User::count(),
                'recentCompanies' => Company::latest()->take(5)->get(),
            ];
        } elseif ($user->role_id == 2) {
            // Company admin sees only their data
            $company = Company::where('user_id', $user->id)->first();
            $data = [
                'totalBranches'  => Branch::where('company_id', $company->id)->count(),
                'totalEmployees' => Employee::whereHas('branch', fn($q) => $q->where('company_id', $company->id))->count(),
                'recentBranches' => Branch::where('company_id', $company->id)->latest()->take(5)->get(),
                'company'        => $company,
            ];
        } else {
            // Employee sees only their own profile
            $employee = Employee::where('user_id', $user->id)->first();
            $data = [
                'employee' => $employee,
                'branch'   => $employee?->branch,
            ];
        }

        return view('dashboard.index', compact('data', 'user'));
    }
}