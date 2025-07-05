<x-app-layout>
<div class="max-w-7xl mx-auto px-4 py-8">
  <!-- Header -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Riwayat Pembayaran</h1>
    <div class="text-xs text-gray-500">
      <a href="#" class="text-[#0288D1] hover:underline">Beranda /</a>
      <span class="text-gray-600">Riwayat Pembayaran</span>
    </div>
  </div>

  <!-- Filter Section -->
  <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6">
    <div class="flex flex-col md:flex-row gap-4">
      <div class="flex-1">
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2 text-sm">
          <option>Semua Status</option>
          <option>Menunggu Pembayaran</option>
          <option>Berhasil</option>
          <option>Gagal</option>
        </select>
      </div>
      <div class="flex-1">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
        <input type="month" class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2 text-sm">
      </div>
    </div>
  </div>

  <!-- Booking Items -->
  <div class="space-y-4">

    <!-- Item 1: Pending Payment -->
    <div class="bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
        <div>
          <h3 class="font-semibold text-gray-800">#BK20230715-001</h3>
          <p class="text-sm text-gray-500 mt-1">15 Jul 2023 10:30</p>
        </div>
        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Menunggu Pembayaran</span>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
          <p class="text-sm text-gray-500">Layanan</p>
          <p class="font-medium">Pemandian Air Panas Reguler</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Kunjungan</p>
          <p class="font-medium">20 Jul 2023 • 14:00</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Jumlah Orang</p>
          <p class="font-medium">2 orang</p>
        </div>
      </div>
      
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
          <p class="text-sm text-gray-500">Total Pembayaran</p>
          <p class="text-lg font-bold text-blue-600">Rp 60.000</p>
        </div>
        <div class="flex space-x-2">
          <a href="{{ route('reservasi') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
            Bayar Sekarang
          </a>
          <a href="{{ route('payment.detail') }}" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50">
            Detail
          </a>
        </div>
      </div>
    </div>

    <!-- Item 2: Success Payment -->
    <div class="bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
        <div>
          <h3 class="font-semibold text-gray-800">#BK20230710-005</h3>
          <p class="text-sm text-gray-500 mt-1">10 Jul 2023 14:15</p>
        </div>
        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Berhasil</span>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
          <p class="text-sm text-gray-500">Layanan</p>
          <p class="font-medium">Pemandian Air Panas VIP</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Kunjungan</p>
          <p class="font-medium">12 Jul 2023 • 16:00</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Jumlah Orang</p>
          <p class="font-medium">4 orang</p>
        </div>
      </div>
      
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
          <p class="text-sm text-gray-500">Total Pembayaran</p>
          <p class="text-lg font-bold text-blue-600">Rp 200.000</p>
        </div>
        <div class="flex space-x-2">
          <a href="{{ route('payment.detail') }}" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50">
            Detail
          </a>
        </div>
      </div>
    </div>

    <!-- Item 3: Expired Payment -->
    <div class="bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
        <div>
          <h3 class="font-semibold text-gray-800">#BK20230628-003</h3>
          <p class="text-sm text-gray-500 mt-1">28 Jun 2023 09:45</p>
        </div>
        <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">Kadaluarsa</span>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
          <p class="text-sm text-gray-500">Layanan</p>
          <p class="font-medium">Pemandian Air Panas Reguler</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Kunjungan</p>
          <p class="font-medium">30 Jun 2023 • 10:00</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Jumlah Orang</p>
          <p class="font-medium">3 orang</p>
        </div>
      </div>
      
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
          <p class="text-sm text-gray-500">Total Pembayaran</p>
          <p class="text-lg font-bold text-blue-600">Rp 90.000</p>
        </div>
        <div class="flex space-x-2">
          <a href="{{ route('payment.detail') }}" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50">
            Detail
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Empty State -->
  <!--
  <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
    </svg>
    <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada riwayat pembayaran</h3>
    <p class="mt-1 text-sm text-gray-500">Anda belum melakukan reservasi apapun.</p>
    <div class="mt-6">
      <a href="#" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
        Buat Reservasi Sekarang
      </a>
    </div>
  </div>
  -->

  <!-- Pagination -->
  <div class="mt-6 flex justify-center">
    <nav class="inline-flex rounded-md shadow-sm -space-x-px">
      <a href="#" class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
        &laquo;
      </a>
      <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
        1
      </a>
      <a href="#" class="px-3 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600">
        2
      </a>
      <a href="#" class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
        &raquo;
      </a>
    </nav>
  </div>
</div>

</x-app-layout>