@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h5 class="text-lg font-semibold text-gray-800 mb-0">User Menu</h5>
                </div>
                <div class="p-0">
                    <a href="{{ route('user.dashboard') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 border-b border-gray-100 transition-colors duration-200">
                        Dashboard
                    </a>
                    <a href="{{ route('user.profile') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 border-b border-gray-100 transition-colors duration-200">
                        Profile
                    </a>
                    @if(auth()->user()->canManageBlogs())
                    <a href="{{ route('author.blogs.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-colors duration-200">
                        My Blogs
                    </a>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="lg:w-3/4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h4 class="text-xl font-semibold text-gray-800 mb-0">Dashboard</h4>
                </div>
                <div class="p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                            <h5 class="text-3xl font-bold text-blue-600 mb-2">{{ $user->blogs()->count() }}</h5>
                            <p class="text-gray-600">Total Blogs</p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                            <h5 class="text-3xl font-bold text-green-600 mb-2">{{ $user->blogs()->sum('likes') }}</h5>
                            <p class="text-gray-600">Total Likes</p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                            <h5 class="text-2xl font-bold text-purple-600 mb-2">{{ $user->role }}</h5>
                            <p class="text-gray-600">Role</p>
                        </div>
                    </div>
                    
                    <hr class="border-gray-200 mb-6">
                    
                    <h5 class="text-lg font-semibold text-gray-800 mb-4">Recent Blogs</h5>
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
                                            <form action="{{ route('author.blogs.destroy', $blog) }}" method="POST" style="display: inline;">
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
                        <div class="text-center py-8">
                            <p class="text-gray-600 mb-4">You haven't created any blogs yet.</p>
                            @if(auth()->user()->canManageBlogs())
                            <a href="{{ route('author.blogs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Create Your First Blog
                            </a>
                            @else
                            <div class="space-y-4">
                                <p class="text-gray-600">Want to create blogs? Become an author to start publishing your content!</p>
                                <a href="{{ route('author.request') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Become an Author
                                </a>
                            </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
