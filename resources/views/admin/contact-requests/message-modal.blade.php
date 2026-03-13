<!-- Message Modal -->
<div id="messageModal" class="fixed inset-0 bg-black/60 z-50 backdrop-blur-sm p-4" style="display: none;" data-submissions="@json($contactSubmissions)">

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

            <!-- <button onclick="closeModal()"
                class="bg-gray-700 text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">
                Close
            </button> -->

        </div>

    </div>

</div>

<!-- Initialize submissions and modal functionality -->
<script>
// Modal HTML is included, but JavaScript functions are in the main file
</script>