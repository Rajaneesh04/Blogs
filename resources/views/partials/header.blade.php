<header class="sticky top-0 bg-white shadow-md z-100">
    <nav class="relative max-w-7xl mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-green-600">MyBlog</a>

            <ul class="hidden md:flex space-x-6 text-gray-600 font-medium">
                <li><a href="{{ route('home') }}" class="hover:text-green-600">Home</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-green-600">About</a></li>
                <li><a href="{{ route('blogs') }}" class="hover:text-green-600">Blogs</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-green-600">Contact</a></li>
            </ul>

            <button class="hidden md:inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Subscribe
            </button>

            <button id="mobile-menu-button"
                    type="button"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-lg border border-gray-200 text-gray-700"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                    aria-label="Open menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="md:hidden hidden absolute top-full left-0 right-0 bg-white border-t border-gray-100 shadow-lg z-[110] p-4">
            <ul class="flex flex-col gap-2 text-gray-700 font-medium">
                <li><a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 hover:bg-green-50 hover:text-green-700">Home</a></li>
                <li><a href="{{ route('about') }}" class="block rounded-lg px-3 py-2 hover:bg-green-50 hover:text-green-700">About</a></li>
                <li><a href="{{ route('blogs') }}" class="block rounded-lg px-3 py-2 hover:bg-green-50 hover:text-green-700">Blogs</a></li>
                <li><a href="{{ route('contact') }}" class="block rounded-lg px-3 py-2 hover:bg-green-50 hover:text-green-700">Contact</a></li>
            </ul>

            <button class="mt-3 w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Subscribe
            </button>
        </div>
    </nav>
</header>

<script>
(() => {
    const button = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    if (!button || !menu) return;

    button.addEventListener('click', () => {
        const isOpen = !menu.classList.contains('hidden');
        menu.classList.toggle('hidden');
        button.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
    });
})();
</script>
