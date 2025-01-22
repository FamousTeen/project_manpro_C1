@extends('base/anggota_navbar')

@section('content')

    <div class="container mx-auto py-8 mt-16">
        <div class="grid grid-cols-12">
            <div class="col-start-4 col-span-6 mb-8 justify-items-center">
                <h4 class="font-bold text-2xl text-center">Pengumuman Khusus Pengurus</h4>
            </div>
        </div>

        <!-- Pengumuman Section -->
        <div class="flex justify-center mb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-16">
                <!-- Example Announcement -->
                <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-bold mb-2">Hari, Tanggal</h2>
                        <!-- Trigger modal on SVG click -->
                        <a href="javascript:void(0);" onclick="openModal('exampleModal')"
                            class="text-[#20252f] hover:text-gray-500">
                        </a>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-700 text-sm">
                            Deskripsi pengumuman di sini...
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
