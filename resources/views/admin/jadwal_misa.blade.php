@extends('base/admin_navbar')

@section('content')
@php
use Carbon\Carbon;
$accounts = App\Models\Account::all();
@endphp

<header class="mt-16 p-8">
    <h1 class="text-2xl font-semibold text-[#20252f]">JADWAL MISA</h1>
    <div class="flex space-x-4 mt-4 justify-center w-full lg:w-3/4 lg:ml-8">
        <!-- Status Filter Buttons -->
        <button class="w-1/4 flex-shrink-0 px-3 py-1 rounded-lg bg-[#740001] text-white status-filter-button text-sm sm:px-4 sm:py-2 lg:px-6 lg:py-3 active" data-status="all">Semua</button>
        <button class="w-1/4 flex-shrink-0 px-3 py-1 rounded-lg bg-[#f6f1e3] text-[#20252f] status-filter-button text-sm sm:px-4 sm:py-2 lg:px-6 lg:py-3" data-status="Proses">Proses</button>
        <button class="w-1/4 flex-shrink-0 px-3 py-1 rounded-lg bg-[#f6f1e3] text-[#20252f] status-filter-button text-sm sm:px-4 sm:py-2 lg:px-6 lg:py-3" data-status="Tertunda">Tertunda</button>
        <button class="w-1/4 flex-shrink-0 px-3 py-1 rounded-lg bg-[#f6f1e3] text-[#20252f] status-filter-button text-sm sm:px-4 sm:py-2 lg:px-6 lg:py-3" data-status="Berhasil">Berhasil</button>
    </div>
    
</header>

@foreach ($misas as $misa)
<div class="bg-[#f6f1e3] rounded-lg shadow-lg p-6 mx-16 mb-8 misa-card" data-status="{{ $misa->status }}">
    <div class="flex flex-col lg:flex-row justify-between">
        <!-- Schedule Card -->
        <div class="flex-1">
            <div class="flex items-start space-x-4">
                <div class="text-2xl">
                    <span class="bg-orange-500 h-5 w-5 rounded-full inline-block"></span>
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">
                        {{ Carbon::parse($misa->activity_datetime)->translatedFormat('j, F Y') }}
                    </h2>
                    <p class="text-gray-600">{{$misa->title}}</p>
                    <p class="text-gray-600">{{ Carbon::parse($misa->activity_datetime)->translatedFormat('H:i') }} WIB</p>
                    <p class="mt-2 flex items-center">
                        Status:
                        <span class="text-black ml-2 flex items-center">
                            @if ($misa->status == 'Proses')
                                <span class="text-gray-500 mr-1">{{$misa->status}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#20252f">
                                    <path d="m614-310 51-51-149-149v-210h-72v240l170 170ZM480-96q-79.38 0-149.19-30T208.5-208.5Q156-261 126-330.96t-30-149.5Q96-560 126-630q30-70 82.5-122t122.46-82q69.96-30 149.5-30t149.55 30.24q70 30.24 121.79 82.08 51.78 51.84 81.99 121.92Q864-559.68 864-480q0 79.38-30 149.19T752-208.5Q700-156 629.87-126T480-96Zm0-384Zm.48 312q129.47 0 220.5-91.5Q792-351 792-480.48q0-129.47-91.02-220.5Q609.95-792 480.48-792 351-792 259.5-700.98 168-609.95 168-480.48 168-351 259.5-259.5T480.48-168Z"/>
                                </svg>
                            @elseif ($misa->status == 'Tertunda')
                                <span class="text-yellow-500 mr-1">{{$misa->status}}</span> ✖
                            @elseif ($misa->status == 'Berhasil')
                                <span class="text-blue-500 mr-1">{{$misa->status}}</span> ✔
                            @else
                                <span class="text-gray-500 mr-1">{{$misa->status}}</span> ✖
                            @endif
                        </span>
                    </p>

                    <p class="text-gray-500 text-sm">
                        Berakhir pada: {{ Carbon::parse($misa->deadline_datetime)->translatedFormat('l, j-m-Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Task Assignment Section -->
        <div class="w-full lg:w-1/2 bg-white p-4 rounded-lg mt-4 lg:mt-0">
            <h3 class="text-[#20252f] font-semibold border-b pb-2">PETUGAS - PETUGAS</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                @php
                $roles = $misa->misaDetails->pluck('roles')->unique();
                @endphp

                @foreach ($roles as $role)
                <div>
                    <h4 class="text-[#20252f] font-semibold">{{ $role }}</h4>
                    <ul class="text-gray-600">
                        @foreach ($misa->misaDetails->where('roles', $role) as $detail)
                        <li class="flex items-center">
                            <span class="mr-2 w-6">
                                @if ($detail->confirmation == 1) ✔
                                @elseif ($detail->confirmation == 0) ✖
                                @endif
                            </span>
                            {{ $detail->account->name }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex justify-end space-x-4 mt-4">
        <button onclick="openEditModal('{{ $misa->id }}')" class="px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg">Edit</button>
        <form action="{{ route('misas.destroy', ['misa' => $misa]) }}" method="post">
            @csrf
            @method('delete')
            <button class="px-4 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg">Delete</button>
        </form>
    </div>
</div>
@endforeach

<script>
    const headerButtons = document.querySelectorAll(".header-button");

    headerButtons.forEach(button => {
        button.addEventListener("click", () => {
            headerButtons.forEach(btn => {
                btn.classList.remove("bg-[#740001]", "text-white");
                btn.classList.add("bg-[#f6f1e3]");
            });

            button.classList.add("bg-[#740001]", "text-white");
            button.classList.remove("bg-[#f6f1e3]");
        });
    });

    function openEditModal(misaId) {
        document.getElementById("anggotaSection-" + misaId).classList.remove("hidden");
    }

    function closeAnggotaSection(misaId) {
        document.getElementById("anggotaSection-" + misaId).classList.add("hidden");
    }

    document.querySelectorAll(".status-filter-button").forEach(button => {
        button.addEventListener("click", function() {
            const selectedStatus = this.getAttribute("data-status");
            const misaCards = document.querySelectorAll(".misa-card");

            document.querySelectorAll(".status-filter-button").forEach(btn => {
                btn.classList.remove("bg-[#740001]", "text-white");
                btn.classList.add("bg-[#f6f1e3]");
            });

            this.classList.add("bg-[#740001]", "text-white");
            this.classList.remove("bg-[#f6f1e3]");

            misaCards.forEach(card => {
                const cardStatus = card.getAttribute("data-status");

                if (selectedStatus === "all" || cardStatus === selectedStatus) {
                    card.classList.remove("hidden");
                } else {
                    card.classList.add("hidden");
                }
            });
        });
    });
</script>

@endsection
