@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-16">

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden max-w-5xl w-full grid md:grid-cols-2">

        <!-- Left Register Info -->
        <div class="bg-green-600 text-white p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-4">Join Our Community</h2>
            <p class="mb-6 text-green-100">
                Create your account to start blogging, share your ideas, and connect with our amazing community of writers and readers.
            </p>

            <div class="space-y-4 text-sm">
                <p>📝 Publish your blogs</p>
                <p>👥 Connect with others</p>
                <p>🚀 Grow your audience</p>
            </div>
        </div>

        <!-- Right Register Form -->
        <div class="p-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                Create your account
            </h2>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 p-3 text-sm text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-5" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Full Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="John Doe"
                               autocomplete="name"
                               required
                               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Email Address</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="john@email.com"
                               autocomplete="username"
                               required
                               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Password</label>
                    <input type="password"
                           name="password"
                           placeholder="Create a strong password"
                           autocomplete="new-password"
                           required
                           class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Confirm Password</label>
                    <input type="password"
                           name="password_confirmation"
                           placeholder="Confirm your password"
                           autocomplete="new-password"
                           required
                           class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 transition text-white font-medium py-3 rounded-lg shadow-md">
                    Create Account
                </button>

                <div class="text-center text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-green-600 hover:text-green-500 font-medium">
                        Sign in
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
