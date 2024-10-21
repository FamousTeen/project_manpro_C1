@extends('base/anggota_navbar')

@section('content')

<!-- Colors: 
        1. #740001 - merah gelap 
        2. #ae0001 - merah terang 
        3. #f6f1e3 - netral 
        4. #002366 - biru terang 
        5. #20252f - biru gelap 
    -->
<div class="container-fluid m-12 me-0 mt-24">
  <!-- Header Section -->
  <div class="grid grid-cols-12">
    <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
      <h1 class="font-bold text-4xl text-center">ACARA</h1>
    </div>
    <div class="col-start-11 col-span-2 text-right mr-16 mt-8">
      <h2 class="font-bold text-xl ">Hi, Shasa</h2>
      <p class="font-normal text-sm" id="currentDate"></p>
    </div>
  </div>
</div>

<!-- Eval Section -->
  <div class="flex justify-center mb-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-16 ">
      <!-- Eval 1 -->
      <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal1')">
      <!-- Date -->
  <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>

  <!-- Event Info -->
  <div class="flex items-center mb-2">
    <div class="w-3 h-3 bg-orange-400 rounded-full mr-2"></div>
    <p class="text-gray-700">Misa Natal</p>
  </div>
  <p class="text-gray-700">06.00 WIB</p>

  <!-- Evaluation Section -->
  <div class="mt-4">
    <h3 class="font-semibold text-gray-800">Evaluasi:</h3>
    <p class="text-gray-700 text-sm">
      Nam eget molestie massa. Nunc non vestibulum ante. Morbi sem tortor, aliquam a tincidunt sit amet, pretium varius orci. Sed eu nibh sit amet arcu dignissim posuere.
    </p>
  </div>
    </div>
    <!-- Eval 2 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal2')">
           <!-- Date -->
  <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>

  <!-- Event Info -->
  <div class="flex items-center mb-2">
    <div class="w-3 h-3 bg-orange-400 rounded-full mr-2"></div>
    <p class="text-gray-700">Misa Natal</p>
  </div>
  <p class="text-gray-700">06.00 WIB</p>

  <!-- Evaluation Section -->
  <div class="mt-4">
    <h3 class="font-semibold text-gray-800">Evaluasi:</h3>
    <p class="text-gray-700 text-sm">
      Nam eget molestie massa. Nunc non vestibulum ante. Morbi sem tortor, aliquam a tincidunt sit amet, pretium varius orci. Sed eu nibh sit amet arcu dignissim posuere.
    </p>
  </div>

    </div>
    <!-- Eval 3 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal3')">
            <!-- Date -->
  <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>

  <!-- Event Info -->
  <div class="flex items-center mb-2">
    <div class="w-3 h-3 bg-orange-400 rounded-full mr-2"></div>
    <p class="text-gray-700">Misa Natal</p>
  </div>
  <p class="text-gray-700">06.00 WIB</p>

  <!-- Evaluation Section -->
  <div class="mt-4">
    <h3 class="font-semibold text-gray-800">Evaluasi:</h3>
    <p class="text-gray-700 text-sm">
      Nam eget molestie massa. Nunc non vestibulum ante. Morbi sem tortor, aliquam a tincidunt sit amet, pretium varius orci. Sed eu nibh sit amet arcu dignissim posuere.
    </p>
  </div>

    </div>

    <!-- Eval 4 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal4')">
            <!-- Date -->
  <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>

  <!-- Event Info -->
  <div class="flex items-center mb-2">
    <div class="w-3 h-3 bg-orange-400 rounded-full mr-2"></div>
    <p class="text-gray-700">Misa Natal</p>
  </div>
  <p class="text-gray-700">06.00 WIB</p>

  <!-- Evaluation Section -->
  <div class="mt-4">
    <h3 class="font-semibold text-gray-800">Evaluasi:</h3>
    <p class="text-gray-700 text-sm">
      Nam eget molestie massa. Nunc non vestibulum ante. Morbi sem tortor, aliquam a tincidunt sit amet, pretium varius orci. Sed eu nibh sit amet arcu dignissim posuere.
    </p>
  </div>

    </div>
    <!-- Eval 5 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal5')">
            <!-- Date -->
  <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>

  <!-- Event Info -->
  <div class="flex items-center mb-2">
    <div class="w-3 h-3 bg-orange-400 rounded-full mr-2"></div>
    <p class="text-gray-700">Misa Natal</p>
  </div>
  <p class="text-gray-700">06.00 WIB</p>

  <!-- Evaluation Section -->
  <div class="mt-4">
    <h3 class="font-semibold text-gray-800">Evaluasi:</h3>
    <p class="text-gray-700 text-sm">
      Nam eget molestie massa. Nunc non vestibulum ante. Morbi sem tortor, aliquam a tincidunt sit amet, pretium varius orci. Sed eu nibh sit amet arcu dignissim posuere.
    </p>
  </div>

    </div>
  </div>
</div>

<!-- Modals -->
<!-- Modal 1 -->
<div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal1')">
  <div class="bg-white p-8 rounded-lg w-1/2" onclick="event.stopPropagation()">
    <h2 class="text-xl font-bold">Detail for 27 September 2024</h2>
    <p class="mt-4">More information about this event...</p>
    <button class="mt-6 bg-red-600 text-white px-4 py-2 rounded" onclick="closeModal('modal1')">Close</button>
  </div>
</div>

<!-- Modal 2 -->
<div id="modal2" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal2')">
  <div class="bg-white p-8 rounded-lg w-1/2" onclick="event.stopPropagation()">
    <h2 class="text-xl font-bold">Detail for 28 September 2024</h2>
    <p class="mt-4">More information about this event...</p>
    <button class="mt-6 bg-red-600 text-white px-4 py-2 rounded" onclick="closeModal('modal2')">Close</button>
  </div>
</div>

<!-- Modal 3 -->
<div id="modal3" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal3')">
    <div class="bg-white p-8 rounded-lg w-1/2" onclick="event.stopPropagation()">
      <h2 class="text-xl font-bold">Detail for 28 September 2024</h2>
      <p class="mt-4">More information about this event...</p>
      <button class="mt-6 bg-red-600 text-white px-4 py-2 rounded" onclick="closeModal('modal3')">Close</button>
    </div>
  </div>

  <!-- Modal 4 -->
<div id="modal4" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal4')">
    <div class="bg-white p-8 rounded-lg w-1/2" onclick="event.stopPropagation()">
      <h2 class="text-xl font-bold">Detail for 28 September 2024</h2>
      <p class="mt-4">More information about this event...</p>
      <button class="mt-6 bg-red-600 text-white px-4 py-2 rounded" onclick="closeModal('modal4')">Close</button>
    </div>
  </div>

    <!-- Modal 5 -->
<div id="modal5" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal5')">
    <div class="bg-white p-8 rounded-lg w-1/2" onclick="event.stopPropagation()">
      <h2 class="text-xl font-bold">Detail for 28 September 2024</h2>
      <p class="mt-4">More information about this event...</p>
      <button class="mt-6 bg-red-600 text-white px-4 py-2 rounded" onclick="closeModal('modal5')">Close</button>
    </div>
  </div>

@endsection

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
