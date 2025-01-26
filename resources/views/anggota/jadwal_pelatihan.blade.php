@extends('base/anggota_navbar')

@section('content')
    <div class="container-fluid m-12 mt-24">
        <!-- Header Section -->
        <div class="grid grid-cols-12">
            <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
                <h1 class="font-bold text-4xl text-center">JADWAL PELATIHAN</h1>
                <div class="block lg:hidden text-center mt-4">
                    <h2 class="font-bold text-lg ">Hi, </h2>
                    <p class="font-normal text-sm" id="currentDatePhone"></p>
                </div>
            </div>
            <div class="col-start-11 col-span-2 text-right mr-16 mt-8 hidden lg:block">
                <h2 class="font-bold text-xl ">Hi, {{ $user->name }}</h2>
                <p class="font-normal text-sm" id="currentDate"></p>
            </div>
        </div>

        {{-- Search --}}
        <!-- Responsive Search Bar -->
        <div
            class="flex flex-col w-full place-items-center col-span-12 sm:col-span-12 md:col-start-11 md:col-span-2 text-right mr-16 mt-8 sm:mt-4">
            <div class="flex w-full justify-between sm:w-[250px] md:w-[250px] lg:w-[250px] mt-4">
                <div class="flex flex-row items-center text-gray-500">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <form id="searchForm" onsubmit="return false;">
                        <div class="flex items-center border-b border-grey-500 py-1">
                            <input id="searchQuery"
                                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                                type="text" placeholder="Search..." aria-label="Search"
                                oninput="searchTraining(this.value)">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Jadwal Misa Section -->
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-items-center gap-16 m-12 mt-10">
        @php
            use App\Models\Training;
            use Carbon\Carbon;
            use App\Models\TrainingDetail;
            use App\Models\GroupDetail;

            $user_group = GroupDetail::where('account_id', $user->id)->get()->first();
            $trainings = Training::whereHas('trainingDetails', function ($query) use ($user_group) {
                $query->where('group_id', $user_group->group_id);
            })
                ->get()
                ->sortBy('training_date');
            Carbon::setLocale('id');
        @endphp
        @foreach ($trainings as $training)
            <!-- Card 1 -->
            <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px]">
                <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal{{ $training->id }}')">
                    <a class="mr-1"><button>detail</button></a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-3 mt-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </div>
                <div class="flex justify-between items-center">
                    <p class="font-bold" style="font-size: 18px">
                        {{ Carbon::parse($training->training_date)->translatedFormat('l, d-M-Y') }}
                    </p>
                </div>
                <div class="mt-2">
                    <div class="flex mb-2">
                        <div class="flex flex-col">
                            <p class="mt-0">{{ Carbon::parse($training->training_date)->translatedFormat('H:i') }} WIB
                                ({{ $training->place }})
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="font-bold">Contact Person:</p>
                        <p>Nama: {{ $training->contact_person }}</p>
                        <p>No HP: <a style="color: blue; text-decoration: underline; cursor: pointer;"
                                href="https://wa.me/62{{ $training->phone_number }}">{{ $training->phone_number }}</a></p>
                    </div>
                </div>
            </div>

            <!-- Modal 1 -->
            <div id="modal{{ $training->id }}"
                class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center"
                onclick="closeModal('modal1')">
                <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12"
                    onclick="event.stopPropagation()">
                    <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal{{ $training->id }}')">
                        &#10005;
                    </button>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Left column: Event details for Card 1 -->
                        <div class="text-left">
                            <div class="flex items-center">
                                <h2 class="text-2xl font-bold ml-2">
                                    {{ Carbon::parse($training->training_date)->translatedFormat('l, d-M-Y') }}</h2>
                            </div>
                            <div class="ms-2">
                                <p class="mt-2 text-lg">
                                    {{ Carbon::parse($training->training_date)->translatedFormat('H:i') }} WIB
                                    ({{ $training->place }})</p>
                                <div class="mt-4">
                                    <p class="font-bold">Contact Person:</p>
                                    <p>Nama: {{ $training->contact_person }}</p>
                                    <p>No HP: <a style="color: blue; text-decoration: underline; cursor: pointer;"
                                            href="https://wa.me/62{{ $training->phone_number }}">{{ $training->phone_number }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="text-left">
                            @php
                                $training_details = TrainingDetail::where('training_id', $training->id)->get();
                            @endphp
                            <p class="text-xl font-bold">Kelompok yang mengikuti:</p>
                            <ul>
                                @foreach ($training_details as $training_detail)
                                    <li>{{ $training_detail->groups->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
    </div>
@endsection

@section('libraryjs')
    <script>
        const today = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('currentDate').innerText = today.toLocaleDateString(undefined, options);
        document.getElementById('currentDatePhone').innerText = today.toLocaleDateString(undefined, options);

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function searchTraining(query) {
            fetch(`/search-training?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const container = document.querySelector('.grid-cols-1'); // Update with your grid container class
                    container.innerHTML = ''; // Clear existing results

                    if (data.length > 0) {
                        data.forEach(training => {
                            const trainingId = training.id;
                            const trainingDate = new Date(training.training_date);
                            const formattedDate = trainingDate.toLocaleDateString('id-ID', {
                                weekday: 'long',
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            });
                            const formattedTime = trainingDate.toLocaleTimeString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            // Safely generate the list for training_details
                            const detailsList = Array.isArray(training.training_details) ?
                                training.training_details.map(detail => `<li>${detail.account.name}</li>`).join(
                                    '') :
                                '<li>No members available</li>';

                            const card = `
            <!-- Card -->
            <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px] h-[250px] mx-auto">
                <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal${trainingId}')">
                    <a class="mr-1"><button>detail</button></a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </div>
                <div class="flex justify-between items-center">
                    <p class="font-bold" style="font-size: 18px">${formattedDate}</p>
                </div>
                <div class="mt-2">
                    <div class="flex mb-2">
                        <div class="flex flex-col">
                            <p class="mt-0">${formattedTime} WIB</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="font-bold">Contact Person:</p>
                        <p>Nama: ${training.contact_person}</p>
                        <p>No HP: <a style="color: blue; text-decoration: underline; cursor: pointer;" href="https://wa.me/62${training.phone_number}">${training.phone_number}</a></p>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="modal${trainingId}" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal${trainingId}')">
                <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
                    <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal${trainingId}')">&#10005;</button>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Left column: Event details -->
                        <div class="text-left">
                            <div class="flex items-center">
                                <h2 class="text-2xl font-bold ml-2">${formattedDate}</h2>
                            </div>
                            <div class="ms-2">
                                <p class="mt-2 text-lg">${formattedTime} WIB</p>
                                <div class="mt-4">
                                    <p class="font-bold">Contact Person:</p>
                                    <p>Nama: ${training.contact_person}</p>
                                    <p>No HP: ${training.phone_number}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-left">
                            <p class="text-xl font-bold">Yang bertugas saat ini:</p>
                            <ul>${detailsList}</ul>
                        </div>
                    </div>
                </div>
            </div>`;

                            container.innerHTML += card;
                        });
                    } else {
                        container.innerHTML = '<p class="text-center">No training found.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
