@extends('base/admin_navbar')

@section('content')
<?php

use Carbon\Carbon;
use App\Models\Misa_Detail;
use App\Models\Account;

Carbon::setLocale('id');
?>
<div class="container-fluid m-12 mt-24">
    <div class="grid grid-cols-12">
        <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
            <h1 class="font-bold text-4xl text-center">EVALUASI</h1>
        </div>
        <!-- Responsive Search Bar -->
        <div class="flex flex-col w-full place-items-center col-span-12 sm:col-span-12 md:col-start-11 md:col-span-2 text-right mr-16 mt-8 sm:mt-4">
            <div class="flex w-full justify-between sm:w-[250px] md:w-[250px] lg:w-[250px] mt-4">
                <div class="flex flex-row items-center text-gray-500">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <form class="sm:w-[250px] md:w-[250px] lg:w-[250px] ml-2">
                        <div class="flex items-center border-b border-grey-500 py-1">
                            <input
                                id="searchInput"
                                class="appearance-none bg-transparent border-none w-full text-gray-700 text-sm mr-2 py-1 px-2 leading-tight focus:outline-none"
                                type="text" placeholder="Search" aria-label="Search" onkeyup="filterMisa()">
                        </div>
                    </form>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openModal('filterModal')">
                        Filter
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Filter Modal -->
    <!-- Filter Modal -->
    <div id="filterModal" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center"
        onclick="closeModal('filterModal')">
        <div class="bg-white p-6 rounded-lg w-96" onclick="event.stopPropagation()">
            <h2 class="text-xl font-bold mb-4">Filter & Sort Misa</h2>

            <!-- Select Month -->
            <label for="filterMonth" class="block mb-2 text-sm font-medium text-gray-700">Filter by Month:</label>
            <select id="filterMonth" class="w-full border rounded px-3 py-2">
                <option value="">All Months</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <!-- Select Year -->
            <label for="filterYear" class="block mb-2 text-sm font-medium text-gray-700 mt-2">Filter by Year:</label>
            <select id="filterYear" class="w-full border rounded px-3 py-2">
                <option value="">All Years</option>
                <?php for ($year = date("Y"); $year >= 2000; $year--) : ?>
                    <option value="<?= $year ?>"><?= $year ?></option>
                <?php endfor; ?>
            </select>

            <!-- Select Date Range -->
            <label class="block mb-2 text-sm font-medium text-gray-700 mt-2">Date Range:</label>
            <div class="flex justify-between">
                <input type="date" id="startDate" class="w-1/2 border rounded px-3 py-2">
                <span class="mx-2">to</span>
                <input type="date" id="endDate" class="w-1/2 border rounded px-3 py-2">
            </div>

            <!-- Sort Order -->
            <label for="sortOrder" class="block mb-2 text-sm font-medium text-gray-700 mt-2">Sort by Date:</label>
            <select id="sortOrder" class="w-full border rounded px-3 py-2">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>

            <!-- Apply Button -->
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                onclick="applyFilters()">
                Apply Filters
            </button>

            <!-- Close Button -->
            <button class="absolute top-2 right-4 text-black text-lg" onclick="closeModal('filterModal')">
                &#10005;
            </button>
        </div>
    </div>




    <!-- Jadwal Misa Section -->
    <div id="misaContainer" class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center gap-16 m-12 mt-10">
        @foreach ($misa as $m)
        <div class="misa-card bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px]"
            data-title="{{ strtolower($m->title) }}"
            data-date="{{ strtolower(Carbon::parse($m->activity_datetime)->translatedFormat('l, j F Y')) }}"
            data-evaluation="{{ strtolower($m->evaluation) }}">
            <div class="flex justify-end text-sm text-gray-500 cursor-pointer" onclick="openModal('modal{{ $m->id }}')">
                <a class="mr-1">detail</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3 mt-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </div>
            <div class="flex justify-between items-center">
                <p class="font-bold text-lg">
                    {{ Carbon::parse($m->activity_datetime)->translatedFormat('l, j F Y') }}
                </p>
            </div>
            <div class="mt-2">
                <div class="flex mb-2">
                    <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
                    <div class="flex flex-col ml-2">
                        <span>{{ $m->title }}</span>
                        <p class="mt-0">{{ date('H.i', strtotime($m->activity_datetime)) }} WIB</p>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex flex-col">
                    <p class="font-bold">Evaluasi: </p>
                    <p class="mt-0 text-sm text-justify">{{ $m->evaluation }}</p>
                </div>
            </div>
        </div>

        <div id="modal{{ $m->id }}"
            class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center"
            onclick="closeModal('modal{{ $m->id }}')">
            <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12"
                onclick="event.stopPropagation()">
                <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal{{ $m->id }}')">
                    &#10005;
                </button>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-left ">
                        <div class="flex items-center justify-items">
                            <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
                            <h2 class="text-2xl font-bold ml-2">{{ $m->title }}</h2>
                        </div>
                        <div class="ms-9">
                            <p class="mt-2 text-lg">
                                {{ Carbon::parse($m->activity_datetime)->translatedFormat('j F Y') }}
                            </p>
                            <p class="font-bold">{{ date('H.i', strtotime($m->activity_datetime)) }} WIB</p>
                        </div>
                        <div class="mt-6 ms-9">
                            <div class="flex flex-col">
                                <p class="font-bold">Evaluasi: </p>
                                <p class="mt-0 text-sm text-justify pe-2 overflow-y-scroll max-h-32">{{ $m->evaluation }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-left">
                        <p class="text-xl font-bold">Yang bertugas saat ini:</p>
                        <p class="mt-2"><span class="font-bold">Petugas:</span></p>
                        <?php
                        $misa_detail = Misa_Detail::get()->where('misa_id', $m->id);
                        $petugas_id = $misa_detail->where('roles', 'Petugas');
                        $pengawas_id = $misa_detail->where('roles', 'Pengawas');
                        $perkap_id = $misa_detail->where('roles', 'Perkap');
                        $petugas = Account::get()->whereIn('id', $petugas_id->pluck('account_id'));
                        $pengawas = Account::get()->whereIn('id', $pengawas_id->pluck('account_id'));
                        $perkap = Account::get()->whereIn('id', $perkap_id->pluck('account_id'));
                        ?>
                        <ul class="list-none mr-14">
                            @foreach ($petugas as $p)
                            <li>{{ $p->name }}</li>
                            @endforeach
                        </ul>
                        <p class="mt-2"><span class="font-bold">Pengawas:</span></p>
                        <ul class="list-none mr-14">
                            @foreach ($pengawas as $p)
                            <li>{{ $p->name }}</li>
                            @endforeach
                        </ul>
                        <p class="mt-2"><span class="font-bold">Perkap:</span></p>
                        <ul class="list-none mr-14">
                            @foreach ($perkap as $p)
                            <li>{{ $p->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        function applySort() {
            let order = document.getElementById("sortOrder").value; // Get selected option
            sortMisa(order); // Call sorting function
            closeModal('filterModal'); // Close modal after applying
        }

        // function sortMisa(order) {
        //     let misaContainer = document.getElementById("misaContainer");
        //     let misaCards = Array.from(misaContainer.children);

        //     misaCards.sort((a, b) => {
        //         let dateA = new Date(a.getAttribute("data-date"));
        //         let dateB = new Date(b.getAttribute("data-date"));

        //         return order === 'asc' ? dateA - dateB : dateB - dateA;
        //     });

        //     misaContainer.innerHTML = ""; // Clear existing content
        //     misaCards.forEach(card => misaContainer.appendChild(card)); // Re-append sorted cards
        // }

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }


        function filterMisa() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.querySelectorAll('.misa-card');

            cards.forEach(card => {
                let title = card.getAttribute('data-title');
                let date = card.getAttribute('data-date');
                let evaluation = card.getAttribute('data-evaluation');

                if (title.includes(input) || date.includes(input) || evaluation.includes(input)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        function applyFilters() {
    let month = document.getElementById("filterMonth").value;
    let year = document.getElementById("filterYear").value;
    let startDate = document.getElementById("startDate").value;
    let endDate = document.getElementById("endDate").value;
    let sortOrder = document.getElementById("sortOrder").value;

    filterMisa(month, year, startDate, endDate);
    sortMisa(sortOrder);
    closeModal('filterModal'); // Close modal after applying
}

function filterMisa(month, year, startDate, endDate) {
    let cards = document.querySelectorAll('.misa-card');

    cards.forEach(card => {
        let dateText = card.getAttribute("data-date"); // "Monday, 5 June 2024"
        let parsedDate = new Date(dateText);

        let cardMonth = String(parsedDate.getMonth() + 1).padStart(2, "0"); // Get month (01-12)
        let cardYear = String(parsedDate.getFullYear()); // Get year

        let isVisible = true;

        // Filter by month
        if (month && cardMonth !== month) {
            isVisible = false;
        }

        // Filter by year
        if (year && cardYear !== year) {
            isVisible = false;
        }

        // Filter by date range
        if (startDate && parsedDate < new Date(startDate)) {
            isVisible = false;
        }
        if (endDate && parsedDate > new Date(endDate)) {
            isVisible = false;
        }

        card.style.display = isVisible ? "block" : "none";
    });
}

function sortMisa(order) {
    let misaContainer = document.getElementById("misaContainer");
    let misaCards = Array.from(misaContainer.children);

    misaCards.sort((a, b) => {
        let dateA = new Date(a.getAttribute("data-date"));
        let dateB = new Date(b.getAttribute("data-date"));

        return order === 'asc' ? dateA - dateB : dateB - dateA;
    });

    misaContainer.innerHTML = ""; // Clear existing content
    misaCards.forEach(card => misaContainer.appendChild(card)); // Re-append sorted cards
}

function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}


        // Modal open function
        function openModal(modalId) {
            console.log("Opening modal: ", modalId);
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Modal close function
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>