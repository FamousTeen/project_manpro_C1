@php
use App\Models\Misa;
use App\Models\Training;
@endphp

@extends('base/anggota_navbar')

@section('content')
<!-- Colors:
                            1. #740001 - merah gelap
                            2. #ae0001 - merah terang
                            3. #f6f1e3 - netral
                            4. #002366 - biru terang
                            5. #20252f - biru gelap
                        -->
<div class="container-fluid m-12 mt-24">
    <!-- Header Section -->
    <div class="grid grid-cols-12">
        <div class="col-start-4 col-span-6 mt-6 mb-8 justify-items-center">
            <h1 class="font-bold text-4xl text-center">DASHBOARD</h1>
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

    <!-- Main Layout: Left and Right Sides -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-y-8 mt-6">

        <!-- Left Side: Tugas, Panitia, and Pengumuman -->
        <div>
            <!-- Tugas and Panitia Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                <div
                    class="bg-[#f6f1e3] p-6 rounded-xl flex justify-between gap-x-3 md:gap-x-12 border border-[#002366]">
                    <div>
                        <p class="font-semibold w-fit text-lg">Tugas</p>
                        <p class="w-fit text-md">
                            @php
                            use App\Models\GroupDetail;

                            $user_group = GroupDetail::where('account_id', $data->id)->get()->first();
                            @endphp

                            {{ Training::where('status', 1)->whereHas('trainingDetails', function ($query) use ($user_group) {
                                        if (!empty(optional($user_group)->group_id)) {
            $query->where('group_id', $user_group->group_id);
        } else {
            $query->whereRaw('1 = 0'); // Ensures it returns 0 if group_id is null
        }
                                    })->count() +
                                    Misa::where('active', 1)->whereHas('misaDetails', function ($query) use ($data) {
                                            
                                            if (!empty(optional($data)->id)) {
                                                $query->where('account_id', $data->id);
        } else {
            $query->whereRaw('1 = 0'); // Ensures it returns 0 if group_id is null
        }
                                        })->count() }}
                        </p>
                    </div>
                    <img class="w-[50px] h-[50px]" src="{{ asset('asset/task_complete.png') }}" alt="Task Icon">
                </div>
                <div
                    class="bg-[#f6f1e3] p-6 rounded-xl flex justify-between gap-x-3 md:gap-x-12 border border-[#002366]">
                    <div>
                        <p class="font-semibold w-fit text-lg">Panitia</p>
                        <p class="w-fit text-md">{{ $data->eventDetails->where('account_id', $data->id)->count() }}</p>
                    </div>
                    <img class="w-[50px] h-[50px]" src="{{ asset('asset/people.png') }}" alt="People Icon">
                </div>
            </div>
        </div>

        <!-- Right Side: Pengumuman Section -->
        <div>
            <div class="grid justify-items-center mb-6">
                <h2 class="font-bold text-xl mb-4">Pengumuman</h2>
                <div class="sm:px-16 px-4">
                    
                    <?php

                    use Carbon\Carbon;

                    $announcement_details = $data->announcementDetails->where('account_id', $data->id);

                    Carbon::setLocale('id');
                    ?>
                    <div class="flex flex-col gap-6">
                        @foreach ($announcement_details as $announcement_detail)
                        <!-- Announcement Card -->
                        <div class="bg-[#f6f1e3] p-8 rounded-xl shadow-lg border border-[#002366]">
                            <p class="font-semibold mb-4">
                                {{ Carbon::parse($announcement_detail->announcement->upload_time)->translatedFormat('l, j F Y') }}
                            </p>
                            <p class="text-sm">
                                {!! nl2br(e(urldecode($announcement_detail->announcement->description))) !!}
                            </p>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('libraryjs')
<script>
    // Function to display the current date in the "Hi, Shasa" section
    const today = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    document.getElementById('currentDate').innerText = today.toLocaleDateString(undefined, options);
    document.getElementById('currentDatePhone').innerText = today.toLocaleDateString(undefined, options);

    // Function to generate the calendar for a specific month and year
    function generateCalendar(year, month) {
        const calendarElement = document.getElementById('calendar');
        const currentMonthElement = document.getElementById('currentMonth');

        // Create a date object for the first day of the specified month
        const firstDayOfMonth = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Clear the calendar
        calendarElement.innerHTML = '';

        // Set the current month text
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];
        currentMonthElement.innerText = `${monthNames[month]} ${year}`;

        // Calculate the day of the week for the first day of the month (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
        const firstDayOfWeek = firstDayOfMonth.getDay();

        // Create headers for the days of the week
        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        daysOfWeek.forEach(day => {
            const dayElement = document.createElement('div');
            dayElement.className = 'text-center font-semibold';
            dayElement.innerText = day;
            calendarElement.appendChild(dayElement);
        });

        // Create empty boxes for days before the first day of the month
        for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyDayElement = document.createElement('div');
            calendarElement.appendChild(emptyDayElement);
        }

        // Create boxes for each day of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'text-center py-2 border cursor-pointer';
            dayElement.innerText = day;

            // Check if this date is the current date
            const currentDate = new Date();
            if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate
                .getDate()) {
                dayElement.classList.add('bg-[#f6f1e3]', 'text-[#20252f]'); // Add classes for the indicator
            }

            calendarElement.appendChild(dayElement);
        }
    }

    // Initialize the calendar with the current month and year
    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    generateCalendar(currentYear, currentMonth);

    // Event listeners for previous and next month buttons
    document.getElementById('prevMonth').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentYear, currentMonth);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentYear, currentMonth);
    });
</script>
@endsection