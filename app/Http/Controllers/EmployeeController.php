<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['branch', 'user'])->latest()->paginate(10);
        $branches = Branch::all();
        return view('employee.index', compact('employees', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string',
            'middle_name' => 'nullable',
            'last_name' => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'country_code' => 'nullable',
            'phone'     => 'nullable',
            'position'  => 'nullable',
            'branch_id' => 'required|exists:branches,id',
            'password'  => 'required|min:8',
        ]);

        $fullName = trim(implode(' ', array_filter([
            $request->first_name,
            $request->middle_name,
            $request->last_name,
        ])));

        $user = User::create([
            'name'     => $fullName,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 3,
        ]);
        
        if (!$user) {
            Log::info('Failed to create user');
            return redirect()->back()->with('error', 'Failed to create user');
        }

        Employee::create([
            'user_id'   => $user->id,
            'branch_id' => $request->branch_id,
            'full_name'  => $fullName,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'country_code' => $request->country_code,
            'phone'     => $request->phone,
            'position'  => $request->position,
        ]);

        if (!$user) {
            Log::info('Failed to create employee record');
            return redirect()->back()->with('error', 'Failed to create employee record');
        }
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name'   => 'required|string',
            'middle_name'  => 'nullable',
            'last_name'    => 'required|string',
            'email'        => 'required|email|unique:users,email,' . $employee->user_id,
            'country_code' => 'nullable',
            'phone'        => 'nullable',
            'position'     => 'nullable',
            'branch_id'    => 'required|exists:branches,id',
        ]);

        $fullName = trim(implode(' ', array_filter([
            $request->first_name,
            $request->middle_name,
            $request->last_name,
        ])));

        // Update user
        $employee->user->update([
            'name'  => $fullName,
            'email' => $request->email,
        ]);

        // Update employee
        $employee->update([
            'full_name'    => $fullName,
            'first_name'   => $request->first_name,
            'middle_name'  => $request->middle_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'country_code' => $request->country_code,
            'phone'        => $request->phone,
            'position'     => $request->position,
            'branch_id'    => $request->branch_id,
        ]);

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }
    
    public function destroy(Employee $employee)
    {
        $employee->user()->delete();
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Employee deleted.');
    }
}