@extends('base/admin_navbar')

@section('content')
<!-- Colors:
                1. #740001 - merah gelap
                2. #ae0001 - merah terang
                3. #f6f1e3 - netral
                4. #002366 - biru terang
                5. #20252f - biru gelap
            -->

<div class="container-fluid content-body mx-12 ">
    @php
    use Carbon\Carbon;
    use App\Models\Account;
    use App\Models\Meet;

    Carbon::setLocale('id');
    @endphp
    <h1 class="text-3xl">Edit Acara</h1>
    @php
    $event_id = $event->id;
    $chief = Account::whereHas('eventDetails', function ($query) use ($event_id) {
    $query->where('event_id', $event_id)->where('roles', 'Ketua');
    })->firstOrFail();



    $accounts = Account::where('id', '!=', $chief->id)->get();
    $eventAccount = Account::whereHas('eventDetails', function ($query) use ($event_id) {
    $query->where('event_id', $event_id)->where('roles', '!=', 'Ketua');
    })->get();

    $availableAccounts= Account::whereDoesntHave('eventDetails', function ($query) use ($event_id) {
    $query->where('event_id', $event_id);
    })->get();
    @endphp
    <div class="container-fluid">
        <form class="rounded-xl py-6 px-6 flex flex-col lg:flex-row bg-[#f6f1e3]"
            method="POST"
            action="{{ route('events.update', ['event' => $event]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Gambar Poster -->
            <img src="{{ asset('images/contoh_poster.jpg') }}"
                class="w-64 mx-auto lg:mx-0 mb-6 lg:mb-0 lg:mr-10"
                alt="">

            <!-- Grid Form -->
            <div class="grid grid-cols-1 gap-4 w-full lg:grid-cols-2">
                <!-- Judul Acara -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Acara</label>
                    <input type="text" id="title" name="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required value="{{ $event->title }}">
                </div>

                <!-- Tanggal Acara -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Acara</label>
                    <input type="date" id="date" name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required value="{{ Carbon::parse($event->date)->translatedFormat('Y-m-d') }}">
                </div>

                <!-- Waktu Mulai -->
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                    <input type="time" id="start_time" name="start_time"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ Carbon::parse($event->start_time)->translatedFormat('H:i') }}" required>
                </div>

                <!-- Waktu Selesai -->
                <div>
                    <label for="finished_time" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                    <input type="time" id="finished_time" name="finished_time"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ Carbon::parse($event->finished_time)->translatedFormat('H:i') }}" required>
                </div>

                <!-- Ketua Acara -->
                <div>
                    <label for="chiefs" class="block text-sm font-medium text-gray-700">Ketua Acara</label>
                    <select id="chiefs"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="event_chief">
                        <option value="{{ $chief->id }}" selected>{{ $chief->name }}</option>
                        @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $event->contact_person }}" required>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $event->phone_number }}" required>
                </div>

                <!-- Tempat Acara -->
                <div>
                    <label for="place" class="block text-sm font-medium text-gray-700">Tempat Acara</label>
                    <input type="text" id="place" name="place"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $event->place }}" required>
                </div>

                <!-- Tombol Simpan -->
                <div class="col-span-1 lg:col-span-2 mt-4 flex justify-center">
                    <button type="submit"
                        class="text-white bg-[#002366] hover:bg-[#20252f] font-medium rounded-lg text-sm px-12 py-2.5 text-center">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    @php
    $meets = Meet::where('event_id', $event->id)->get();
    @endphp

    <div class="relative py-6 ps-6 overflow-x-auto sm:rounded-lg">

        <div class="flex justify-between items-center">
            <h1 class="ms-3 mt-9 mb-3 text-2xl">Informasi Anggota Panitia Acara</h1>
            <button id="openModalButton" class="bg-[#002366] text-white hover:bg-[#20252f] rounded-lg px-4 py-2">
                Add Anggota
            </button>
        </div>


        <!-- Static Table Version -->
        <table class="w-full text-md text-left rtl:text-right">
            <thead class="text-md uppercase bg-[#f6f1e3]">
                <tr>
                    <th scope="col" class="rounded-tl-lg px-6 py-3 text-center border-b border-gray-500">Nama Anggota</th>
                    <th scope="col" class="px-6 py-3 text-center border-b border-gray-500">Wilayah</th>
                    <th scope="col" class="px-6 py-3 text-center border-b border-gray-500">Role</th>
                    <th scope="col" class="rounded-tr-lg px-6 py-3 text-center border-b border-gray-500">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventAccount as $account)
                <tr class="bg-[#f6f1e3] border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">{{ $account->name }}</th>
                    <td class="px-6 py-4 text-center">{{ $account->region }}</td>
                    <td class="px-6 py-4 text-center">
                        {{-- Accessing the role directly from the event_detail relationship --}}
                        @php
                        $eventDetail = \App\Models\EventDetail::where('account_id', $account->id)->first();
                        @endphp
                        {{ $eventDetail ? $eventDetail->roles : 'No Role' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button type="button"
                            class="editAnggotaBtn text-white bg-[#002366] hover:bg-[#20252f] font-medium rounded-lg text-sm px-12 py-2.5"
                            data-id="{{ $account->id }}"
                            data-name="{{ $account->name }}"
                            data-region="{{ $account->region }}"
                            data-role="{{ $eventDetail ? $eventDetail->roles : '' }}"
                            data-current-role="{{ $eventDetail ? $eventDetail->roles : '' }}">
                            Edit
                        </button>
                        <form action="{{ route('admin.eventAccounts.remove', ['eventId' => $event->id, 'accountId' => $account->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-white bg-[#ae0001] hover:bg-[#740001] font-medium rounded-lg text-sm px-12 py-2.5 text-center me-2 mb-2">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div id="editAnggotaModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="px-6 py-4 flex justify-between items-center bg-[#002366] text-white">
                <h2 class="text-lg font-bold">Edit Anggota</h2>
                <button id="closeModal" class="text-xl font-bold">&times;</button>
            </div>
            <form id="editAnggotaForm" method="POST" action="{{ route('admin.eventAccounts.update', ['eventId' => $event->id, 'accountId' => $account->id]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="editAccountId" name="account_id">
                <div class="px-6 py-4 space-y-4">
                    <!-- Available Anggota Dropdown -->
                    <div>
                        <label for="availableAnggota" class="block text-sm font-medium text-gray-700">Anggota Tersedia</label>
                        <select id="availableAnggota" name="new_anggota_id"
                            class="w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
                            <option value="{{ $account->id }}" {{ $account->id == old('new_anggota_id') ? 'selected' : '' }}>
                                {{ $account->name }}
                            </option>
                            @foreach ($availableAccounts as $account)
                            <option value="{{ $account->id }}" {{ $account->id == old('new_anggota_id') ? 'selected' : '' }}>{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Role Input -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <input id="role" name="role" type="text" class="w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required placeholder="Enter role" value="{{ old('role') }}" />
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-100 flex justify-end">
                    <button type="button" id="cancelModal"
                        class="text-gray-600 bg-gray-300 hover:bg-gray-400 rounded-lg px-4 py-2 mr-2">Cancel</button>
                    <button type="submit"
                        class="bg-[#002366] text-white hover:bg-[#20252f] rounded-lg px-4 py-2">Save</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Structure -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Add Anggota to Event</h2>
            <form action="{{ route('admin.eventAccounts.add', ['eventId' => $event->id]) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="new_anggota_id" class="block text-sm font-medium text-gray-700">Anggota Tersedia</label>
                        <select id="new_anggota_id" name="new_anggota_id" class="w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
                            <option value="" disabled selected>Select an Anggota</option>
                            @foreach ($availableAccounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <input id="role" name="role" type="text" class="w-full bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required placeholder="Enter role" />
                    </div>
                </div>

                <div class="flex justify-end space-x-4 py-4">
                    <button type="button" id="cancelModal" class="text-gray-600 bg-gray-300 hover:bg-gray-400 rounded-lg px-4 py-2">Cancel</button>
                    <button type="submit" class="bg-[#002366] text-white hover:bg-[#20252f] rounded-lg px-4 py-2">Add Anggota</button>
                </div>
            </form>
        </div>
    </div>



    <div class="relative py-6 ps-6 overflow-x-auto sm:rounded-lg">
        <div>
            <h1 class="ms-3 mt-9 mb-3 text-2xl">Informasi Rapat & Kegiatan untuk Acara</h1>
            <button id="openModalButton" class="bg-[#002366] text-white hover:bg-[#20252f] rounded-lg px-4 py-2" onclick="openModal()">
                Add Rapat
            </button>
        </div>

        @if (!($meets->all() == null))
        <table class="w-full text-md text-left rtl:text-right">
            <thead class="text-md uppercase bg-[#f6f1e3]">
                <tr>
                    <th scope="col" class="rounded-tl-lg px-6 py-3 text-center border-b border-gray-500">
                        Kegiatan
                    </th>
                    <th scope="col" class="px-6 py-3 text-center border-b border-gray-500">
                        Tanggal Dilaksanakan
                    </th>
                    <th scope="col" class="rounded-tr-lg px-6 py-3 text-center border-b border-gray-500">
                        Notulen/Catatan
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meets as $meet)
                <tr class="bg-[#f6f1e3] border-b">
                    <th scope="row" class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                        {{$meet->title}}
                    </th>
                    <td class="px-6 py-4 text-center">
                        {{ Carbon::parse($meet->date)->translatedFormat('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{route('meets.show', ['meet' => $meet])}}">
                            <button type="button" class="text-white bg-[#002366] hover:bg-[#20252f] bg-[#002366] hover:bg-[#20252f font-medium rounded-lg text-sm px-12 py-2.5 text-center me-2 mb-2">Detail</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-4 mb-4 text-sm flex justify-center text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Data Rapat tidak ditemukan
        </div>
        @endif
    </div>

    <!-- Modal for Adding Rapat -->
    <div id="addRapatModal" class="hidden fixed inset-0 z-50 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
            <h2 class="text-2xl font-bold mb-4">Tambah Rapat Pengurus</h2>

            <!-- Form to create a meeting -->
            <form action="{{ route('meets.storeRapat') }}" method="POST">
                @csrf

                <!-- Event ID -->
                <input type="hidden" name="event_id" value="{{ $event->id }}">


                <!-- Title -->
                <div class="mb-4">
                    <label for="namaJadwal" class="block text-lg font-medium text-gray-700">Judul Kegiatan</label>
                    <input type="text" name="namaJadwal" id="namaJadwal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    @error('namaJadwal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Date -->
                <div class="mb-4">
                    <label for="tanggalJadwal" class="block text-lg font-medium text-gray-700">Tanggal Dilaksanakan</label>
                    <input type="date" name="tanggalJadwal" id="tanggalJadwal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    @error('tanggalJadwal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Time -->
                <div class="mb-4">
                    <label for="waktuJadwal" class="block text-lg font-medium text-gray-700">Waktu Dilaksanakan</label>
                    <input type="time" name="waktuJadwal" id="waktuJadwal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    @error('waktuJadwal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Place -->
                <div class="mb-4">
                    <label for="lokasiJadwal" class="block text-lg font-medium text-gray-700">Tempat</label>
                    <input type="text" name="lokasiJadwal" id="lokasiJadwal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    @error('lokasiJadwal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Notulen -->
                <div class="mb-4">
                    <label for="meetDesc" class="block text-lg font-medium text-gray-700">Notulen/Catatan</label>
                    <textarea name="meetDesc" id="meetDesc" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required></textarea>
                    @error('meetDesc') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white py-2 px-4 rounded-lg">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>



</div>
@endsection

@section('libraryjs')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var ElementHeight = $("nav").height();
        var ElementPadding = parseInt($("nav").css('padding').replace("px", ""));
        var numberMargin = ((ElementHeight + (ElementPadding * 2)) / 16) + 2;
        var MarginTop = String(numberMargin) + "rem";
        console.log(MarginTop);
        $(".content-body").css("margin-top", MarginTop);
    });



    $(document).ready(function() {
        // Show modal and populate fields when Edit button is clicked
        $(".editAnggotaBtn").click(function() {
            const accountId = $(this).data("id");
            const name = $(this).data("name");
            const region = $(this).data("region");
            const role = $(this).data("role"); // Get the role from data-role attribute

            // Populate the modal fields
            $("#editAccountId").val(accountId);
            $("#availableAnggota").val(accountId); // Set the dropdown to the clicked account's id

            // Set the role input field with the current role value
            $("#role").val(role);

            // Update form action dynamically
            const actionUrl = `/admin/eventAccounts/${accountId}/update`;
            $("#editAnggotaForm").attr("action", actionUrl);

            // Show the modal
            $("#editAnggotaModal").removeClass("hidden");
        });

        // Close modal
        $("#closeModal, #cancelModal").click(function() {
            $("#editAnggotaModal").addClass("hidden");
        });
    });
    const openModalButton = document.getElementById('openModalButton');
    const modal = document.getElementById('modal');
    const cancelModal = document.getElementById('cancelModal');

    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    cancelModal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    function openModal() {
        document.getElementById('addRapatModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addRapatModal').classList.add('hidden');
    }
</script>

@endsection