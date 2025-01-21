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
    <h1 class="ms-3 mt-9 mb-3 text-2xl">Informasi Anggota Panitia Acara</h1>

    <!-- Static Table Version -->
    <table class="w-full text-md text-left rtl:text-right">
        <thead class="text-md uppercase bg-[#f6f1e3]">
            <tr>
                <th scope="col" class="rounded-tl-lg px-6 py-3 text-center border-b border-gray-500">Nama Anggota</th>
                <th scope="col" class="px-6 py-3 text-center border-b border-gray-500">Wilayah</th>
                <th scope="col" class="rounded-tr-lg px-6 py-3 text-center border-b border-gray-500">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-[#f6f1e3] border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">Angel</th>
                <td class="px-6 py-4 text-center">carolus</td>
                <td class="px-6 py-4 text-center">
                    <button type="button" class="text-white bg-[#002366] hover:bg-[#20252f] font-medium rounded-lg text-sm px-12 py-2.5 text-center me-2 mb-2">Edit</button>
                    <button type="button" class="text-white bg-[#ae0001] hover:bg-[#740001] font-medium rounded-lg text-sm px-12 py-2.5 text-center me-2 mb-2">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


    <div class="relative py-6 ps-6 overflow-x-auto sm:rounded-lg">
        <h1 class="ms-3 mt-9 mb-3 text-2xl">Informasi Rapat & Kegiatan untuk Acara</h1>
        @if (!($meets->all() == null))
        <table class="w-full text-md text-left rtl:text-right">
            <thead class="text-md uppercase bg-[#f6f1e3]">
                <tr>
                    <th scope="col" class="rounded-tl-lg px-6 py-3 text-center border-b border-gray-500 dark:border-gray-600">
                        Kegiatan
                    </th>
                    <th scope="col" class="px-6 py-3 text-center border-b border-gray-500 dark:border-gray-600">
                        Tanggal Dilaksanakan
                    </th>
                    <th scope="col" class="rounded-tr-lg px-6 py-3 text-center border-b border-gray-500 dark:border-gray-600">
                        Notulen/Catatan
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meets as $meet)
                <tr class="bg-[#f6f1e3] border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
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
</script>
@endsection