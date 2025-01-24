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

@if (session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
    {{ session('success') }}
</div>
@endif

@php
use Carbon\Carbon;

Carbon::setLocale('id');
@endphp

<!-- Card Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mx-16">
    @foreach ($meets as $meet)
    <div class="bg-[#f6f1e3] border border-[#002366] rounded-lg shadow-md p-6 space-y-2">
        <h2 class="text-lg font-semibold text-gray-800">{{$meet->title}}</h2>
        <p class="text-gray-600">
            {{ Carbon::parse($meet->date)->translatedFormat('l, j-m-Y') }}
        </p>
        <p class="text-gray-600">Lokasi: {{$meet->place}}</p>
        <p class="text-gray-600">Catatan: {!! nl2br(e(urldecode($meet->notulen))) !!}</p>
    </div>
</div>


<script>
    const addModal = document.getElementById('addModal');
    const deleteModal = document.getElementById('deleteModal');
    const addButton = document.getElementById('addButton');
    const closeButton = document.getElementById('closeModal');
    const deleteButtons = document.querySelectorAll('.deleteButton');

    // Function to show the modal and populate with data if editing
    function showModal(editMode = false, data = {}) {
        addModal.classList.remove('hidden');
        modalTitle.innerText = 'Tambahkan Jadwal Khusus Pengurus';
        document.getElementById('namaJadwal').value = '';
        document.getElementById('tanggalJadwal').value = '';
        document.getElementById('lokasiJadwal').value = '';
        document.getElementById('catatanJadwal').value = '';
        document.getElementById('meetDesc').value = '';
    }

    // Show modal when add button is clicked
    addButton.onclick = function() {
        showModal(false);
    }

    function readTextarea2() {
        const textareaValue = document.getElementById(`catatanJadwal`).value;
        document.getElementById(`meetDesc`).value = encodeURIComponent(textareaValue);
        console.log(document.getElementById(`meetDesc`).value);
    }

    function readTextarea(index) {
        const textareaValue = document.getElementById(`editCatatanJadwal${index}`).value;
        document.getElementById(`meetDesc${index}${index}`).value = encodeURIComponent(textareaValue);
        console.log(document.getElementById(`meetDesc${index}${index}`).value);
    }

    // Show modal when edit button is clicked
    function openEditModal(id) {
        const button = document.getElementById(`editButton${id}`);
        const modal = document.getElementById(`editModal${id}`);
        const data = {
            nama: button.getAttribute('data-nama'),
            tanggal: button.getAttribute('data-tanggal'),
            waktu: button.getAttribute('data-waktu'),
            lokasi: button.getAttribute('data-lokasi'),
            catatan: button.getAttribute('data-catatan')
        };
        document.getElementById(`editNamaJadwal${id}`).value = data.nama;
        document.getElementById(`editTanggalJadwal${id}`).value = data.tanggal;
        document.getElementById(`editWaktuJadwal${id}`).value = data.waktu;
        document.getElementById(`editLokasiJadwal${id}`).value = data.lokasi;
        document.getElementById(`editCatatanJadwal${id}`).value = decodeURIComponent(data.catatan);
        document.getElementById(`meetDesc${id}${id}`).value = data.catatan;

        modal.classList.remove('hidden');

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        }
    }

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

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
    }

    // Close modal when clicking outside of the modal
    window.onclick = function(event) {
        if (event.target === addModal) {
            addModal.classList.add('hidden');
        }
        if (event.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
    }
</script>

@endsection