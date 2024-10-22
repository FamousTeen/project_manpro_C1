@extends('base/anggota_navbar')

@section('content')
<div class="container-fluid m-12 me-0 mt-24">
  <!-- Header Section -->
  <div class="grid grid-cols-12">
    <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
      <h1 class="font-bold text-4xl text-center">JADWAL</h1>
    </div>
    <div class="col-start-11 col-span-2 text-right mr-16 mt-8">
      <h2 class="font-bold text-xl ">Hi, Shasa</h2>
      <p class="font-normal text-sm" id="currentDate"></p>
    </div>
  </div>

  {{-- Search --}}
  <div class="flex flex-row justify-end items-center mt-10 text-gray-500">
    <div class="mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
      </svg>
    </div>

    <form class="w-[200px] max-w-sm">
      <div class="flex items-center border-b border-grey-500 py-2">
        <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="search" aria-label="Full name">
      </div>
    </form>
  </div>


  <!-- Jadwal Misa Section -->
  <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 m-12 mt-5">
    <!-- Card 1 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px] h-[200px] mx-auto">
      @foreach ($misas as $misa)
      <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal1')">
        <a class="mr-1">detail</a>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-1">
          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
        </svg>
      </div>
      <div class="flex justify-between items-center">
        <p class="font-bold" style="font-size: 18px">
          {{ \Carbon\Carbon::parse($misa->activity_datetime)->translatedFormat('l') }},
          {{ \Carbon\Carbon::parse($misa->activity_datetime)->format('d-M-Y') }}
        </p>
      </div>
      <div class="mt-2">
        <div class="flex mb-2">
          <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
          <div class="flex flex-col ml-2">
            <span>{{$misa->title}}</span>
            <p class="mt-0">{{\Carbon\Carbon::parse($misa->activity_datetime)->format('H:i')}} WIB</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal 1 -->
    <div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal1')">
      <div class="bg-[#D1D9D1] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
        <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal1')">
          &#10005;
        </button>
        <!-- Content inside the modal with two columns -->
        <div class="grid grid-cols-2 gap-4">
          <!-- Left column: Event details -->
          <div class="text-left ">
            <div class="flex items-center justify-items">
              <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
              <h2 class="text-2xl font-bold ml-2">{{$misa->title}}</h2>
            </div>
            <div class="ms-9">
              <p class="mt-2 text-lg">{{\Carbon\Carbon::parse($misa->activity_datetime)->format('d-M-Y')}}</p>
              <p class="font-bold">{{\Carbon\Carbon::parse($misa->activity_datetime)->format('H:i')}} WIB</p>
            </div>
          </div>

          <!-- Right column: Task details -->
          <!-- Right column: Task details -->
          <div class="text-left">
            <p class="text-xl font-bold">Yang bertugas saat ini:</p>

            @php
            // Initialize an array to hold roles
            $roles = [];

            // Collect all unique roles from misaDetails
            foreach ($misas as $misa) {
            foreach ($misa->misaDetails as $detail) {
            if (!in_array($detail->roles, $roles)) {
            $roles[] = $detail->roles; // Add unique role
            }
            }
            }
            @endphp

            @foreach ($roles as $role)
            <p class="mt-2"><span class="font-bold">{{ $role }}:</span></p>
            <ul>
              @php
              $found = false; // Flag to check if any personnel found for the role
              @endphp

              @foreach ($misas as $misa)
              @foreach ($misa->misaDetails as $detail)
              @if ($detail->roles === $role)
              <li>{{ $detail->account->name }}</li>
              @php
              $found = true; // Set flag to true if personnel found
              @endphp
              @endif
              @endforeach
              @endforeach

              @if (!$found)
              <li>Tidak ada personel untuk {{ $role }}</li> <!-- Message if no personnel found -->
              @endif
            </ul>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>

  @section('libraryjs')
  <script>
    // Function to display the current date in the "Hi, Shasa" section
    const today = new Date();
    const options = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    };
    document.getElementById('currentDate').innerText = today.toLocaleDateString(undefined, options);

    // Modal open function
    function openModal(modalId) {
      document.getElementById(modalId).classList.remove('hidden');
    }

    // Modal close function
    function closeModal(modalId) {
      document.getElementById(modalId).classList.add('hidden');
    }
  </script>
  @endsection