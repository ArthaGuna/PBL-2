<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Chatbot extends Component
{
    public $prompt = '';
    public $history = [];
    public $recommendedQuestions = [];
    public $isTyping = false;
    public $chatOpen = false;

    protected $customAnswers = [
        'harga tiket' => 'Harga tiket masuk Yeh Panes adalah Rp20.000 untuk dewasa dan Rp10.000 untuk anak-anak.',
        'tiket berapa' => 'Harga tiket masuk Yeh Panes adalah Rp20.000 untuk dewasa dan Rp10.000 untuk anak-anak.',
        'berapa tiket' => 'Harga tiket masuk Yeh Panes adalah Rp20.000 untuk dewasa dan Rp10.000 untuk anak-anak.',
        'jam buka' => 'Yeh Panes buka setiap hari dari pukul 08.00 hingga 20.00 WITA.',
        'fasilitas' => 'Fasilitas di Yeh Panes meliputi kolam air panas, spa, tempat makan, dan area parkir.',
        'reservasi' => 'Ya, reservasi online dapat dilakukan melalui website resmi atau WhatsApp.',
        'lokasi' => 'Yeh Panes terletak di Desa Penatahan, Tabanan, Bali.',
    ];

    public function mount()
    {
        $allQuestions = [
            'Berapa harga tiket masuk?',
            'Jam buka Yeh Panes?',
            'Apa saja fasilitas di Yeh Panes?',
            'Apakah bisa reservasi online?',
            'Dimana lokasi Yeh Panes Penatahan?',
        ];

        $this->recommendedQuestions = collect($allQuestions)
            ->shuffle()
            ->take(3)
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.chat-bot');
    }

    public function toggleChat()
    {
        $this->chatOpen = !$this->chatOpen;
    }

    public function submit($question = null)
    {
        $userPrompt = $question ?: trim($this->prompt);

        if (empty($userPrompt)) {
            return;
        }

        // Reset input field
        $this->prompt = '';

        $this->isTyping = true;
        $this->chatOpen = true;

        $historyValue = ['q' => $userPrompt];
        $this->history[] = $historyValue;

        // Check custom answers
        $foundAnswer = null;
        foreach ($this->customAnswers as $key => $answer) {
            if (stripos($userPrompt, $key) !== false) {
                $foundAnswer = $answer;
                break;
            }
        }

        if ($foundAnswer) {
            usleep(1000000); // 1 second delay
            $this->history[count($this->history) - 1]['a'] = $foundAnswer;
            $this->isTyping = false;
            return;
        }

        // Use Gemini API
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . env('GEMINI_API_KEY'), [
                "contents" => [[
                    "parts" => [["text" => "Topik: Yeh Panes Penatahan Bali\n\nPertanyaan: {$userPrompt}"]],
                ]],
            ]);

            $text = $response->successful()
                ? $response->json()['candidates'][0]['content']['parts'][0]['text']
                : "Maaf, terjadi kesalahan pada server.";
        } catch (\Exception $e) {
            $text = "Gagal menghubungi layanan AI. Silakan coba lagi.";
        }

        usleep(1000000); // 1 second delay
        $this->history[count($this->history) - 1]['a'] = $text;
        $this->isTyping = false;
    }
}
