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

    Carbon::setLocale('id');
    @endphp
    <h1 class="text-3xl">Daftar Acara</h1>
    @foreach ($events as $event)
    @php
    $event_id = $event->id;
    $chief = Account::whereHas('eventDetails', function ($query) use ($event_id) {
    $query->where('event_id', $event_id)->where('roles', 'Ketua');
    })->firstOrFail();
    @endphp
    <div class="mt-6 rounded-xl py-6 pe-6 ps-12 ms-5 flex bg-[#C4CDC1]">
        <img src="{{asset('images/contoh_poster.jpg')}}" class="w-64" alt="">
        <div class="flex justify-between w-full">
            <div class="flex flex-col ms-10">
                <p class="font-semibold text-xl">
                    {{ Carbon::parse($event->date)->translatedFormat('j F Y') }}
                </p>
                <p>{{ Carbon::parse($event->start_time)->translatedFormat('H.i') }} WIB - {{ Carbon::parse($event->finished_time)->translatedFormat('H.i') }} WIB</p>
                <h1 class="text-3xl mt-16">{{$event->title}}</h1>
                <p class="mt-20">Ketua Acara : {{$chief->name}}</p>
                <p>Contact Person : {{$event->contact_person}}</p>
            </div>
            <div class="flex items-end">
                <!-- Edit button -->
                <a href="{{route('events.edit', ['event' => $event])}}"><button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</button></a>
                <!-- Delete button -->
                <a href=""><button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button></a>
            </div>
        </div>
    </div>
    @endforeach
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