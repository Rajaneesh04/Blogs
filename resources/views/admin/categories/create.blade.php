@extends('admin.layouts.app')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen w-full">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Add Category</h1>

    <div class="bg-white p-5 md:p-8 rounded-2xl shadow-md w-full max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-gray-600 mb-2 font-semibold">Category Name</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Enter category name..."
                       class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400">

                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                    Save Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
