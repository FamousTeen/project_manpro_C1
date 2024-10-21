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
            <textarea class="w-full h-40 p-4 border border-[#002366] rounded-md focus:outline-none focus:ring-2 focus:ring-[#002366]" placeholder="Masukkan Pengumuman..."></textarea>
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
        <div class="flex justify-between items-center">
        <h2 class="text-lg font-bold mb-2">Rabu, 25-12-2024</h2>
        <a href="#" class="text-[#20252f] hover:text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path d="M17.414 2.586a2 2 0 010 2.828L8.828 14l-4 1 1-4 8.586-8.586a2 2 0 012.828 0z" />
                <path fill-rule="evenodd" d="M3 18a1 1 0 001 1h12a1 1 0 001-1V8a1 1 0 00-2 0v9H5V7H4v11z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
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


<!-- Modal -->
<div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal1')">
    <div class="bg-white p-8 rounded-lg w-1/2 relative" onclick="event.stopPropagation()">
        <!-- Trash Icon for Deletion -->
        <button class="absolute top-8 right-8 text-red-600 hover:text-red-800" onclick="confirmDelete('modal1')">
            
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#20252f"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
        </button>
      
        <!-- Modal Content -->
        <h2 class="text-xl font-bold">Rabu, 25-12-2024</h2>
        <textarea id="eventDetails" class="mt-4 w-full h-32 border border-gray-300 rounded p-2" placeholder="Masukkan pengumuman">Bagi Teman-Teman yang bertugas pada tanggal sekian dipersilahkan untuk latihan di gereja.

Tanggal : 12-09-24
Jam : 11.00 WIB

Sekian dan Terima Kasih</textarea>
  
        <!-- Buttons -->
        <div class="mt-6 flex justify-end space-x-4">
            <button class="bg-[#002366] text-white px-4 py-2 rounded" onclick="saveChanges()">Save</button>
            <button class="bg-[#ae0001] text-white px-4 py-2 rounded" onclick="closeModal('modal1')">Close</button>
        </div>
    </div>
</div>

<!-- Confirmation Pop-Up for Deletion -->
<div id="deleteConfirm" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="text-lg font-semibold text-center mb-4">Apakah mau dihapus?</h3>
        <div class="flex justify-center space-x-4">
            <button class="bg-red-600 text-white px-4 py-2 rounded" onclick="deleteAnnouncement()">Iya, Dihapus</button>
            <button class="bg-gray-600 text-white px-4 py-2 rounded" onclick="closeDeleteConfirm()">Tidak</button>
        </div>
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

  //save button
  function saveChanges() {
    const updatedText = document.getElementById('eventDetails').value;
    console.log('Saved text:', updatedText);
    closeModal('modal1');
  }

  // Open delete confirmation
function confirmDelete(modalId) {
    closeModal(modalId);
    document.getElementById('deleteConfirm').classList.remove('hidden');
}

// Close delete confirmation
function closeDeleteConfirm() {
    document.getElementById('deleteConfirm').classList.add('hidden');
}

// Delete announcement function
function deleteAnnouncement() {
    console.log('Announcement deleted');
    closeDeleteConfirm();
}

</script>
@endsection
