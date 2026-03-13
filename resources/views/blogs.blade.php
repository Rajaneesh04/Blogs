@extends('layouts.app')

@section('content')

<section class="bg-gray-100 py-16 text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-3">Explore Blogs</h1>
    <p class="text-gray-600 max-w-xl mx-auto">
        Discover insights, ideas and stories from our latest articles.
    </p>
</section>

<div class="max-w-7xl mx-auto px-6 mt-10 flex flex-col md:flex-row justify-between items-center gap-4">
    
    <!-- Search -->
    <input
        type="text"
        id="blog-search"
        placeholder="Search blogs..."
        class="border px-4 py-2 rounded-lg w-full md:w-1/3 shadow-sm focus:ring-2 focus:ring-green-500 outline-none"
    >

    <!-- Dynamic Categories -->
    <div class="flex gap-3 flex-wrap justify-center">

        <!-- All Button -->
        <button data-id="all"
            class="category-btn bg-green-600 text-white px-4 py-2 rounded-lg shadow">
            All
        </button>

        @foreach($categories as $category)
            <button data-id="{{ $category->id }}"
                class="category-btn bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
                {{ $category->name }}
            </button>
        @endforeach

    </div>
</div>

<section class="max-w-7xl mx-auto px-6 py-12">
    <div id="blog-container" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($blogs as $blog)
        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
            
            <div class="relative">
                <img src="{{ asset('storage/'.$blog->image) }}" 
                     class="h-52 w-full object-cover" 
                     alt="{{ $blog->title }}">

                <!-- Category Badge -->
                <div class="absolute top-3 left-3 bg-green-600 text-white text-xs px-3 py-1 rounded-full">
                    {{ $blog->category->name ?? 'No Category' }}
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    {{ $blog->title }}
                </h2>

                <p class="text-gray-600 text-sm mb-4">
                    {{ $blog->short_desc }}
                </p>

                <!-- Author info -->
                @if($blog->user)
                <div class="flex items-center gap-2 mb-4 text-sm text-gray-500">
                    @if($blog->user->avatar)
                        <img src="{{ asset('avatars/' . $blog->user->avatar) }}" alt="{{ $blog->user->name }}" class="w-6 h-6 rounded-full">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&size=24&background=0d6efd&color=fff" alt="{{ $blog->user->name }}" class="w-6 h-6 rounded-full">
                    @endif
                    <span>By {{ $blog->user->name }}</span>
                </div>
                @endif

                <div class="flex items-center justify-between gap-3">
                    
                    <a href="{{ route('blog.show', $blog->id) }}"
                       class="inline-block text-green-600 font-medium hover:underline">
                        Read More →
                    </a>

                    @php $isLiked = in_array($blog->id, $likedBlogIds ?? [], true); @endphp
                    
                    <form method="POST" action="{{ route('blog.like.toggle', $blog->id) }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border shadow-sm transition-all duration-200
                            {{ $isLiked ? 'border-rose-300 bg-rose-50 text-rose-600 hover:bg-rose-100' : 'border-gray-200 bg-white text-gray-600 hover:text-rose-600 hover:border-rose-200 hover:bg-rose-50' }}"
                            aria-label="{{ $isLiked ? 'Unlike blog' : 'Like blog' }}">
                            
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                class="w-4 h-4"
                                fill="{{ $isLiked ? 'currentColor' : 'none' }}"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 10-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                            </svg>

                            <span class="text-xs font-bold px-1.5 py-0.5 rounded-full bg-white/80 border border-current/20">
                                {{ $blog->likes ?? 0 }}
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @empty
        <div class="col-span-full text-center text-gray-500">
            No blogs available yet.
        </div>
        @endforelse

    </div>
</section>

@endsection


<!-- AJAX SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".category-btn");
    const searchInput = document.getElementById("blog-search");
    const blogContainer = document.getElementById("blog-container");
    let activeCategoryId = "all";
    let debounceTimer = null;

    function renderLoading() {
        blogContainer.innerHTML = `
            <div class="col-span-full text-center py-10 text-gray-500">
                Loading blogs...
            </div>
        `;
    }

    function loadBlogs() {
        const params = new URLSearchParams({
            category: activeCategoryId,
            title: searchInput.value.trim()
        });

        renderLoading();

        fetch("/blogs/filter?" + params.toString())
            .then(response => response.text())
            .then(data => {
                blogContainer.innerHTML = data;
            })
            .catch(() => {
                blogContainer.innerHTML = `
                    <div class="col-span-full text-center py-10 text-red-500">
                        Failed to load blogs.
                    </div>
                `;
            });
    }

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            activeCategoryId = this.dataset.id;

            buttons.forEach(btn => {
                btn.classList.remove("bg-green-600", "text-white");
                btn.classList.add("bg-gray-200");
            });

            this.classList.remove("bg-gray-200");
            this.classList.add("bg-green-600", "text-white");

            loadBlogs();
        });
    });

    searchInput.addEventListener("input", function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(loadBlogs, 300);
    });

});
</script>
