<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini CRM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-56 bg-white border-r border-gray-200 min-h-screen flex flex-col fixed top-0 left-0 z-20">
        
        <!-- Logo -->
        <div class="px-5 py-4 border-b border-gray-100">
            <h1 class="text-gray-900 font-bold text-base tracking-tight">Mini CRM</h1>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

            <p class="text-gray-400 text-xs uppercase tracking-widest px-2 pb-2 pt-1">Main</p>

            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <p class="text-gray-400 text-xs uppercase tracking-widest px-2 pb-2 pt-4">Management</p>
            @endif

            @if(Auth::user()->role_id == 1)
            <a href="{{ route('company.index') }}" 
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('company.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Companies
            </a>
            @endif

            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <a href="{{ route('branch.index') }}" 
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('branch.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                </svg>
                Branches
            </a>

            <a href="{{ route('employee.index') }}" 
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('employees.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Employees
            </a>
            @endif

            @if(Auth::user()->role_id == 1)
            <p class="text-gray-400 text-xs uppercase tracking-widest px-2 pb-2 pt-4">System</p>
            <a href="" 
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium transition-all text-gray-500 hover:bg-gray-50 hover:text-gray-900">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>
            @endif

        </nav>

    </aside>

    <!-- Main Content -->
    <div class="ml-56 flex-1 flex flex-col min-h-screen">

        <!-- Topbar -->
        <header class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-between sticky top-0 z-10">
            
            <!-- Page Title -->
            <h2 class="text-gray-800 font-semibold text-sm">@yield('page-title', 'Dashboard')</h2>

            <!-- Right Side -->
            <div class="flex items-center gap-3">

                <!-- Notification Bell -->
                <button class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>

                <!-- Account Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-gray-100 transition">
                        <div class="w-7 h-7 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <p class="text-xs font-semibold text-gray-700 leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ Auth::user()->role_id == 1 ? 'Superadmin' : (Auth::user()->role_id == 2 ? 'Company Admin' : 'Employee') }}
                            </p>
                        </div>
                        <svg class="w-3 h-3 text-gray-400 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition
                         class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                        
                        <div class="px-3 py-2 border-b border-gray-100">
                            <p class="text-xs font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            My Profile
                        </a>

                        <div class="border-t border-gray-100 mt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 px-3 py-2 text-sm text-red-500 hover:bg-red-50 transition w-full">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 flex-1">
            @yield('content')
        </main>

    </div>

</body>
</html>