@extends('base/admin_navbar')

<style>
    #search {
        outline: none;
        box-shadow: none;
    }
</style>

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
    <div class="flex justify-between">
        <div>
            <h1 class="text-3xl">Daftar Pelatihan</h1>
        </div>
        <div class="bg-white flex px-4 border-b border-[#333] focus-within:border-b-blue-500 overflow-hidden max-w-md me-3 font-[sans-serif]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="18px" class="fill-gray-600 mr-3">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
            <input type="text" id="search" placeholder="Search Something..." class="border-transparent border-none bg-transparent focus:bg-transparent focus:outline-none bg-none input-no-bg" />
        </div>
    </div>

    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        {{ session('success')}}
    </div>
    @endif

    <div id="ajaxResult">
        @foreach ($trainings as $training)
        <div class="my-6 rounded-xl py-6 pe-6 ms-5 flex bg-[#C4CDC1]">
            <div class="flex justify-between w-full">
                <div class="flex flex-col ms-10">
                    <p class="font-semibold text-xl">
                        {{ Carbon::parse($training->training_date)->translatedFormat('j F Y') }}
                    </p>
                    <p>{{ Carbon::parse($training->training_date)->translatedFormat('H.i') }} WIB</p>
                    <h1 class="text-3xl mt-16">{{$training->event->title}}</h1>
                    <p>Contact Person : {{$training->contact_person}} ({{$training->phone_number}})</p>
                    <p>Tempat Pelatihan : {{$training->place}}</p>
                </div>
                <div class="flex items-end">
                    <!-- Edit button -->
                    <a href="{{route('trainings.edit', ['training' => $training])}}"><button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</button></a>
                    <!-- Delete button -->
                    <div>
                        <form class="mb-0" action="{{route('trainings.destroy', ['training' => $training])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@php
// Fetch all accounts and store them in a variable
$accounts = Account::with('eventDetails')->get();

@endphp

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

    $("#search").on("keyup", function(event) {
        var detail = $('#search').val();
        var url;

        if (detail == "") {
            url = '{{ url('') }}/trainings/searchs/all';
        } else {
            url = '{{ url('') }}/trainings/search/' + detail;
        }

        console.log(url);

        $.ajax({
            url: url,
            success: function(result) {
                console.log(result);
                var trainingCardsHtml = "";
                if (result.data.length > 0) {
                    for (var i = 0; i < result.data.length; i++) {
                        trainingCardsHtml += `
        <div class="mt-6 rounded-xl py-6 pe-6 ms-5 flex bg-[#C4CDC1]">
            <div class="flex justify-between w-full">
                <div class="flex flex-col ms-10">
                <p class="font-semibold text-xl">
                    ${new Date(result.data[i].training_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                </p>
                <p>${new Date(`${result.data[i].training_date}`).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }).replace(":", ".")} WIB
                </p>
                <h1 class="text-3xl mt-16">${result.data[i].event.title}</h1>
                <p>Contact Person : ${result.data[i].contact_person} (${result.data[i].phone_number})</p>
                <p>Tempat Pelatihan : ${result.data[i].place}</p>
            </div>
            <div class="flex items-end">
                <!-- Edit button -->
                <a href="/trainings/${result.data[i].id}/edit">
                    <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</button>
                </a>
                <!-- Delete button -->
                <a href="#">
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                </a>
            </div>
        </div>
    </div>
`;
                    }
                }
                $("#ajaxResult").html(trainingCardsHtml);
            }
        });
    });
</script>
@endsection