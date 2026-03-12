@extends('admin.layouts.app')

@section('content')
<div class="p-8 bg-gray-100 min-h-screen w-5xl">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Contact Requests</h1>
    </div>

    <!-- Contact Requests Table -->
    <div class="bg-white shadow rounded-2xl overflow-hidden">

        <table class="w-full text-left table-fixed">

            <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="p-4 w-36">Name</th>
                    <th class="p-4 w-60">Email</th>
                    <th class="p-4 w-40">Subject</th>
                    <th class="p-4 w-80">Message</th>
                    <th class="p-4 w-32">Date</th>
                    <th class="p-4 w-24 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">

                @forelse($contactSubmissions as $submission)
                <tr class="border-t hover:bg-gray-50 transition">

                    <!-- Name -->
                    <td class="p-4 font-semibold">
                        {{ $submission->name }}
                    </td>

                    <!-- Email -->
                    <td class="p-4 text-gray-500">
                        {{ $submission->email }}
                    </td>

                    <!-- Subject -->
                    <td class="p-4">
                        {{ $submission->subject }}
                    </td>

                    <!-- Message -->
                    <td class="p-4 text-gray-500">
                        <div class="truncate" title="{{ $submission->message }}">
                            {{ \Illuminate\Support\Str::limit($submission->message, 20) }}
                        </div>
                    </td>

                    <!-- Date -->
                    <td class="p-4 text-gray-500">
                        {{ $submission->created_at->format('M d, Y') }}
                    </td>

                    <!-- Actions -->
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <!-- View Button -->
                            <button data-submission-id="{{ $submission->id }}" 
                                    class="view-message-btn inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group"
                                    title="View Message">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002 2v12a2 2 0 002-2 2v-4a2 2 0 011.316 1.624l-6.732-3.376a4 4 0 016.624 1.624L9 16.07a4 4 0 01-1.897 1.13L6 18l.8-2.685a4 4 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>

                            <!-- Delete Button -->
                            <form method="POST" action="{{ route('admin.contactreq.delete', $submission->id) }}"
                                  onsubmit="return confirm('Delete this contact request?');">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group"
                                        title="Delete Contact Request">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.377H6.084a2.25 2.25 0 01-2.244-2.377L4.774 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-3 text-center text-gray-500">No contact requests found</td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- Include Message Modal Component -->
@include('admin.contact-requests.message-modal', ['contactSubmissions' => $contactSubmissions])

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.view-message-btn').forEach(button => {
        button.addEventListener('click', function() {
            const submissionId = this.dataset.submissionId;
            showMessage(submissionId);
        });
    });
});
</script>
@endsection
