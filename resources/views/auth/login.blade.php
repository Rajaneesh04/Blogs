@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-16">

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden max-w-5xl w-full grid md:grid-cols-2">

        <!-- Left Login Info -->
        <div class="bg-green-600 text-white p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-4">Welcome Back</h2>
            <p class="mb-6 text-green-100">
                Sign in to your account to access your dashboard, manage your profile, and connect with our community.
            </p>

            <div class="space-y-4 text-sm">
                <p>🔐 Secure authentication</p>
                <p>📊 Personal dashboard</p>
                <p>🌟 Community features</p>
            </div>
        </div>

        <!-- Right Login Form -->
        <div class="p-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                Sign in to your account
            </h2>

            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-100 p-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Email Address</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Enter your email"
                           autocomplete="username"
                           required
                           class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Password</label>
                    <input type="password"
                           name="password"
                           placeholder="Enter your password"
                           autocomplete="current-password"
                           required
                           class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox"
                               name="remember"
                               id="remember_me"
                               class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="remember_me" class="ml-2 text-gray-900 text-sm">
                            Remember me
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-500">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 transition text-white font-medium py-3 rounded-lg shadow-md">
                    Sign In
                </button>

                <div class="text-center text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-green-600 hover:text-green-500 font-medium">
                        Create account
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
