<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Jacuzzi (Private Pool)') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/jacuzzi') }}" class="hover:underline text-[#0288D1]">Beranda</a> / <span
                    class="text-gray-600">Jacuzzi</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Gambar -->
            <div class="mb-8">
                <img src="{{ asset('img/airpanas.png') }}" alt="Tentang Kami"
                    class="w-3xl h-auto rounded-lg shadow-md object-cover">
            </div>

            <!-- Teks -->
            <div class="text-gray-700 text-justify text-sm sm:text-base leading-relaxed space-y-4">
                <p>
                    Selamat datang di Wisata Air Panas Penatahan — tempat di mana ketenangan alam dan kehangatan alami
                    berpadu sempurna. Terletak di jantung Desa Penatahan yang asri, kami hadir untuk memberikan
                    pengalaman relaksasi dan penyembuhan melalui sumber air panas alami yang kaya akan mineral.
                </p>
                <p>
                    Kami berkomitmen untuk menghadirkan suasana yang nyaman, bersih, dan ramah bagi setiap pengunjung.
                    Dengan memadukan keindahan alam, pelayanan yang hangat, dan budaya lokal yang kaya, kami berharap
                    dapat menjadi destinasi pilihan untuk beristirahat dan melepas penat dari hiruk-pikuk keseharian.
                </p>
                <p>
                    Mari rasakan sendiri keajaiban alam yang kami tawarkan, dan jadikan momen Anda di Penatahan sebagai
                    kenangan yang tak terlupakan.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>