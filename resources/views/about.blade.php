@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-emerald-500 text-white py-20 text-center">
    <h1 class="text-5xl font-bold mb-4">About Our Blog</h1>
    <p class="max-w-2xl mx-auto text-lg">
        Sharing ideas, insights and stories that inspire developers, creators and innovators.
    </p>
</section>


<!-- Our Story -->
<section class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">

    <div>
        <h2 class="text-3xl font-bold mb-4">Our Story</h2>
        <p class="text-gray-600 leading-relaxed">
            We started with a simple mission — to create a platform where knowledge meets creativity.
            Our blog is a place where technology, design and ideas come together to inspire people
            across the world.
        </p>
        <p class="text-gray-600 mt-4 leading-relaxed">
            Whether you're a student, developer or entrepreneur, our goal is to provide valuable
            content that helps you grow.
        </p>
    </div>

    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c"
         class="rounded-2xl shadow-lg">
</section>


<!-- Mission & Vision -->
<section class="bg-gray-100 py-16">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 text-center">

        <div class="bg-white p-8 rounded-2xl shadow">
            <h3 class="text-2xl font-semibold mb-3">Our Mission</h3>
            <p class="text-gray-600">
                To empower learners and creators by delivering high quality content
                that educates, inspires and drives innovation.
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow">
            <h3 class="text-2xl font-semibold mb-3">Our Vision</h3>
            <p class="text-gray-600">
                To become a trusted platform where ideas grow and knowledge spreads globally.
            </p>
        </div>

    </div>
</section>


<!-- Values -->
<section class="max-w-6xl mx-auto px-6 py-16 text-center">
    <h2 class="text-3xl font-bold mb-10">Our Values</h2>

    <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
            <h4 class="text-xl font-semibold mb-2">Quality</h4>
            <p class="text-gray-600">We deliver meaningful and valuable content.</p>
        </div>

        <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
            <h4 class="text-xl font-semibold mb-2">Innovation</h4>
            <p class="text-gray-600">We embrace new ideas and technologies.</p>
        </div>

        <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
            <h4 class="text-xl font-semibold mb-2">Community</h4>
            <p class="text-gray-600">We grow together with our readers.</p>
        </div>

    </div>
</section>


<!-- Team Section -->
<section class="bg-gray-100 py-16 text-center">
    <h2 class="text-3xl font-bold mb-10">Meet Our Team</h2>

    <div class="flex justify-center gap-10 flex-wrap">

        <div class="bg-white p-6 rounded-2xl shadow w-60">
            <img src="https://i.pravatar.cc/150?img=3" class="rounded-full mx-auto mb-4">
            <h4 class="font-semibold">Admin</h4>
            <p class="text-gray-500 text-sm">Founder</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow w-60">
            <img src="https://i.pravatar.cc/150?img=5" class="rounded-full mx-auto mb-4">
            <h4 class="font-semibold">Editor</h4>
            <p class="text-gray-500 text-sm">Content Lead</p>
        </div>

    </div>
</section>


<!-- CTA -->
<section class="bg-green-600 text-white text-center py-16">
    <h2 class="text-3xl font-bold mb-4">Join Our Journey</h2>
    <p class="mb-6">Be part of our growing community.</p>
    <a href="/blogs" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold shadow hover:bg-gray-100">
        Explore Blogs
    </a>
</section>

@endsection