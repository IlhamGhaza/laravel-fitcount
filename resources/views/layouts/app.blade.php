@if (session('success'))
    <div class="bg-[#BBE67A] text-[#385723] px-4 py-2 rounded-[30px] text-center">
        {{ session('success') }}
    </div>
@endif

{{-- error --}}
@if (session('error'))
    <div class="bg-[#FF2D20] text-[#385723] px-4 py-2 rounded-[30px] text-center">
        {{ session('error') }}
    </div>
@endif
