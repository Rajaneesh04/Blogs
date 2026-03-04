@extends('admin.layouts.app')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen w-full">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Edit Blog
    </h1>

    <div class="bg-white p-5 md:p-8 rounded-2xl shadow-md w-full">
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-5">
                <label class="block text-gray-600 mb-2 font-semibold">Blog Title</label>
                <input name="title"
                       value="{{ old('title', $blog->title) }}"
                       placeholder="Enter blog title..."
                       class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="mb-5">
                <label class="block text-gray-600 mb-2 font-semibold">Short Description</label>
                <input name="short_desc"
                       value="{{ old('short_desc', $blog->short_desc) }}"
                       placeholder="Write a short description..."
                       class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="mb-5">
                <label class="block text-gray-600 mb-2 font-semibold">Current Image</label>
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-50 h-10 object-cover rounded-lg mb-3 border">
                <label class="block text-gray-600 mb-2 font-semibold">Replace Image (Optional)</label>
                <input type="file"
                       name="image"
                       class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:font-medium file:text-white hover:file:bg-indigo-700">
            </div>

            <div class="mb-6">
                <label class="block text-gray-600 mb-2 font-semibold">Full Blog Content</label>
                <textarea name="body"
                          rows="6"
                          placeholder="Write full blog content..."
                          class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('body', $blog->body) }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                    Update Blog
                </button>
                <a href="{{ route('admin.blogs.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
