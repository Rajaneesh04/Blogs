<header class="sticky top-0 bg-white shadow-md z-50">
    <nav class="relative max-w-7xl mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-green-600">MyBlog</a>

            <ul class="hidden md:flex space-x-6 text-gray-600 font-medium">
                <li><a href="{{ route('home') }}" class="hover:text-green-600">Home</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-green-600">About</a></li>
                <li><a href="{{ route('blogs') }}" class="hover:text-green-600">Blogs</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-green-600">Contact</a></li>
            </ul>

            <a href="{{ route('subscription') }}" class="hidden md:inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Subscribe
            </a>

            @guest
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600">Login</a>
                    <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Register</a>
                </div>
            @else
                <div class="relative hidden md:block">
                    <button id="user-menu-button" class="flex items-center space-x-2 text-gray-600 hover:text-green-600">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-full">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=32&background=0d6efd&color=fff" alt="Avatar" class="w-8 h-8 rounded-full">
                        @endif
                        <span>{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 z-[60]">
                        <div class="py-2">
                            <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                            @if(auth()->user()->canManageBlogs())
                                <a href="{{ route('author.blogs.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">My Blogs</a>
                            @endif
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Admin Panel</a>
                            @endif
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest

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

        <div id="mobile-menu" class="md:hidden hidden fixed inset-0 bg-white border-t border-gray-100 shadow-lg z-[70]">
            <div class="p-4">
                <ul class="flex flex-col gap-2 text-gray-700 font-medium">
                    <li><a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 hover:bg-green-50 hover:text-green-700">Home</a></li>
                    <li><a href="{{ route('about') }}" class="block rounded-lg px-3 py-2 hover:bg-green-50 hover:text-green-700">About</a></li>
                    <li><a href="{{ route('blogs') }}" class="block rounded-lg px-3 py-2 hover:bg-green-50 hover:text-green-700">Blogs</a></li>
                    <li><a href="{{ route('contact') }}" class="block rounded-lg px-3 py-2 hover:bg-green-50 hover:text-green-700">Contact</a></li>
                </ul>

                <a href="{{ route('subscription') }}" class="mt-3 w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 inline-block text-center">
                    Subscribe
                </a>

                @guest
                    <div class="mt-4 flex flex-col gap-2">
                        <a href="{{ route('login') }}" class="block text-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">Login</a>
                        <a href="{{ route('register') }}" class="block text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Register</a>
                    </div>
                @else
                    <div class="mt-4 border-t pt-4">
                        <div class="flex items-center space-x-3 mb-3">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=40&background=0d6efd&color=fff" alt="Avatar" class="w-10 h-10 rounded-full">
                            @endif
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('user.dashboard') }}" class="block text-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">Dashboard</a>
                            <a href="{{ route('user.profile') }}" class="block text-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">Profile</a>
                            @if(auth()->user()->canManageBlogs())
                                <a href="{{ route('author.blogs.index') }}" class="block text-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">My Blogs</a>
                            @endif
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block text-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">Admin Panel</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</header>

<script>
(() => {
    // Mobile menu toggle
    const mobileButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileButton && mobileMenu) {
        mobileButton.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden');
            mobileButton.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
        });
    }

    // User dropdown menu toggle
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenu.contains(e.target) && !userMenuButton.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }
})();
</script>
