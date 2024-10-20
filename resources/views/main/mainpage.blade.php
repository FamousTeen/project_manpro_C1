@extends('base.main_navbar')

@section('content')

<!-- Colors: 
        1. #740001 - merah gelap 
        2. #ae0001 - merah terang 
        3. #f6f1e3 - netral 
        4. #002366 - biru terang 
        5. #20252f - biru gelap 
    -->

<!-- dokumentasi -->
<section class="bg-blue-500 text-white h-screen flex items-center justify-center" id="documentation">
        <div class="w-full w-screen">
                <img src="https://via.placeholder.com/800x400" alt="Slideshow" class="w-full h-auto">
        </div>
    </section>

<!-- jadwal misa -->
<section class="bg-[#002366] h-screen p-8" id="jadwal-misa">
        <h2 class="text-3xl font-extrabold mb-4 text-center my-8 text-white">Jadwal Misa</h2>
        <div class="max-w-4xl mx-auto">
            <!-- Card 1 -->
            <div class="my-8 bg-[#f6f1e3] text-[#20252f] rounded-xl shadow-lg p-4">
                <h3 class="ml-12 text-xl font-semibold mb-2">Misa Harian</h3>
                <hr class="border-[#ae0001] mb-4">
                <div class="flex place-content-center space-x-32">
                    <div>
                        <div>
                            <p>Senin-Sabtu</p>
                        </div>
                        <div>
                            <!-- List of hours displayed horizontally -->
                            <ul class="flex space-x-4">
                                <li>06.00 WIB</li>
                                <li>09.00 WIB</li>
                                <li>15.00 WIB</li>
                                <li>19.00 WIB</li>
                            </ul>
                        </div>
                        </div>
                        <div>
                        <div>
                            <p>Senin-Sabtu</p>
                        </div>
                        <div>
                            <!-- List of hours displayed horizontally -->
                            <ul class="flex space-x-4 ">
                                <li>06.00 WIB</li>
                                <li>09.00 WIB</li>
                                <li>15.00 WIB</li>
                                <li>19.00 WIB</li>
                            </ul>
                        </div>
                        </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="my-8 bg-[#f6f1e3] text-[#20252f] rounded-xl shadow-lg p-4">
                <h1 class="ml-12 text-xl font-semibold mb-2">Misa Harian</h1>
                <hr class="border-[#ae0001] mb-4">
                <div class="flex place-content-center space-x-32">
                    <div>
                        <div>
                            <p>Senin-Sabtu</p>
                        </div>
                        <div>
                            <!-- List of hours displayed horizontally -->
                            <ul class="flex space-x-4">
                                <li>06.00 WIB</li>
                                <li>09.00 WIB</li>
                                <li>15.00 WIB</li>
                                <li>19.00 WIB</li>
                            </ul>
                        </div>
                        </div>
                        <div>
                        <div>
                            <p>Senin-Sabtu</p>
                        </div>
                        <div>
                            <!-- List of hours displayed horizontally -->
                            <ul class="flex space-x-4 ">
                                <li>06.00 WIB</li>
                                <li>09.00 WIB</li>
                                <li>15.00 WIB</li>
                                <li>19.00 WIB</li>
                            </ul>
                        </div>
                        </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="my-8 bg-[#f6f1e3] text-[#20252f] rounded-xl shadow-lg p-4">
                <h1 class="ml-12 text-xl font-semibold mb-2">Misa Harian</h1>
                <hr class="border-[#ae0001] mb-4">
                <div class="flex place-content-center space-x-32">
                    <div>
                        <div>
                            <p>Senin-Sabtu</p>
                        </div>
                        <div>
                            <!-- List of hours displayed horizontally -->
                            <ul class="flex space-x-4">
                                <li>06.00 WIB</li>
                                <li>09.00 WIB</li>
                                <li>15.00 WIB</li>
                                <li>19.00 WIB</li>
                            </ul>
                        </div>
                        </div>
                        <div>
                        <div>
                            <p>Senin-Sabtu</p>
                        </div>
                        <div>
                            <!-- List of hours displayed horizontally -->
                            <ul class="flex space-x-4 ">
                                <li>06.00 WIB</li>
                                <li>09.00 WIB</li>
                                <li>15.00 WIB</li>
                                <li>19.00 WIB</li>
                            </ul>
                        </div>
                        </div>
                </div>
    </section>

<!-- 7 pillar -->
<section class="bg-[#f6f1e3] py-16" id="section3">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-extrabold text-center text-[#20252f] mb-8">7 PILAR</h2>
        
        <!-- Flexbox for the 7 cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-6">
            
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/150" alt="Pillar 1" class="mb-4 mx-auto rounded-full">
                <h3 class="text-xl font-semibold text-[#20252f]">Pillar 1</h3>
                <p class="text-gray-600">Short description for pillar 1</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/150" alt="Pillar 2" class="mb-4 mx-auto rounded-full">
                <h3 class="text-xl font-semibold text-[#20252f]">Pillar 2</h3>
                <p class="text-gray-600">Short description for pillar 2</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/150" alt="Pillar 3" class="mb-4 mx-auto rounded-full">
                <h3 class="text-xl font-semibold text-[#20252f]">Pillar 3</h3>
                <p class="text-gray-600">Short description for pillar 3</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/150" alt="Pillar 4" class="mb-4 mx-auto rounded-full">
                <h3 class="text-xl font-semibold text-[#20252f]">Pillar 4</h3>
                <p class="text-gray-600">Short description for pillar 4</p>
            </div>

            <!-- Card 5 -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/150" alt="Pillar 5" class="mb-4 mx-auto rounded-full">
                <h3 class="text-xl font-semibold text-[#20252f]">Pillar 5</h3>
                <p class="text-gray-600">Short description for pillar 5</p>
            </div>

            <!-- Card 6 -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/150" alt="Pillar 6" class="mb-4 mx-auto rounded-full">
                <h3 class="text-xl font-semibold text-[#20252f]">Pillar 6</h3>
                <p class="text-gray-600">Short description for pillar 6</p>
            </div>

            <!-- Card 7 -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/150" alt="Pillar 7" class="mb-4 mx-auto rounded-full">
                <h3 class="text-xl font-semibold text-[#20252f]">Pillar 7</h3>
                <p class="text-gray-600">Short description for pillar 7</p>
            </div>

        </div>
    </div>
</section>

<!-- acara yang diadakan -->
<section class="bg-[#002366] py-16 p-8 text-center" id="section4">
  <h2 class="text-3xl font-extrabold text-center text-white mb-8">ACARA YANG DIADAKAN</h2>

  <!-- Content Section -->
  <div class="flex justify-center items-center space-x-4">

    <!-- Left Arrow (Image) -->
    <div class="flex items-center">
      <button class="p-2">
        <img src="../../images/previous_button.png" alt="Previous Event" class="w-8 h-8 hover:opacity-75" />
      </button>
    </div>

    <!-- Poster Section (Center) -->
    <div class="bg-gray-200 p-6 shadow-lg">
      <div class="mb-4">
        <img src="../../images/contoh_poster.jpg" alt="Poster Acara" class="mx-auto w-64" />
      </div>
      <p class="text-center text-sm mt-2">27 September 2024</p>
    </div>

    <!-- Event Details Section (Right) -->
    <div class=" p-6 text-left max-w-lg self-start">
      <h2 class="text-[#f6f1e3] text-3xl font-semibold mb-4">(NAMA ACARA)</h2>
      <p class="text-white text-sm">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus et maximus libero. Aenean eget accumsan massa. Sed commodo tempus nisi, vitae tristique lorem mollis sed. In dignissim sem eget mi interdum lacinia. Suspendisse nibh elit, laoreet eu sem eu, rhoncus malesuada neque.
      </p>
      <p class="text-white text-sm mt-4">Contact Person: XXXXXX-08123123123</p>
    </div>

    <!-- Right Arrow (Image) -->
    <div class="flex items-center">
      <button class="p-2">
        <img src="../../images/next_button.png" alt="Next Event" class="w-8 h-8 hover:opacity-75" />
      </button>
    </div>

  </div>
</section>

<!-- kolekte -->
<section class="bg-[#f6f1e3] py-16 text-center" id="section5">
    
    <h2 class="text-3xl font-bold text-[#20252f] mb-8">PERSEMBAHAN KASIH / KOLEKTE</h2>
    
    <div class="container mx-auto px-4 flex items-center justify-center space-x-16">
      <!-- QR Code Section (Left) -->
      <div class="w-[400px] flex-shrink-0">
        <img src="https://via.placeholder.com/400x400" alt="QR Code" class="w-full h-full object-cover rounded-lg">
      </div>
  
      <!-- Description Section (Right) -->
      <div class="w-[450px] text-left self-start mt-8">
        <p class="font-bold text-[#ae0001]">
          Dapat melalui Transfer
        </p>
      </div>
    </div>
  </section> 


<!-- follow us -->
<section class="bg-[#002366] py-16 p-8 text-center" id="section6">
    <div class="flex justify-center items-center space-x-16  mr-16">
  <h1 class="text-[#f6f1e3] text-3xl font-bold mb-6">FOLLOW US ON</h1>\
    
    <!-- Instagram Card -->
    <div class="bg-[#f6f1e3] p-6 rounded-xl shadow-lg w-48 h-60">
      <h2 class="text-pink-600 text-2xl font-semibold mb-4">Instagram</h2>
      <img src="instagram-logo-url" alt="Instagram Logo" class="mx-auto w-12 h-12 mb-2">
      <p class="text-black font-semibold">@ig_misdinar</p>
    </div>

    <!-- YouTube Card -->
    <div class="bg-[#f6f1e3] p-6 rounded-xl shadow-lg w-48 h-60">
      <h2 class="text-gray-800 text-2xl font-semibold mb-4">YouTube</h2>
      <img src="youtube-logo-url" alt="YouTube Logo" class="mx-auto w-12 h-12 mb-2">
      <p class="text-black font-semibold">@yt_misdinar</p>
    </div>
</section>
