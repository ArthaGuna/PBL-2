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
        'siapa', 'halo', 'hai', 'hi' => 'Saya adalah ESPA AI Asisstant. Ada yang dapat saya bantu? 😊',
        'harga', 'tiket' => 'Harga tiket masuk Yeh Panes adalah Rp20.000 untuk dewasa dan Rp10.000 untuk anak-anak.',
        'tiket' => 'Harga tiket masuk Yeh Panes adalah Rp20.000 untuk dewasa dan Rp10.000 untuk anak-anak.',
        'jam', 'buka' => 'Yeh Panes buka setiap hari dari pukul 07.00 hingga 18.00 WITA.',
        'fasilitas' => 'Fasilitas di Yeh Panes meliputi kolam air panas, spa, tempat makan, dan area parkir.',
        'reservasi' => 'Ya, reservasi online dapat dilakukan melalui website resmi Yeh Panes Penatahan atau WhatsApp.',
        'tempat', 'lokasi', 'maps', 'dimana' => 'Yeh Panes terletak di Jalan Batukaru, Desa Penatahan, Kabupaten Tabanan, Bali. Ayo nikmati kehangatan berendam di airpanasnya!😊
        <br><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.470477537418!2d115.11394577412748!3d-8.153243681549342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd221a626e1808d%3A0x730355ee7e420183!2sYeh%20Panes%20Hot%20Spring!5e0!3m2!1sen!2sid!4v1718618063212!5m2!1sen!2sid" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        
    ];

    public function mount()
    {
        $allQuestions = [
            'Berapa harga tiket masuknya?',
            'Jam berapa buka?',
            'Apa saja fasilitas yang ada?',
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
                    "parts" => [["text" => "Topik: Yeh Panes Penatahan Tabanan\n\nPertanyaan: {$userPrompt}"]],
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
