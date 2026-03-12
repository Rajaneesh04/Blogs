<!-- Message Modal -->
<div id="messageModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 backdrop-blur-sm p-4" data-submissions="@json($contactSubmissions)">

    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-hidden animate-[fadeIn_.3s_ease] flex flex-col">

        <!-- Header -->
        <div class="flex items-center justify-between bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 text-white">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>

                </div>

                <div>
                    <h3 class="text-lg font-semibold">Message Details</h3>
                    <p class="text-sm text-blue-100">Contact form submission</p>
                </div>
            </div>

            <!-- Close Button -->
            <button onclick="closeModal()" class="hover:bg-white/20 p-2 rounded-lg transition">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>


        <!-- Body -->
        <div class="flex-1 p-6 space-y-4 overflow-y-auto max-h-[60vh]">

            <div id="modalContent"></div>

        </div>


        <!-- Footer -->
        <div class="bg-gray-50 px-6 py-4 flex justify-end">

            <button onclick="closeModal()"
                class="bg-gray-700 text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">
                Close
            </button>

        </div>

    </div>

</div>

<!-- Initialize submissions and modal functionality -->
<script>
const submissions = JSON.parse(document.getElementById('messageModal').dataset.submissions);

// Modal functionality
function showMessage(id) {
    const submission = submissions.find(s => s.id === id);
    
    if (submission) {
        const content = `
            <!-- Person Information -->
            <div class="bg-blue-50 rounded-lg p-4 mb-4">
                <div class="flex items-start gap-3">
                    <!-- Avatar -->
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                        ${submission.name.charAt(0).toUpperCase()}
                    </div>
                    
                    <!-- Name and Email -->
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-900 text-lg mb-1">${submission.name}</h4>
                        <div class="flex items-center gap-2 text-gray-600 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>${submission.email}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subject -->
            <div class="bg-amber-50 rounded-lg p-4 mb-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg flex items-center justify-center text-white shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h10m-7 4h10" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h5 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-1">Subject</h5>
                        <p class="text-gray-900 font-bold text-base">${submission.subject}</p>
                    </div>
                </div>
            </div>

            <!-- Message -->
            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                <div class="flex items-start gap-3 mb-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center text-white shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7a2 2 0 002-2v-4a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h5 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-1">Message</h5>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-3 border border-gray-200">
                    <p class="text-gray-700 leading-relaxed text-sm">${submission.message}</p>
                </div>
            </div>

            <!-- Timestamp -->
            <div class="bg-slate-50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-slate-400 to-gray-500 rounded-lg flex items-center justify-center text-white shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3v4m-6 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h5 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-1">Received</h5>
                        <p class="text-gray-900 font-medium text-sm">${new Date(submission.created_at).toLocaleDateString('en-US', { 
                            year: 'numeric', 
                            month: 'short', 
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        })}</p>
                    </div>
                </div>
            </div>
        `;
        
        document.getElementById('modalContent').innerHTML = content;
        document.getElementById('messageModal').style.display = 'flex';
    }
}

function closeModal() {
    document.getElementById('messageModal').style.display = 'none';
}
</script>