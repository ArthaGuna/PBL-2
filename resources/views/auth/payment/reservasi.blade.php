<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Reservasi Pemandian Air Panas') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda /</a>
                <span class="text-gray-600">Beli Tiket</span>
            </div>
        </div>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Reservasi Pemandian Air Panas</h2>

                    <form method="POST" action="{{ route('reservasi.proses') }}" id="reservasi-form">
                        @csrf
                        <input type="hidden" id="total_harga" name="total_harga" value="">

                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Kolom Kiri -->
                            <div class="flex-1 space-y-4 sm:space-y-6">
                                <div>
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-700">Nama Anda</label>
                                    <input type="text" id="nama" name="nama" value="{{ Auth::user()->name }}"
                                           class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                                </div>

                                <!-- Pilih Layanan -->
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Layanan</label>
                                    <div class="space-y-2">
                                        @foreach ($layanans as $layanan)
                                            <div class="flex items-center ps-4 border border-gray-200 rounded-lg hover:border-blue-500">
                                                <input type="radio" id="layanan-{{ $layanan->id }}"
                                                       name="layanan" value="{{ $layanan->id }}"
                                                       data-harga="{{ $layanan->tiket->harga ?? 0 }}"
                                                       data-maks="{{ $layanan->tiket->maks_pengunjung ?? 10 }}"
                                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300"
                                                       {{ $loop->first ? 'checked' : '' }}>
                                                <label for="layanan-{{ $layanan->id }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900">
                                                    {{ $layanan->nama_layanan }}
                                                    <p class="text-xs text-gray-500 mt-1">Rp {{ number_format($layanan->tiket->harga ?? 0, 0, ',', '.') }}/orang</p>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="tanggal" class="block mb-2 text-sm text-gray-700">Tanggal Kunjungan</label>
                                        <input type="date" id="tanggal" name="tanggal" min="{{ date('Y-m-d') }}"
                                               class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                                    </div>
                                    <div>
                                        <label for="waktu" class="block mb-2 text-sm text-gray-700">Waktu Kunjungan</label>
                                        <input type="time" id="waktu" name="waktu" min="08:00" max="20.00"
                                               class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                                    </div>
                                </div>

                                <div>
                                    <label for="jumlah_orang" class="block mb-2 text-sm font-medium text-gray-700">Jumlah Pengunjung</label>
                                    <input type="number" id="jumlah_orang" name="jumlah_orang" min="1" value="1"
                                           class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                                    <p id="jumlah-error" class="mt-1 text-xs text-red-600 hidden"></p>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="flex-1 space-y-4">
                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 lg:sticky lg:top-6">
                                    <h3 class="text-lg font-semibold mb-4">Ringkasan Pembayaran</h3>

                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span>Subtotal:</span>
                                            <span id="subtotal" class="font-semibold">-</span>
                                        </div>
                                        <hr>
                                        <div class="flex justify-between">
                                            <span class="font-bold text-base">Total Bayar:</span>
                                            <span id="total-bayar" class="text-blue-600 font-bold text-lg">-</span>
                                        </div>
                                    </div>

                                    <button type="submit" id="pay-button"
                                            class="w-full mt-4 text-white bg-gray-400 cursor-not-allowed text-xs px-5 py-3 rounded-lg uppercase tracking-wide"
                                            disabled>
                                        BAYAR SEKARANG
                                    </button>
                                </div>

                                <div class="p-3 bg-blue-50 rounded-lg border border-blue-100 text-xs text-blue-700">
                                    <strong class="block text-blue-800 mb-1">Informasi Penting</strong>
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Pembayaran harus dilakukan dalam waktu 1x24 jam</li>
                                        <li>Tunjukkan nomor booking ke petugas tiket</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('reservasi-form');
                const payButton = document.getElementById('pay-button');
                const jumlahOrang = document.getElementById('jumlah_orang');
                const nama = document.getElementById('nama');
                const tanggal = document.getElementById('tanggal');
                const waktu = document.getElementById('waktu');
                const jumlahError = document.getElementById('jumlah-error');

                function isFormValid() {
                    const layanan = document.querySelector('input[name="layanan"]:checked');
                    const jumlah = parseInt(jumlahOrang.value);
                    if (!layanan || isNaN(jumlah) || jumlah < 1) return false;

                    const maks = parseInt(layanan.dataset.maks);
                    return (
                        nama.value.trim() !== '' &&
                        tanggal.value !== '' &&
                        waktu.value !== '' &&
                        jumlah <= maks
                    );
                }

                function updateTotal() {
                    const layanan = document.querySelector('input[name="layanan"]:checked');
                    const jumlah = parseInt(jumlahOrang.value) || 0;

                    if (!layanan || !isFormValid()) {
                        document.getElementById('subtotal').textContent = '-';
                        document.getElementById('total-bayar').textContent = '-';
                        payButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                        payButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                        payButton.disabled = true;
                    } else {
                        const harga = parseInt(layanan.dataset.harga);
                        const total = harga * jumlah;

                        document.getElementById('subtotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
                        document.getElementById('total-bayar').textContent = 'Rp ' + total.toLocaleString('id-ID');
                        document.getElementById('total_harga').value = total;

                        payButton.disabled = false;
                        payButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        payButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    }

                    // Validasi jumlah pengunjung
                    if (layanan) {
                        const maks = parseInt(layanan.dataset.maks);
                        if (jumlah > maks) {
                            jumlahError.textContent = `Maksimal pengunjung untuk layanan ini adalah ${maks}`;
                            jumlahError.classList.remove('hidden');
                            payButton.disabled = true;
                            payButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                            payButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                        } else {
                            jumlahError.textContent = '';
                            jumlahError.classList.add('hidden');
                        }
                    }
                }

                form.addEventListener('change', updateTotal);
                form.addEventListener('input', updateTotal);
                updateTotal();

                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    if (payButton.disabled) return;

                    payButton.disabled = true;
                    payButton.innerHTML = `<svg class="inline w-4 h-4 mr-2 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                          </svg>Memproses...`;

                    const formData = new FormData(form);
                    fetch('{{ route("reservasi.proses") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success' && data.snapToken) {
                                snap.pay(data.snapToken, {
                                    onSuccess: result => window.location.href = "{{ route('reservasi.thankyou') }}?order_id=" + result.order_id,
                                    onPending: result => window.location.href = "{{ route('reservasi.pending') }}?order_id=" + result.order_id,
                                    onError: () => {
                                        alert('Pembayaran gagal!');
                                        resetButton();
                                    },
                                    onClose: () => resetButton()
                                });
                            } else {
                                alert(data.message || 'Gagal memproses pembayaran');
                                resetButton();
                            }
                        })
                        .catch(() => {
                            alert('Terjadi kesalahan saat mengirim permintaan');
                            resetButton();
                        });

                    function resetButton() {
                        payButton.disabled = false;
                        payButton.textContent = 'BAYAR SEKARANG';
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
