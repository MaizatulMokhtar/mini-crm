<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini CRM - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Mini CRM</h1>
            <p class="text-gray-500 text-sm mt-1">Sign in to your account</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 text-sm p-3 rounded-lg mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="you@example.com"
                >
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    name="password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••"
                >
            </div>

            <button 
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg text-sm transition">
                Sign In
            </button>
        </form>
    </div>

</body>
</html>