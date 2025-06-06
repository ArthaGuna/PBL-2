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
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" 
                                    min="{{ date('Y-m-d') }}">
                            </div>
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
                            <div class="flex justify-between mb-2 text-green-600 hidden" id="promo-section">
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

    {{-- javascripts --}}
    @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded'); // Debug log
        
        // Initialize date input with proper min date
        const tanggalKunjunganEl = document.getElementById('tanggal_kunjungan');
        if (tanggalKunjunganEl) {
            const today = new Date().toISOString().split('T')[0];
            tanggalKunjunganEl.setAttribute('min', today);
            console.log('Date input initialized with min date:', today);
        }
        
        // Format tanggal saat diubah
        tanggalKunjunganEl.addEventListener('change', function() {
            if (this.value) {
                const [year, month, day] = this.value.split('-');
                this.dataset.formatted = `${day}/${month}/${year}`;
                console.log('Date formatted:', this.dataset.formatted);
            }
        });

        // Step Navigation Functions
        function goToStep(step) {
            console.log('Attempting to go to step:', step);
            
            try {
                // Hide all steps
                const allSteps = document.querySelectorAll('[id^="step-"]:not([id*="indicator"])');
                console.log('Found steps:', allSteps.length);
                allSteps.forEach(el => {
                    el.classList.add('hidden');
                    console.log('Hidden step:', el.id);
                });
                
                // Show current step
                const currentStep = document.getElementById(`step-${step}`);
                if (currentStep) {
                    currentStep.classList.remove('hidden');
                    console.log('Showing step:', `step-${step}`);
                } else {
                    console.error('Step not found:', `step-${step}`);
                }
                
                // Update step indicators
                const allIndicators = document.querySelectorAll('[id^="step-indicator-"]');
                console.log('Found indicators:', allIndicators.length);
                allIndicators.forEach(el => {
                    el.classList.remove('border-blue-600', 'text-blue-600');
                    el.classList.add('border-gray-200', 'text-gray-500');
                });
                
                // Highlight current step indicator
                const currentIndicator = document.getElementById(`step-indicator-${step}`);
                if (currentIndicator) {
                    currentIndicator.classList.remove('border-gray-200', 'text-gray-500');
                    currentIndicator.classList.add('border-blue-600', 'text-blue-600');
                    console.log('Updated indicator for step:', step);
                }
                
                // Update summary if going to step 3
                if (step === 3) {
                    updateOrderSummary();
                }
            } catch (error) {
                console.error('Error in goToStep:', error);
            }
        }
        
        // Validation functions
        function validateStep1() {
            const tanggal = document.getElementById('tanggal_kunjungan').value;
            const waktu = document.getElementById('waktu_kunjungan').value;
            const jumlah = document.getElementById('jumlah_pengunjung').value;
            
            console.log('Step 1 validation:', {tanggal, waktu, jumlah});
            
            if (!tanggal) {
                alert('Harap pilih tanggal kunjungan');
                return false;
            }
            if (!waktu) {
                alert('Harap pilih waktu kunjungan');
                return false;
            }
            if (!jumlah || parseInt(jumlah) < 1) {
                alert('Harap masukkan jumlah pengunjung yang valid');
                return false;
            }
            
            return true;
        }
        
        function validateStep2() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            
            console.log('Step 2 validation:', {name, email, phone});
            
            if (!name) {
                alert('Harap masukkan nama lengkap');
                return false;
            }
            if (!email) {
                alert('Harap masukkan email');
                return false;
            }
            if (!phone) {
                alert('Harap masukkan nomor telepon');
                return false;
            }
            
            // Basic email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Format email tidak valid');
                return false;
            }
            
            return true;
        }
        
        // Event Listeners for Navigation Buttons
        const nextStep1Btn = document.getElementById('next-step-1');
        if (nextStep1Btn) {
            nextStep1Btn.addEventListener('click', function() {
                console.log('Next step 1 clicked');
                if (validateStep1()) {
                    goToStep(2);
                }
            });
            console.log('Next step 1 button listener added');
        } else {
            console.error('Next step 1 button not found');
        }
        
        const prevStep2Btn = document.getElementById('prev-step-2');
        if (prevStep2Btn) {
            prevStep2Btn.addEventListener('click', function() {
                console.log('Previous step 2 clicked');
                goToStep(1);
            });
        }
        
        const nextStep2Btn = document.getElementById('next-step-2');
        if (nextStep2Btn) {
            nextStep2Btn.addEventListener('click', function() {
                console.log('Next step 2 clicked');
                if (validateStep2()) {
                    goToStep(3);
                }
            });
        }
        
        const prevStep3Btn = document.getElementById('prev-step-3');
        if (prevStep3Btn) {
            prevStep3Btn.addEventListener('click', function() {
                console.log('Previous step 3 clicked');
                goToStep(2);
            });
        }
        
        // Apply promo code
        const applyPromoBtn = document.getElementById('apply-promo');
        if (applyPromoBtn) {
            applyPromoBtn.addEventListener('click', function() {
                const promoCode = document.getElementById('kode_promo').value.trim();
                if (promoCode) {
                    alert(`Kode promo ${promoCode} diterapkan!`);
                    console.log('Promo code applied:', promoCode);
                } else {
                    alert('Harap masukkan kode promo');
                }
            });
        }
        
        // Pay now button
        const payNowBtn = document.getElementById('pay-now');
        if (payNowBtn) {
            payNowBtn.addEventListener('click', function() {
                const termsChecked = document.getElementById('terms').checked;
                if (!termsChecked) {
                    alert('Anda harus menyetujui syarat dan ketentuan');
                    return;
                }
                alert('Pembayaran diproses!');
                console.log('Payment processing...');
            });
        }
        
        // Update order summary
        function updateOrderSummary() {
            console.log('Updating order summary');
            
            // Get values from form
            const dateInput = document.getElementById('tanggal_kunjungan');
            let formattedDate = '-';
            
            if (dateInput && dateInput.value) {
                formattedDate = dateInput.dataset.formatted || 
                               dateInput.value.split('-').reverse().join('/');
            }
            
            const timeValue = document.getElementById('waktu_kunjungan').value;
            const visitors = document.getElementById('jumlah_pengunjung').value;
            const promoCode = document.getElementById('kode_promo').value.trim();
            
            // Format time
            let formattedTime = '-';
            const timeOptions = {
                '08:00': '08:00 - 10:00',
                '10:00': '10:00 - 12:00',
                '13:00': '13:00 - 15:00',
                '15:00': '15:00 - 17:00'
            };
            formattedTime = timeOptions[timeValue] || '-';
            
            // Calculate total
            const pricePerPerson = 25000;
            const total = visitors ? parseInt(visitors) * pricePerPerson : 0;
            
            // Apply discount if promo code exists (demo only)
            let discount = 0;
            if (promoCode) {
                discount = Math.floor(total * 0.1); // 10% discount for demo
            }
            
            // Update summary elements
            const summaryElements = {
                'summary-date': formattedDate,
                'summary-time': formattedTime,
                'summary-visitors': visitors || '0',
                'summary-discount': `Rp ${discount.toLocaleString('id-ID')}`,
                'summary-total': `Rp ${(total - discount).toLocaleString('id-ID')}`
            };
            
            Object.entries(summaryElements).forEach(([id, value]) => {
                const element = document.getElementById(id);
                if (element) {
                    element.textContent = value;
                }
            });
            
            // Show/hide promo section
            const promoSection = document.getElementById('promo-section');
            if (promoSection) {
                if (discount > 0) {
                    promoSection.classList.remove('hidden');
                } else {
                    promoSection.classList.add('hidden');
                }
            }
            
            console.log('Order summary updated:', {formattedDate, formattedTime, visitors, discount, total});
        }
        
        // Initialize first step
        console.log('Initializing step 1');
        goToStep(1);
        
        console.log('All event listeners setup complete');
    });
</script>
@endpush
</x-app-layout>