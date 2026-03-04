@forelse($blogs as $blog)
<div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
    <div class="relative">
        <img src="{{ asset('storage/'.$blog->image) }}"
             class="h-52 w-full object-cover"
             alt="{{ $blog->title }}">

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

        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('blog.show', $blog->id) }}"
               class="inline-block text-green-600 font-medium hover:underline">
                Read More ->
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
    No blogs found.
</div>
@endforelse
