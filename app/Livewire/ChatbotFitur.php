<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Chatbot;

class ChatbotFitur extends Component
{
    public $prompt = '';
    public $isTyping = false;
    public $chatOpen = false;
    public $history = [];
    public $recommendedQuestions = [];

    public function render()
    {
        return view('livewire.chat-bot-fitur');
    }

    public function toggleChat()
    {
        $this->chatOpen = !$this->chatOpen;
    }

    protected function getCustomAnswer($userPrompt)
    {
        $chatbots = Chatbot::all();

        foreach ($chatbots as $chatbot) {
            $keywords = is_array($chatbot->keyword)
                ? $chatbot->keyword
                : array_map('trim', explode(',', $chatbot->keyword));

            foreach ($keywords as $keyword) {
                if (stripos($userPrompt, $keyword) !== false) {
                    return $chatbot->answer;
                }
            }
        }
        return null;
    }

    public function submit($question = null)
    {
        $userPrompt = $question ?: trim($this->prompt);
        if (empty($userPrompt)) return;

        $this->prompt = '';
        $this->isTyping = true;
        $this->chatOpen = true;

        $this->history[] = ['q' => $userPrompt];

        // Cek jawaban dari database
        $foundAnswer = $this->getCustomAnswer($userPrompt);

        if ($foundAnswer) {
            usleep(1000000);
            $this->history[count($this->history) - 1]['a'] = $foundAnswer;
            $this->isTyping = false;
            return;
        }

        // Jika tidak ditemukan, fallback ke Gemini API
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . env('GEMINI_API_KEY'), [
                "contents" => [[
                    "parts" => [["text" => "Topik: Yeh Panes Penatahan Tabanan\n\nPertanyaan: {$userPrompt}"]],
                ]],
            ]);

            $text = $response->successful()
                ? $response->json()['candidates'][0]['content']['parts'][0]['text']
                : "Maaf, terjadi kesalahan pada server.";
        } catch (\Exception $e) {
            $text = "Gagal menghubungi layanan AI. Silakan coba lagi.";
        }

        usleep(1000000);
        $this->history[count($this->history) - 1]['a'] = $text;
        $this->isTyping = false;
    }
}
