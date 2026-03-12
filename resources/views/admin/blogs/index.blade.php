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
                        <div class="flex items-center justify-center gap-2">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group"
                               title="Edit Blog">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>

                            <!-- Delete Button -->
                            <form method="POST" action="{{ route('admin.blogs.delete', $blog->id) }}"
                                  onsubmit="return confirm('Delete this blog?');">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group"
                                        title="Delete Blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.377H6.084a2.25 2.25 0 01-2.244-2.377L4.774 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
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