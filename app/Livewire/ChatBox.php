<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChatBox extends Component
{
    public $prompt = '';
    public $history = [];

    public function render()
    {
        return view('livewire.chat-box');
    }
    
    public function submit()
    {
        // Validate input
        $this->validate([
            "prompt" => "required|string|max:1000"
        ]);

        // Store the prompt before clearing it
        $userPrompt = trim($this->prompt);
        
        // Clear the prompt immediately
        $this->prompt = '';

        $historyValue = ["q" => $userPrompt];

        try {
            $response = Http::timeout(30)->withHeaders([
                "Content-Type" => "application/json"
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . env('GEMINI_API_KEY'), [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => $userPrompt]
                        ]
                    ]
                ]
            ]);

            if($response->successful()){
                $text = $response->json()['candidates'][0]['content']['parts'][0]['text'];
            } else {
                $text = "Ada sesuatu yang salah. Silakan coba lagi.";
            }
        } catch (\Exception $e) {
            $text = "Terjadi kesalahan dalam mengirim pesan. Silakan coba lagi.";
        }

        $historyValue['a'] = $text;
        $this->history[] = $historyValue;
        
        // Dispatch event to JavaScript
        $this->dispatch('messageSubmitted');
    }
}