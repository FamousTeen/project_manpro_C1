@extends('admin/base')

@section('content')
<div class="container-fluid m-12 me-0">
  <div class="grid grid-cols-12">
    <div class="grid col-start-4 col-span-6 mt-6 justify-items-center">
      <h1 class="font-bold text-2xl ">DASHBOARD</h1>
    </div>
    <div class="grid col-start-11 col-span-2">
      <h2>Hi, Shasaa</h2>
      <p>Day, DD-MM-YYYY</p>
    </div>
  </div>

  <div class="flex justify-center grid-cols-2 m-12 gap-x-12">
    <div class="bg-[#C4CDC1] p-6 pe-16 md:p-4 rounded-xl flex justify-between gap-x-3 md:gap-x-12">
      <div>
        <p class="font-semibold w-fit">Tugas</p>
        <p class=" w-fit">3</p>
      </div>
      <img class="w-[50px] h-[50px]" src="{{ asset('asset/task_complete.png')}}" alt="">
    </div>
    <div class="bg-[#C4CDC1] p-4 rounded-xl flex justify-between gap-x-3 md:gap-x-12">
      <div>
        <p class="font-semibold w-fit">Panitia</p>
        <p class=" w-fit">4</p>
      </div>
      <img class="w-[50px] h-[50px]" src="{{ asset('asset/people.png')}}" alt="">
    </div>
  </div>

  <div>
    <div class="grid justify-items-center">
      <h1 class="font-bold text-xl">CALENDER</h1>
    </div>
    <div class="flex items-center justify-center">
      <div class="lg:w-7/12 md:w-9/12 sm:w-10/12 mx-auto p-4 ps-0">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
          <!-- Calendar Header -->
          <div class="flex items-center justify-between px-6 py-3 bg-[#C4CDC1]">
            <button id="prevMonth" class="text-black">Previous</button>
            <h2 id="currentMonth" class="text-black text-lg md:text-xl"></h2>
            <button id="nextMonth" class="text-black">Next</button>
          </div>

          <!-- Calendar Days Grid -->
          <div class="grid grid-cols-7 gap-2 p-4 text-center text-sm md:text-base" id="calendar">
            <!-- Calendar Days Go Here -->
          </div>

          <!-- Buat detail event (kalo butuh) -->
          <!-- Modal
              <div id="myModal" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>
                <div
                  class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                  <div class="modal-content py-4 text-left px-6">
                    <div class="flex justify-between items-center pb-3">
                      <p class="text-2xl font-bold">Selected Date</p>
                      <button id="closeModal"
                        class="modal-close px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>
                    </div>
                    <div id="modalDate" class="text-xl font-semibold"></div>
                  </div>
                </div>
              </div> -->
        </div>
      </div>
    </div>
  </div>

</div>

</div>
@endsection

@section('libraryjs')
<script>
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
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
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
      if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
        dayElement.classList.add('bg-[#C4CDC1]', 'text-black'); // Add classes for the indicator
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

  // Function to show the modal with the selected date
  function showModal(selectedDate) {
    const modal = document.getElementById('myModal');
    const modalDateElement = document.getElementById('modalDate');
    modalDateElement.innerText = selectedDate;
    modal.classList.remove('hidden');
  }

  // Function to hide the modal
  function hideModal() {
    const modal = document.getElementById('myModal');
    modal.classList.add('hidden');
  }

  // Event listener for date click events
  const dayElements = document.querySelectorAll('.cursor-pointer');
  dayElements.forEach(dayElement => {
    dayElement.addEventListener('click', () => {
      const day = parseInt(dayElement.innerText);
      const selectedDate = new Date(currentYear, currentMonth, day);
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      const formattedDate = selectedDate.toLocaleDateString(undefined, options);
      showModal(formattedDate);
    });
  });

  // Event listener for closing the modal
  document.getElementById('closeModal').addEventListener('click', () => {
    hideModal();
  });

</script>
@endsection