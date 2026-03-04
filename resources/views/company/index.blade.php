@extends('layouts.app')

@section('page-title', 'Companies')

@section('content')
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
<div x-data="{ open: false, editOpen: false, editCompany: {} }">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Companies</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage all registered companies</p>
        </div>
        <button @click="open = true"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Company
        </button>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 text-green-600 text-sm px-4 py-3 rounded-lg mb-4 border border-green-100">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Company</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Email</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Phone</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Website</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Joined</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($companies as $company)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            @if($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" class="w-8 h-8 rounded-full object-cover">
                            @else
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr($company->name, 0, 1)) }}
                            </div>
                            @endif
                            <span class="font-medium text-gray-800">{{ $company->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-500">{{ $company->email }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $company->phone ?? '-' }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $company->website ?? '-' }}</td>
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $company->created_at->diffForHumans() }}</td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-1 justify-end">

                            <!-- Edit Button -->
                            <div class="relative" x-data="{ tooltip: false }">
                                <button @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                    class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition">

                                </button>
                                <button @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                    @click="editCompany = {
                                        id: '{{ $company->id }}',
                                        name: '{{ $company->name }}',
                                        email: '{{ $company->email }}',
                                        country_code: '{{ $company->country_code }}',
                                        phone: '{{ $company->phone }}',
                                        website: '{{ $company->website }}',
                                        address: '{{ $company->address }}'
                                    }; editOpen = true"
                                    class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <div x-show="tooltip" x-cloak
                                    class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 px-2 py-1 bg-gray-800 text-white text-xs rounded-md whitespace-nowrap pointer-events-none">
                                    Edit
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>

                            <!-- Delete Button -->
                            <div class="relative" x-data="{ tooltip: false }">
                                <form method="POST" action="{{ route('company.destroy', $company) }}"
                                    onsubmit="return confirm('Delete this company?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                        class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                                <div x-show="tooltip" x-cloak
                                    class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 px-2 py-1 bg-gray-800 text-white text-xs rounded-md whitespace-nowrap pointer-events-none">
                                    Delete
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-8 text-center text-gray-400">No companies found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-3 border-t border-gray-100 flex items-center justify-between">
            <p class="text-xs text-gray-400">
                Showing {{ $companies->firstItem() ?? 0 }} to {{ $companies->lastItem() ?? 0 }} of {{ $companies->total() }} companies
            </p>
            @if($companies->hasPages())
            {{ $companies->links() }}
            @endif
        </div>
    </div>

    <!-- Add Company Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50" @click="open = false"></div>

        <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
            <div x-show="open" x-cloak class="modal-overlay" @click.self="open = false">
                <div class="modal-box">

                    <!-- Modal Header -->
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white z-10">
                        <div>
                            <h3 class="text-base font-semibold text-gray-800">Add Company</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Create a new company account</p>
                        </div>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="px-6 py-5 space-y-4">

                            @if($errors->any())
                            <div class="bg-red-50 text-red-600 text-xs px-3 py-2 rounded-lg border border-red-100">
                                {{ $errors->first() }}
                            </div>
                            @endif

                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Company Name <span class="text-red-400">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Acme Corporation">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email <span class="text-red-400">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="admin@company.com">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Password <span class="text-red-400">*</span></label>
                                    <input type="password" name="password"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Min. 8 characters">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Country Code</label>
                                    <input type="text" name="country_code" value="{{ old('country_code') }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="60">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="123456789">
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Address</label>
                                    <textarea name="address" rows="2"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Company address">{{ old('address') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Website</label>
                                    <input type="text" name="website" value="{{ old('website') }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="https://company.com">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Logo</label>
                                    <input type="file" name="logo" accept="image/*"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-between gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl sticky bottom-0">
                            <button type="button" @click="open = false"
                                class="bg-gray-100 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 rounded-lg shadow-md px-5 py-2">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                                Create Company
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Company Modal -->
    <div x-show="editOpen" x-cloak class="modal-overlay" @click.self="editOpen = false">
        <div class="modal-box">

            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white z-10">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Edit Company</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Update company details</p>
                </div>
                <button @click="editOpen = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" :action="`/company/${editCompany.id}`" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="px-6 py-5 space-y-4">
                    <div class="grid grid-cols-2 gap-4">

                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Company Name <span class="text-red-400">*</span></label>
                            <input type="text" name="name" :value="editCompany.name"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Acme Corporation">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email <span class="text-red-400">*</span></label>
                            <input type="email" name="email" :value="editCompany.email"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="admin@company.com">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Country Code</label>
                            <input type="text" name="country_code" :value="editCompany.country_code"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="60">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Phone</label>
                            <input type="text" name="phone" :value="editCompany.phone"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="123456789">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Website</label>
                            <input type="text" name="website" :value="editCompany.website"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="https://company.com">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Address</label>
                            <textarea name="address" rows="2"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Company address"
                                x-text="editCompany.address"></textarea>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Logo</label>
                            <input type="file" name="logo" accept="image/*"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
                            <p class="text-xs text-gray-400 mt-1">Leave empty to keep current logo.</p>
                        </div>

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-between gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl sticky bottom-0">
                    <button type="button" @click="editOpen = false"
                        class="bg-gray-100 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 rounded-lg shadow-md px-5 py-2">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                        Update Company
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Auto open modal if validation errors --}}
@if($errors->any())
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('modal', {
            open: true
        })
    })
</script>
@endif

@endsection