<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-indigo-900 via-purple-900 to-gray-900 min-h-screen flex items-center justify-center">

    <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl flex overflow-hidden w-[900px]">

        <!-- Left Side (Branding) -->
        <div class="hidden md:flex flex-col justify-center items-center w-1/2 bg-gradient-to-br from-indigo-600 to-purple-700 text-white p-10">

            <h1 class="text-4xl font-bold mb-4">Welcome Back 👋</h1>
            <p class="text-lg text-center opacity-90">
                Manage your blogs, publish content and monitor your platform easily.
            </p>

            <div class="mt-10 text-6xl opacity-40">
                📝
            </div>

        </div>

        <!-- Right Side (Login Form) -->
        <div class="w-full md:w-1/2 p-10">

            <h2 class="text-3xl font-bold mb-6 text-gray-800">Admin Login</h2>

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-600 mb-1">Username</label>
                    <input 
                        name="username"
                        placeholder="Enter username"
                        class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 rounded-lg p-3 outline-none transition"
                    >
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Password</label>
                    <input 
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 rounded-lg p-3 outline-none transition"
                    >
                </div>

                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
                    Login →
                </button>

            </form>

        </div>

    </div>

</body>
</html>