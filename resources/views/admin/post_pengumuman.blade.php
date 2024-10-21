@extends('base/admin_navbar')

@section('content')

<!-- Colors: 
        1. #740001 - merah gelap 
        2. #ae0001 - merah terang 
        3. #f6f1e3 - netral 
        4. #002366 - biru terang 
        5. #20252f - biru gelap 
    -->
    <div class="container mx-auto py-8 mt-8">
        <!-- Input Pengumuman Section -->
        <div class="p-6 mb-8 bg-[#ae0001]">
            <h2 class="ml-4 text-2xl text-[#f6f1e3] font-semibold mb-4">Input Pengumuman</h2>
            <textarea class="w-full h-40 p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan Pengumuman..."></textarea>
            <div class="text-right mt-4">
                <button class="bg-[#002366] text-white py-2 px-4 rounded-md hover:bg-[#740001] transition-all duration-300">Unggah</button>
            </div>
        </div>

        <div class="grid grid-cols-12">
            <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
              <h4 class="font-bold text-3xl text-center">PENGUMUMAN</h4>
            </div>
          </div>

        <!-- Pengumuman Section -->
  <div class="flex justify-center mb-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-16 ">
      <!-- Pengumuman 1 -->
      <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal1')">
        <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>
        <div class="mt-4">
            <p class="text-gray-700 text-sm">
                Bagi Teman-Teman yang bertugas pada tanggal sekian dipersilahkan untuk latihan di gereja.
                <br><br>
                Tanggal : 12-09-24
                <br>
                Jam : 11.00 WIB
                <br><br>
                Sekian dan Terima Kasih
            </p>
        </div>
    </div>
    {{-- <!-- Pengumuman 2 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal2')">
        <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>
        <div class="mt-4">
            <p class="text-gray-700 text-sm">
                Bagi Teman-Teman yang bertugas pada tanggal sekian dipersilahkan untuk latihan di gereja.
                <br><br>
                Tanggal : 12-09-24
                <br>
                Jam : 11.00 WIB
                <br><br>
                Sekian dan Terima Kasih
            </p>
        </div>
    </div>
    <!-- Pengumuman 3 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal3')">
        <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>
        <div class="mt-4">
            <p class="text-gray-700 text-sm">
                Bagi Teman-Teman yang bertugas pada tanggal sekian dipersilahkan untuk latihan di gereja.
                <br><br>
                Tanggal : 12-09-24
                <br>
                Jam : 11.00 WIB
                <br><br>
                Sekian dan Terima Kasih
            </p>
        </div>
    </div>
    <!-- Pengumuman 4 -->
    <div class="bg-[#f6f1e3] p-6 shadow-lg w-64 mx-8 border border-[#002366] rounded-lg cursor-pointer" onclick="openModal('modal4')">
        <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>
        <div class="mt-4">
            <p class="text-gray-700 text-sm">
                Bagi Teman-Teman yang bertugas pada tanggal sekian dipersilahkan untuk latihan di gereja.
                <br><br>
                Tanggal : 12-09-24
                <br>
                Jam : 11.00 WIB
                <br><br>
                Sekian dan Terima Kasih
            </p>
        </div>
    </div>
  </div>
</div> --}}

<!-- Modals -->
<!-- Modal 1 -->
<div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal1')">
    <div class="bg-white p-8 rounded-lg w-1/2" onclick="event.stopPropagation()">
      <h2 class="text-xl font-bold">Rabu, 25-12-2024</h2>
      <textarea id="eventDetails" class="mt-4 w-full h-32 border border-gray-300 rounded p-2" placeholder="Masukkan pengumuman">Bagi Teman-Teman yang bertugas pada tanggal sekian dipersilahkan untuk latihan di gereja.

Tanggal : 12-09-24
Jam : 11.00 WIB

Sekian dan Terima Kasih</textarea>
  
      <!-- Buttons -->
      <div class="mt-6 flex justify-end space-x-4">
        <button class="bg-green-600 text-white px-4 py-2 rounded" onclick="saveChanges()">Save</button>
        <button class="bg-red-600 text-white px-4 py-2 rounded" onclick="closeModal('modal1')">Close</button>
      </div>
    </div>
  </div>
{{-- 
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
  </div> --}}


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

  function saveChanges() {
    const updatedText = document.getElementById('eventDetails').value;
    console.log('Saved text:', updatedText);
    closeModal('modal1');
  }
</script>
@endsection
