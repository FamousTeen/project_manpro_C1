        @extends('base/admin_navbar')

        @section('content')

        <div class="container mx-auto py-8 mt-8 mb-8 justify-items-center">
            <div class="grid grid-cols-12">
                <div class="col-start-4 col-span-6 mt-8 mb-8 justify-items-center">
                    <h2 class="font-bold text-3xl text-center">Input Jadwal Misa</h2>
                </div>
            </div>

            <!-- Input Jadwal Section -->
            <div class="flex justify-center mb-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                    <!-- Input Button -->
                    <div class="flex items-center justify-center">
                        <div class="w-64 h-64 bg-gray-200 border-2 border-dashed border-gray-400 flex flex-col justify-center items-center rounded-lg cursor-pointer hover:bg-gray-300 transition duration-300"
                            onclick="openModal('modalJadwal')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <p class="mt-4 text-gray-600 font-semibold">Add new</p>
                        </div>
                    </div>

                   <!-- Card Jadwal Button -->
                    <div class="w-64 h-64 bg-[#f6f1e3] p-6 border border-gray-300 rounded-lg shadow-lg flex flex-col justify-between cursor-pointer" onclick="openModal('modal1', 'Misa Mingguan', '18.00 WIB', 'Minggu, 15-09-2024')">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-bold">Minggu, 15-09-2024</h2>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm text-gray-700 flex items-center">
                                <span class="inline-block w-2.5 h-2.5 bg-orange-500 rounded-full mr-2"></span> Misa Mingguan
                            </p>
                            <p class="text-sm text-gray-700 mt-1">18.00 WIB</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-xs text-gray-500">Senin, 10 April 2024</p>
                        </div>
                        <div class="mt-4">
                            <button class="w-full bg-[#002366] text-white py-2 rounded-lg hover:bg-[#20252f] transition-all duration-300">Upload</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal1')">
                        <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
                            <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal1')">
                                &#10005;
                            </button>
                            <!-- Content inside the modal with two columns -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-left">
                                    <div class="flex items-center justify-items">
                                        <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
                                        <h2 class="text-2xl font-bold ml-2" id="modalTitle">Misa Mingguan</h2> <!-- Title -->
                                    </div>
                                    <div class="ms-9">
                                        <p class="mt-2 text-lg" id="modalDate">Minggu, 15-09-2024</p> <!-- Date -->
                                        <p class="font-bold" id="modalTime">18.00 WIB</p> <!-- Time -->
                                    </div>
                                </div>
                                
                                <!-- Right column: Task details -->
                                <div class="text-left">
                                    <p class="text-xl font-bold">Yang bertugas saat ini:</p>
                                    <p class="mt-2"><span class="font-bold">Petugas:</span></p>
                                    <div class="flex flex-row">
                                        <ul class="mr-14">
                                            <li>Angel</li>
                                            <li>Martin</li>
                                            <li>Shasaa</li>
                                            <li>Jonathan</li>
                                        </ul>
                                        <ul>
                                            <li>Angel</li>
                                            <li>Martin</li>
                                            <li>Angel</li>
                                        </ul>
                                    </div>
                                    <p class="mt-2"><span class="font-bold">Pengawas:</span></p>
                                    <ul>
                                        <li>Alonso</li>
                                        <li>Bryan</li>
                                    </ul>
                                    <p class="mt-2"><span class="font-bold">Perkap:</span></p>
                                    <ul>
                                        <li>Alonso</li>
                                        <li>Bryan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


        <!-- Modal with two sections (Jadwal Misa and Anggota) -->
        <div id="modalJadwal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal('modalJadwal')"></div>
                <div class="bg-[#f6f1e3] rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                    <div class="p-6">
                        
                        <!-- Toggle buttons -->
                        <div class="mt-4 flex space-x-4">
                            <button id="btnJadwalMisa" class="w-full bg-[#002366] text-white py-2 rounded-lg hover:bg-[#20252f] transition-all duration-300" onclick="showSection('jadwalMisa')">
                                Jadwal Misa
                            </button>
                            <button id="btnAnggota" class="w-full bg-[#002366] text-white py-2 rounded-lg hover:bg-[#20252f] transition-all duration-300" onclick="showSection('anggota')">
                                Anggota
                            </button>
                        </div>

                        <!-- Container to ensure both sections have equal height -->
                        <div class="relative mt-6 flex flex-col justify-between min-h-[300px]">
                            <!-- Jadwal Misa Section -->
                            <div id="jadwalMisaSection">
                                <form class="space-y-4 ">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                                        <input type="text" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Nama Kegiatan">
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
                                            <input type="date" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Jam Kegiatan</label>
                                            <input type="time" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Tanggal Upload</label>
                                            <input type="date" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Jam Upload</label>
                                            <input type="time" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Bentuk Kegiatan</label>
                                        <div class="mt-1 relative">
                                            <select class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white">
                                                <option>Misa Harian / Rutin</option>
                                                <option>Misa Acara Besar</option>
                                                <option>Misa Pernikahan</option>
                                                <option>Pelatihan</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Anggota Section (Initially hidden) -->
                            <!-- Anggota Section -->
                            <div id="anggotaSection" class="hidden">
                                <form class="space-y-4" id="anggotaForm">
                                    <!-- Nama Dropdown -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                                        <select id="namaAnggota" class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white">
                                            <option value="John Doe">Angel - Bar - 1</option>
                                            <option value="Jane Smith">Josh - Fil - 1</option>
                                            <option value="Mike Johnson">Mike - Car - 2</option>
                                        </select>
                                    </div>

                                    <!-- Tugas Dropdown or Custom Input -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tugas</label>
                                        <div class="mt-1 relative">
                                            <select id="tugasAnggota" class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white">
                                                <option value="Petugas">Petugas</option>
                                                <option value="Pengawas">Pengawas</option>
                                                <option value="Perlengkapan">Perlengkapan</option>
                                                <option value="custom">Custom (Isi Manual)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Text field for custom Tugas (hidden by default) -->
                                    <div id="customTugasInput" class="hidden">
                                        <label class="block text-sm font-medium text-gray-700">Tugas Custom</label>
                                        <input type="text" id="customTugasField" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Tugas lainnya">
                                    </div>

                                    <button type="button" class="w-full bg-[#740001] text-white py-2 rounded-lg hover:bg-[#20252f] transition-all duration-300" onclick="addAnggota()">
                                        Tambah Anggota
                                    </button>
                                </form>

                                <!-- Table to show added anggota -->
                                <div class="mt-6 overflow-y-auto max-h-60">
                                    <h3 class="text-lg font-semibold">Daftar Anggota</h3>
                                    <table class="w-full mt-2 table-auto border-collapse border border-gray-300">
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th class="border border-gray-300 px-1 py-1">No.</th>
                                                <th class="border border-gray-300 px-6 py-1">Nama</th>
                                                <th class="border border-gray-300 px-1 py-1">Wilayah</th>
                                                <th class="border border-gray-300 px-4 py-1">Tugas</th>
                                                <th class="border border-gray-300 py-1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="anggotaTableBody">
                                            <tr class="bg-white">
                                                <th class="border border-gray-300 px-1 py-1">1.</th>
                                                <th class="border border-gray-300 px-6 py-1"></th>
                                                <th class="border border-gray-300 px-1 py-1"></th>
                                                <th class="border border-gray-300 px-4 py-1"></th>
                                                <th class="border border-gray-300 py-1">
                                                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-1 bg-[#ae0001] text-base font-medium text-white hover:bg-[#740001] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Delete
                                                    </button>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#f6f1e3] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#002366] text-base font-medium text-white hover:bg-[#20252f] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Save
                        </button>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal('modalJadwal')">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @endsection

        @section('libraryjs')
        <script>
        // Function to open the modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Function to show Jadwal Misa section and hide Anggota section
        function showSection(section) {
            const jadwalMisaSection = document.getElementById('jadwalMisaSection');
            const anggotaSection = document.getElementById('anggotaSection');

            if (section === 'jadwalMisa') {
                jadwalMisaSection.classList.remove('hidden');
                anggotaSection.classList.add('hidden');
            } else if (section === 'anggota') {
                jadwalMisaSection.classList.add('hidden');
                anggotaSection.classList.remove('hidden');
            }
        }

        // Function to add a new Anggota to the table
        function addAnggota() {
            const nama = document.getElementById('namaAnggota').value;
            const wilayah = document.getElementById('wilayahAnggota').value;
            const tugas = document.getElementById('tugasAnggota').value;

            if (nama && wilayah && tugas) {
                const tableBody = document.getElementById('anggotaTableBody');
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td class="border border-gray-300 px-4 py-2">${nama}</td>
                    <td class="border border-gray-300 px-4 py-2">${wilayah}</td>
                    <td class="border border-gray-300 px-4 py-2">${tugas}</td>
                `;
                tableBody.appendChild(row);

                // Clear input fields after adding
                document.getElementById('anggotaForm').reset();
            } else {
                alert('Please fill out all fields.');
            }
        }
        // Show or hide custom Tugas input field based on selection
        document.getElementById('tugasAnggota').addEventListener('change', function() {
            const customTugasInput = document.getElementById('customTugasInput');
            if (this.value === 'custom') {
                customTugasInput.classList.remove('hidden');
            } else {
                customTugasInput.classList.add('hidden');
            }
        });

        // Function to add a new Anggota to the table
        function addAnggota() {
            const nama = document.getElementById('namaAnggota').value;
            const tugasSelect = document.getElementById('tugasAnggota');
            let tugas = tugasSelect.value;

            // If 'custom' is selected, use the value from the custom field
            if (tugas === 'custom') {
                tugas = document.getElementById('customTugasField').value;
            }

            if (nama && tugas) {
                const tableBody = document.getElementById('anggotaTableBody');
                const row = document.createElement('tr');

                // Split the "nama" field to get the region (Wilayah)
                const [name, wilayah] = nama.split(' - ');

                row.innerHTML = `
                    <td class="border border-gray-300 px-4 py-2">${name}</td>
                    <td class="border border-gray-300 px-4 py-2">${wilayah}</td>
                    <td class="border border-gray-300 px-4 py-2">${tugas}</td>
                `;
                tableBody.appendChild(row);

                // Clear input fields after adding
                document.getElementById('anggotaForm').reset();
                document.getElementById('customTugasInput').classList.add('hidden'); // Hide custom field again
            } else {
                alert('Please fill out all fields.');
            }
        }

        </script>
        @endsection
