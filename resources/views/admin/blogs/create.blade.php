@extends('admin.layouts.app')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen w-full">

    <!-- Page Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Create New Blog
    </h1>

    <!-- Form Card -->
    <div class="bg-white p-5 md:p-8 rounded-2xl shadow-md w-full">

        <form action="/admin/store" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-5">
                <label class="block text-gray-600 mb-2 font-semibold">Blog Title</label>
                <input name="title"
                       placeholder="Enter blog title..."
                       class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <!-- Short Description -->
            <div class="mb-5">
                <label class="block text-gray-600 mb-2 font-semibold">Short Description</label>
                <input name="short_desc"
                       placeholder="Write a short description..."
                       class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

                        <!-- Category -->
            <div class="mb-5">
                <label class="block text-gray-600 mb-2 font-semibold">
                    Category
                </label>

                <select name="category_id"
                        required
                        class="w-full border rounded-lg p-3 bg-white 
                            focus:outline-none focus:ring-2 focus:ring-indigo-400">

                    <option value="">Select Category</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Image Upload -->
            <div class="mb-5">
                <label class="block text-gray-600 mb-2 font-semibold">Upload Image</label>
                <input type="file"
                       name="image"
                       class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:font-medium file:text-white hover:file:bg-indigo-700">
            </div>

            <!-- Full Body -->
            <div class="mb-6">
                <label class="block text-gray-600 mb-2 font-semibold">Full Blog Content</label>
                <textarea name="body"
                          rows="6"
                          placeholder="Write full blog content..."
                          class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
            </div>

            <!-- Submit -->
            <button
                class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                Publish Blog
            </button>

        </form>

    </div>

</div>
@endsection
