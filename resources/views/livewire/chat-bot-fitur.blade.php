<div class="fixed bottom-0 right-0 mb-4 mr-4 z-50">
    <!-- Chat Toggle Button -->
    <button wire:click="toggleChat" id="chat-toggle"
        class="bg-blue-600 text-white p-1 rounded-full shadow-lg hover:bg-blue-700 transition flex items-center justify-center h-12 w-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Chat Container -->
    <div id="chat-container"
        class="fixed bottom-20 right-4 w-96 bg-white border border-gray-200 rounded-lg shadow-xl transition-all duration-300 flex flex-col"
        style="height: 500px; @if(!$chatOpen) transform: scale(0.95); opacity: 0; pointer-events: none; @else transform: scale(1); opacity: 1; pointer-events: auto; @endif">

        <!-- Header -->
        <div class="bg-blue-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 rounded-full bg-blue-400 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="font-semibold">ESPA AI</span>
            </div>
            <button wire:click="toggleChat" class="hover:text-blue-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Chat Messages -->
        <div class="flex-1 p-4 overflow-y-auto bg-gray-50" id="chat-messages">
            @if (count($history) === 0)
                <div class="text-center mb-4">
                    <div class="w-16 h-16 mx-auto mb-2 rounded-full bg-blue-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="font-medium text-gray-700">ESPA AI Assistant</h3>
                    <p class="text-sm text-gray-500 mb-4">Ada yang bisa saya bantu?</p>

                    <div class="grid grid-cols-1 gap-2">
                        @foreach ($recommendedQuestions as $question)
                            <button wire:click="submit('{{ $question }}')"
                                class="text-left w-full bg-white border border-gray-200 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-50 transition text-sm">
                                {{ $question }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            @foreach ($history as $index => $item)
                <!-- User Message -->
                <div class="mb-4">
                    <div class="flex justify-end">
                        <div class="bg-blue-600 text-white rounded-lg py-2 px-3 max-w-xs lg:max-w-md">
                            {{ $item['q'] }}
                        </div>
                    </div>
                    <div class="flex justify-end mt-1">
                        <span class="text-xs text-gray-500">Anda</span>
                    </div>
                </div>

                <!-- AI Response -->
                @if(isset($item['a']))
                    <div class="mb-4">
                        <div class="flex justify-start">
                            <div class="bg-gray-100 text-gray-800 rounded-lg py-2 px-3 max-w-xs lg:max-w-md">
                                {!! $item['a'] !!}
                            </div>
                        </div>
                        <div class="flex justify-start mt-1">
                            <span class="text-xs text-gray-500">ESPA AI</span>
                        </div>
                    </div>
                @elseif($isTyping && $index === count($history) - 1)
                    <div class="mb-4">
                        <div class="flex justify-start">
                            <div class="bg-gray-100 text-gray-800 rounded-lg py-2 px-3 max-w-xs lg:max-w-md">
                                <div class="flex space-x-1">
                                    <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 0ms">
                                    </div>
                                    <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 150ms">
                                    </div>
                                    <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 300ms">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start mt-1">
                            <span class="text-xs text-gray-500">ESPA AI sedang mengetik...</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t bg-white">
            <div class="flex rounded-lg border border-gray-300 overflow-hidden">
                <input wire:model="prompt" wire:keydown.enter="submit" type="text"
                    class="flex-1 px-4 py-2 focus:outline-none text-sm" placeholder="Masukan pertanyaan..."
                    id="chat-input">
                <button wire:click="submit" wire:loading.attr="disabled"
                    class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700 transition flex items-center justify-center">
                    <svg wire:loading.remove wire:target="submit" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg wire:loading wire:target="submit" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>
            <p class="text-xs text-gray-500 mt-2 text-center">ESPA AI bisa membuat kesalahan. Periksa informasi penting.
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatMessages = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');

        function scrollToBottom() {
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        // Auto-scroll when new message arrives
        Livewire.hook('message.processed', (message) => {
            scrollToBottom();

            // Clear input after successful submission
            if (message.component.fingerprint.name === 'chatbot' &&
                message.updateQueue.some(update => update.method === 'submit')) {
                if (chatInput) {
                    chatInput.value = '';
                }
            }
        });

        // Also clear input when clicking the button (as fallback)
        document.addEventListener('click', function (e) {
            if (e.target.closest('button[wire\\:click="submit"]')) {
                setTimeout(() => {
                    if (chatInput) chatInput.value = '';
                }, 100);
            }
        });
    });
</script>