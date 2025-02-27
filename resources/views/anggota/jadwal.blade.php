@extends('base/anggota_navbar')

@section('content')
    @php
        $data = Auth::guard('account')->user();
    @endphp
    <div class="container-fluid m-12 mt-24">
        <!-- Header Section -->
        <div class="grid grid-cols-12">
            <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
                <h1 class="font-bold text-4xl text-center">JADWAL</h1>
                <div class="block lg:hidden text-center mt-4">
                    <h2 class="font-bold text-lg ">Hi, {{ $data->name }}</h2>
                    <p class="font-normal text-sm" id="currentDatePhone"></p>
                </div>
            </div>
            <div class="col-start-11 col-span-2 text-right mr-16 mt-8 hidden lg:block">
                <h2 class="font-bold text-xl ">Hi, {{ $data->name }}</h2>
                <p class="font-normal text-sm" id="currentDate"></p>
            </div>
        </div>

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
                    <form class="sm:w-[250px] md:w-[250px] lg:w-[250px] ml-2" id="searchForm">
                        <div class="flex items-center border-b border-grey-500 py-1">
                            <input id="searchQuery"
                                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                                type="text" placeholder="Search..." aria-label="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Jadwal Misa Section -->
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-items-center gap-16 m-12 mt-10">
        @foreach ($misas as $misa)
            <!-- Card 1 -->
            <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px]">
                <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal{{ $misa->id }}')">
                    <a class="mr-1"><button>detail</button></a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-3 mt-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </div>
                <div class="flex justify-between items-center">
                    <p class="font-bold" style="font-size: 18px">
                        {{ \Carbon\Carbon::parse($misa->activity_datetime)->translatedFormat('l') }},
                        {{ \Carbon\Carbon::parse($misa->activity_datetime)->format('d-M-Y') }}
                    </p>
                </div>
                <div class="mt-2">
                    <div class="flex mb-2">
                        <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
                        <div class="flex flex-col ml-2">
                            <span>{{ $misa->title }}</span>
                            <p class="mt-0">{{ \Carbon\Carbon::parse($misa->activity_datetime)->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="modal{{ $misa->id }}"
                class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center"
                onclick="closeModal('modal{{ $misa->id }}')">
                <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12"
                    onclick="event.stopPropagation()">
                    <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal{{ $misa->id }}')">
                        &#10005;
                    </button>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Left column: Event details -->
                        <div class="text-left">
                            <div class="flex items-center justify-items">
                                <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
                                <h2 class="text-2xl font-bold ml-2">{{ $misa->title }}</h2>
                            </div>
                            <div class="ms-9">
                                <p class="mt-2 text-lg">
                                    {{ \Carbon\Carbon::parse($misa->activity_datetime)->format('d-M-Y') }}</p>
                                <p class="font-bold">{{ \Carbon\Carbon::parse($misa->activity_datetime)->format('H:i') }}
                                    WIB</p>
                            </div>
                        </div>

                        <!-- Right column: Task details -->
                        <div class="text-left">
                            <p class="text-xl font-bold">Yang bertugas saat ini:</p>

                            @php
                                $user = null;
                                if (Auth::guard('admin')->check()) {
                                    $user = Auth::guard('admin')->user();
                                } elseif (Auth::guard('account')->check()) {
                                    $user = Auth::guard('account')->user();
                                }

                                $loggedInUserId = $user->id;
                                $roles = [];

                                foreach ($misa->misaDetails as $detail) {
                                    if (!in_array($detail->roles, $roles)) {
                                        $roles[] = $detail->roles;
                                    }
                                }
                            @endphp

                            @foreach ($roles as $role)
                                <p class="mt-2"><span class="font-bold">{{ $role }}:</span></p>
                                <ul>
                                    @php $found = false; @endphp
                                    @foreach ($misa->misaDetails as $detail)
                                        @if ($detail->roles === $role)
                                            <li>{{ $detail->account->name }}</li>
                                            @php $found = true; @endphp
                                        @endif
                                    @endforeach

                                    @if (!$found)
                                        <li>Tidak ada personel untuk {{ $role }}</li>
                                    @endif
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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


        document.getElementById('searchQuery').addEventListener('input', function() {
            const query = this.value;

            // Perform an AJAX request
            fetch(`{{ route('misas.search') }}?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then((response) => response.json())
                .then((data) => {
                    const container = document.querySelector('.grid.grid-cols-1');
                    container.innerHTML = ''; // Clear existing results

                    // Populate new results
                    data.forEach((misa) => {
                        const misaCard = `
        <!-- Card -->
        <div class="bg-[#f6f1e3] p-6 shadow-lg border border-[#002366] rounded-xl w-[300px] h-[200px] mx-auto">
          <div class="flex justify-end text-sm text-gray-500" onclick="openModal('modal${misa.id}')">
            <a class="mr-1"><button>detail</button></a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-1">
              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>
          </div>
          <div class="flex justify-between items-center">
            <p class="font-bold" style="font-size: 18px">
              ${new Date(misa.activity_datetime).toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'short',
                day: 'numeric',
              })}
            </p>
          </div>
          <div class="mt-2">
            <div class="flex mb-2">
              <span class="bg-orange-500 mt-1 h-4 w-4 rounded-full inline-block"></span>
              <div class="flex flex-col ml-2">
                <span>${misa.title}</span>
                <p class="mt-0">${new Date(misa.activity_datetime).toLocaleTimeString('en-US', {
                  hour: '2-digit',
                  minute: '2-digit',
                })} WIB</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div id="modal${misa.id}" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal${misa.id}')">
          <div class="bg-[#f6f1e3] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
            <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal${misa.id}')">&#10005;</button>
            <div class="grid grid-cols-2 gap-4">
              <!-- Left column: Event details -->
              <div class="text-left">
                <div class="flex items-center">
                  <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
                  <h2 class="text-2xl font-bold ml-2">${misa.title}</h2>
                </div>
                <div class="ms-9">
                  <!-- Custom date format: dd-MMM-yyyy with dashes -->
                  <p class="mt-2 text-lg">${formatDate(new Date(misa.activity_datetime))}</p>
                  <p class="font-bold">${new Date(misa.activity_datetime).toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                  })} WIB</p>
                </div>
              </div>

              <!-- Right column: Task details -->
              <div class="text-left">
                <p class="text-xl font-bold">Yang bertugas saat ini:</p>
                ${
                  misa.misaDetails?.length > 0
                  ? misa.misaDetails.map(
                    (detail) => `
                                  <p class="mt-2"><span class="font-bold">${detail.roles}:</span></p>
                                  <ul>
                                    <li>${detail.account?.name || 'Tidak ada personel'}</li>
                                  </ul>
                                `
                  ).join('')
                  : '<p class="mt-2">Tidak ada personel yang bertugas</p>'
                }
              </div>
            </div>
          </div>
        </div>
      `;
                        container.innerHTML += misaCard;
                    });
                })
                .catch((error) => console.error('Error fetching data:', error));
        });

        // Modal control functions
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Custom function to format the date as dd-MMM-yyyy with dashes (e.g., 02-dec-2024)
        function formatDate(date) {
            const day = date.getDate().toString().padStart(2, '0'); // Ensure two digits for day
            const month = date.toLocaleString('en-US', {
                month: 'short'
            }).toLowerCase(); // Get short month in lowercase
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }
    </script>
@endsection
