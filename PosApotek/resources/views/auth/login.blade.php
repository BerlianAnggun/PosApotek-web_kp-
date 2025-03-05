<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Apotek</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-indigo-400 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/illustrations/11.png') }}" alt="Logo Apotek" class="mx-auto w-20 h-20">
            <h1 class="text-2xl font-bold text-gray-700 mt-2">SIGN IN</h1>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Masukkan email"
                    required
                >
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <!-- Remember Me -->

            <!-- Login Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition"
                >
                    Login
                </button>
            </div>
        </form>

        <!-- Additional Links -->
       
    </div>
</body>
</html>
