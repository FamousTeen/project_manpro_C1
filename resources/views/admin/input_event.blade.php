@extends('base/admin_navbar')

@section('content')
<!-- Colors:
                1. #740001 - merah gelap
                2. #ae0001 - merah terang
                3. #f6f1e3 - netral
                4. #002366 - biru terang
                5. #20252f - biru gelap
            -->

<div class="container mx-auto mt-20">
    <h2 class="ml-4 p-6 mt-4 text-2xl font-semibold">Input Acara Misdinar</h2>
</div>

<div class="max-w-full mx-auto px-16 rounded-lg">
    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
 
        <!-- Left Column: Data Acara Section -->
        <div class="bg-[#f6f1e3] p-6 rounded-lg">
            <h3 class="text-xl font-bold mb-4">Data Acara</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium">Nama Acara</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="flex space-x-4">
                    <div>
                        <label class="block text-sm font-medium">Tanggal</label>
                        <input type="date" class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jam</label>
                        <input type="time" class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium">Tempat</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="flex space-x-4">
                    <div>
                        <label class="block text-sm font-medium">Contact Person</label>
                        <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">No. Telepon</label>
                        <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium">Narasi Singkat</label>
                    <textarea class="mt-1 block w-full border-gray-300 rounded-md h-24"></textarea>
                </div>
            </div>
        </div>

        <!-- Right Column: Poster Acara and Pengurus Acara Section -->
        <div class="grid grid-cols-1 gap-2">
            <div>
                <div class="bg-[#f6f1e3] p-6 rounded-lg h-56 relative">
                    <h3 class="text-xl font-bold absolute top-4 left-6">Poster Acara</h3>
                    <div class="flex items-center justify-center h-36 mt-8">
                        <label for="file-upload-poster" class="border-2 border-dashed border-gray-400 rounded-lg p-4 text-gray-600 flex flex-col items-center justify-center cursor-pointer w-full h-full">
                            <svg id="upload-icon" class="w-10 h-10 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span id="upload-text-poster">Tekan untuk unggah foto</span>
                            <input id="file-upload-poster" type="file" class="hidden" onchange="handleFileUploadPoster(event)" />
                            <span id="file-name-poster" class="hidden mt-2 text-gray-800 font-semibold"></span>
                        </label>
                    </div>
                </div>
            </div>
        
            <!-- Pengurus Acara -->
            <div class="bg-[#f6f1e3] p-6 rounded-lg grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Ketua Acara</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium">Wakil Ketua Acara</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium">Sekretaris 1</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium">Sekretaris 2</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium">Bendahara 1</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium">Bendahara 2</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
            </div>
        </div>
    </div>

    <!-- Anggota Panitia and Rundown Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <!-- Anggota Panitia -->
    <div class="bg-[#f6f1e3] h-72 p-6 rounded-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Anggota Panitia</h2>
            <button onclick="openModal()" class="bg-[#002366] hover:bg-[#20252f] text-white text-sm px-4 py-1 rounded">Tambah +</button>
        </div>
        
        <div class="no-scrollbar overflow-y-auto max-h-52">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b-2 border-black">
                        <th class="pb-2">No.</th>
                        <th class="pb-2">Nama</th>
                        <th class="pb-2">Wilayah</th>
                        <th class="pb-2">Divisi</th>
                        <th class="pb-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-black">
                        <td class="py-2">1</td>
                        <td class="py-2">Example Nama</td>
                        <td class="py-2">Example Wilayah</td>
                        <td class="py-2">Example Divisi</td>
                        <td class="py-2">
                            <button onclick="deleteRow(this)" class="bg-[#ae0001] hover:bg-[#740001] text-white text-sm px-4 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b ">
                        <td class="py-2">2</td>
                        <td class="py-2">Example Nama</td>
                        <td class="py-2">Example Wilayah</td>
                        <td class="py-2">Example Divisi</td>
                        <td class="py-2">
                            <button onclick="deleteRow(this)" class="bg-[#ae0001] hover:bg-[#740001] text-white text-sm px-4 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
<div id="myModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" style="z-index: 1000;">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4">Tambah Anggota Panitia</h2>
        <div class="mb-4">
            <label for="name-dropdown" class="block text-sm font-medium">Nama</label>
            <select id="name-dropdown" class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="Nama 1 - Wilayah 1">Nama 1 - Wilayah 1</option>
                <option value="Nama 2 - Wilayah 2">Nama 2 - Wilayah 2</option>
                <option value="Nama 3 - Wilayah 3">Nama 3 - Wilayah 3</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="divisi-input" class="block text-sm font-medium">Divisi</label>
            <input type="text" id="divisi-input" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div class="flex justify-end">
            <button onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded mr-2">Batal</button>
            <button class="bg-[#002366] hover:bg-[#20252f] text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </div>
</div>


        <!-- Rundown Upload -->
        <div class="grid grid-cols-1 gap-2">
            <div>
                <div class="bg-[#f6f1e3] p-6 rounded-lg h-72 relative">
                    <h3 class="text-xl font-bold absolute top-4 left-6">Rundown Acara</h3>
                    <div class="flex items-center justify-center h-52 mt-8">
                        <label for="file-upload" class="border-2 border-dashed border-gray-400 rounded-lg p-4 text-gray-600 flex flex-col items-center justify-center cursor-pointer w-full h-full">
                            <svg id="upload-icon" class="w-10 h-10 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span id="upload-text">Tekan untuk unggah foto</span>
                            <input id="file-upload" type="file" class="hidden" onchange="handleFileUpload(event)" />
                            <span id="file-name" class="hidden mt-2 text-gray-800 font-semibold"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Akses Input Section -->
        <div class="bg-[#f6f1e3] h-72 p-6 rounded-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold">Akses Input</h2>
                <button onclick="openSearchModal()" class="bg-[#002366] hover:bg-[#20252f] text-white text-sm px-4 py-1 rounded">Tambah +</button>
            </div>
            <div class="no-scrollbar overflow-y-auto max-h-52">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b-2 border-black">
                            <th class="pb-2">No.</th>
                            <th class="pb-2">Nama</th>
                            <th class="pb-2">Email</th>
                            <th class="pb-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-black">
                            <td class="py-2">1</td>
                            <td class="py-2">Example Name</td>
                            <td class="py-2">example@email.com</td>
                            <td class="py-2">
                                <button onclick="deleteRow(this)" class="bg-[#ae0001] hover:bg-[#740001] text-white text-sm px-4 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Search Modal -->
<div id="searchModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" style="z-index: 1000;">
    <div class="bg-white rounded-lg p-6 w-96 h-64">
        <h2 class="text-xl font-bold mb-4">Akses Input</h2>
        <div class="mb-4">
            <label for="name-dropdown" class="block text-sm font-medium">Nama</label>
            <select id="name-dropdown" class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="">Pilih Nama Anggota</option>
                <option value="Nama 1 - Wilayah 1">Nama 1 - Wilayah 1</option>
                <option value="Nama 2 - Wilayah 2">Nama 2 - Wilayah 2</option>
                <option value="Nama 3 - Wilayah 3">Nama 3 - Wilayah 3</option>
                <option value="Nama 4 - Wilayah 4">Nama 4 - Wilayah 4</option>
                <option value="Nama 5 - Wilayah 5">Nama 5 - Wilayah 5</option>
            </select>
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="addSelectedName()" class="bg-[#002366] hover:bg-[#20252f] text-white mt-8 px-4 py-2 rounded">Tambah</button>
            <button onclick="closeSearchModal()" class="bg-gray-300 hover:bg-gray-400 text-black mt-8 px-4 py-2 rounded ml-2">Batal</button>
        </div>
    </div>
</div>

        <!-- Jadwal Rapat Input Section -->
        <div class="bg-[#f6f1e3] h-72 p-6 rounded-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold">Jadwal Rapat</h2>
                <button onclick="openRapatModal()" class="bg-[#002366] hover:bg-[#20252f] text-white text-sm px-4 py-1 rounded">Tambah +</button>
            </div>
            <div class="no-scrollbar overflow-y-auto max-h-52">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b-2 border-black">
                            <th class="pb-2">No.</th>
                            <th class="pb-2">Kegiatan</th>
                            <th class="pb-2">Tanggal & Waktu</th>
                            <th class="pb-2"></th>
                            <th class="pb-2"></th>
                        </tr>
                    </thead>
                    <tbody id="rapat-table-body">
                        <tr class="border-b border-black">
                            <td class="py-2">1</td>
                            <td class="py-2">Example Kegiatan</td>
                            <td class="py-2">Example Tanggal & Waktu</td>
                            <td class="py-2">
                                <button onclick="editRapat(this)" class="bg-[#002366] hover:bg-[#20252f] text-white text-sm px-4 py-1 rounded">Edit</button>
                            </td>
                            <td class="py-2">
                                <button onclick="deleteRow(this)" class="bg-[#ae0001] hover:bg-[#740001] text-white text-sm px-4 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

<!-- Rapat Input Modal -->
<div id="rapatModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" style="z-index: 1000;">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4">Edit Jadwal Rapat</h2>
        <div class="mb-4">
            <label for="kegiatan" class="block text-sm font-medium">Kegiatan</label>
            <input type="text" id="kegiatan" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium">Tanggal</label>
            <input type="date" id="tanggal" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="waktu" class="block text-sm font-medium">Waktu</label>
            <input type="time" id="waktu" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="lokasi" class="block text-sm font-medium">Lokasi</label>
            <input type="text" id="lokasi" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="catatan" class="block text-sm font-medium">Catatan</label>
            <textarea id="catatan" class="mt-1 block w-full border-gray-300 rounded-md" rows="3"></textarea>
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="saveRapatChanges()" class="bg-[#002366] hover:bg-[#20252f] text-white px-4 py-2 rounded">Simpan</button>
            <button onclick="closeRapatModal()" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded ml-2">Batal</button>
        </div>
    </div>
</div>
</div>
    <!-- Save Button -->
    <div class="text-center mt-4 mb-12">
        <button class="bg-[#002366] hover:bg-[#20252f] w-64 text-white px-6 py-3 rounded-md">Simpan</button>
    </div>
    
@endsection
@section('libraryjs')
<script>
    function openModal() {
    document.getElementById('myModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('myModal').classList.add('hidden');
}

function openSearchModal() {
        document.getElementById('searchModal').classList.remove('hidden');
    }

    function closeSearchModal() {
        document.getElementById('searchModal').classList.add('hidden');
        document.getElementById('name-dropdown').selectedIndex = 0; 
    }

    function addSelectedName() {
        const dropdown = document.getElementById('name-dropdown');
        const selectedValue = dropdown.value;
        if (selectedValue) {
            console.log("Selected Name:", selectedValue);
            
            const tableBody = document.querySelector('table tbody');
            const newRow = document.createElement('tr');
            const rowCount = tableBody.rows.length + 1; 

            newRow.innerHTML = `<td class="py-2">${rowCount}</td>
                                <td class="py-2">${selectedValue}</td>
                                <td class="py-2">example@email.com</td>`;
            tableBody.appendChild(newRow);
            closeSearchModal();
        } else {
            alert("Silakan pilih nama dari dropdown."); 
        }
    }    
    function openRapatModal() {
        document.getElementById('rapatModal').classList.remove('hidden');
    }

    function closeRapatModal() {
        document.getElementById('rapatModal').classList.add('hidden');
        document.getElementById('rapatModal').reset(); 
    }

    function addRapat() {
        const kegiatan = document.getElementById('kegiatan').value;
        const tanggal = document.getElementById('tanggal').value;
        const waktu = document.getElementById('waktu').value;
        const lokasi = document.getElementById('lokasi').value;
        const catatan = document.getElementById('catatan').value;

        if (kegiatan && tanggal && waktu && lokasi) {
            const tableBody = document.getElementById('rapat-table-body');
            const rowCount = tableBody.rows.length + 1; 
            const newRow = document.createElement('tr');

            newRow.innerHTML = `<td class="py-2">${rowCount}</td>
                                <td class="py-2">${kegiatan}</td>
                                <td class="py-2">${tanggal}</td>
                                <td class="py-2">${waktu}</td>`;
            tableBody.appendChild(newRow);
            closeRapatModal();
        } else {
            alert("Silakan lengkapi semua informasi yang diperlukan.");
        }
    }
    let currentRow;

function editRapat(button) {
    currentRow = button.closest('tr');
    document.getElementById('kegiatan').value = currentRow.cells[1].innerText;
    document.getElementById('tanggal').value = ""; 
    document.getElementById('waktu').value = ""; 
    document.getElementById('lokasi').value = currentRow.cells[3].innerText;
    
    document.getElementById('rapatModal').classList.remove('hidden');
}

function closeRapatModal() {
    document.getElementById('rapatModal').classList.add('hidden');
}

function saveRapatChanges() {
    currentRow.cells[1].innerText = document.getElementById('kegiatan').value;
    currentRow.cells[2].innerText = document.getElementById('tanggal').value + ' ' + document.getElementById('waktu').value;
    currentRow.cells[3].innerText = document.getElementById('lokasi').value;

    closeRapatModal();
}
//button delete di list tabel"
        function deleteRow(button) {
        var row = button.closest('tr');
        row.remove();
    }

    // Handle file upload for Rundown Acara
    function handleFileUpload(event) {
        var fileInput = event.target;
        var fileNameSpan = document.getElementById('file-name');
        var uploadIcon = document.getElementById('upload-icon');
        var uploadText = document.getElementById('upload-text');

        // Hide icon and text
        uploadIcon.style.display = 'none';
        uploadText.style.display = 'none';

        // Show file name
        var fileName = fileInput.files[0].name;
        fileNameSpan.textContent = fileName;
        fileNameSpan.style.display = 'block';
    }

    // Handle file upload for Poster Acara
    function handleFileUploadPoster(event) {
        var fileInput = event.target;
        var fileNameSpan = document.getElementById('file-name-poster');
        var uploadIcon = document.getElementById('upload-icon');
        var uploadText = document.getElementById('upload-text-poster');

        // Hide icon and text
        uploadIcon.style.display = 'none';
        uploadText.style.display = 'none';

        // Show file name
        var fileName = fileInput.files[0].name;
        fileNameSpan.textContent = fileName;
        fileNameSpan.style.display = 'block';
    }
</script>
@endsection
