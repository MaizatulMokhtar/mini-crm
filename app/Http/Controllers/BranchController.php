<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == Role::SUPERADMIN) {
            $branches = Branch::with('company')->latest()->paginate(10);
            $companies = Company::all();
        } elseif ($user->role_id == Role::COMPANY) {
            $company = Company::where('user_id', $user->id)->first();
            $branches = Branch::with('company')
                ->where('company_id', $company->id)
                ->latest()->paginate(10);
            $companies = Company::where('user_id', $user->id)->get(); // collection for the dropdown
        } elseif ($user->role_id == Role::EMPLOYEE) {
            $companies = Company::where('company_id', $user->employee->branch->company->id);
            $branches = Branch::with('company')
                ->where('id', $user->employee->branch_id)
                ->latest()->paginate(10);
        }

        return view('branch.index', compact('branches', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email',
            'phone'      => 'nullable|string|max:20',
        ]);

        Branch::create([
            'company_id' => $request->company_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ]);

        return redirect()->route('branch.index')->with('success', 'Branch created successfully.');
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email',
            'phone'      => 'nullable|string|max:20',
        ]);

        $branch->update([
            'company_id' => $request->company_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ]);

        return redirect()->route('branch.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branch.index')->with('success', 'Branch deleted.');
    }
}
