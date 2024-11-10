@extends('base/admin_navbar')

@section('content')
@php
$accounts = App\Models\Account::all();
// Count the duties for each account by counting occurrences in misa_details
$dutyCounts = DB::table('misa_details')
->select('account_id', DB::raw('count(*) as duty_count'))
->groupBy('account_id')
->get()
->keyBy('account_id'); // Key the result by account_id for easier access
$misas = App\Models\Misa::all();

@endphp
<div class="container mx-auto py-8 mt-8 mb-8 justify-items-center">
    <div class="grid grid-cols-12">
        <div class="col-start-4 col-span-6 mt-8 mb-8 justify-items-center">
            <h2 class="font-bold text-3xl text-center">Input Jadwal Misa</h2>
        </div>
    </div>

    <!-- Input Jadwal Section -->
    <div class="flex justify-center mb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-16">
            <!-- Input Button -->
            <div class="flex items-center justify-center">
                <div class="w-64 h-64 bg-gray-200 border-2 border-dashed border-gray-400 flex flex-col justify-center items-center rounded-lg cursor-pointer hover:bg-gray-300 transition duration-300"
                    onclick="openModal('modalJadwal')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <p class="mt-4 text-gray-600 font-semibold">Add new</p>
                </div>
            </div>

            @foreach ($misas as $misa)
            <!-- Card for each misa -->
            <div class="w-64 h-64 bg-[#f6f1e3] p-6 border border-gray-300 rounded-lg shadow-lg flex flex-col justify-between cursor-pointer"
                onclick="openModal('modal{{ $misa->id }}')">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold">
                        {{ \Carbon\Carbon::parse($misa->activity_datetime)->translatedFormat('l') }},
                        {{ \Carbon\Carbon::parse($misa->activity_datetime)->format('d-M-Y') }}
                    </h2>
                </div>
                <div class="mt-2">
                    <p class="text-sm text-gray-700 flex items-center">
                        <span class="inline-block w-2.5 h-2.5 bg-orange-500 rounded-full mr-2"></span> {{$misa->title}}
                    </p>
                    <p class="text-sm text-gray-700 mt-1">{{ \Carbon\Carbon::parse($misa->activity_datetime)->format('H:i') }} WIB</p>
                </div>
                <div class="mt-4">
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($misa->upload_datetime)->translatedFormat('l') }},
                        {{ \Carbon\Carbon::parse($misa->upload_datetime)->format('d-M-Y') }}
                    </p>
                </div>
                <div class="mt-4">
                    <button class="w-full bg-[#002366] text-white py-2 rounded-lg hover:bg-[#20252f] transition-all duration-300">Upload</button>
                </div>
            </div>


            <!-- Modal for each misa -->
            <div id="modal{{ $misa->id }}" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal{{ $misa->id }}')">
                <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
                    <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal{{ $misa->id }}')">
                        &#10005;
                    </button>
                    <!-- Content inside the modal with two columns -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-left">
                            <div class="flex items-center justify-items">
                                <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
                                <h2 class="text-2xl font-bold ml-2">{{ $misa->title }}</h2> <!-- Title -->
                            </div>
                            <div class="ms-9">
                                <p class="mt-2 text-lg">{{ \Carbon\Carbon::parse($misa->activity_datetime)->translatedFormat('l') }},
                                    {{ \Carbon\Carbon::parse($misa->activity_datetime)->format('d-M-Y') }}
                                </p> <!-- Date -->
                                <p class="font-bold">{{ \Carbon\Carbon::parse($misa->activity_datetime)->format('H:i') }} WIB</p> <!-- Time -->
                            </div>
                        </div>

                        <!-- Right column: Task details -->
                        <div class="text-left">
                            <p class="text-xl font-bold">Yang bertugas saat ini:</p>

                            @php
                            // Group the misaDetails by roles
                            $roles = $misa->misaDetails->groupBy('roles');
                            @endphp

                            @foreach ($roles as $role => $details)
                            <p class="mt-2"><span class="font-bold">{{ $role }}:</span></p>
                            <ul>
                                @foreach ($details as $detail)
                                <li>{{ $detail->account->name ?? 'Tidak ada nama' }}</li>
                                @endforeach
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
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
                                <form id="jadwalMisaForm" class="space-y-4" method="POST" action="{{ route('misas.store') }}">
                                    @csrf
                                    <!-- Jadwal Misa Section -->
                                    <div id="jadwalMisaSection">
                                        <div>
                                            <label for="title" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                                            <input type="text" id="title" name="title" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Nama Kegiatan">
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
                                                <input type="date" name="activity_datetime" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Jam Kegiatan</label>
                                                <input type="time" name="activity_time" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Tanggal Upload</label>
                                                <input type="date" name="upload_datetime" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Jam Upload</label>
                                                <input type="time" name="upload_time" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Bentuk Kegiatan</label>
                                            <div class="mt-1 relative">
                                                <select name="category" class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white">
                                                    <option value="Misa Harian/Rutin">Misa Harian/Rutin</option>
                                                    <option value="Misa Acara Besar">Misa Acara Besar</option>
                                                    <option value="Misa Pernikahan">Misa Pernikahan</option>
                                                    <option value="Pelatihan">Pelatihan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Anggota Section (Initially hidden) -->
                                    <!-- Anggota Section -->
                                    <div id="anggotaSection" class="hidden">
                                        <!-- Nama Dropdown -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                                            <select id="namaAnggota" class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white">
                                                @foreach($accounts as $account)
                                                <option value="{{ $account->id }}" data-details="{{ $account->name }} - {{ $account->region }} - {{ $dutyCounts->get($account->id)->duty_count ?? 0 }}">
                                                    {{ $account->name }} - {{ $account->region }} - {{ $dutyCounts->get($account->id)->duty_count ?? 0 }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="selectedOptions[]" id="selectedOptionsInput">
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
                                                <input type="hidden" name="selectedOptions2[]" id="selectedOptionsInput2">
                                            </div>
                                        </div>

                                        <!-- Text field for custom Tugas (hidden by default) -->
                                        <div id="customTugasInput" class="hidden">
                                            <label class="block text-sm font-medium text-gray-700">Tugas Custom</label>
                                            <input name="customTugas[]" type="text" id="customTugasField" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Tugas lainnya">
                                        </div>

                                        <button type="button" class="w-full bg-[#740001] text-white py-2 rounded-lg hover:bg-[#20252f] transition-all duration-300" onclick="addAnggota()">
                                            Tambah Anggota
                                        </button>

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
                                                    <!-- Table rows will be added here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="bg-[#f6f1e3] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#002366] text-base font-medium text-white hover:bg-[#20252f] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Save
                                        </button>
                                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal('modalJadwal')">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            @endsection

            @section('libraryjs')
            <script>
                let selectedOptionsArray = [];
                let selectedOptionsArray2 = [];
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

                document.addEventListener("DOMContentLoaded", function() {

                    const addToArrayButton = document.getElementById("addToArrayButton");

                    // Initialize an array to store selected options


                    // Add event listener to "Add to Array" button
                    addToArrayButton.addEventListener("click", function() {


                        // Update the hidden input field with the array as a JSON string
                        selectedOptionsInput.value = JSON.stringify(selectedOptionsArray);
                    });
                });

                document.getElementById('tugasAnggota').addEventListener('change', function() {
                    const customInput = document.getElementById('customTugasInput');
                    if (this.value === 'custom') {
                        customInput.classList.remove('hidden');
                    } else {
                        customInput.classList.add('hidden');
                    }
                });
                // Define an array to store the table data
                const anggotaData = [];

                function addAnggota() {
                    const selectedOptionsInput = document.getElementById("selectedOptionsInput");
                    const selectedOptionsInput2 = document.getElementById("selectedOptionsInput2");

                    const namaSelect = document.getElementById('namaAnggota');
                    const tugasSelect = document.getElementById('tugasAnggota');
                    const customTugasField = document.getElementById('customTugasField');
                    const tableBody = document.getElementById('anggotaTableBody');

                    // Loop through all selected options in the namaSelect
                    for (const option of namaSelect.selectedOptions) {
                        const namaValue = option.value;
                        const namaDetails = option.getAttribute('data-details');
                        let tugas = tugasSelect.value;

                        // If 'custom' is selected, use the value from the custom field
                        if (tugas === 'custom') {
                            tugas = customTugasField.value;
                        }

                        if (namaValue && (tugas || tugasSelect.value !== 'custom')) {
                            // Extract the name, region, and duty count from data-details
                            const [nameOnly, wilayah, dutyCount] = namaDetails.split(' - ');

                            // Check if the name already exists in the table
                            let nameExists = false;
                            for (let row of tableBody.rows) {
                                const nameCell = row.cells[1]; // Assuming name is in the second cell
                                if (nameCell.textContent.trim() === nameOnly) {
                                    nameExists = true;
                                    break;
                                }
                            }

                            if (nameExists) {
                                alert(`The name "${nameOnly}" already exists in the table.`);
                                continue; // Skip this iteration if the name exists
                            }

                            // Add a new row to the table
                            const row = document.createElement('tr');
                            row.style.backgroundColor = 'white';

                            row.innerHTML = `
                <td class="border border-gray-300 px-1 py-1">${tableBody.children.length + 1}.</td>
                <td name="anggota[]" class="border border-gray-300 px-6 py-1">${nameOnly}</td>
                <td class="border border-gray-300 px-1 py-1">${wilayah}</td>
                <td name="roles[]" class="border border-gray-300 px-4 py-1">${tugas}</td>
                <td name="customTugas" class="border border-gray-300 py-1">
                    <button type="button" class="delete-btn w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-1 bg-[#ae0001] text-base font-medium text-white hover:bg-[#740001] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                </td>
            `;

                            tableBody.appendChild(row);

                            // Disable the selected option in the dropdown
                            option.disabled = true;

                            // Add event listener for delete button
                            row.querySelector('.delete-btn').addEventListener('click', function() {
                                // Enable the option in the dropdown again when the row is deleted
                                option.disabled = false;

                                // Remove the row from the table
                                tableBody.removeChild(row);
                                updateRowNumbers(); // Update row numbers
                            });
                        } else {
                            alert('Please fill out all fields.');
                        }
                    }

                    // Clear the form fields after adding multiple entries
                    const anggotaForm = document.getElementById('anggotaForm');
                    if (anggotaForm) {
                        anggotaForm.reset();
                    }
                    document.getElementById('customTugasInput').classList.add('hidden'); // Hide custom field again
                }

                // Function to update row numbers after deletion
                function updateRowNumbers() {
                    const rows = document.querySelectorAll('#anggotaTableBody tr');
                    rows.forEach((row, index) => {
                        row.cells[0].textContent = `${index + 1}.`;
                    });
                }

                // Function to delete a row from the table
                function deleteRow(button, name, wilayah, dutyCount) {
                    const row = button.closest('tr'); // Get the row of the button
                    const tableBody = document.getElementById('anggotaTableBody');

                    // Construct the full value of the option in the dropdown
                    const fullValue = `${name} - ${wilayah} - ${dutyCount}`;

                    // Remove the row from the table
                    tableBody.removeChild(row);

                    // Enable the option again in the dropdown
                    const selectOption = document.querySelector(`#namaAnggota option[value="${fullValue}"]`);
                    if (selectOption) {
                        selectOption.disabled = false; // Enable the option
                    }
                }
            </script>
            @endsection