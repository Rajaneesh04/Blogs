@extends('admin.layouts.app')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen w-full">

    <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Categories</h1>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-indigo-600 text-white px-5 py-2 rounded-lg shadow hover:bg-indigo-700 transition w-full sm:w-auto text-center">
            + Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="p-4">ID</th>
                        <th class="p-4">Name</th>
                        <th class="p-4">Slug</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">
                    @forelse($categories as $category)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="p-4">{{ $category->id }}</td>
                        <td class="p-4 font-semibold">{{ $category->name }}</td>
                        <td class="p-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                   class="text-blue-500 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this category?');">
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
                        <td colspan="4" class="py-4 text-center text-gray-500">No categories found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
