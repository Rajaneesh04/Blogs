@extends('admin.layouts.app')

@section('content')
<div class="p-8 bg-gray-100 min-h-screen w-5xl">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Users Management</h1>
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow rounded-2xl overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="p-4">Name</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Joined Date</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">

                @forelse($users as $user)
                <tr class="border-t hover:bg-gray-50 transition">

                    <!-- Name -->
                    <td class="p-4 font-semibold">
                        {{ $user->name }}
                    </td>

                    <!-- Email -->
                    <td class="p-4 text-gray-500">
                        {{ $user->email }}
                    </td>

                    <!-- Status -->
                    <td class="p-4">
                        @if($user->is_active)
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                                Active
                            </span>
                        @else
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <!-- Joined Date -->
                    <td class="p-4 text-gray-500">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>

                    <!-- Actions -->
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">

                            <!-- Toggle Active Status -->
                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline">
                                @csrf
                                @php
    $confirmMessage = "Are you sure you want to " . ($user->is_active ? "deactivate" : "activate") . " this user?";
@endphp
                                <button type="submit" 
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg transition-all duration-200 group {{ $user->is_active ? 'text-green-500 hover:bg-green-50' : 'text-red-500 hover:bg-red-50' }}"
                                        onclick="return confirm('{{ $confirmMessage }}')"
                                        title="{{ $user->is_active ? 'Deactivate User' : 'Activate User' }}">
                                        
                                    <!-- Tick Icon for both active/inactive, color changes -->
                                    @if($user->is_active)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#10b981" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#ef4444" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </button>
                            </form>

                            <!-- Delete User -->
                            <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group"
                                        onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')"
                                        title="Delete User">
                                    <!-- Delete Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-3 text-center text-gray-500">No users found</td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection
