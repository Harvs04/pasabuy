<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png">
    <title>Pasabuy</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-gray-50">
    <nav class="fixed top-0 z-50 w-full bg-[#014421]">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
            <a href={{ route('dashboard') }}  class="flex ms-2 md:me-24">
                <img src={{ asset('assets/Pasabuy-logo-no-name.png') }} class="h-8 me-3" alt="pasabuy_logo" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">PASABUY</span>
            </a>
            </div>
        </div>
        </div>
    </nav>
    <livewire:user-profile :id="$id" />
    @livewireScripts
    @livewireScriptConfig 
</body>
</html>