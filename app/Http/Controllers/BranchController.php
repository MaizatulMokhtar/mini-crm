<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::with('company')->latest()->paginate(10);
        $companies = Company::all();
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

        // If is_hq is checked, unset existing HQ for that company
        if ($request->is_hq) {
            Branch::where('company_id', $request->company_id)
                  ->where('is_hq', true)
                  ->update(['is_hq' => false]);
        }

        Branch::create([
            'company_id' => $request->company_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'is_hq'      => $request->boolean('is_hq'),
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

        if ($request->is_hq) {
            Branch::where('company_id', $request->company_id)
                ->where('id', '!=', $branch->id)
                ->where('is_hq', true)
                ->update(['is_hq' => false]);
        }

        $branch->update([
            'company_id' => $request->company_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'is_hq'      => $request->boolean('is_hq'),
        ]);

        return redirect()->route('branch.index')->with('success', 'Branch updated successfully.');
    }
    
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branch.index')->with('success', 'Branch deleted.');
    }
}