<x-filament::page>
    <style>
        /* Reset default Filament page styles */
        .filament-page {
            padding: 0 !important;
            margin: 0 !important;
            height: 100vh;
            background: #f8fafc;
        }

        /* Iframe container with subtle shadow and rounded corners */
        .iframe-container {
            height: calc(100vh - 3rem);
            margin: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }

        /* Iframe styling */
        .iframe-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        /* Header with title and actions */
        .iframe-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .iframe-container {
                margin: 0;
                border-radius: 0;
                height: 100vh;
            }

            .iframe-header {
                padding: 0.75rem 1rem;
            }
        }
    </style>

    <div class="iframe-container">
        <div class="iframe-header">
            <h2 class="text-xl font-semibold text-gray-800">
                Website Preview
                <span class="text-sm text-gray-500 ml-2">Live Mode</span>
            </h2>
            <div class="flex space-x-2">
                <button @click="window.location.reload()"
                    class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-100 rounded-md transition">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Refresh
                    </span>
                </button>
                <a href="{{ url('/') }}" target="_blank"
                    class="px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                    Open in New Tab
                </a>
            </div>
        </div>
        <iframe src="{{ url('/') }}" class="w-full h-full" frameborder="0" title="Website Preview"></iframe>
    </div>

    <script>
        // Auto-resize iframe to content (if same domain)
        function resizeIframe() {
            const iframe = document.querySelector('iframe');
            try {
                iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
            } catch (e) {
                // Cross-origin security restriction
            }
        }

        // Refresh iframe every 30 seconds (optional)
        setInterval(() => {
            document.querySelector('iframe').contentWindow.location.reload();
        }, 30000);
    </script>
</x-filament::page>