@extends('base/anggota_navbar')

@section('content')
    <?php
    use Carbon\Carbon;
    
    Carbon::setLocale('id');
    ?>
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
                @foreach ($announcement as $ann)
                    <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-bold mb-2">
                                {{ Carbon::parse($ann->upload_time)->translatedFormat('l, j F Y') }}</h2>
                        </div>
                        <div class="mt-4">
                            <p class="text-gray-700 text-sm">
                                {!! nl2br(e(urldecode($ann->description))) !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
