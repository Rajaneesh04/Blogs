@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-16">

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden max-w-5xl w-full grid md:grid-cols-2">

        <!-- Left Contact Info -->
        <div class="bg-green-600 text-white p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-4">Let's Talk</h2>
            <p class="mb-6 text-green-100">
                We'd love to hear from you. Send us a message and we'll respond as soon as possible.
            </p>

            <div class="space-y-4 text-sm">
                <p>Bangalore, India</p>
                <p>+91 98765 43210</p>
                <p>support@example.com</p>
            </div>
        </div>

        <!-- Right Contact Form -->
        <div class="p-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                Send us a message
            </h2>

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 p-3 text-sm text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-5" method="POST" action="{{ route('contact.submit') }}">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Full Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="John Doe"
                               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Email Address</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="john@email.com"
                               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Subject</label>
                    <input type="text"
                           name="subject"
                           value="{{ old('subject') }}"
                           placeholder="How can we help?"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Message</label>
                    <textarea rows="5"
                              name="message"
                              placeholder="Write your message here..."
                              class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('message') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 transition text-white font-medium py-3 rounded-lg shadow-md">
                    Send Message
                </button>

            </form>
        </div>

    </div>

</div>
@endsection
