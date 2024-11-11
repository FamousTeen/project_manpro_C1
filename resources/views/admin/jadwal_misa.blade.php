@extends('base/admin_navbar')

@section('content')

<header class="mt-16 p-8">
    <h1 class="text-2xl font-semibold text-[#20252f]">JADWAL MISA</h1>
    <div class="flex space-x-4 mt-4 ml-8">
        <!-- Default Active Button -->
        <button class="px-4 py-2 rounded-lg bg-[#740001] text-white header-button" id="button-semui">Semua</button>
        <button class="px-4 py-2 bg-[#f6f1e3] rounded-lg hover:bg-[#740001] hover:text-white header-button" id="button-proses">Proses</button>
        <button class="px-4 py-2 bg-[#f6f1e3] rounded-lg hover:bg-[#740001] hover:text-white header-button" id="button-tertunda">Tertunda</button>
        <button class="px-4 py-2 bg-[#f6f1e3] rounded-lg hover:bg-[#740001] hover:text-white header-button" id="button-berhasil">Berhasil</button>
    </div>
</header>

<!-- Schedule and Task Section Container -->
<div class="bg-[#f6f1e3] rounded-lg shadow-lg p-6 mx-16 mb-8 space-x-8">
    <div class="flex justify-between">
        <!-- Schedule Card -->
        <div class="flex-1">
            <div class="flex items-start space-x-4">
                <div class=" text-2xl">
                    <span class="bg-orange-500 h-5 w-5 rounded-full inline-block"></span>
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Minggu, 15-09-2024</h2>
                    <p class="text-gray-600">Misa Mingguan</p>
                    <p class="text-gray-600">18.00 WIB</p>
                    <p class="mt-2 flex items-center"> 
                        Status: 
                        <span class="text-black ml-2">Proses</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000" class="ml-2">
                            <path d="M520-496v-144q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640v159q0 8 3 15.5t9 13.5l132 132q11 11 28 11t28-11q11-11 11-28t-11-28L520-496ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/>
                        </svg>
                    </p>
                    <p class="text-gray-500 text-sm">Berakhir pada: Rabu, 13-07-2024</p>
                </div>
            </div>
        </div>

        <!-- Task Assignment Section -->
        <div class="w-1/2 bg-white p-4 rounded-lg">
            <h3 class="text-[#20252f] font-semibold border-b pb-2">PETUGAS - PETUGAS</h3>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <!-- Petugas Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Petugas</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6"></span> Angel
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Martin
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Shasaa
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Jonathan
                        </li>
                    </ul>
                </div>
                <!-- Pengawas Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Pengawas</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6"></span> Alonso
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Bryan
                        </li>
                    </ul>
                </div>
                <!-- Perlengkapan Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Perlengkapan</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Alonso
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6"></span> Bryan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-4">
        <button onclick="openEditModal()" class="px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg">Edit</button>
        <button class="px-4 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg">Delete</button>
    </div>
</div>
<!-- Schedule and Task Section Container -->
<div class="bg-[#f6f1e3] rounded-lg shadow-lg p-6 mx-16 mb-8 space-x-8">
    <div class="flex justify-between">
        <!-- Schedule Card -->
        <div class="flex-1">
            <div class="flex items-start space-x-4">
                <div class=" text-2xl">
                    <span class="bg-orange-500 h-5 w-5 rounded-full inline-block"></span>
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Minggu, 15-09-2024</h2>
                    <p class="text-gray-600">Misa Mingguan</p>
                    <p class="text-gray-600">18.00 WIB</p>
                    <p class="mt-2 flex items-center"> 
                        Status: 
                        <span class="text-black ml-2 mr-2">Tertunda</span>✖
                    </p>
                    <p class="text-gray-500 text-sm">Berakhir pada: Rabu, 13-07-2024</p>
                </div>
            </div>
        </div>

        <!-- Task Assignment Section -->
        <div class="w-1/2 bg-white p-4 rounded-lg">
            <h3 class="text-[#20252f] font-semibold border-b pb-2">PETUGAS - PETUGAS</h3>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <!-- Petugas Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Petugas</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Angel
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Martin
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✖</span> Shasaa
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✖</span> Jonathan
                        </li>
                    </ul>
                </div>
                <!-- Pengawas Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Pengawas</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Alonso
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✖</span> Bryan
                        </li>
                    </ul>
                </div>
                <!-- Perlengkapan Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Perlengkapan</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Alonso
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✖</span> Bryan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-4">
        <button onclick="openEditModal()" class="px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg">Edit</button>
        <button class="px-4 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg">Delete</button>
    </div>
</div>
<!-- Schedule and Task Section Container -->
<div class="bg-[#f6f1e3] rounded-lg shadow-lg p-6 mx-16 mb-8 space-x-8">
    <div class="flex justify-between">
        <!-- Schedule Card -->
        <div class="flex-1">
            <div class="flex items-start space-x-4">
                <div class=" text-2xl">
                    <span class="bg-orange-500 h-5 w-5 rounded-full inline-block"></span>
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Minggu, 15-09-2024</h2>
                    <p class="text-gray-600">Misa Mingguan</p>
                    <p class="text-gray-600">18.00 WIB</p>
                    <p class="mt-2 flex items-center"> 
                        Status: 
                        <span class="text-black ml-2 mr-2">Berhasil</span>✔
                    </p>
                    <p class="text-gray-500 text-sm">Berakhir pada: Rabu, 13-07-2024</p>
                </div>
            </div>
        </div>

        <!-- Task Assignment Section -->
        <div class="w-1/2 bg-white p-4 rounded-lg">
            <h3 class="text-[#20252f] font-semibold border-b pb-2">PETUGAS - PETUGAS</h3>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <!-- Petugas Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Petugas</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Angel
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Martin
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Shasaa
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Jonathan
                        </li>
                    </ul>
                </div>
                <!-- Pengawas Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Pengawas</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Alonso
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Bryan
                        </li>
                    </ul>
                </div>
                <!-- Perlengkapan Column -->
                <div>
                    <h4 class="text-[#20252f] font-semibold">Perlengkapan</h4>
                    <ul class="text-gray-600">
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Alonso
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 w-6">✔</span> Bryan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-4">
        <button onclick="openEditModal()" class="px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg">Edit</button>
        <button class="px-4 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg">Delete</button>
    </div>
</div>

<!-- Anggota Section Modal -->
<div id="anggotaSection" class="hidden fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h3 class="text-[#740001] font-semibold mb-4">Ubah Anggota</h3>

        <!-- Nama Dropdown -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Anggota</label>
            <select id="namaAnggota" class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white">
                <option value="1" data-details="Angel - Region A - 5 tugas">Angel - Region A - 5 tugas</option>
                <option value="2" data-details="Martin - Region B - 3 tugas">Martin - Region B - 3 tugas</option>
                <option value="3" data-details="Shasaa - Region C - 4 tugas">Shasaa - Region C - 4 tugas</option>
                <option value="4" data-details="Jonathan - Region D - 2 tugas">Jonathan - Region D - 2 tugas</option>
            </select>
            <input type="hidden" name="selectedOptions[]" id="selectedOptionsInput">
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Tugas</label>
            <div class="relative">
                <select id="tugasAnggota" class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white">
                    <option value="Petugas">Petugas</option>
                    <option value="Pengawas">Pengawas</option>
                    <option value="Perlengkapan">Perlengkapan</option>
                    <option value="custom">Custom (Isi Manual)</option>
                </select>
            </div>
        </div>

        <div id="customTaskInput" class="hidden mt-2">
            <label class="block text-sm font-medium text-gray-700">Tugas Custom</label>
            <input type="text" id="customTask" class="block w-full p-2 border border-gray-300 rounded-md" placeholder="Masukkan tugas...">
        </div>

        <div class="mt-4">
            <!-- Task Assignment Section -->
            <div class="w-full bg-white p-4 rounded-lg">
                <h3 class="text-[#20252f] font-semibold border-b pb-2">PETUGAS - PETUGAS</h3>
                <div class="grid grid-cols-2 gap-4 mt-2">
                    <!-- Petugas Column -->
                    <div>
                        <h4 class="text-[#20252f] font-semibold">Petugas</h4>
                        <ul class="text-gray-600">
                            <li class="flex items-center">
                                <span class="mr-2 w-6">✔</span> Angel
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2 w-6">✔</span> Martin
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2 w-6">✔</span> Shasaa
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2 w-6">✔</span> Jonathan
                            </li>
                        </ul>
                    </div>
                    <!-- Pengawas Column -->
                    <div>
                        <h4 class="text-[#20252f] font-semibold">Pengawas</h4>
                        <ul class="text-gray-600">
                            <li class="flex items-center">
                                <span class="mr-2 w-6">✔</span> Alonso
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2 w-6">✔</span> Bryan
                            </li>
                        </ul>
                    </div>
                    <!-- Perlengkapan Column -->
                    <div>
                        <h4 class="text-[#20252f] font-semibold">Perlengkapan</h4>
                        <ul class="text-gray-600">
                            <li class="flex items-center">
                                <span class="mr-2 w-6">✔</span> Alonso
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2 w-6">✔</span> Bryan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 flex justify-end space-x-4">
            <button class="px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg" onclick="closeAnggotaSection()">Tutup</button>
            <button class="px-6 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg" onclick="addAnggota()">Simpan</button>
        </div>
    </div>
</div>

<script>
    const headerButtons = document.querySelectorAll(".header-button");

headerButtons.forEach(button => {
    button.addEventListener("click", () => {
        // Remove active styles from all header buttons
        headerButtons.forEach(btn => {
            btn.classList.remove("bg-[#740001]", "text-white");
            btn.classList.add("bg-[#f6f1e3]");  // Reset to default color
        });

        // Add active styles to the clicked button
        button.classList.add("bg-[#740001]", "text-white");
        button.classList.remove("bg-[#f6f1e3]");  // Remove default color
    });
});

    // Open the modal when Edit button is clicked
    function openEditModal() {
        const anggotaSection = document.getElementById("anggotaSection");
        anggotaSection.classList.remove("hidden");
    }

    // Close the modal
    function closeAnggotaSection() {
        const anggotaSection = document.getElementById("anggotaSection");
        anggotaSection.classList.add("hidden");
    }

    // Handle adding anggota
    function addAnggota() {
        const selectedAnggota = document.getElementById("namaAnggota").value;
        const selectedTugas = document.getElementById("tugasAnggota").value;
        let customTugas = '';

        if (selectedTugas === "custom") {
            customTugas = document.getElementById("customTask").value;
        }

        console.log(`Anggota: ${selectedAnggota}, Tugas: ${selectedTugas}, Custom Tugas: ${customTugas}`);

        // Close modal after adding
        closeAnggotaSection();
    }

    // Handle custom task visibility
    document.getElementById("tugasAnggota").addEventListener("change", function() {
        if (this.value === "custom") {
            document.getElementById("customTaskInput").classList.remove("hidden");
        } else {
            document.getElementById("customTaskInput").classList.add("hidden");
        }
    });
</script>

@endsection
