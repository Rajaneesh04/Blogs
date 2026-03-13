@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden bg-slate-950 text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 opacity-90"></div>
    <div class="relative w-full pl-6 pr-0 md:pl-10 md:pr-0 py-8 md:py-12">
        <div class="grid lg:grid-cols-12 gap-6 md:gap-8 items-center">
            <div class="lg:col-span-6">
                <span class="inline-flex items-center rounded-full bg-emerald-500/20 text-emerald-300 px-3 py-1 text-xs font-semibold mb-5">
                    Featured Story
                </span>

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                    {{ $blog->title }}
                </h1>

                <p class="text-slate-300 text-lg mb-8">
                    {{ $blog->short_desc }}
                </p>

                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-300">
                    <span>Published {{ $blog->created_at->format('F d, Y') }}</span>
                    <span class="hidden md:inline">&bull;</span>
                    <span>{{ max(1, ceil(str_word_count(strip_tags($blog->body)) / 200)) }} min read</span>
                    @if($blog->user)
                    <span class="hidden md:inline">&bull;</span>
                    <div class="flex items-center gap-2">
                        @if($blog->user->avatar)
                            <img src="{{ asset('avatars/' . $blog->user->avatar) }}" alt="{{ $blog->user->name }}" class="w-5 h-5 rounded-full">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&size=20&background=0d6efd&color=fff" alt="{{ $blog->user->name }}" class="w-5 h-5 rounded-full">
                        @endif
                        <span>By {{ $blog->user->name }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-6 lg:justify-self-end w-full">
                <div class="bg-white/10 rounded-2xl shadow-xl overflow-hidden border border-white/20">
                    <img
                        src="{{ asset('storage/' . $blog->image) }}"
                        alt="{{ $blog->title }}"
                        class="w-full h-[150px] sm:h-[220px] lg:h-[330px] object-cover"
                    >
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-12 md:py-16">
    <article class="max-w-7xl mx-auto px-6">
        <div class="p-0 md:p-2">
            <div class="prose prose-slate max-w-none leading-8 lg:leading-9">
                <p class="text-lg lg:text-xl text-slate-700">
                    {{ $blog->short_desc }}
                </p>

                <hr class="my-8 border-slate-200">

                <p class="whitespace-pre-line text-slate-700 text-base lg:text-lg">
                    {{ $blog->body }}
                </p>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('blogs') }}"
               class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg shadow hover:bg-emerald-700 transition">
                <span>&larr;</span>
                <span>Back to Blogs</span>
            </a>
        </div>
    </article>
</section>

@endsection
