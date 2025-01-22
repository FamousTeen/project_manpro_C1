@extends('base/anggota_navbar')

@section('content')
<!-- Colors:
    1. #740001 - merah gelap
    2. #ae0001 - merah terang
    3. #f6f1e3 - netral
    4. #002366 - biru terang
    5. #20252f - biru gelap
-->

<div class="container mx-auto py-8 mt-16">

    <div class="grid grid-cols-12">
        <div class="col-start-4 col-span-6 mb-8 justify-items-center">
            <h4 class="font-bold text-2xl text-center">Jadwal Khusus Pengurus</h4>
        </div>
    </div>

<!-- Card Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mx-16">
    <!-- Example Card -->
    <div class="bg-[#f6f1e3] border border-[#002366] rounded-lg shadow-md p-6 space-y-2">
        <h2 class="text-xl font-semibold text-gray-800">Judul Jadwal</h2>
        <p class="text-gray-600">Tanggal: Senin, 01-01-2023</p>
        <p class="text-gray-600">Lokasi: Lokasi Contoh</p>
        <p class="text-gray-600">Catatan: Catatan jadwal</p>
        <div class="flex justify-end">
        </div>
    </div>
</div>

@endsection
