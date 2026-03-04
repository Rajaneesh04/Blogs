@forelse($blogs as $blog)
<div class="bg-white p-5 rounded-xl shadow mb-4">
    <h2 class="text-xl font-bold mb-2">
        {{ $blog->title }}
    </h2>

    <p class="text-gray-600 mb-2">
        {{ $blog->short_desc }}
    </p>

    <span class="text-sm text-indigo-600 font-semibold">
        {{ $blog->category->name ?? 'No Category' }}
    </span>
</div>
@empty
<p class="text-gray-500">No blogs found</p>
@endforelse