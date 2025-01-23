@extends('base/anggota_navbar')

@section('content')
<!-- Colors:
                1. #740001 - merah gelap
                2. #ae0001 - merah terang
                3. #f6f1e3 - netral
                4. #002366 - biru terang
                5. #20252f - biru gelap
            -->

<div class="container mx-auto py-8 mt-16">

    <div class="grid grid-cols-12">
        <div class="col-start-4 col-span-6 mb-8 justify-items-center">
            <h4 class="font-bold text-2xl text-center">Dokumen-Dokumen Khusus Pengurus</h4>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 w-full max-w-3xl mx-auto p-8">
        @php
        $index = 0;
        @endphp
        @foreach ($templates as $template)
        <button onclick="openPreview('template{{$index++}}')" type="button" class="bg-[#f6f1e3] text-[#20252f] hover:bg-[#20252f] hover:text-white px-4 py-2 rounded shadow">Template {{$template->title}}</button>
        @endforeach
    </div>

    <!-- Placeholder for iframe preview -->
    @for ($i = 0; $i < count($templates); $i++)
        <div class="mt-12 hidden" id="template{{$i}}">
        <div class="flex justify-between mb-3">
            <h1 class="font-bold text-2xl">Template {{$templates[$i]->title}}</h1>
        </div>
        <iframe id="templatePDF" class="w-full h-[1200px]" src="{{asset('asset/' . $templates[$i]->file)}}" frameborder="0"></iframe>
</div>
@endfor
 
</div>

@endsection

@section('libraryjs')
<script>
    function openPreview(templateID) {
        document.getElementById(templateID).classList.remove('hidden');
        if (!(previewArray[0] == null)) {
            document.getElementById(previewArray[0]).classList.add('hidden');
            previewArray = [];
        }
        previewArray.push(templateID);
    }
</script>

