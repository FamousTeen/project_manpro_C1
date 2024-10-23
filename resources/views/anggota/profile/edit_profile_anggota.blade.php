@extends('base/anggota_navbar')

@section('content')

<!-- Colors: 
        1. #740001 - merah gelap 
        2. #ae0001 - merah terang 
        3. #f6f1e3 - netral 
        4. #002366 - biru terang 
        5. #20252f - biru gelap 
    -->

<div class="flex justify-center items-center min-h-screen bg-gray-100 mt-14">
  <div class="bg-[#f6f1e3] rounded-lg p-8 shadow-lg w-full max-w-4xl">
    <h2 class="text-center text-4xl font-bold text-[#20252f] mb-8">PROFILE</h2>
    <div class="flex">
      <!-- Profile Image Section -->
      <div class="relative w-1/3 p-4 ml-8 mt-16">
        <div class="bg-gray-300 rounded-lg h-48 w-full flex justify-center items-center">
          <!-- Placeholder for profile image -->
          <img src="../../images/dummy_foto_orang.jpg" class="rounded-lg" alt="">
        </div>
        
        <!-- Edit Profile Picture Button -->
        <div class="flex justify-center mt-6">
          <button
            class="bg-[#ae0001] text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#740001] focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75"
            onclick="document.getElementById('profilePictureModal').classList.remove('hidden')"
          >
            Edit Profile Picture
          </button>
        </div>
      </div>
      
      <!-- Profile Information Section -->
      <div class="w-2/3 p-4">
        <div class="grid grid-cols-2 ml-8 gap-y-8">
          <div class="text-gray-600 font-semibold">Nama Panggilan</div>
          <input
            type="text"
            class="border border-gray-300 rounded-lg p-2 text-gray-700"
            value="Shasaa"
          />
          
          <div class="text-gray-600 font-semibold">Nama Lengkap</div>
          <input
            type="text"
            class="border border-gray-300 rounded-lg p-2 text-gray-700"
            value="Shasaa Wijaya"
          />
          
          <div class="text-gray-600 font-semibold">Email</div>
          <input
            type="email"
            class="border border-gray-300 rounded-lg p-2 text-gray-700"
            value="shasaawijaya@gmail.com"
          />
          
          <div class="text-gray-600 font-semibold">Alamat</div>
          <input
            type="text"
            class="border border-gray-300 rounded-lg p-2 text-gray-700"
            value="Jl. Melati No.23, Surabaya"
          />
          
          <div class="text-gray-600 font-semibold">Tempat, Tanggal Lahir</div>
          <input
            type="text"
            class="border border-gray-300 rounded-lg p-2 text-gray-700"
            value="Surabaya, 29 Februari 2003"
          />
          
          <div class="text-gray-600 font-semibold">Wilayah</div>
          <input
            type="text"
            class="border border-gray-300 rounded-lg p-2 text-gray-700"
            value="Carolus"
          />
        </div>
      </div>
    </div>

    <!-- Save My Profile Button -->
    <div class="flex justify-center mt-8">
      <button class="bg-[#002366] text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-[#20252f] focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
        Save Profile
      </button>
    </div>
  </div>
</div>

<!-- Modal for Editing Profile Picture -->
<div
  id="profilePictureModal"
  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden"
>
  <div class="bg-white rounded-lg p-8 w-1/3">
    <h2 class="text-xl font-bold text-gray-700 mb-6">Upload Profile Picture</h2>
    <form>
      <label class="block">
        <span class="sr-only">Choose File</span>
        <input
          type="file"
          class="block w-full text-sm rounded-lg text-gray-700 file:mr-4 file:py-2 file:px-4
                 file:rounded-lg file:border-0
                 file:text-sm file:font-semibold
                 file:bg-[#002366] file:text-white
                 hover:file:bg-[#20252f]"
          accept="image/*"
        />
      </label>
      
      <div class="flex justify-end mt-4">
        <button
          type="button"
          class="bg-gray-500 text-white font-semibold px-4 py-2 rounded-lg mr-2 hover:bg-gray-600"
          onclick="document.getElementById('profilePictureModal').classList.add('hidden')"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="bg-[#002366] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#20252f]"
        >
          Save
        </button>
      </div>
    </form>
  </div>
</div>

@endsection