@extends('base/admin_navbar')

<style>
    #search {
        outline: none;
        box-shadow: none;
    }
</style>

@section('content')
<div class="container-fluid content-body mx-12">
    @php
        use Carbon\Carbon;
        use App\Models\Account;

        Carbon::setLocale('id');
    @endphp
    <div class="flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-3xl mb-4 sm:mb-0">Daftar Acara</h1>
        <div class="w-full sm:max-w-md bg-white flex px-4 py-2 border-b border-[#333] focus-within:border-b-blue-500 overflow-hidden font-[sans-serif]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="18px" class="fill-gray-600 mr-3">
                <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>
            </svg>
            <input type="text" id="search" placeholder="Search Something..." class="border-none bg-transparent focus:outline-none w-full">
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div id="ajaxResult">
        @foreach ($events as $event)
            @php
                $event_id = $event->id;
                $chief = Account::whereHas('eventDetails', function ($query) use ($event_id) {
                    $query->where('event_id', $event_id)->where('roles', 'Ketua');
                })->firstOrFail();
            @endphp
            <div class="my-6 rounded-xl p-6 flex flex-col sm:flex-row bg-[#f6f1e3] relative">
                <img src="{{ asset('images/contoh_poster.jpg') }}" class="w-full sm:w-64 h-auto mb-4 sm:mb-0" alt="">
                <div class="flex flex-col sm:ms-10 flex-grow">
                    <p class="font-semibold text-xl">
                        {{ Carbon::parse($event->date)->translatedFormat('j F Y') }}
                    </p>
                    <p>{{ Carbon::parse($event->start_time)->translatedFormat('H.i') }} WIB - {{ Carbon::parse($event->finished_time)->translatedFormat('H.i') }} WIB</p>
                    <h1 class="text-3xl mt-4">{{ $event->title }}</h1>
                    <p class="mt-6">Ketua Acara: {{ $chief->name }}</p>
                    <p>Contact Person: {{ $event->contact_person }} ({{ $event->phone_number }})</p>
                    <p>Tempat Acara: {{ $event->place }}</p>

                    <div class="flex flex-col sm:flex-row sm:absolute sm:bottom-4 sm:right-4 gap-2 mt-4">
                        <a href="{{ route('events.edit', ['event' => $event]) }}">
                            <button type="button" class="text-white bg-[#002366] hover:bg-[#20252f] font-medium rounded-full text-sm px-5 py-2.5">Edit</button>
                        </a>
                        <form action="{{ route('events.destroy', ['event' => $event]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-white bg-[#ae0001] hover:bg-[#740001] font-medium rounded-full text-sm px-5 py-2.5">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('libraryjs')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var ElementHeight = $("nav").height();
        var ElementPadding = parseInt($("nav").css('padding').replace("px", ""));
        var numberMargin = ((ElementHeight + (ElementPadding * 2)) / 16) + 2;
        var MarginTop = String(numberMargin) + "rem";
        $(".content-body").css("margin-top", MarginTop);
    });

    $("#search").on("keyup", function(event) {
        var detail = $('#search').val();
        var url = detail === "" ? '{{ url('') }}/events/searchs/all' : '{{ url('') }}/events/search/' + detail;

        $.ajax({
            url: url,
            success: function(result) {
                var eventsCardHtml = "";
                if (result.data.length > 0) {
                    result.data.forEach(function(event) {
                        eventsCardHtml += `
                        <div class="my-6 rounded-xl p-6 flex flex-col sm:flex-row bg-[#f6f1e3]">
                            <img src="{{ asset('images/contoh_poster.jpg') }}" class="w-full sm:w-64 h-auto mb-4 sm:mb-0" alt="">
                            <div class="flex flex-col sm:ms-10 flex-grow">
                                <p class="font-semibold text-xl">
                                    ${new Date(event.date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                                </p>
                                <p>${new Date(`1970-01-01T${event.start_time}`).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }).replace(":", ".")} WIB - 
                                   ${new Date(`1970-01-01T${event.finished_time}`).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }).replace(":", ".")} WIB</p>
                                <h1 class="text-3xl mt-4">${event.title}</h1>
                                <p class="mt-6">Ketua Acara: ${event.chief.name}</p>
                                <p>Contact Person: ${event.contact_person} (${event.phone_number})</p>
                                <p>Tempat Acara: ${event.place}</p>

                                <div class="flex flex-wrap gap-2 mt-4 sm:mt-auto sm:absolute sm:bottom-4 sm:right-4">
                                    <a href="/events/${event.id}/edit">
                                        <button type="button" class="text-white bg-[#002366] hover:bg-[#20252f] font-medium rounded-full text-sm px-5 py-2.5">Edit</button>
                                    </a>
                                    <form action="/events/search/delete/${event.id}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="text-white bg-[#ae0001] hover:bg-[#740001] font-medium rounded-full text-sm px-5 py-2.5">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>`;
                    });
                }
                $("#ajaxResult").html(eventsCardHtml);
            }
        });
    });
</script>
@endsection
