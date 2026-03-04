@extends('admin.layouts.app')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <p class="text-gray-500">Welcome back. Here's what's happening today.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Total Blogs</h3>
            <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalBlogs }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Registered Users</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $registeredUsers }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Contact Messages</h3>
            <p class="text-3xl font-bold text-pink-600 mt-2">{{ $totalContactMessages }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-4 md:p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Recent Blogs</h2>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-left border-collapse">
                <thead>
                    <tr class="text-gray-500 text-sm border-b">
                        <th class="py-2">Title</th>
                        <th class="py-2">Summary</th>
                        <th class="py-2">Date</th>
                        <th class="py-2 text-right">Status</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">
                    @forelse($blogs as $blog)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3">{{ $blog->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($blog->short_desc, 40) }}</td>
                        <td>{{ $blog->created_at ? $blog->created_at->format('M d, Y') : '-' }}</td>
                        <td class="text-right">
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                                Published
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-3 text-center text-gray-500">No blogs found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-4 md:p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Recent Contact Messages</h2>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-left border-collapse">
                <thead>
                    <tr class="text-gray-500 text-sm border-b">
                        <th class="py-2">Name</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Subject</th>
                        <th class="py-2">Date</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($contactSubmissions as $submission)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3">{{ $submission->name }}</td>
                        <td>{{ $submission->email }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($submission->subject, 50) }}</td>
                        <td>{{ $submission->created_at ? $submission->created_at->format('M d, Y h:i A') : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-3 text-center text-gray-500">No contact messages yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
