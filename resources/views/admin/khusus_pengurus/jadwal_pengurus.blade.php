@extends('base/admin_navbar')

@section('content')
<!-- Colors:
                1. #740001 - merah gelap
                2. #ae0001 - merah terang
                3. #f6f1e3 - netral
                4. #002366 - biru terang
                5. #20252f - biru gelap
            -->

<div class="container mx-auto py-8 mt-8 flex items-center">
    <h2 class="ml-4 p-6 mt-4 text-2xl font-semibold flex-1">Jadwal Khusus Pengurus</h2>
    <button id="addButton" class="bg-[#002366] hover:bg-[#20252f] text-white font-semibold px-4 py-2 rounded-lg mr-16 mt-12">+ Tambah</button>
</div>
@php
use Carbon\Carbon;

Carbon::setLocale('id');
@endphp

<!-- Card Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mx-16">
    @foreach ($meets as $meet)
    <div class="bg-[#f6f1e3] border border-[#002366] rounded-lg shadow-md p-6 space-y-2">
        <h2 class="text-lg font-semibold text-gray-800">{{$meet->title}}</h2>
        <p class="text-gray-600">
            {{ Carbon::parse($meet->date)->translatedFormat('l, j-m-Y') }}
        </p>
        <p class="text-gray-600">Lokasi: {{$meet->place}}</p>
        <p class="text-gray-600">Catatan: {!! nl2br(e(urldecode($meet->notulen))) !!}</p>
        <div class="flex justify-end pt-4">
            <button class="editButton bg-[#002366] hover:bg-[#20252f] text-white font-semibold px-4 py-2 rounded-lg" data-nama="{{$meet->title}}" data-tanggal="{{ Carbon::parse($meet->date)->translatedFormat('Y-m-j') }}" data-lokasi="{{$meet->place}}" data-catatan="{!! nl2br(e(urldecode($meet->notulen))) !!}">Edit</button>
            <button class="deleteButton bg-[#ae0001] hover:bg-[#740001] text-white font-semibold px-4 py-2 rounded-lg ml-2" data-nama="Rapat Evaluasi">Delete</button>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal for Add -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 id="modalTitle" class="text-lg font-semibold mb-4">Tambahkan Jadwal Khusus Pengurus</h2>
        <label class="block mb-2">Nama Jadwal:</label>
        <input id="namaJadwal" type="text" class="border border-gray-300 rounded-lg w-full p-2 mb-4" placeholder="Masukkan nama jadwal">

        <label class="block mb-2">Tanggal:</label>
        <input id="tanggalJadwal" type="date" class="border border-gray-300 rounded-lg w-full p-2 mb-4">

        <label class="block mb-2">Lokasi:</label>
        <input id="lokasiJadwal" type="text" class="border border-gray-300 rounded-lg w-full p-2 mb-4" placeholder="Masukkan lokasi">

        <label class="block mb-2">Catatan:</label>
        <textarea id="catatanJadwal" class="border border-gray-300 rounded-lg w-full p-2 mb-4" rows="4" placeholder="Masukkan catatan"></textarea>

        <div class="flex justify-end">
            <button id="closeModal" class="bg-[#ae0001] hover:bg-[#740001] text-white font-semibold px-4 py-2 rounded-lg mr-2">Batal</button>
            <button id="saveButton" class="bg-[#002366] hover:bg-[#20252f] text-white font-semibold px-4 py-2 rounded-lg">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal for Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center hidden" style="z-index: 1000;">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 id="editModalTitle" class="text-lg font-semibold mb-4"></h2>
        <label class="block mb-2">Nama Jadwal:</label>
        <input id="editNamaJadwal" type="text" class="border border-gray-300 rounded-lg w-full p-2 mb-4" placeholder="Masukkan nama jadwal">

        <label class="block mb-2">Tanggal:</label>
        <input id="editTanggalJadwal" type="date" class="border border-gray-300 rounded-lg w-full p-2 mb-4">

        <label class="block mb-2">Lokasi:</label>
        <input id="editLokasiJadwal" type="text" class="border border-gray-300 rounded-lg w-full p-2 mb-4" placeholder="Masukkan lokasi">

        <label class="block mb-2">Catatan:</label>
        <textarea id="editCatatanJadwal" class="border border-gray-300 rounded-lg w-full p-2 mb-4" rows="4" placeholder="Masukkan catatan"></textarea>

        <div class="flex justify-end">
            <button id="closeEditModal" class="bg-[#ae0001] hover:bg-[#740001] text-white font-semibold px-4 py-2 rounded-lg mr-2">Batal</button>
            <button id="saveButton" class="bg-[#002366] hover:bg-[#20252f] text-white font-semibold px-4 py-2 rounded-lg">Simpan</button>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-96 flex flex-col items-center">
        <h2 class="text-lg font-semibold mb-4 text-center">Konfirmasi Penghapusan</h2>
        <p id="deleteMessage" class="mb-4 text-center">Apakah Anda yakin ingin menghapus "<span id="scheduleName"></span>"?</p>
        <div class="flex justify-center w-full">
            <button id="cancelDelete" class="bg-[#ae0001] hover:bg-[#740001] text-white font-semibold px-4 py-2 rounded-lg mr-2">Batal</button>
            <button id="confirmDelete" class="bg-[#002366] hover:bg-[#20252f] text-white font-semibold px-4 py-2 rounded-lg">Hapus</button>
        </div>
    </div>
</div>


<script>
    const addModal = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    const addButton = document.getElementById('addButton');
    const closeButton = document.getElementById('closeModal');
    const closeEditButton = document.getElementById('closeEditModal');
    const deleteButtons = document.querySelectorAll('.deleteButton');
    const editButtons = document.querySelectorAll('.editButton');
    const modalTitle = document.getElementById('modalTitle');
    const editModalTitle = document.getElementById('editModalTitle');

    console.log('Before removing hidden:', editModal.classList);
editModal.classList.remove('hidden');
console.log('After removing hidden:', editModal.classList);

    // Function to show the modal and populate with data if editing
    function showModal(editMode = false, data = {}) {
        if (editMode) {
            editModal.classList.remove('hidden');
            editModal.classList.remove('flex');
            console.log(editModal.classList);
            editModalTitle.innerText = 'Edit Jadwal Khusus Pengurus';
            document.getElementById('editNamaJadwal').value = data.nama;
            document.getElementById('editTanggalJadwal').value = data.tanggal;
            document.getElementById('editLokasiJadwal').value = data.lokasi;
            document.getElementById('editCatatanJadwal').value = data.catatan;
        } else {
            addModal.classList.remove('hidden');
            modalTitle.innerText = 'Tambahkan Jadwal Khusus Pengurus';
            document.getElementById('namaJadwal').value = '';
            document.getElementById('tanggalJadwal').value = '';
            document.getElementById('lokasiJadwal').value = '';
            document.getElementById('catatanJadwal').value = '';
        }
    }

    // Show modal when add button is clicked
    addButton.onclick = function() {
        showModal(false);
    }

    // Show modal when edit button is clicked
    editButtons.forEach(button => {
        button.onclick = function() {
            const data = {
                nama: button.getAttribute('data-nama'),
                tanggal: button.getAttribute('data-tanggal'),
                lokasi: button.getAttribute('data-lokasi'),
                catatan: button.getAttribute('data-catatan')
            };
            showModal(true, data);
        }
    });

    // Show confirmation modal when delete button is clicked
    deleteButtons.forEach(button => {
        button.onclick = function() {
            const scheduleName = button.getAttribute('data-nama');
            document.getElementById('scheduleName').innerText = scheduleName;
            deleteModal.classList.remove('hidden');
        }
    });

    // Cancel delete action
    document.getElementById('cancelDelete').onclick = function() {
        deleteModal.classList.add('hidden');
    }

    // Confirm delete action
    document.getElementById('confirmDelete').onclick = function() {
        // Here you can handle the deletion logic, such as making an API call
        alert('Jadwal telah dihapus: ' + document.getElementById('scheduleName').innerText);
        deleteModal.classList.add('hidden');
        // Optionally, you can also remove the card from the DOM if necessary
    }

    // Close modal when close button is clicked
    closeButton.onclick = function() {
        addModal.classList.add('hidden');
    }

    closeEditButton.onclick = function() {
        editModal.classList.add('hidden');
    }

    // Close modal when clicking outside of the modal
    window.onclick = function(event) {
        if (event.target === addModal) {
            addModal.classList.add('hidden');
        }
        else if (event.target === editModal) {
            editModal.classList.add('hidden');
        }
        else
        if (event.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
    }
</script>

@endsection