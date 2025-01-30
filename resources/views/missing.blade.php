<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body>
<section class="bg-white ">
    <div class="container flex items-center min-h-screen px-6 py-12 mx-auto">
        <div class="flex flex-col items-center max-w-sm mx-auto text-center">
            <p class="p-3 text-sm font-medium text-green-500 rounded-full bg-green-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#014421" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </p>
            <h1 class="mt-3 text-2xl font-semibold text-gray-800  md:text-3xl">Page not found</h1>
            <p class="mt-4 text-gray-500">The page you are looking for doesn't exist. Here are some helpful links:</p>

            <div class="flex items-center justify-center w-full mt-6 gap-x-3 shrink-0 sm:w-auto">
                <a href="{{ route('dashboard') }}" class="w-1/2 px-5 py-2 text-sm text-white bg-[#014421] rounded-lg hover:bg-green-800">
                    Take me home
                </a>
            </div>
        </div>
    </div>
</section>
</body>
</html>