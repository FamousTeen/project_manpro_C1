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
        <h1 class="text-3xl">Edit Jadwal Pelatihan</h1>
        <form class="mt-6 mb-6 rounded-xl py-6 px-6 bg-[#f6f1e3]" method="POST"
            action="{{ route('trainings.update', [$group, $training]) }}">
            @csrf
            @method('put')
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 w-full">
                <div class="col-span-1">
                    <label for="group" class="mt-2">Kelompok</label>
                    <select id="group" name="group"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        @foreach ($list_group as $item)
                            @if ($item->name == $group->name)
                                <option value="{{ $item->name }}" selected>{{ $item->name }}</option>
                            @else
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="place" class="mt-2">Tempat Pelatihan</label>
                    <input type="text" id="place" name="place"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $training->place }}" required />
                </div>

                <div class="col-span-1">
                    <label for="date" class="mt-2">Tanggal Pelatihan</label>
                    <input type="date" id="date" name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required value="{{ Carbon::parse($training->training_date)->translatedFormat('Y-m-d') }}" />
                </div>

                <div class="col-span-1">
                    <label for="time" class="mt-2">Waktu Pelatihan</label>
                    <input type="time" id="time" name="time"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ Carbon::parse($training->training_date)->translatedFormat('H:i') }}" required />
                </div>

                <div class="col-span-1">
                    <label for="contact_person" class="mt-2">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $training->contact_person }}" required />
                </div>

                <div class="col-span-1">
                    <label for="phone_number" class="mt-2">Nomor Telepon</label>
                    <input type="text" id="phone_number" name="phone_number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $training->phone_number }}" required />
                </div>

                <div class="col-span-1 sm:col-span-2">
                    <label for="notes" class="mt-2">Catatan</label>
                    <textarea id="eventDesc0" name="description" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Tulis catatan jika diperlukan" oninput="readTextarea2()">{!! nl2br(e(urldecode($training->description))) !!}</textarea>
                    <input type="hidden" name="eventDesc" id="eventDesc00">
                </div>

                <div class="flex col-span-1 sm:col-span-2 mt-4 items-start justify-center">
                    <button type="submit"
                        class="px-8 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg">Edit</button>
                </div>
            </div>
        </form>
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
            console.log(MarginTop);
            $(".content-body").css("margin-top", MarginTop);
        });

        function readTextarea2() {
            const textareaValue = document.getElementById(`eventDesc0`).value;
            document.getElementById(`eventDesc00`).value = encodeURIComponent(textareaValue);
            console.log(document.getElementById(`eventDesc00`).value);
        }
    </script>
@endsection
