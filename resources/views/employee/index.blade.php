@extends('layouts.app')

@section('page-title', 'Employees')

@section('content')

<div x-data="{ open: false, editOpen: false, editEmployee: {} }">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Employees</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage all employees</p>
        </div>
        <button @click="open = true"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Employee
        </button>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 text-green-600 text-sm px-4 py-3 rounded-lg mb-4 border border-green-100">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="bg-red-50 text-red-600 text-sm px-4 py-3 rounded-lg mb-4 border border-red-100">
        {{ session('error') }}
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Employee</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Email</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Phone</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Position</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Branch</th>
                    <th class="text-left text-xs text-gray-500 uppercase tracking-wide px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($employees as $employee)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr($employee->full_name, 0, 1)) }}
                            </div>
                            <span class="font-medium text-gray-800">{{ $employee->full_name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-500">{{ $employee->email }}</td>
                    <td class="px-5 py-3 text-gray-500">+{{ $employee->country_code }}{{ $employee->phone ?? '-' }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $employee->position ?? '-' }}</td>
                    <td class="px-5 py-3">
                        <span class="bg-blue-50 text-blue-600 text-xs px-2 py-1 rounded-full">
                            {{ $employee->branch->name ?? '-' }}
                        </span>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-1 justify-end">

                            <!-- Edit -->
                            <div class="relative" x-data="{ tooltip: false }">
                                <button @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                    @click="editEmployee = {
                                            id: '{{ $employee->id }}',
                                            first_name: '{{ $employee->first_name }}',
                                            middle_name: '{{ $employee->middle_name }}',
                                            last_name: '{{ $employee->last_name }}',
                                            email: '{{ $employee->email }}',
                                            country_code: '{{ $employee->country_code }}',
                                            phone: '{{ $employee->phone }}',
                                            position: '{{ $employee->position }}',
                                            branch_id: '{{ $employee->branch_id }}'
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
                                <form method="POST" action="{{ route('employee.destroy', $employee) }}"
                                    onsubmit="return confirm('Delete this employee?')">
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
                    <td colspan="7" class="px-5 py-8 text-center text-gray-400">No employees found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-3 border-t border-gray-100 flex items-center justify-between">
            <p class="text-xs text-gray-400">
                Showing {{ $employees->firstItem() ?? 0 }} to {{ $employees->lastItem() ?? 0 }} of {{ $employees->total() }} employees
            </p>
            @if($employees->hasPages())
            {{ $employees->links() }}
            @endif
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div x-show="open" x-cloak class="modal-overlay" @click.self="open = false">
        <div class="modal-box">

            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white z-10">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Add Employee</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Create a new employee account</p>
                </div>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="px-6 py-5 space-y-4">

                    @if($errors->any())
                    <div class="bg-red-50 text-red-600 text-xs px-3 py-2 rounded-lg border border-red-100">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <div class="grid grid-cols-3 gap-4">

                        <!-- Row 1: Name fields -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">First Name <span class="text-red-400">*</span></label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="First Name">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Middle Name</label>
                            <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Middle Name">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Last Name <span class="text-red-400">*</span></label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Last Name">
                        </div>

                        <!-- Row 2: Email + Password -->
                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email <span class="text-red-400">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="john@company.com">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Password <span class="text-red-400">*</span></label>
                            <div class="relative" x-data="{ show: false }">
                                <input :type="show ? 'text' : 'password'" name="password"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 pr-9 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Password">
                                <button type="button" @click="show = !show"
                                    class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                                    <!-- Eye Open -->
                                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <!-- Eye Closed -->
                                    <svg x-show="show" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Row 3: Country Code + Phone -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Country Code</label>
                            <input type="text" name="country_code" value="{{ old('country_code') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="60">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="123456789">
                        </div>

                        <!-- Row 4: Position + Branch -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Position</label>
                            <input type="text" name="position" value="{{ old('position') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g. Manager">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Branch <span class="text-red-400">*</span></label>
                            <select name="branch_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                                @endforeach
                            </select>
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
                        Create Employee
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div x-show="editOpen" x-cloak class="modal-overlay" @click.self="editOpen = false">
        <div class="modal-box">

            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white z-10">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Edit Employee</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Update employee details</p>
                </div>
                <button @click="editOpen = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form method="POST" :action="`/employee/${editEmployee.id}`">
                @csrf
                @method('PUT')

                <div class="px-6 py-5 space-y-4">
                    <div class="grid grid-cols-3 gap-4">

                        <!-- Row 1: Name -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">First Name <span class="text-red-400">*</span></label>
                            <input type="text" name="first_name" :value="editEmployee.first_name"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="First Name">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Middle Name</label>
                            <input type="text" name="middle_name" :value="editEmployee.middle_name"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Middle Name">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Last Name <span class="text-red-400">*</span></label>
                            <input type="text" name="last_name" :value="editEmployee.last_name"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Last Name">
                        </div>

                        <!-- Row 2: Email -->
                        <div class="col-span-3">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email <span class="text-red-400">*</span></label>
                            <input type="email" name="email" :value="editEmployee.email"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="john@company.com">
                        </div>

                        <!-- Row 3: Country Code + Phone -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Country Code</label>
                            <input type="text" name="country_code" :value="editEmployee.country_code"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="60">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Phone</label>
                            <input type="text" name="phone" :value="editEmployee.phone"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="123456789">
                        </div>

                        <!-- Row 4: Position + Branch -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Position</label>
                            <input type="text" name="position" :value="editEmployee.position"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g. Manager">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Branch <span class="text-red-400">*</span></label>
                            <select name="branch_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    :selected="editEmployee.branch_id == '{{ $branch->id }}'">
                                    {{ $branch->name }}
                                </option>
                                @endforeach
                            </select>
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
                        Update Employee
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