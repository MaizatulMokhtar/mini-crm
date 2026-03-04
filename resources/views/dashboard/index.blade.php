@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')

    @if($user->role_id == 1)
        {{-- SUPERADMIN VIEW --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Companies</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $data['totalCompanies'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Branches</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $data['totalBranches'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Employees</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $data['totalEmployees'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Users</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $data['totalUsers'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Recent Companies</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs text-gray-500 uppercase border-b border-gray-100">
                        <th class="pb-3">Company</th>
                        <th class="pb-3">Email</th>
                        <th class="pb-3">Phone</th>
                        <th class="pb-3">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($data['recentCompanies'] as $company)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 font-medium text-gray-800">{{ $company->name }}</td>
                        <td class="py-3 text-gray-500">{{ $company->email }}</td>
                        <td class="py-3 text-gray-500">{{ $company->phone }}</td>
                        <td class="py-3 text-gray-400">{{ $company->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-400">No companies yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    @elseif($user->role_id == 2)
        {{-- COMPANY ADMIN VIEW --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Branches</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $data['totalBranches'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Employees</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $data['totalEmployees'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Your Branches</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs text-gray-500 uppercase border-b border-gray-100">
                        <th class="pb-3">Branch</th>
                        <th class="pb-3">Email</th>
                        <th class="pb-3">Phone</th>
                        <th class="pb-3">HQ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($data['recentBranches'] as $branch)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 font-medium text-gray-800">{{ $branch->name }}</td>
                        <td class="py-3 text-gray-500">{{ $branch->email }}</td>
                        <td class="py-3 text-gray-500">{{ $branch->phone }}</td>
                        <td class="py-3">
                            @if($branch->is_hq)
                                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">HQ</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-400">No branches yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    @else
        {{-- EMPLOYEE VIEW --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-lg">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">My Profile</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Name</span>
                    <span class="text-gray-800 font-medium">{{ $data['employee']->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Position</span>
                    <span class="text-gray-800 font-medium">{{ $data['employee']->position ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Branch</span>
                    <span class="text-gray-800 font-medium">{{ $data['branch']->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Email</span>
                    <span class="text-gray-800 font-medium">{{ $data['employee']->email ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Phone</span>
                    <span class="text-gray-800 font-medium">{{ $data['employee']->phone ?? '-' }}</span>
                </div>
            </div>
        </div>
    @endif

@endsection