@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-semibold text-gray-800">My Blogs</h3>
        <a href="{{ route('author.blogs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
            Create New Blog
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 border border-green-200 rounded-lg bg-green-50 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if($blogs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($blogs as $blog)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="w-full h-48 object-cover" alt="{{ $blog->title }}">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h5 class="text-xl font-semibold text-gray-800 mb-2">{{ $blog->title }}</h5>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($blog->short_desc, 100) }}</p>
                        
                        <div class="text-sm text-gray-500 mb-4">
                            <span class="inline-flex items-center">
                                <i class="fas fa-heart mr-1"></i> {{ $blog->likes }} likes
                            </span>
                            <span class="mx-2">|</span>
                            <span>{{ $blog->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('blog.show', $blog->id) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                View
                            </a>
                            <a href="{{ route('author.blogs.edit', $blog) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Edit
                            </a>
                            <form action="{{ route('author.blogs.destroy', $blog) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this blog?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="flex justify-center mt-8">
            {{ $blogs->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="mb-6">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h4 class="text-xl font-semibold text-gray-800 mb-2">No blogs found</h4>
            <p class="text-gray-600 mb-6">You haven't created any blogs yet.</p>
            <a href="{{ route('author.blogs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Create Your First Blog
            </a>
        </div>
    @endif
</div>
@endsection
