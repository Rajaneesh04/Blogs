@extends('admin.layouts.app')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen w-full">

    <!-- Page Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Blogs</h1>

        <a href="{{ route('admin.blogs.create') }}"
           class="bg-indigo-600 text-white px-5 py-2 rounded-lg shadow hover:bg-indigo-700 transition w-full sm:w-auto text-center">
            + Create Blog
        </a>
    </div>

    <!-- Blog Table -->
    <div class="bg-white shadow rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">
        <table class="w-full min-w-[640px] text-left">

            <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Title</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Content</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">

                @forelse($blogs as $blog)
                <tr class="border-t hover:bg-gray-50 transition">
                    
                    <!-- ID -->
                    <td class="p-4">{{ $blog->id }}</td>

                    <!-- Title -->
                    <td class="p-4 font-semibold">
                        {{ $blog->title }}
                    </td>

                    <!-- Category -->
                    <td class="p-4">
                        {{ $blog->category->name ?? 'No Category' }}
                    </td>

                    <!-- Short Content -->
                    <td class="p-4 text-gray-500">
                        {{ \Illuminate\Support\Str::limit($blog->body, 80) }}
                    </td>

                    <!-- Actions -->
                    <td class="p-4">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                               class="text-blue-500 hover:underline">
                               Edit
                            </a>

                            <form method="POST" action="{{ route('admin.blogs.delete', $blog->id) }}"
                                  onsubmit="return confirm('Delete this blog?');">
                                @csrf
                                <button type="submit" class="text-red-500 hover:underline cursor-pointer">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-3 text-center text-gray-500">
                        No blogs found
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
        </div>

    </div>

</div>
@endsection