<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="current-convo-id" content="{{ $convo_id }}">
    <link rel="shortcut icon" type="x-icon" href="https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png">
    <title>Pasabuy</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    @livewireStyles
</head>
<body class="bg-gray-50">
    <livewire:message-view :convo_id="$convo_id" />
    @livewireScripts
    @livewireScriptConfig
</body>
</html>