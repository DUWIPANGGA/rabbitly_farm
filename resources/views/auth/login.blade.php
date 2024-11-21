<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rabittly Farm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .login-container {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-300 via-blue-200 to-indigo-500 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center min-h-screen">

    <!-- Login Form Card -->
    <div class="login-container w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-lg p-10">

        <!-- Rabbit Logo -->
        <div class="flex justify-center mb-8">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="w-15 h-20">
        </div>

        <!-- Title -->
        <h2 class="text-3xl font-semibold text-center text-gray-700 dark:text-gray-200 mb-4">Welcome To Rabbitly Shop!</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-8">Login to your account</p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" type="email" name="email" class="block w-full px-4 py-3 mt-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base dark:bg-gray-700 dark:text-gray-300" required autofocus autocomplete="username" value="{{ old('email') }}">
                @error('email')
                    <span class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" type="password" name="password" class="block w-full px-4 py-3 mt-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base dark:bg-gray-700 dark:text-gray-300" required autocomplete="current-password">
                @error('password')
                    <span class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">Forgot Password?</a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full py-3 px-4 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out">Log in</button>
        </form>

        <!-- Register Link -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Sign Up</a>
            </p>
        </div>

        <!-- Footer Inside Card -->
        <footer class="mt-6 text-center text-gray-600 dark:text-gray-400 text-xs">
            &copy; {{ date('Y') }} Kelinci Store. All Rights Reserved.
        </footer>
    </div>
</body>
</html>
