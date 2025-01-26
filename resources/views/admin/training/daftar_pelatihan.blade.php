@extends('base/admin_navbar')

@section('content')
    <div class="container-fluid content-body mx-12">
        @php
            use Carbon\Carbon;
            use App\Models\Account;

            Carbon::setLocale('id');
        @endphp
        <div class="flex flex-col lg:flex-row justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl mb-4 lg:mb-8">Daftar Pelatihan</h1>
            </div>
            <div class="bg-white flex px-4 border-b border-[#333] focus-within:border-b-blue-500 overflow-hidden max-w-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="18px" class="fill-gray-600 mr-3">
                    <path
                        d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                    </path>
                </svg>
                <input type="text" id="search" placeholder="Search Something..."
                    class="border-transparent border-none bg-transparent focus:bg-transparent focus:outline-none bg-none input-no-bg" />
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div id="ajaxResult">
            @foreach ($trainings as $training)
                @if ($training->group->count() > 0)
                        @php
                            dd($training->group);
                        @endphp
                    @foreach ($training->group as $g)
                        <div class="my-6 rounded-xl py-6 px-6 flex flex-col lg:flex-row bg-[#f6f1e3]">
                            <div class="flex flex-col lg:flex-grow">
                                <p class="font-semibold text-lg lg:text-xl">
                                    {{ Carbon::parse($training->training_date)->translatedFormat('j F Y') }}
                                </p>
                                <p class="text-sm lg:text-base">
                                    {{ Carbon::parse($training->training_date)->translatedFormat('H.i') }} WIB
                                </p>
                                <h1 class="text-xl lg:text-3xl mt-4 mb-4">{{ $g->name }}</h1>
                                <p class="text-sm lg:text-base">Contact Person : {{ $training->contact_person }} ( <a
                                        style="color: blue; text-decoration: underline; cursor: pointer;"
                                        href="https://wa.me/62{{ $training->phone_number }}">{{ $training->phone_number }}</a>)
                                </p>
                                <p class="text-sm lg:text-base">Tempat Pelatihan : {{ $training->place }}</p>
                            </div>
                            <!-- Button group for actions -->
                            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-end lg:space-x-2 mt-4 lg:mt-0">
                                <a href="{{ route('trainings.edit', [$training, $g]) }}"
                                    class="px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg text-center mb-2 lg:mb-0 lg:mr-2">
                                    Edit
                                </a>
                                <form class="mb-0" action="{{ route('trainings.destroy', ['training' => $training]) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="px-4 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg w-full lg:w-auto">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('libraryjs')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var ElementHeight = $("nav").height();
            var ElementPadding = parseInt($("nav").css('padding').replace("px", ""));
            var numberMargin = ((ElementHeight + (ElementPadding * 2)) / 16) + 2;
            var MarginTop = String(numberMargin) + "rem";
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

            $.ajax({
                url: url,
                success: function(result) {
                    var trainingCardsHtml = "";
                    if (result.data.length > 0) {
                        for (var i = 0; i < result.data.length; i++) {
                            trainingCardsHtml += `
                                <div class="my-6 rounded-xl py-6 px-6 flex flex-col lg:flex-row bg-[#f6f1e3]">
                                    <div class="flex flex-col lg:flex-grow">
                                        <p class="font-semibold text-lg lg:text-xl">${new Date(result.data[i].training_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</p>
                                        <p class="text-sm lg:text-base">${new Date(result.data[i].training_date).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }).replace(":", ".")} WIB</p>
                                        <h1 class="text-xl lg:text-3xl mt-4 mb-4">${result.data[i].groups[0].name}</h1>
                                        <p class="text-sm lg:text-base">Contact Person : ${result.data[i].contact_person} (<a style="color: blue; text-decoration: underline; cursor: pointer;" href="https://wa.me/62${result.data[i].phone_number}">${result.data[i].phone_number}</a>)</p>
                                        <p class="text-sm lg:text-base">Tempat Pelatihan : ${result.data[i].place}</p>
                                    </div>
                                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-end lg:space-x-2 mt-4 lg:mt-0">
                                        <a href="/trainings/${result.data[i].id}/edit" class="px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg text-center mb-2 lg:mb-0 lg:mr-2">Edit</a>
                                        <form action="/trainings/search/delete/${result.data[i].id}" method="post" class="mb-0">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="px-4 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg w-full lg:w-auto">Delete</button>
                                        </form>
                                    </div>
                                </div>`;
                        }
                    }
                    $("#ajaxResult").html(trainingCardsHtml);
                }
            });
        });
    </script>
@endsection
