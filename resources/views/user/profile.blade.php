@extends('layouts.user')

@section('content')
<div class="flex min-h-screen bg-gray-100 pt-0">
    <!-- Sidebar -->
    <div class="fixed left-0 top-20 w-64 bg-white shadow-lg z-50 flex flex-col" style="height: calc(100vh - 5rem);">
        <div class="p-6 flex-shrink-0">
            <div class="flex items-center mb-6">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=32&background=3B82F6&color=fff" alt="User Avatar">
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-semibold text-gray-800">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="mt-6 flex-1 overflow-y-auto">
            <a href="{{ route('user.dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 group">
                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 6l7 7 7 7V6a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2h4a2 2 0 002-2V8a2 2 0 002-2z" />
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('user.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 group bg-blue-50 text-blue-600">
                <svg class="mr-3 h-5 w-5 text-blue-600 group-hover:text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01-4-4H4a4 4 0 00-4 4v8a4 4 0 004 4h12a4 4 0 004-4v-8a4 4 0 004-4z" />
                </svg>
                <span class="font-medium">Profile</span>
            </a>
            @if(auth()->user()->canManageBlogs())
                <a href="{{ route('author.blogs.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 group">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 012-2v6a2 2 0 012-2h6a2 2 0 002-2v6a2 2 0 002-2z" />
                    </svg>
                    <span class="font-medium">My Blogs</span>
                </a>
            @endif
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 group">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.318c.426-1.426 1.426-1.426H3.682c0-.426.34-.426-.426V3.682c0-.426.34-.426-.426h1.641v1.641c0 .426.34.426.426.426h1.641v1.641c0 .426.34.426.426.426zm9.75 3.75v3.682c0-.426.34-.426-.426h1.641v1.641c0 .426.34.426.426.426h1.641v1.641c0 .426.34.426.426.426z" />
                    </svg>
                    <span class="font-medium">Admin Panel</span>
                </a>
            @endif
        </nav>

        <!-- Logout Button -->
        <div class="mt-auto p-6 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 shadow-sm">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4 4m0 0L4 12m0 0l4 4m0 0L4 16" />
                    </svg>
                    <span class="font-semibold">Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64">
        <main class="flex-1 p-6">
            <div class="bg-white rounded-lg shadow-md">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h4 class="text-xl font-semibold text-gray-800 mb-0">Profile Settings</h4>
                </div>
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 p-4 border border-green-200 rounded-lg bg-green-50 text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tabs -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8">
                            <button class="py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600" onclick="showTab('profile')">
                                Profile Information
                            </button>
                            <button class="py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" onclick="showTab('password')">
                                Change Password
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div id="tab-content">
                        <!-- Profile Tab -->
                        <div id="profile-tab" class="tab-content">
                            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                    <div class="md:col-span-1 text-center">
                                        @if($user->avatar)
                                            <img src="{{ asset('avatars/' . $user->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128&background=3B82F6&color=fff" alt="Avatar" class="w-32 h-32 rounded-full mx-auto mb-4">
                                        @endif
                                    </div>
                                    <div class="md:col-span-2 space-y-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                            <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('bio') border-red-500 @enderror" id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Avatar</label>
                                    <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('avatar') border-red-500 @enderror" id="avatar" name="avatar" accept="image/*">
                                    @error('avatar')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-600" value="{{ $user->role }}" readonly>
                                </div>

                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    Update Profile
                                </button>
                            </form>
                        </div>

                        <!-- Password Tab -->
                        <div id="password-tab" class="tab-content hidden">
                            <form action="{{ route('user.password.change') }}" method="POST" class="mt-6">
                                @csrf
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-500 @enderror" id="current_password" name="current_password" required>
                                        @error('current_password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror" id="password" name="password" required>
                                        @error('password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password_confirmation') border-red-500 @enderror" id="password_confirmation" name="password_confirmation" required>
                                        @error('password_confirmation')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="mt-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    // Remove active state from all buttons
    document.querySelectorAll('nav button').forEach(btn => {
        btn.classList.remove('border-blue-500', 'text-blue-600');
        btn.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab
    document.getElementById(tabName + '-tab').classList.remove('hidden');
    
    // Add active state to clicked button
    event.target.classList.remove('border-transparent', 'text-gray-500');
    event.target.classList.add('border-blue-500', 'text-blue-600');
}
</script>
@endsection
