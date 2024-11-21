<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kelinci Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .register-container {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-300 via-blue-200 to-indigo-500 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center min-h-screen">

    <!-- Register Form Card -->
    <div class="register-container w-full max-w-md bg-gray-50 dark:bg-gray-800 rounded-lg shadow-lg p-8">

        <!-- Rabbit Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="w-15 h-20">
        </div>

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-gray-200 mb-2">Create Your Account</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-6">Join us and enjoy shopping!</p>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-600">Name</label>
                <input id="name" type="text" name="name"
                    class="block w-full px-4 py-2 mt-1 rounded-md border--300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300"
                    required autofocus autocomplete="name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" type="email" name="email"
                    class="block w-full px-4 py-2 mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300"
                    required autocomplete="username" value="{{ old('email') }}">
                @error('email')
                    <span class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" type="password" name="password"
                    class="block w-full px-4 py-2 mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300"
                    required autocomplete="new-password">
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePasswordVisibility('password')">
                    <i class="fas fa-eye" id="eye-password"></i>
                </span>
                @error('password')
                    <span class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="block w-full px-4 py-2 mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300"
                    required autocomplete="new-password">
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePasswordVisibility('password_confirmation')">
                    <i class="fas fa-eye" id="eye-confirm-password"></i>
                </span>
                @error('password_confirmation')
                    <span class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Register Button -->
            <button type="submit"
                class="w-full py-3 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out">Register</button>
        </form>

        <!-- Already Registered Link -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">Already registered?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Log in</a>
            </p>
        </div>

        <!-- Footer Inside Card -->
        <footer class="mt-4 text-center text-gray-600 dark:text-gray-400 text-xs">
            &copy; {{ date('Y') }} Kelinci Store. All Rights Reserved.
        </footer>
    </div>

    <script>
        function togglePasswordVisibility(id) {
            const passwordInput = document.getElementById(id);
            const eyeIcon = document.getElementById(id === 'password' ? 'eye-password' : 'eye-confirm-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
