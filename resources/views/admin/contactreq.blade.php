@extends('admin.layouts.app')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-screen w-full">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Contact</h1>
        <p class="text-sm text-gray-500">Total: {{ $contactSubmissions->count() }}</p>
    </div>

    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="p-4">Name</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Subject</th>
                        <th class="p-4">Date</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">
                    @forelse($contactSubmissions as $submission)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="p-4 font-semibold">{{ $submission->name }}</td>
                        <td class="p-4 text-gray-500">{{ $submission->email }}</td>
                        <td class="p-4">{{ \Illuminate\Support\Str::limit($submission->subject, 50) }}</td>
                        <td class="p-4">{{ $submission->created_at ? $submission->created_at->format('M d, Y h:i A') : '-' }}</td>
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
