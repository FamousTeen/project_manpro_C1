@extends('base/anggota_navbar')

@section('content')
    <?php
    use Carbon\Carbon;
    
    Carbon::setLocale('id');
    ?>
    <div class="container-fluid m-12 mt-24">
        <!-- Header Section -->
        <div class="grid grid-cols-12">
          <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
              <h1 class="font-bold text-4xl text-center">PENGUMUMAN KHUSUS PENGURUS</h1>
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

        <!-- Pengumuman Section -->
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-items-center gap-16 m-12 mt-10">
            <!-- Example Announcement -->
            @foreach ($announcement as $ann)
                <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px]">
                    <div class="flex justify-end text-sm">
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