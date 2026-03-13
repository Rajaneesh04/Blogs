@extends('layouts.app')

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
            <a href="{{ route('user.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 group">
                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.318c.426-1.426 1.426-1.426H3.682c0-.426.34-.426-.426V3.682c0-.426.34-.426-.426h1.641v1.641c0 .426.34.426.426.426h1.641v1.641c0 .426.34.426.426.426h1.641v1.641c0 .426.34.426.426.426zm9.75 3.75v3.682c0-.426.34-.426-.426h1.641v1.641c0 .426.34.426.426.426h1.641v1.641c0 .426.34.426.426.426h1.641v1.641c0 .426.34.426.426.426z" />
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
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">{{ $user->blogs()->count() }}</div>
                    <p class="text-gray-600">Total Blogs</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">{{ $user->blogs()->sum('likes') }}</div>
                    <p class="text-gray-600">Total Likes</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-2xl font-bold text-purple-600 mb-2">{{ $user->role }}</div>
                    <p class="text-gray-600">Role</p>
                </div>
            </div>
            
            <hr class="border-gray-200 mb-8">
            
            <!-- Recent Blogs -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Recent Blogs</h2>
                @if($blogs->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Likes</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $blog->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $blog->category->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $blog->likes }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $blog->created_at->diffForHumans() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if(auth()->user()->canManageBlogs())
                                                <a href="{{ route('author.blogs.edit', $blog) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                                <form action="{{ route('author.blogs.destroy', $blog) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $blogs->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="mb-6">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 012-2v6a2 2 0 012-2h6a2 2 0 002-2v6a2 2 0 002-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">No blogs yet</h3>
                        <p class="text-gray-600 mb-6">You haven't created any blogs yet.</p>
                        @if(auth()->user()->canManageBlogs())
                            <a href="{{ route('author.blogs.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0 0l4 4m0 0v16" />
                                </svg>
                                Create Your First Blog
                            </a>
                        @else
                            <div class="space-y-4">
                                <p class="text-gray-600 mb-4">Want to create blogs? Become an author to start publishing your content!</p>
                                <a href="{{ route('author.request') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002 2v5a2 2 0 002-2z" />
                                    </svg>
                                    Become an Author
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
