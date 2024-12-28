@extends('base/anggota_navbar')

@section('content')
<div class="container-fluid m-12 mt-24">
  <!-- Header Section -->
  <div class="grid grid-cols-12">
    <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
        <h1 class="font-bold text-4xl text-center">JADWAL PELATIHAN</h1>
        <div class="block lg:hidden text-center mt-4">
            <h2 class="font-bold text-lg ">Hi, </h2>
        <p class="font-normal text-sm" id="currentDatePhone"></p>
        </div>
    </div>
    <div class="col-start-11 col-span-2 text-right mr-16 mt-8 hidden lg:block">
        <h2 class="font-bold text-xl ">Hi, </h2>
        <p class="font-normal text-sm" id="currentDate"></p>
    </div>
</div>

  {{-- Search --}}
  <!-- Responsive Search Bar -->
  <div class="flex flex-col w-full place-items-center col-span-12 sm:col-span-12 md:col-start-11 md:col-span-2 text-right mr-16 mt-8 sm:mt-4">
    <div class="flex w-full justify-between sm:w-[250px] md:w-[250px] lg:w-[250px] mt-4">
        <div class="flex flex-row items-center text-gray-500">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <form class="sm:w-[250px] md:w-[250px] lg:w-[250px] ml-2" id="searchForm">
              <div class="flex items-center border-b border-grey-500 py-1">
                <input
                  id="searchQuery"
                  class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                  type="text"
                  placeholder="Search..."
                  aria-label="Search">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Jadwal Misa Section -->
  <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-items-center gap-16 m-12 mt-10">
    <!-- Card 1 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px] h-[250px] mx-auto">
      <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal1')">
        <a class="mr-1"><button>detail</button></a>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-1">
          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
        </svg>
      </div>
      <div class="flex justify-between items-center">
        <p class="font-bold" style="font-size: 18px">
          Minggu, 14-Jan-2024
        </p>
      </div>
      <div class="mt-2">
        <div class="flex mb-2">
          <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
          <div class="flex flex-col ml-2">
            <span>Misa Pagi</span>
            <p class="mt-0">07:30 WIB</p>
          </div>
        </div>
        <div class="mt-4">
          <p class="font-bold">Contact Person:</p>
          <p>Nama: Anton</p>
          <p>No HP: 081234567890</p>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px] h-[250px] mx-auto">
      <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal2')">
        <a class="mr-1"><button>detail</button></a>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-1">
          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
        </svg>
      </div>
      <div class="flex justify-between items-center">
        <p class="font-bold" style="font-size: 18px">
          Minggu, 21-Jan-2024
        </p>
      </div>
      <div class="mt-2">
        <div class="flex mb-2">
          <span class="bg-green-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
          <div class="flex flex-col ml-2">
            <span>Misa Siang</span>
            <p class="mt-0">11:00 WIB</p>
          </div>
        </div>
        <div class="mt-4">
          <p class="font-bold">Contact Person:</p>
          <p>Nama: Budi</p>
          <p>No HP: 081234567891</p>
        </div>
      </div>
    </div>

    

    <!-- Modal 1 -->
    <div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal1')">
      <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
        <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal1')">
          &#10005;
        </button>
        <div class="grid grid-cols-2 gap-4">
          <!-- Left column: Event details for Card 1 -->
          <div class="text-left">
            <div class="flex items-center">
              <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
              <h2 class="text-2xl font-bold ml-2">Misa Pagi</h2>
            </div>
            <div class="ms-9">
              <p class="mt-2 text-lg">14-Jan-2024</p>
              <p class="font-bold">07:30 WIB</p>
              <div class="mt-4">
                <p class="font-bold">Contact Person:</p>
                <p>Nama: Anton</p>
                <p>No HP: 081234567890</p>
              </div>
            </div>
          </div>
          <div class="text-left">
            <p class="text-xl font-bold">Yang bertugas saat ini:</p>
            <ul>
              <li>Anton</li>
              <li>Maria</li>
              <li>Rina</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 2 -->
    <div id="modal2" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal2')">
      <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
        <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal2')">
          &#10005;
        </button>
        <div class="grid grid-cols-2 gap-4">
          <!-- Left column: Event details for Card 2 -->
          <div class="text-left">
            <div class="flex items-center">
              <span class="bg-green-500 h-7 w-7 rounded-full inline-block"></span>
              <h2 class="text-2xl font-bold ml-2">Misa Siang</h2>
            </div>
            <div class="ms-9">
              <p class="mt-2 text-lg">21-Jan-2024</p>
              <p class="font-bold">11:00 WIB</p>
              <div class="mt-4">
                <p class="font-bold">Contact Person:</p>
                <p>Nama: Budi</p>
                <p>No HP: 081234567891</p>
              </div>
            </div>
          </div>
          <div class="text-left">
            <p class="text-xl font-bold">Yang bertugas saat ini:</p>
            <ul>
              <li>Budi</li>
              <li>Sinta</li>
              <li>Arya</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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

  function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
  }
</script>
@endsection
