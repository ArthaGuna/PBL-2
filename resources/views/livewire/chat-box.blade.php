<div class="fixed bottom-0 right-0 mb-4 mr-4 z-50">
    <!-- Chat Toggle Button -->
    <button id="chat-toggle" class="bg-blue-600 text-white p-3 rounded-full font-semibold hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition ease-in-out duration-150 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Chat Container (Hidden by default) -->
    <div id="chat-container" class="hidden fixed bottom-16 right-4 w-96 bg-white shadow-lg rounded-lg">
        <!-- Header -->
        <div class="bg-blue-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <p class="text-lg font-semibold">ESPA AI</p>
            <button id="chat-close" class="text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-full p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Chat Messages -->
        <div class="p-4 h-80 overflow-y-auto bg-gray-50" id="chat-messages">
            @foreach ( $history as $item )
            <!-- User Message -->
            <div class="mb-4">
                <div class="flex justify-end mb-1">
                    <span class="text-xs text-gray-500 font-medium">Anda</span>
                </div>
                <div class="flex justify-end">
                    <p class="bg-gray-200 text-gray-800 rounded-lg py-2 px-4 inline-block max-w-xs">{{ $item['q'] }}</p>
                </div>
            </div>
            
            <!-- AI Response -->
            <div class="mb-4">
                <div class="flex justify-start mb-1">
                    <span class="text-xs text-gray-500 font-medium">ESPA AI</span>
                </div>
                <div class="flex justify-start">
                    <p class="bg-blue-600 text-white rounded-lg py-2 px-4 inline-block max-w-xs">{{ $item['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Input Area -->
        <div class="p-4 border-t flex bg-white">
            <input 
                wire:model.live="prompt"
                type="text" 
                placeholder="Ketik pesan..." 
                class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 text-gray-700"
                wire:keydown.enter="submit"
                id="chat-input">
            <button
                type="button"
                wire:click="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-r-md font-semibold hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition ease-in-out duration-150">
                Kirim
            </button>
        </div>
    </div>
</div>

<script>
    let isChatOpen = false;

    // Toggle chat visibility
    document.getElementById('chat-toggle').addEventListener('click', function() {
        const chatContainer = document.getElementById('chat-container');
        if (chatContainer.classList.contains('hidden')) {
            chatContainer.classList.remove('hidden');
            isChatOpen = true;
        } else {
            chatContainer.classList.add('hidden');
            isChatOpen = false;
        }
    });

    // Close chat
    document.getElementById('chat-close').addEventListener('click', function() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.classList.add('hidden');
        isChatOpen = false;
    });

    // Auto-scroll to bottom when new messages arrive
    document.addEventListener('livewire:updated', function() {
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
        
        // Keep chat open after livewire update
        if (isChatOpen) {
            const chatContainer = document.getElementById('chat-container');
            if (chatContainer && chatContainer.classList.contains('hidden')) {
                chatContainer.classList.remove('hidden');
            }
        }
    });

    // Handle Livewire initialization
    document.addEventListener('livewire:init', function() {
        Livewire.on('messageSubmitted', function() {
            // Keep chat open after message submission
            if (isChatOpen) {
                const chatContainer = document.getElementById('chat-container');
                if (chatContainer && chatContainer.classList.contains('hidden')) {
                    chatContainer.classList.remove('hidden');
                }
            }
        });
    });
</script>