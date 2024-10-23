@extends('base/anggota_navbar')

@section('content')
<?php

use Carbon\Carbon;

Carbon::setLocale('id');
?>
<div class="container-fluid m-12 me-0 mt-24">
    <!-- Header Section -->
    <div class="grid grid-cols-12">
        <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
            <h1 class="font-bold text-4xl text-center">EVALUASI</h1>
        </div>
        <div class="col-start-11 col-span-2 text-right mr-16 mt-8">
            <h2 class="font-bold text-xl ">Hi, Shasa</h2>
            <p class="font-normal text-sm" id="currentDate"></p>
        </div>
    </div>

    <!-- Jadwal Misa Section -->
    <div
        class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-center gap-x-4 gap-y-16 mx-32 mt-5">
        @foreach ($misa as $m)
        <!-- Card 1 -->
        <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px] mx-auto resize-y">
            <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal{{ $m->id }}')">
                <a class="mr-1">detail</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3 mt-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </div>
            <div class="flex justify-between items-center">
                <p class="font-bold" style="font-size: 18px">
                    {{ Carbon::parse($m->misa->date)->translatedFormat('l, j F Y') }}
                </p>
            </div>
            <div class="mt-2">
                <div class="flex mb-2">
                    <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
                    <div class="flex flex-col ml-2">
                        <span>{{ $m->misa->title }}</span>
                        <p class="mt-0">{{ date('H.i', strtotime($m->misa->activity_datetime)) }} WIB</p>
                    </div>
                </div>
            </div>
            {{-- Evaluasi --}}
            <div class="mt-6">
                <div class="flex flex-col">
                    <p class="font-bold">Evaluasi: </p>
                    <p class="mt-0 text-sm text-justify">{{ $m->misa->evaluation }}</p>
                </div>
            </div>
        </div>
        <!-- Modal 1 -->
        <div id="modal{{ $m->id }}"
            class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center"
            onclick="closeModal('modal{{ $m->id }}')">
            <div class="bg-[#D1D9D1] p-8 rounded-lg w-[700px] h-[400px] relative p-12"
                onclick="event.stopPropagation()">
                <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal{{ $m->id }}')">
                    &#10005;
                </button>
                <!-- Content inside the modal with two columns -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Left column: Event details -->
                    <div class="text-left ">
                        <div class="flex items-center justify-items">
                            <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
                            <h2 class="text-2xl font-bold ml-2">{{ $m->misa->title }}</h2>
                        </div>
                        <div class="ms-9">
                            <p class="mt-2 text-lg">
                                {{ Carbon::parse($m->misa->activity_datetime)->translatedFormat('j F Y') }}
                            </p>
                            <p class="font-bold">{{ date('H.i', strtotime($m->misa->activity_datetime)) }} WIB</p>
                        </div>
                        {{-- Evaluasi --}}
                        <div class="mt-6 ms-9">
                            <div class="flex flex-col">
                                <p class="font-bold">Evaluasi: </p>
                                <p class="mt-0 text-sm text-justify pe-2">{{ $m->misa->evaluation }}</p>
                            </div>
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
        @endforeach
    </div>

    @section('libraryjs')
    <script>
        // Function to display the current date in the "Hi, Shasa" section
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

    @endsection