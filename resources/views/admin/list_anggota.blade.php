@extends('base/admin_navbar')

@section('content')

<!-- Colors: 
        1. #740001 - merah gelap 
        2. #ae0001 - merah terang 
        3. #f6f1e3 - netral 
        4. #002366 - biru terang 
        5. #20252f - biru gelap 
    -->
    
    <div class="container mx-auto py-8 mt-8 mb-8 justify-items-center">
        <div class="grid grid-cols-12">
            <div class="col-start-4 col-span-6 mt-8 mb-8">
                <h2 class="font-bold text-3xl text-center">Anggota Misdinar</h2>
            </div>
        </div>

        {{-- Search --}}
        <div class="right-0 top-0">
            <div class="flex flex-row justify-items mt-5text-gray-500">
                <div class="mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg> 
                </div>
                    
                <form class="sm:w-[500px] md:w-[650px] lg:w-[900px]">
                    <div class="flex items-center border-b border-grey-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="search" aria-label="Full name">
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-md sm:w-[600px] md:w-[750px] lg:w-[1000px] mt-10">
            <table class="min-w-full text-sm text-left rtl:text-right text-black" style="table-layout: auto;">
                <thead class="text-md text-black uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Birthdate
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Region
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white even:bg-[#f6f1e3] border-b hover:bg-gray-50 hover:even:bg-[#e9e5d8]">
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4">
                            Silverasdashdbd
                        </td>
                        <td class="px-6 py-4">
                            Laptopfasfsafsaf ajsfjasfsf ajsfjasfhasfuhaf
                        </td>
                        <td class="px-6 py-4">
                            $2999
                        </td>
                        <td class="px-6 py-4">
                            A
                        </td>
                        <td class="px-6 py-4" id="statusCell">
                            Active
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-2">
                                <button class="bg-[#002366] text-white py-1 px-2 rounded-md hover:bg-[#20252f] transition-all duration-300 text-sm mt-2" onclick="openModal('modal1')">Edit</button>
                                <button class="bg-[#ae0001] text-white py-1 px-2 rounded-md hover:bg-[#740001] transition-all duration-300 text-sm mt-2">Delete</button>
                            </div>
                        </td>
                    </tr>
                    {{-- Modal 1 --}}
                    <div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal1')">
                        <div class="bg-[#f6f1e3] p-8 rounded-lg w-[500px] h-[400px] relative p-12" onclick="event.stopPropagation()">
                            <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal1')">
                                &#10005;
                            </button>
                            <div class="text-left px-10 py-5">
                                <div class="flex flex-col">
                                    <p class="font-bold text-xl">Nama: </p>
                                    <p class="font-semibold">Apple MacBook Pro 17"</p>
                                </div>
                                <div class="flex flex-col mt-5">
                                    <p class="font-bold text-xl">Email: </p>
                                    <p class="font-semibold">Silverasdashdbd</p>
                                </div>
                                <div class="flex flex-col mt-5">
                                    <p class="font-bold text-xl">Region: </p>
                                    <p class="font-semibold">A</p>
                                </div>
                                <div class="flex flex-col mt-5">
                                    <p class="font-bold text-xl">Status: </p>
                                    <div class="flex flex-row m">
                                        <p id="statusLabel">Inactive</p>
                                        <label class="inline-flex items-center cursor-pointer ms-5">
                                        <input type="checkbox" value="" class="sr-only peer" id="statusToggle" onchange="updateStatus()" checked>
                                        <div class="relative w-14 h-7 bg-[#740001] peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#002366] dark:peer-focus:ring-[#002366] rounded-full peer dark:bg-[#740001] peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-[#002366] duration-700"></div>
                                      </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr class="odd:bg-white even:bg-[#f6f1e3] border-b hover:bg-gray-50 hover:even:bg-[#e9e5d8]">
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                            Microsoft Surface Pro
                        </th>
                        <td class="px-6 py-4">
                            White
                        </td>
                        <td class="px-6 py-4">
                            Laptop PC
                        </td>
                        <td class="px-6 py-4">
                            $1999
                        </td>
                        <td class="px-6 py-4">
                            A
                        </td>
                        <td class="px-6 py-4">
                            Active
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-2">
                                <button class="bg-[#002366] text-white py-1 px-2 rounded-md hover:bg-[#20252f] transition-all duration-300 text-sm mt-2 " onclick="openModal('modal1')">Edit</button>
                                <button class="bg-[#ae0001] text-white py-1 px-2 rounded-md hover:bg-[#740001] transition-all duration-300 text-sm mt-2">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal 2 -->
                    <div id="modal1" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" onclick="closeModal('modal1')">
                        <div class="bg-[#D1D9D1] p-8 rounded-lg w-[700px] h-[400px] relative p-12" onclick="event.stopPropagation()">
                            <button class="absolute top-4 right-4 text-black" onclick="closeModal('modal1')">
                                &#10005;
                            </button>
                            <!-- Content inside the modal with two columns -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Left column: Event details -->
                                <div class="text-left ">
                                    <div class="flex items-center justify-items">
                                        <span class="bg-orange-500 h-7 w-7 rounded-full inline-block"></span>
                                        <h2 class="text-2xl font-bold ml-2">Misa Natal</h2>
                                    </div>
                                    <div class="ms-9">
                                    <p class="mt-2 text-lg">25 Desember 2024</p>
                                    <p class="font-bold">06.00 WIB</p>
                                    </div>
                                    {{-- Evaluasi --}}
                                    <div class="mt-6 ms-9">
                                    <div class="flex flex-col">
                                        <p class="font-bold">Evaluasi: </p>
                                        <p class="mt-0 text-sm text-justify pe-2">Nam eget molestie massa. Nunc non vestibulum ante. Morbi sem tortor, aliquam a tincidunt sit amet, pretium varius orci. Sed eu nibh sit amet arcu dignissim posuere. </p>
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

                    <tr class="odd:bg-white even:bg-[#f6f1e3] border-b hover:bg-gray-50 hover:even:bg-[#e9e5d8]">
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                            Magic Mouse
                        </th>
                        <td class="px-6 py-4">
                            Silverasdashdbd
                        </td>
                        <td class="px-6 py-4">
                            Laptopfasfsafsaf ajsfjasfsf ajsfjasfhasfuhaf
                        </td>
                        <td class="px-6 py-4">
                            $2999
                        </td>
                        <td class="px-6 py-4">
                            A
                        </td>
                        <td class="px-6 py-4">
                            Active
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-2">
                                <button class="bg-[#002366] text-white py-1 px-2 rounded-md hover:bg-[#20252f] transition-all duration-300 text-sm mt-2">Edit</button>
                                <button class="bg-[#ae0001] text-white py-1 px-2 rounded-md hover:bg-[#740001] transition-all duration-300 text-sm mt-2">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="odd:bg-white even:bg-[#f6f1e3] border-b hover:bg-gray-50 hover:even:bg-[#e9e5d8]">
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4">
                            Silverasdashdbd
                        </td>
                        <td class="px-6 py-4">
                            Laptopfasfsafsaf ajsfjasfsf ajsfjasfhasfuhaf
                        </td>
                        <td class="px-6 py-4">
                            $2999
                        </td>
                        <td class="px-6 py-4">
                            A
                        </td>
                        <td class="px-6 py-4">
                            Active
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-2">
                                <button class="bg-[#002366] text-white py-1 px-2 rounded-md hover:bg-[#20252f] transition-all duration-300 text-sm mt-2">Edit</button>
                                <button class="bg-[#ae0001] text-white py-1 px-2 rounded-md hover:bg-[#740001] transition-all duration-300 text-sm mt-2">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="odd:bg-white even:bg-[#f6f1e3] border-b hover:bg-gray-50 hover:even:bg-[#e9e5d8]">
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                            Microsoft Surface Pro
                        </th>
                        <td class="px-6 py-4">
                            White
                        </td>
                        <td class="px-6 py-4">
                            Laptop PC
                        </td>
                        <td class="px-6 py-4">
                            $1999
                        </td>
                        <td class="px-6 py-4">
                            A
                        </td>
                        <td class="px-6 py-4">
                            Active
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-2">
                                <button class="bg-[#002366] text-white py-1 px-2 rounded-md hover:bg-[#20252f] transition-all duration-300 text-sm mt-2">Edit</button>
                                <button class="bg-[#ae0001] text-white py-1 px-2 rounded-md hover:bg-[#740001] transition-all duration-300 text-sm mt-2">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="odd:bg-white even:bg-[#f6f1e3] border-b hover:bg-gray-50 hover:even:bg-[#e9e5d8]">
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                            Magic Mouse
                        </th>
                        <td class="px-6 py-4">
                            Silverasdashdbd
                        </td>
                        <td class="px-6 py-4">
                            Laptopfasfsafsaf ajsfjasfsf ajsfjasfhasfuhaf
                        </td>
                        <td class="px-6 py-4">
                            $2999
                        </td>
                        <td class="px-6 py-4">
                            A
                        </td>
                        <td class="px-6 py-4">
                            Active
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-2">
                                <button class="bg-[#002366] text-white py-1 px-2 rounded-md hover:bg-[#20252f] transition-all duration-300 text-sm mt-2">Edit</button>
                                <button class="bg-[#ae0001] text-white py-1 px-2 rounded-md hover:bg-[#740001] transition-all duration-300 text-sm mt-2">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>









    </div>


<script>
    function updateStatus() {
        const toggle = document.getElementById('statusToggle');
        const statusLabel = document.getElementById('statusLabel');
        const statusCell = document.getElementById('statusCell');
        
        // Periksa apakah toggle diaktifkan atau dinonaktifkan
        if (toggle.checked) {
            statusLabel.textContent = 'Active';
            statusCell.textContent = 'Active';
        } else {
            statusLabel.textContent = 'Inactive';
            statusCell.textContent = 'Inactive';
        }
    }

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