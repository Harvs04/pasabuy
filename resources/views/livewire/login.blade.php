@extends('layouts.app')

@section('content')
<div class="md:flex flex-row font-montserrat">
    <div class="bg-[#014421] flex flex-row gap-2 md:h-screen md:w-1/2 md:flex-col md:gap-0 md:justify-center items-center">
        <img src="{{ asset('assets/Pasabuy-logo-no-name.png') }}" class="ml-5 w-16 py-2 md:ml-0 md:w-1/2 md:py-0">
        <p class="text-white text-xl font-bold md:text-6xl">PASABUY</p>
    </div>
    <div>
        Login
    </div>
</div>
@endsection
