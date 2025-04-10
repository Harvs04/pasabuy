<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png">
    <title>Pasabuy</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body>
<div class="flex flex-col items-center justify-center w-screen h-screen gap-12 py-8 ">
      <p class="p-3 text-sm font-medium text-green-500 rounded-full bg-green-50">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" strokeWidth="2" fill="#014421" class="size-20">
          <path fill-rule="evenodd" d="m6.72 5.66 11.62 11.62A8.25 8.25 0 0 0 6.72 5.66Zm10.56 12.68L5.66 6.72a8.25 8.25 0 0 0 11.62 11.62ZM5.105 5.106c3.807-3.808 9.98-3.808 13.788 0 3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788Z" clip-rule="evenodd" />
        </svg>
      </p>
      <div class="flex flex-col items-center gap-4">
        <h1 class="text-3xl font-medium text-center">
          You are not authorized
        </h1>
        <p class="text-xl text-center ">
          You tried to access a page you did not have prior
          authorization for.
        </p>
        <div class="flex items-center justify-center w-full mt-6 gap-x-3 shrink-0 sm:w-auto">
            <a href="{{ route('dashboard') }}" class="w-2/3 sm:w-full px-5 py-2 text-sm text-white bg-[#014421] rounded-lg hover:bg-green-800 text-center">
                Back to home
            </a>
        </div>
      </div>
    </div>
</body>
</html>