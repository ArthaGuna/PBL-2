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

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8 bg-white border-b border-gray-200">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-8">Reservasi Pemandian Air Panas</h2>
                    
                    <form method="POST" action="{{ route('reservasi.proses') }}" id="reservasi-form">   
                        @csrf
                        <input type="hidden" id="total_harga" name="total_harga" value="50000">
                        
                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Kolom Kiri - Form Reservasi -->
                            <div class="flex-1 space-y-4 sm:space-y-6">
                                <!-- Nama Wisatawan -->
                                <div>
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-700">Nama Anda</label>
                                    <input type="text" id="nama" name="nama" value="{{ Auth::user()->name }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                           required>
                                </div>
                                
                                <!-- Pilihan Layanan -->
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Layanan</label>
                                    <div class="space-y-2 sm:space-y-3">
                                        <!-- Pemandian Air Panas Umum -->
                                        <div class="flex items-center ps-4 border border-gray-200 rounded-lg hover:border-blue-500">
                                            <input id="layanan-umum" type="radio" value="umum" name="layanan" 
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" 
                                                   checked>
                                            <label for="layanan-umum" class="w-full py-3 sm:py-4 ms-2 text-sm font-medium text-gray-900">
                                                Pemandian Air Panas Umum
                                                <p class="text-xs text-gray-500 mt-1">Rp 50.000/orang</p>
                                            </label>
                                        </div>
                                        
                                        <!-- Jacuzzi Private -->
                                        <div class="flex items-center ps-4 border border-gray-200 rounded-lg hover:border-blue-500">
                                            <input id="layanan-jacuzzi" type="radio" value="jacuzzi" name="layanan" 
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                            <label for="layanan-jacuzzi" class="w-full py-3 sm:py-4 ms-2 text-sm font-medium text-gray-900">
                                                Jacuzzi (Private)
                                                <p class="text-xs text-gray-500 mt-1">Rp 150.000/orang</p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3 sm:gap-4">
                                    <!-- Tanggal Kunjungan -->
                                    <div>
                                        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                                        <input type="date" id="tanggal" name="tanggal" min="{{ date('Y-m-d') }}"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                               required>
                                    </div>
                                    
                                    <!-- Waktu Kunjungan -->
                                    <div>
                                        <label for="waktu" class="block mb-2 text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                                        <input type="time" id="waktu" name="waktu" min="08:00" max="22:00"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                               required>
                                    </div>
                                </div>
                                
                                <!-- Jumlah Orang -->
                                <div>
                                    <label for="jumlah_orang" class="block mb-2 text-sm font-medium text-gray-700">Jumlah Pengunjung</label>
                                    <input type="number" id="jumlah_orang" name="jumlah_orang" min="1" max="10" 
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                           value="1" required>
                                </div>
                            </div>
                            
                            <!-- Kolom Kanan - Pembayaran -->
                            <div class="flex-1 space-y-4 sm:space-y-6">
                                <div class="p-4 sm:p-6 bg-gray-50 rounded-lg border border-gray-200 lg:sticky lg:top-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-3 sm:mb-4">Ringkasan Pembayaran</h3>
                                    
                                    <!-- Total Harga -->
                                    <div class="space-y-2 sm:space-y-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-700">Subtotal:</span>
                                            <span id="subtotal" class="font-semibold">Rp 50.000</span>
                                        </div>
                                        <hr class="my-2 border-gray-300">
                                        <div class="flex justify-between items-center">
                                            <span class="text-base sm:text-lg font-bold text-gray-800">Total Bayar:</span>
                                            <span id="total-bayar" class="text-lg sm:text-xl font-bold text-blue-600">Rp 50.000</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Button Bayar Sekarang -->
                                    <button type="submit" id="pay-button"
                                            class="w-full mt-4 sm:mt-6 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2 sm:py-3 text-center uppercase tracking-wider">
                                        BAYAR SEKARANG
                                    </button>
                                </div>
                                
                                <!-- Informasi Tambahan -->
                                <div class="p-3 sm:p-4 bg-blue-50 rounded-lg border border-blue-100">
                                    <h4 class="text-xs sm:text-sm font-semibold text-blue-800 mb-1 sm:mb-2">Informasi Penting</h4>
                                    <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
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

    @push('scripts')
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" 
                data-client-key="{{ config('midtrans.client_key') }}"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const timeInput = document.getElementById('waktu');
                const dateInput = document.getElementById('tanggal');
                
                dateInput.addEventListener('change', function() {
                    const today = new Date();
                    const selectedDate = new Date(this.value);
                    const todayDate = new Date(today.toDateString());
                    
                    if (selectedDate.toDateString() === todayDate.toDateString()) {
                        const currentHour = today.getHours();
                        const currentMinute = today.getMinutes();
                        timeInput.min = `${currentHour + 1}:${currentMinute.toString().padStart(2, '0')}`;
                    } else {
                        timeInput.min = '08:00';
                    }
                });
                
                function calculateTotal() {
                    const hargaUmum = 50000;
                    const hargaJacuzzi = 150000;
                    const jumlah = parseInt(document.getElementById('jumlah_orang').value) || 1;
                    const isUmum = document.getElementById('layanan-umum').checked;
                    
                    const subtotal = isUmum ? hargaUmum * jumlah : hargaJacuzzi * jumlah;
                    
                    document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
                    document.getElementById('total-bayar').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
                    document.getElementById('total_harga').value = subtotal;
                }
                
                document.getElementById('layanan-umum').addEventListener('change', calculateTotal);
                document.getElementById('layanan-jacuzzi').addEventListener('change', calculateTotal);
                document.getElementById('jumlah_orang').addEventListener('input', calculateTotal);
                
                calculateTotal();
                
                const payButton = document.getElementById('pay-button');
                const form = document.getElementById('reservasi-form');
                
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    payButton.disabled = true;
                    payButton.innerHTML = 'Memproses...';
                    
                    fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.snapToken) {
                            snap.pay(data.snapToken, {
                                onSuccess: function(result) {
                                    window.location.href = "{{ route('reservasi.thankyou') }}?order_id=" + data.reservasi.kode_booking;
                                },
                                onPending: function(result) {
                                    window.location.href = "{{ route('reservasi.pending') }}?order_id=" + data.reservasi.kode_booking;
                                },
                                onError: function(result) {
                                    window.location.href = "{{ route('reservasi.failed') }}?order_id=" + data.reservasi.kode_booking;
                                },
                                onClose: function() {
                                    payButton.disabled = false;
                                    payButton.innerHTML = 'BAYAR SEKARANG';
                                }
                            });
                        } else {
                            alert(data.message || 'Terjadi kesalahan saat memproses pembayaran');
                            payButton.disabled = false;
                            payButton.innerHTML = 'BAYAR SEKARANG';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses reservasi');
                        payButton.disabled = false;
                        payButton.innerHTML = 'BAYAR SEKARANG';
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>