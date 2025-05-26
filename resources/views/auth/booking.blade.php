<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Pembelian Tiket') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> / <span class="text-gray-600">Beli Tiket</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Booking Form Container -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Form Steps Indicator -->
                <div class="flex border-b">
                    <div id="step-indicator-1" class="w-1/3 py-4 px-6 text-center border-b-2 border-blue-600 font-medium text-blue-600">
                        <span>Informasi Kunjungan</span>
                    </div>
                    <div id="step-indicator-2" class="w-1/3 py-4 px-6 text-center border-b-2 border-gray-200 font-medium text-gray-500">
                        <span>Detail Pengunjung</span>
                    </div>
                    <div id="step-indicator-3" class="w-1/3 py-4 px-6 text-center border-b-2 border-gray-200 font-medium text-gray-500">
                        <span>Pembayaran</span>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-6">
                    <!-- Step 1: Informasi Kunjungan -->
                    <div id="step-1">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Kunjungan</h2>
                        
                        <!-- Tanggal Kunjungan -->
                        <div class="mb-4">
                            <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan</label>
                            <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <!-- Waktu Kunjungan -->
                        <div class="mb-4">
                            <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700 mb-1">Waktu Kunjungan</label>
                            <select id="waktu_kunjungan" name="waktu_kunjungan" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Waktu</option>
                                <option value="08:00">08:00 - 10:00</option>
                                <option value="10:00">10:00 - 12:00</option>
                                <option value="13:00">13:00 - 15:00</option>
                                <option value="15:00">15:00 - 17:00</option>
                            </select>
                        </div>
                        
                        <!-- Jumlah Pengunjung -->
                        <div class="mb-4">
                            <label for="jumlah_pengunjung" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pengunjung</label>
                            <input type="number" id="jumlah_pengunjung" name="jumlah_pengunjung" min="1" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <!-- Promo Code -->
                        <div class="mb-6">
                            <label for="kode_promo" class="block text-sm font-medium text-gray-700 mb-1">Kode Promo (Opsional)</label>
                            <div class="flex">
                                <input type="text" id="kode_promo" name="kode_promo" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" id="apply-promo" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Gunakan
                                </button>
                            </div>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="flex justify-end">
                            <button type="button" id="next-step-1" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Detail Pengunjung (Hidden Initially) -->
                    <div id="step-2" class="hidden">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Pengunjung</h2>
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="name" name="name" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="flex justify-between">
                            <button type="button" id="prev-step-2" 
                                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Kembali
                            </button>
                            <button type="button" id="next-step-2" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Pembayaran (Hidden Initially) -->
                    <div id="step-3" class="hidden">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Pemesanan</h2>
                        
                        <!-- Order Summary -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Tanggal Kunjungan:</span>
                                <span class="font-medium" id="summary-date">-</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Waktu Kunjungan:</span>
                                <span class="font-medium" id="summary-time">-</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Jumlah Pengunjung:</span>
                                <span class="font-medium" id="summary-visitors">-</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Harga Tiket:</span>
                                <span class="font-medium">Rp 25.000/orang</span>
                            </div>
                            <div class="flex justify-between mb-2 text-green-600" id="promo-section">
                                <span class="text-gray-600">Diskon:</span>
                                <span class="font-medium" id="summary-discount">Rp 0</span>
                            </div>
                            <div class="border-t border-gray-200 my-3"></div>
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total Pembayaran:</span>
                                <span id="summary-total">Rp 0</span>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Metode Pembayaran</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
                            <div class="border rounded-md p-3 text-center cursor-pointer hover:border-blue-500">
                                <div class="h-12 mb-2 flex items-center justify-center">
                                    <img src="https://via.placeholder.com/80x40?text=Bank+Transfer" alt="Bank Transfer" class="max-h-full">
                                </div>
                                <span class="text-sm">Bank Transfer</span>
                            </div>
                            <div class="border rounded-md p-3 text-center cursor-pointer hover:border-blue-500">
                                <div class="h-12 mb-2 flex items-center justify-center">
                                    <img src="https://via.placeholder.com/80x40?text=Gopay" alt="Gopay" class="max-h-full">
                                </div>
                                <span class="text-sm">Gopay</span>
                            </div>
                            <div class="border rounded-md p-3 text-center cursor-pointer hover:border-blue-500">
                                <div class="h-12 mb-2 flex items-center justify-center">
                                    <img src="https://via.placeholder.com/80x40?text=OVO" alt="OVO" class="max-h-full">
                                </div>
                                <span class="text-sm">OVO</span>
                            </div>
                            <div class="border rounded-md p-3 text-center cursor-pointer hover:border-blue-500">
                                <div class="h-12 mb-2 flex items-center justify-center">
                                    <img src="https://via.placeholder.com/80x40?text=Dana" alt="Dana" class="max-h-full">
                                </div>
                                <span class="text-sm">Dana</span>
                            </div>
                        </div>
                        
                        <!-- Terms and Conditions -->
                        <div class="mb-6">
                            <div class="flex items-start">
                                <input type="checkbox" id="terms" name="terms" class="mt-1">
                                <label for="terms" class="ml-2 block text-sm text-gray-700">
                                    Saya menyetujui syarat dan ketentuan yang berlaku. Pembatalan atau perubahan pesanan dapat dilakukan maksimal 1x24 jam sebelum waktu kunjungan.
                                </label>
                            </div>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="flex justify-between">
                            <button type="button" id="prev-step-3" 
                                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Kembali
                            </button>
                            <button type="button" id="pay-now" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Login/Register Prompt -->
            @guest
            <div class="mt-6 text-center">
                <p class="text-gray-600">Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 hover:underline focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded">
                        {{ __('Masuk disini') }}
                    </a>
                </p>
                <p class="text-gray-600 mt-1">Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 hover:underline focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded">
                        {{ __('Daftar disini') }}
                    </a>
                </p>
            </div>
            @endguest
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Step Navigation Functions
            function goToStep(step) {
                // Hide all steps
                document.querySelectorAll('[id^="step-"]').forEach(el => {
                    el.classList.add('hidden');
                });
                
                // Show current step
                document.getElementById(`step-${step}`).classList.remove('hidden');
                
                // Update step indicators
                document.querySelectorAll('[id^="step-indicator-"]').forEach(el => {
                    el.classList.remove('border-blue-600', 'text-blue-600');
                    el.classList.add('border-gray-200', 'text-gray-500');
                });
                
                // Highlight current step indicator
                const currentIndicator = document.getElementById(`step-indicator-${step}`);
                currentIndicator.classList.remove('border-gray-200', 'text-gray-500');
                currentIndicator.classList.add('border-blue-600', 'text-blue-600');
                
                // Update summary if going to step 3
                if (step === 3) {
                    updateOrderSummary();
                }
            }
            
            // Event Listeners for Navigation Buttons
            document.getElementById('next-step-1').addEventListener('click', function() {
                // Basic validation for step 1
                const tanggal = document.getElementById('tanggal_kunjungan').value;
                const waktu = document.getElementById('waktu_kunjungan').value;
                const jumlah = document.getElementById('jumlah_pengunjung').value;
                
                if (!tanggal || !waktu || !jumlah) {
                    alert('Harap lengkapi semua informasi kunjungan');
                    return;
                }
                
                goToStep(2);
            });
            
            document.getElementById('prev-step-2').addEventListener('click', function() {
                goToStep(1);
            });
            
            document.getElementById('next-step-2').addEventListener('click', function() {
                // Basic validation for step 2
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const phone = document.getElementById('phone').value;
                
                if (!name || !email || !phone) {
                    alert('Harap lengkapi semua detail pengunjung');
                    return;
                }
                
                goToStep(3);
            });
            
            document.getElementById('prev-step-3').addEventListener('click', function() {
                goToStep(2);
            });
            
            // Apply promo code
            document.getElementById('apply-promo').addEventListener('click', function() {
                const promoCode = document.getElementById('kode_promo').value;
                if (promoCode) {
                    alert(`Kode promo ${promoCode} diterapkan!`);
                    // Here you would typically validate the promo code with your backend
                }
            });
            
            // Pay now button
            document.getElementById('pay-now').addEventListener('click', function() {
                if (!document.getElementById('terms').checked) {
                    alert('Anda harus menyetujui syarat dan ketentuan');
                    return;
                }
                alert('Pembayaran diproses!');
                // Here you would typically process the payment
            });
            
            // Update order summary
            function updateOrderSummary() {
                // Get values from form
                const date = document.getElementById('tanggal_kunjungan').value;
                const time = document.getElementById('waktu_kunjungan').value;
                const visitors = document.getElementById('jumlah_pengunjung').value;
                const promoCode = document.getElementById('kode_promo').value;
                
                // Format date
                const formattedDate = date ? new Date(date).toLocaleDateString('id-ID', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                }) : '-';
                
                // Format time
                let formattedTime = '-';
                if (time === '08:00') formattedTime = '08:00 - 10:00';
                else if (time === '10:00') formattedTime = '10:00 - 12:00';
                else if (time === '13:00') formattedTime = '13:00 - 15:00';
                else if (time === '15:00') formattedTime = '15:00 - 17:00';
                
                // Calculate total
                const pricePerPerson = 25000;
                const total = visitors ? visitors * pricePerPerson : 0;
                
                // Apply discount if promo code exists (demo only)
                let discount = 0;
                if (promoCode) {
                    discount = total * 0.1; // 10% discount for demo
                }
                
                // Update summary
                document.getElementById('summary-date').textContent = formattedDate;
                document.getElementById('summary-time').textContent = formattedTime;
                document.getElementById('summary-visitors').textContent = visitors || '0';
                document.getElementById('summary-discount').textContent = `Rp ${discount.toLocaleString('id-ID')}`;
                document.getElementById('summary-total').textContent = `Rp ${(total - discount).toLocaleString('id-ID')}`;
                
                // Show/hide promo section
                document.getElementById('promo-section').classList.toggle('hidden', discount === 0);
            }
            
            // Initialize first step
            goToStep(1);
        });
    </script>
    @endpush
</x-app-layout>