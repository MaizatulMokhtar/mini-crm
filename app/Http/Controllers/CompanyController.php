<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('user')->latest()->paginate(10);
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'phone'        => 'nullable|string|max:20',
            'country_code' => 'nullable|string|max:5',
            'address'      => 'nullable|string',
            'website'      => 'nullable|string|max:255',
            'password'     => 'required|min:8',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Create user account for company
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 2,
        ]);

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Company::create([
            'user_id'      => $user->id,
            'name'         => $request->name,
            'email'        => $request->email,
            'country_code' => $request->country_code,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'website'      => $request->website,
            'logo'         => $logoPath,
        ]);

        return redirect()->route('company.index')->with('success', 'Company created successfully.');
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $company->user_id,
            'phone'        => 'nullable|string|max:20',
            'country_code' => 'nullable|string|max:5',
            'address'      => 'nullable|string',
            'website'      => 'nullable|string|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update user
        $company->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Handle logo
        $logoPath = $company->logo;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $company->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'country_code' => $request->country_code,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'website'      => $request->website,
            'logo'         => $logoPath,
        ]);

        return redirect()->route('company.index')->with('success', 'Company updated successfully.');
    }
    
    public function destroy(Company $company)
    {
        $company->user()->delete();
        $company->delete();
        return redirect()->route('company.index')->with('success', 'Company deleted.');
    }
}