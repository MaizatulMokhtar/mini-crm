@extends('layouts.app')

@section('page-title', 'Branches')

@section('content')

<div x-data="{ open: false, editOpen: false, editBranch: {} }">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Branches</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage all branches</p>
        </div>
        <button @click="open = true"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Branch
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
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Branch</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Company</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Email</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Phone</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Type</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($branches as $branch)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr($branch->name, 0, 1)) }}
                            </div>
                            <span class="font-medium text-gray-800">{{ $branch->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-500">{{ $branch->company->name ?? '-' }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $branch->email ?? '-' }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $branch->phone ?? '-' }}</td>
                    <td class="px-5 py-3">
                        @if($branch->is_hq)
                        <span class="bg-blue-50 text-blue-600 text-xs px-2 py-1 rounded-full font-medium">HQ</span>
                        @else
                        <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full">Branch</span>
                        @endif
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-1 justify-end">

                            <!-- Edit -->
                            <div class="relative" x-data="{ tooltip: false }">
                                <button @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                    @click="editBranch = {
                                        id: '{{ $branch->id }}',
                                        company_id: '{{ $branch->company_id }}',
                                        name: '{{ $branch->name }}',
                                        email: '{{ $branch->email }}',
                                        phone: '{{ $branch->phone }}',
                                        is_hq: {{ $branch->is_hq ? 'true' : 'false' }}
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

                            <!-- Delete -->
                            <div class="relative" x-data="{ tooltip: false }">
                                <form method="POST" action="{{ route('branch.destroy', $branch) }}"
                                    onsubmit="return confirm('Delete this branch?')">
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
                    <td colspan="6" class="px-5 py-8 text-center text-gray-400">No branches found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-5 py-3 border-t border-gray-100 flex items-center justify-between">
            <p class="text-xs text-gray-400">
                Showing {{ $branches->firstItem() ?? 0 }} to {{ $branches->lastItem() ?? 0 }} of {{ $branches->total() }} branches
            </p>
            @if($branches->hasPages())
            {{ $branches->links() }}
            @endif
        </div>
    </div>

    <!-- Add Branch Modal -->
    <div x-show="open" x-cloak class="modal-overlay" @click.self="open = false">
        <div class="modal-box">

            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white z-10">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Add Branch</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Create a new branch</p>
                </div>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{ route('branch.store') }}">
                @csrf
                <div class="px-6 py-5 space-y-4">

                    @if($errors->any())
                    <div class="bg-red-50 text-red-600 text-xs px-3 py-2 rounded-lg border border-red-100">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">

                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Company <span class="text-red-400">*</span></label>
                            <select name="company_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Branch Name <span class="text-red-400">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g. KL Branch">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="branch@company.com">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="123456789">
                        </div>

                        <div class="col-span-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_hq" value="1" {{ old('is_hq') ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-xs font-semibold text-gray-600">Set as HQ Branch</span>
                            </label>
                            <p class="text-xs text-gray-400 mt-1">This will unset the current HQ for the selected company.</p>
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
                        Create Branch
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Branch Modal -->
    <div x-show="editOpen" x-cloak class="modal-overlay" @click.self="editOpen = false">
        <div class="modal-box">

            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white z-10">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Edit Branch</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Update branch details</p>
                </div>
                <button @click="editOpen = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" :action="`/branch/${editBranch.id}`">
                @csrf
                @method('PUT')

                <div class="px-6 py-5 space-y-4">
                    <div class="grid grid-cols-2 gap-4">

                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Company <span class="text-red-400">*</span></label>
                            <select name="company_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}"
                                    :selected="editBranch.company_id == '{{ $company->id }}'">
                                    {{ $company->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Branch Name <span class="text-red-400">*</span></label>
                            <input type="text" name="name" :value="editBranch.name"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g. KL Branch">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                            <input type="email" name="email" :value="editBranch.email"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="branch@company.com">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Phone</label>
                            <input type="text" name="phone" :value="editBranch.phone"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="123456789">
                        </div>

                        <div class="col-span-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_hq" value="1"
                                    :checked="editBranch.is_hq"
                                    class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-xs font-semibold text-gray-600">Set as HQ Branch</span>
                            </label>
                            <p class="text-xs text-gray-400 mt-1">This will unset the current HQ for the selected company.</p>
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
                        Update Branch
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($errors->any())
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modal', {
                open: true
            })
        })
    </script>
    @endif

</div>

@endsection