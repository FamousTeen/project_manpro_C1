<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    @vite('resources/css/app.css')

    {{-- For Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            overflow-x: hidden;
        }

        body {
            font-family: 'Poltawski Nowy', serif;
            background-color: #FCF1D5;
        }
    </style>

    @yield('librarycss')
</head>
<!-- Colors: 
        1. #740001 - merah gelap 
        2. #ae0001 - merah terang 
        3. #f6f1e3 - netral 
        4. #002366 - biru terang 
        5. #20252f - biru gelap 
    -->

<body class="bg-white overflow-x-hidden">
    <nav class="bg-[#20252f] text-white p-4 fixed top-0 left-0 right-0 z-50 w-screen">
        <div class="max-w-screen w-full mx-auto flex justify-between items-center">
            <!-- Logo Section -->
            <a href="{{route('main_page')}}" class="flex items-center">
                <img src="../../../images/LOGO_MISDINAR.png" alt="Logo" class="h-12 w-12 md:h-12 md:w-12 mr-2 ml-2 sm:ml-4">
                <span class="font-bold text-xs sm:text-sm md:text-md lg:text-lg hidden md:inline">
                    MISDINAR ST. TARSISIUS GEREJA KATOLIK ROH KUDUS
                </span>
            </a>

            <!-- Navbar Buttons -->
            <div class="flex space-x-4 sm:space-x-6 md:space-x-8 items-center ms-2 sm:ms-4 md:ms-5 mr-2 sm:mr-4">
                <a href="{{route('main_page')}}" class="hover:text-[#ae0001] transition duration-300 text-xs sm:text-sm md:text-md lg:text-lg">
                    Home
                </a>
                <a href="{{ route('start_login') }}"
                    class="bg-white text-[#20252f] text-xs sm:text-sm md:text-md lg:text-lg xl:text-xl py-1 sm:py-2 px-4 sm:px-6 rounded-full hover:bg-[#ae0001] hover:text-white transition duration-300">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-screen-sm mx-auto px-4 sm:px-2 overflow-x-hidden">
        @yield('content')
    </div>

    @vite('resources/js/app.js')
    @yield('libraryjs')
</body>


</html>