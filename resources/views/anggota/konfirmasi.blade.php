@extends('base/anggota_navbar')

@section('content')
<div class="container-fluid m-12 me-0 mt-24">
  <!-- Header Section -->
  <div class="grid grid-cols-12">
    <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
      <h1 class="font-bold text-4xl text-center">KONFIRMASI MISA</h1>
    </div>
    <div class="col-start-11 col-span-2 text-right mr-16 mt-8">
      <h2 class="font-bold text-xl ">Hi, Shasa</h2>
      <p class="font-normal text-sm" id="currentDate"></p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 justify-center mx-32 mt-5 mb-4">
    <div class="md:col-span-3 text-left">
      <h2 class="font-semibold text-md text-gray-500">Perhatikan batas waktu konfirmasi!</h2>
    </div>
  </div>

  <!-- Jadwal Misa Section -->
  <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-center gap-x-4 gap-y-16 mx-32 mt-5">
    <!-- Card 1 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px] mx-auto resize-y">
        <p class="text-sm text-sm text-gray-600 text-right mb-4">sisa waktu konfirmasi 01:00:00</p>
      <div class="flex justify-between items-center">
        <p class="font-bold" style="font-size: 18px">Rabu, 25-12-2024</p>
      </div>
      <div class="mt-2">
        <div class="flex mb-2">
            <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
            <div class="flex flex-col ml-2">
                <span>Misa Natal</span>
                <p class="mt-0">06.00 WIB</p>
            </div>
        </div>
      </div>
      {{-- Button Konfirmasi --}}
      <div class="mt-6">
        <div class="flex flex-row justify-center gap-6 mt-6">
            <button class="flex items-center justify-center rounded-md bg-green-600 border border-green-700 p-2 transition-all shadow-sm hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </button>
            <button class="flex items-center justify-center rounded-md bg-red-600 border border-red-700 p-2 transition-all shadow-sm hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-none active:bg-red-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-[#C4CDC1] p-6 rounded-xl w-[300px] h-[200px] mx-auto">
        <div href="#" class="flex justify-end text-sm text-gray-500">
            <a class="mr-1">detail</a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>              
        </div>
      <div class="flex justify-between items-center">
        <p class="font-bold" style="font-size: 18px">Rabu, 25-12-2024</p>
      </div>
      <div class="mt-2">
        <div class="flex mb-2">
            <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
            <div class="flex flex-col ml-2">
                <span>Misa Natal</span>
                <p class="mt-0">10.00 WIB</p>
            </div>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-[#C4CDC1] p-6 rounded-xl w-[300px] h-[200px] mx-auto">
        <div href="#" class="flex justify-end text-sm text-gray-500">
            <a class="mr-1">detail</a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>              
        </div>
      <div class="flex justify-between items-center">
        <p class="font-bold" style="font-size: 18px">Minggu, 15-09-2024</p>
      </div>
      <div class="mt-2">
        <div class="flex mb-2">
            <span class="bg-blue-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
            <div class="flex flex-col ml-2">
                <span>Misa Mingguan</span>
                <p class="mt-0">18.00 WIB</p>
            </div>
        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-[#C4CDC1] p-6 rounded-xl w-[300px] h-[200px] mx-auto">
        <div href="#" class="flex justify-end text-sm text-gray-500">
            <a class="mr-1">detail</a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>              
        </div>
      <div class="flex justify-between items-center">
        <p class="font-bold" style="font-size: 18px">Minggu, 15-09-2024</p>
      </div>
      <div class="mt-2">
        <div class="flex mb-2">
            <span class="bg-blue-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
            <div class="flex flex-col ml-2">
                <span>Misa Mingguan</span>
                <p class="mt-0">18.00 WIB</p>
            </div>
        </div>
      </div>
    </div>



  </div>

  @section('libraryjs')
<script>
  // Function to display the current date in the "Hi, Shasa" section
  const today = new Date();
  const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
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