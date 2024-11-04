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
    <h2 class="ml-4 p-6 mt-4 text-2xl font-semibold flex-1">Dokumen Khusus Pengurus</h2>
    <button id="addButton" class="bg-[#002366] hover:bg-[#20252f] text-white font-semibold px-4 py-2 rounded-lg mr-16 mt-12">+ Tambah</button>
</div>

<!-- Card Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mx-16">
    @for ($i = 0; $i < 3; $i++)
    <div class="bg-[#f6f1e3] border border-[#002366] rounded-lg shadow-md p-6 space-y-2">
        <h2 class="text-lg font-semibold text-gray-800">Rapat Evaluasi</h2>
        <p class="text-gray-600">Minggu, 25-12-2024</p>
        <p class="text-gray-600">Lokasi: xxx</p>
        <p class="text-gray-600">Catatan: xxx</p>
        <div class="flex justify-end pt-4">
            <button class="editButton bg-[#002366] hover:bg-[#20252f] text-white font-semibold px-4 py-2 rounded-lg" data-nama="Rapat Evaluasi" data-tanggal="2024-12-25" data-lokasi="xxx" data-catatan="xxx">Edit</button>
            <button class="bg-[#ae0001] hover:bg-[#740001] text-white font-semibold px-4 py-2 rounded-lg ml-2">Delete</button>
        </div>
    </div>
    @endfor
</div>

<!-- Modal -->
<div id="myModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
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

<script>
    const modal = document.getElementById('myModal');
    const addButton = document.getElementById('addButton');
    const closeButton = document.getElementById('closeModal');
    const editButtons = document.querySelectorAll('.editButton');
    const modalTitle = document.getElementById('modalTitle');

    // Function to show the modal and populate with data if editing
    function showModal(editMode = false, data = {}) {
        modal.classList.remove('hidden');
        if (editMode) {
            modalTitle.innerText = 'Edit Jadwal Khusus Pengurus';
            document.getElementById('namaJadwal').value = data.nama;
            document.getElementById('tanggalJadwal').value = data.tanggal;
            document.getElementById('lokasiJadwal').value = data.lokasi;
            document.getElementById('catatanJadwal').value = data.catatan;
        } else {
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

    // Close modal when close button is clicked
    closeButton.onclick = function() {
        modal.classList.add('hidden');
    }

    // Close modal when clicking outside of the modal
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    }
</script>

@endsection
