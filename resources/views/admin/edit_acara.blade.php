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
    <form class="mt-6 rounded-xl py-6 pe-6 ps-12 ms-5 flex bg-[#C4CDC1]" method="POST" action="{{ route('events.update', ['event' => $event]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <img src="{{asset('images/contoh_poster.jpg')}}" class="w-64" alt="">
        <div class="grid ms-10 gap-4 gap-y-2 grid-cols-2 w-3/4">
            <!-- <div class="flex flex-col ms-10 w-full"> -->
            <div>
                <label for="title">
                    Judul Acara
                </label>
                <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ $event->title}}" />
            </div>

            <div>
                <label for="date" class="mt-2">
                    Tanggal Acara
                </label>
                <input type="date" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ Carbon::parse($event->date)->translatedFormat('Y-m-d') }}" />
            </div>

            <div>
                <label for="start_time" class="mt-2">
                    Waktu Mulai
                </label>
                <input type="time" id="start_time" name="start_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ Carbon::parse($event->start_time)->translatedFormat('H:i') }}" required />
            </div>

            <div>
                <label for="finished_time" class="mt-2">
                    Waktu Selesai
                </label>
                <input type="time" id="finished_time" name="finished_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ Carbon::parse($event->finished_time)->translatedFormat('H:i') }}" required />
            </div>

            <div>
                <label for="event_chief" class="mt-2">
                    Ketua Acara
                </label>
                <select id="chiefs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="event_chief">
                    <option value="{{$chief->id}}" selected>{{$chief->name}}</option>
                    @foreach ($accounts as $account)
                        <option value="{{$account->id}}">{{$account->name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="contact_person" class="mt-2">
                    Contact Person
                </label>
                <input type="text" id="contact_person" name="contact_person" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$event->contact_person}}" required />
            </div>

            <div class="flex col-span-2 items-start justify-center">
                <button type="submit" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-12 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</button>
            </div>
        </div>
    </form>

    @php
    $meets = Meet::where('event_id', $event->id)->get();
    @endphp

    <div class="relative py-6 ps-6 overflow-x-auto sm:rounded-lg">
        <h1 class="ms-3 mt-9 mb-3 text-2xl">INFORMASI RAPAT & KEGIATAN UNTUK ACARA</h1>
        <table class="w-full text-md text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-[#C4CDC1] dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Kegiatan
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Tanggal Dilaksanakan
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Notulen/Catatan
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meets as $meet)
                <tr class="bg-[#f6f1e3] border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        {{$meet->title}}
                    </th>
                    <td class="px-6 py-4 text-center">
                        {{ Carbon::parse($meet->date)->translatedFormat('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{route('meets.show', ['meet' => $meet])}}">
                            <button type="button" class="text-white bg-teal-400 hover:bg-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-12 py-2.5 text-center me-2 mb-2 dark:focus:ring-teal-900">Detail</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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