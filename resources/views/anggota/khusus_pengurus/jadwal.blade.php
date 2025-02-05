@extends('base/anggota_navbar')

@section('content')
    {{-- Colors:
    1. #740001 - merah gelap
    2. #ae0001 - merah terang
    3. #f6f1e3 - netral
    4. #002366 - biru terang
    5. #20252f - biru gelap --}}

    @php
        use App\Models\Event;
        use App\Models\EventDetail;
        use App\Models\Meet;
        use Carbon\Carbon;

        $user_event_details = EventDetail::where('account_id', $user->id)->get();
        $user_events = Event::whereIn('id', $user_event_details->pluck('event_id'))->where('status', 1)->get();
        Carbon::setLocale('id');
    @endphp

    <div class="container-fluid m-12 mt-24">
        <!-- Header Section -->
        <div class="grid grid-cols-12">
            <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
                <h1 class="font-bold text-4xl text-center">JADWAL KHUSUS PENGURUS</h1>
                <div class="block lg:hidden text-center mt-4">
                    <h2 class="font-bold text-lg ">Hi, {{ $user->name }}</h2>
                    <p class="font-normal text-sm" id="currentDatePhone"></p>
                </div>
            </div>
            <div class="col-start-11 col-span-2 text-right mr-16 mt-8 hidden lg:block">
                <h2 class="font-bold text-xl ">Hi, {{ $user->name }}</h2>
                <p class="font-normal text-sm" id="currentDate"></p>
            </div>
        </div>

        <div class="container mx-auto py-8 mt-16">
            <!-- Card Grid -->
            <div
                class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-items-center gap-16 m-12 mt-10">
                <!-- Example Card -->
                @foreach ($user_events as $ue)
                    @php
                        $user_meets = Meet::where('event_id', $ue->id)->where('permission', 1)->get();
                    @endphp

                    @foreach ($user_meets as $um)
                        <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px]">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $um->title }}</h2>
                            <p class="text-gray-600">Tanggal:
                                {{ Carbon::parse($um->date)->translatedFormat('l, j F Y') }}
                            </p>
                            <p class="text-gray-600">Lokasi: {{ $um->place }}</p>
                            <p class="text-gray-600">Catatan: {!! nl2br(e(urldecode($um->notulen))) !!}</p>
                            <div class="flex justify-end">
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endsection

        @section('libraryjs')
            <script>
                const today = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                document.getElementById('currentDate').innerText = today.toLocaleDateString(undefined, options);
                document.getElementById('currentDatePhone').innerText = today.toLocaleDateString(undefined, options);
            </script>
        @endsection
