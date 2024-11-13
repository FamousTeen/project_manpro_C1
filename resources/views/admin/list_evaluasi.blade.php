@extends('base/admin_navbar')

@section('content')
<?php
use Carbon\Carbon;

Carbon::setLocale('id');
?>
    <div class="container-fluid m-12 mt-24">
        <div class="grid grid-cols-12">
            <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
                <h1 class="font-bold text-4xl text-center">EVALUASI</h1>
            </div>
            <div class="flex flex-col w-full place-items-center col-start-11 col-span-2 text-right mr-16 mt-8">
                <div class="flex w-full justify-between sm:w-[250px] md:w-[250px] lg:w-[250px] mt-4">
                    <div class="flex flex-row items-center text-gray-500">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg> 
                        </div>
                        <form class="sm:w-[250px] md:w-[250px] lg:w-[250px] ml-2">
                            <div class="flex items-center border-b border-grey-500 py-1">
                                <input class="appearance-none bg-transparent border-none w-full text-gray-700 text-sm mr-2 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Search" aria-label="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Misa Section -->
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-center gap-16 m-12 mt-10">
        @foreach ($misa as $m)
        <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px] mx-auto resize-y">
            <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal{{$m->id}}')">
                <a class="mr-1">detail</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3 mt-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </div>
            <div class="flex justify-between items-center">
                <p class="font-bold" style="font-size: 18px">
                    {{ Carbon::parse($m->misa->activity_datetime)->translatedFormat('l, j F Y') }}
                </p>
            </div>
            <div class="mt-2">
                <div class="flex mb-2">
                    <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
                    <div class="flex flex-col ml-2">
                        <span>Judul Kegiatan</span>
                        <p class="mt-0">19.00 WIB</p>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex flex-col">
                    <p class="font-bold">Evaluasi: </p>
                    <p class="mt-0 text-sm text-justify">Contoh evaluasi misa atau kegiatan lainnya.</p>
                </div>
            </div>
        </div>

        <!-- Modal Example -->
        <div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center"
            onclick="closeModal('modal1')">
            <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
                <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal1')">
                    &#10005;
                </button>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-left ">
                        <div class="flex items-center justify-items">
                            <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
                            <h2 class="text-2xl font-bold ml-2">Judul Kegiatan</h2>
                        </div>
                        <div class="ms-9">
                            <p class="mt-2 text-lg">1 Januari 2024</p>
                            <p class="font-bold">19.00 WIB</p>
                        </div>
                        <div class="mt-6 ms-9">
                            <div class="flex flex-col">
                                <p class="font-bold">Evaluasi: </p>
                                <p class="mt-0 text-sm text-justify pe-2">Contoh evaluasi misa atau kegiatan lainnya.</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-left">
                        <p class="text-xl font-bold">Yang bertugas saat ini:</p>
                        <p class="mt-2"><span class="font-bold">Petugas:</span></p>
                        <ul class="list-none mr-14">
                            <li>Nama Petugas 1</li>
                            <li>Nama Petugas 2</li>
                            <li>Nama Petugas 3</li>
                        </ul>
                        <p class="mt-2"><span class="font-bold">Pengawas:</span></p>
                        <ul class="list-none mr-14">
                            <li>Nama Pengawas 1</li>
                            <li>Nama Pengawas 2</li>
                            <li>Nama Pengawas 3</li>
                        </ul>
                        <p class="mt-2"><span class="font-bold">Perkap:</span></p>
                        <ul class="list-none mr-14">
                            <li>Nama Perkap 1</li>
                            <li>Nama Perkap 2</li>
                            <li>Nama Perkap 3</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        const today = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('currentDate').innerText = today.toLocaleDateString(undefined, options);

        // Modal open function
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Modal close function
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>