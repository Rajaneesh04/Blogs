@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative min-h-[72vh] overflow-hidden" id="home-hero-carousel">
    <div class="absolute inset-0">
        <div class="hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-700"
             style="background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1800&q=80');"></div>
        <div class="hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-700 opacity-0"
             style="background-image: url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=1800&q=80');"></div>
        <div class="hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-700 opacity-0"
             style="background-image: url('https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&w=1800&q=80');"></div>
        <div class="absolute inset-0 bg-slate-900/55"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 min-h-[72vh] flex items-center justify-center text-center">
        <div class="max-w-4xl">
            <h2 class="text-4xl md:text-7xl font-bold text-white mb-6 leading-tight">
                Share Your Stories With The World &#127757;
            </h2>
            <p class="text-slate-100/90 text-lg max-w-3xl mx-auto mb-8">
                A modern blogging platform where you can explore ideas, share thoughts, and inspire readers
                through meaningful content.
            </p>
            <a href="{{ url('/blogs') }}"
               class="bg-green-600 text-white px-9 py-4 rounded-xl shadow hover:bg-green-700 inline-block transition text-xl">
                Start Reading &rarr;
            </a>
        </div>
    </div>

    <!-- <button type="button"
            id="hero-prev"
            class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 text-white w-11 h-11 rounded-full text-2xl leading-none">
        &#8249;
    </button>

    <button type="button"
            id="hero-next"
            class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 text-white w-11 h-11 rounded-full text-2xl leading-none">
        &#8250;
    </button> -->

    <!-- <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-3" id="hero-dots">
        <button type="button" class="hero-dot w-3 h-3 rounded-full bg-white" aria-label="Slide 1"></button>
        <button type="button" class="hero-dot w-3 h-3 rounded-full bg-white/45" aria-label="Slide 2"></button>
        <button type="button" class="hero-dot w-3 h-3 rounded-full bg-white/45" aria-label="Slide 3"></button>
    </div> -->
</section>

<!-- Blog Preview Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-3xl font-semibold text-center mb-12">Latest Blogs</h3>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gray-50 rounded-xl shadow hover:shadow-lg transition p-6">
                <h4 class="text-xl font-semibold mb-2">Design Trends 2025</h4>
                <p class="text-gray-600 text-sm mb-4">
                    Discover the latest UI/UX design trends shaping the future.
                </p>
                <a href="#" class="text-green-600 font-medium">Read More &rarr;</a>
            </div>

            <div class="bg-gray-50 rounded-xl shadow hover:shadow-lg transition p-6">
                <h4 class="text-xl font-semibold mb-2">Laravel Best Practices</h4>
                <p class="text-gray-600 text-sm mb-4">
                    Improve your Laravel apps with clean architecture tips.
                </p>
                <a href="#" class="text-green-600 font-medium">Read More &rarr;</a>
            </div>

            <div class="bg-gray-50 rounded-xl shadow hover:shadow-lg transition p-6">
                <h4 class="text-xl font-semibold mb-2">AI in Blogging</h4>
                <p class="text-gray-600 text-sm mb-4">
                    How AI is changing content creation and storytelling.
                </p>
                <a href="#" class="text-green-600 font-medium">Read More &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-green-600 text-white py-16 text-center">
    <h3 class="text-3xl font-bold mb-4">Join Our Community</h3>
    <p class="mb-6">Start writing and share your knowledge today.</p>
    <button class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
        Create Blog
    </button>
</section>

<script>
(() => {
    const carousel = document.getElementById('home-hero-carousel');
    if (!carousel) return;

    const slides = Array.from(carousel.querySelectorAll('.hero-slide'));
    const dots = Array.from(carousel.querySelectorAll('.hero-dot'));
    const prevBtn = document.getElementById('hero-prev');
    const nextBtn = document.getElementById('hero-next');

    let current = 0;
    let timer;

    const render = (index) => {
        slides.forEach((slide, i) => slide.classList.toggle('opacity-0', i !== index));
        dots.forEach((dot, i) => {
            dot.classList.toggle('bg-white', i === index);
            dot.classList.toggle('bg-white/45', i !== index);
        });
    };

    const goTo = (index) => {
        current = (index + slides.length) % slides.length;
        render(current);
    };

    const start = () => {
        timer = setInterval(() => goTo(current + 1), 4500);
    };

    const restart = () => {
        clearInterval(timer);
        start();
    };

    prevBtn?.addEventListener('click', () => {
        goTo(current - 1);
        restart();
    });

    nextBtn?.addEventListener('click', () => {
        goTo(current + 1);
        restart();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            goTo(index);
            restart();
        });
    });

    render(current);
    start();
})();
</script>

@endsection
