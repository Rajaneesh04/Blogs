<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-16">

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden max-w-5xl w-full grid md:grid-cols-2">

        <!-- Left Side (Branding) -->
        <div class="bg-green-600 text-white p-10 flex flex-col justify-center">

            <h2 class="text-3xl font-bold mb-4">Welcome Back</h2>
            <p class="mb-6 text-green-100">
                Manage your blogs, publish content and monitor your platform easily.
            </p>

            <div class="space-y-4 text-sm">
                <p>🔐 Admin access</p>
                <p>📊 Content management</p>
                <p>� User oversight</p>
            </div>

        </div>

        <!-- Right Side (Login Form) -->
        <div class="p-10">

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Admin Login</h2>

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-600 mb-1">Username</label>
                    <input 
                        name="username"
                        placeholder="Enter username"
                        class="w-full border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-300 rounded-lg p-3 outline-none transition"
                    >
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Password</label>
                    <input 
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        class="w-full border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-300 rounded-lg p-3 outline-none transition"
                    >
                </div>

                <div class="flex items-center">
                    <input 
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
                    >
                    <label for="remember" class="ml-2 text-gray-900 text-sm">
                        Remember me
                    </label>
                </div>

                <button class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
                    Login →
                </button>

            </form>

        </div>

    </div>

</body>
</html>