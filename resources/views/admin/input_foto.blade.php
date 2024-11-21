@extends('base/admin_navbar')

@section('content')
<div class="container mx-auto py-8 mt-8 mb-8">
    <div class="grid grid-cols-12">
        <div class="col-start-2 col-span-6 mt-8">
            <h2 class="font-bold text-3xl">Input Foto Dokumentasi</h2>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-2 p-6">
        <div class="bg-[#f6f1e3] p-4 rounded-lg shadow-md mb-6 grid grid-cols-4 gap-4 items-center">
            <div class="col-span-1">
                <button onclick="toggleModal()" class="flex items-center bg-[#002366] hover:bg-[#20252f] text-white px-4 py-2 rounded-md font-semibold ml-12">
                    <span class="mr-2">+</span> Tambahkan Foto
                </button>
            </div>
            <div class="text-sm text-[#20252f] border border-gray-300 p-4 rounded-lg bg-white col-span-3 mr-8">
                <p class="font-semibold mb-1">Syarat & Ketentuan Foto</p>
                <ul class="list-disc ml-4">
                    <li>Ukuran Foto 800x400</li>
                    <li>Foto Landscape</li>
                    <li>Resolusi file minimum</li>
                </ul>
            </div>
        </div>

        <div class="bg-white border border-gray-300 p-4 rounded-lg">
            <table class="w-full text-center table-auto">
                <thead>
                    <tr>
                        <th class="pb-3 border-b font-semibold w-1/4">Foto Dokumentasi</th>
                        <th class="pb-3 border-b font-semibold">Tanggal Unggah</th>
                        <th class="pb-3 border-b font-semibold">Hapus Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-4 flex items-center justify-center space-x-4">
                            <img src="../../../images/default.jpg" alt="Foto Dokumentasi" class="w-10 h-10 rounded">
                            <span>Christmas 2024</span>
                        </td>
                        <td class="py-4 text-center">26/12/2024</td>
                        <td class="py-4 text-center">
                            <button class="bg-[#ae0001] hover:bg-[#740001] text-white px-4 py-2 rounded-md">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Structure for Uploading Documentation Photo -->
<div id="photoModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-8 w-1/3">
        <h2 class="text-xl font-bold text-gray-700 mb-6">Upload Foto Dokumentasi</h2>
        <label class="block">
            <span class="sr-only">Pilih Foto</span>
            <input type="file"
                class="block w-full text-sm rounded-lg text-gray-700 file:mr-4 file:py-2 file:px-4
                file:rounded-lg file:border-0
                file:text-sm file:font-semibold
                file:bg-[#002366] file:text-white
                hover:file:bg-[#20252f]"
                name="rundown_image" accept=".jpg, .png, .jpeg" onchange="handleFileUpload(event)" required />
        </label>
        <div id="file-name" class="hidden mt-2 text-gray-800 font-semibold"></div>
        <div id="image-preview" class="mt-4 hidden">
            <img id="preview-image" src="" alt="Image Preview" class="w-full h-auto rounded-lg">
        </div>
        <div class="flex justify-end mt-6">
            <button type="button"
                class="bg-gray-500 text-white font-semibold px-4 py-2 rounded-lg mr-2 hover:bg-gray-600"
                onclick="toggleModal()">Cancel</button>
            <button type="button"
                class="bg-[#002366] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#20252f]" onclick="savePhoto()">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    // Toggle the modal visibility
    function toggleModal() {
        const modal = document.getElementById('photoModal');
        modal.classList.toggle('hidden');
    }

    function handleFileUpload(event) {
        const file = event.target.files[0];
        const fileNameElement = document.getElementById('file-name');
        const imagePreviewElement = document.getElementById('image-preview');
        const previewImageElement = document.getElementById('preview-image');
        
        if (file) {
            fileNameElement.textContent = file.name;
            fileNameElement.classList.remove('hidden');
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImageElement.src = e.target.result;
                imagePreviewElement.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    function savePhoto() {
        toggleModal(); 
    }
</script>
