<aside class="hidden md:flex md:w-64 min-h-screen bg-gray-900 text-gray-300 flex-col shadow-lg">
    <div class="p-6 text-2xl font-bold text-white border-b border-gray-700">
        Admin Panel
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 p-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.categories.index') }}"
           class="flex items-center gap-3 p-3 rounded-lg transition {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
            Categories
        </a>

        <a href="{{ route('admin.blogs.index') }}"
           class="flex items-center gap-3 p-3 rounded-lg transition {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
            Blogs
        </a>

        <a href="{{ route('admin.contactreq.index') }}"
           class="flex items-center gap-3 p-3 rounded-lg transition {{ request()->routeIs('admin.contactreq.index') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
            Contact
        </a>

        <a href="#"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            Users
        </a>

        <a href="#"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            Settings
        </a>
    </nav>

    <div class="p-4 border-t flex items-center justify-between text-sm">
        <div>
            <p class="text-gray-400">Logged in as</p>
            <p class="font-semibold text-white">Admin</p>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="p-2 rounded-lg hover:bg-red-500/20 transition" title="Logout">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-400 hover:text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12h-9m0 0l3-3m-3 3l3 3" />
                </svg>
            </button>
        </form>
    </div>
</aside>

<nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-gray-900 border-t border-gray-700">
    <div class="grid grid-cols-4">
        <a href="{{ route('admin.dashboard') }}"
           class="py-3 flex items-center justify-center {{ request()->routeIs('admin.dashboard') ? 'text-white bg-gray-800' : 'text-gray-300' }}"
           aria-label="Dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h8V3H3v10zm10 8h8V3h-8v18zM3 21h8v-6H3v6z" />
            </svg>
        </a>

        <a href="{{ route('admin.blogs.index') }}"
           class="py-3 flex items-center justify-center {{ request()->routeIs('admin.blogs.*') ? 'text-white bg-gray-800' : 'text-gray-300' }}"
           aria-label="Blogs">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21h-15A2.5 2.5 0 012 18.5v-13A2.5 2.5 0 014.5 3h15A2.5 2.5 0 0122 5.5v13a2.5 2.5 0 01-2.5 2.5zM7 7h10M7 11h10M7 15h6" />
            </svg>
        </a>

        <a href="{{ route('admin.contactreq.index') }}"
           class="py-3 flex items-center justify-center {{ request()->routeIs('admin.contactreq.index') ? 'text-white bg-gray-800' : 'text-gray-300' }}"
           aria-label="Contact">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6m-6 8h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </a>

        <form method="POST" action="{{ route('admin.logout') }}" class="py-3 flex items-center justify-center">
            @csrf
            <button type="submit" class="text-red-400" aria-label="Logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12h-9m0 0l3-3m-3 3l3 3" />
                </svg>
            </button>
        </form>
    </div>
</nav>
