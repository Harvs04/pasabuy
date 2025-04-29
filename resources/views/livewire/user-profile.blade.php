<div class="text-gray-800 mx-2 my-4"
    x-data="{ orders: '{{ count($user->orders) }}', transactions: '{{ count($user->transactions) }}', rating_count: '{{ count($user->ratings) }}' }">

    <div class="flex flex-col font-poppins" x-cloak>
        <!-- ALERT MESSAGES -->
        @if(session('change_role_success'))
        <div
            class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                    {{ session('change_role_success') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
        <script>
        setTimeout(() => {
            document.querySelector('.flash').style.display = 'none';
        }, 3000); // 3 seconds
        </script>
        @endif
        @if(session('change_pass_success'))
        <div
            class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                    {{ session('change_pass_success') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
        <script>
        setTimeout(() => {
            document.querySelector('.flash').style.display = 'none';
        }, 3000); // 3 seconds
        </script>
        @endif
        @if(session('change_info_success'))
        <div
            class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                    {{ session('change_info_success') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
        <script>
        setTimeout(() => {
            document.querySelector('.flash').style.display = 'none';
        }, 3000); // 3 seconds
        </script>
        @endif
        @if(session('change_pass_success'))
        <div
            class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                    {{ session('change_pass_success') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
        <script>
        setTimeout(() => {
            document.querySelector('.flash').style.display = 'none';
        }, 3000); // 3 seconds
        </script>
        @endif
        @if(session('dp_change'))
        <div
            class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                    {{ session('dp_change') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
        <script>
        setTimeout(() => {
            document.querySelector('.flash').style.display = 'none';
        }, 3000); // 3 seconds
        </script>
        @endif
        @if(session('contact_error'))
        <div
            class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <div class="text-center text-sm">
                    {{ session('contact_error') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
        <script>
        setTimeout(() => {
            document.querySelector('.flash').style.display = 'none';
        }, 3000); // 3 seconds
        </script>
        @endif
        @if(session('error'))
        <div
            class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <div class="text-center text-sm">
                    {{ session('error') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
        <script>
        setTimeout(() => {
            document.querySelector('.flash').style.display = 'none';
        }, 3000); // 3 seconds
        </script>
        @endif

        <div class="flex flex-row items-center gap-3 md:gap-5" style="margin-top: 3.5rem;">
            <!-- SPINNER -->
            <div wire:loading.delay
                wire:target="changeRole, saveInfoChanges, savePassChanges, deleteAccount, logOut, uploadImage"
                class="fixed inset-0 bg-white bg-opacity-50 z-[51] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101"
                    class="absolute top-1/2 left-1/2 w-12 h-12 text-gray-200 animate-spin fill-[#014421]">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="w-full sm:w-5/6 flex flex-col lg:flex-row gap-4">
                <!-- PASABUY INFO & IMAGE -->
                <div class="w-full md:w-1/3 flex flex-col">
                    <div class="flex flex-col gap-4">
                        <!-- IMAGE -->
                        <div class="rounded-md bg-white shadow w-full p-4">
                            <div
                                class="flex flex-row items-center lg:items-start xl:items-center gap-2 mb-4 pb-2 border-b">
                                <a href={{ route('dashboard') }} class="p-1.5 hover:bg-gray-200 hover:rounded-full">
                                    <svg class="w-5 md:w-6" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.75 18.75H33.75C34.0815 18.75 34.3995 18.8817 34.6339 19.1161C34.8683 19.3505 35 19.6685 35 20C35 20.3315 34.8683 20.6495 34.6339 20.8839C34.3995 21.1183 34.0815 21.25 33.75 21.25H8.75C8.41848 21.25 8.10054 21.1183 7.86612 20.8839C7.6317 20.6495 7.5 20.3315 7.5 20C7.5 19.6685 7.6317 19.3505 7.86612 19.1161C8.10054 18.8817 8.41848 18.75 8.75 18.75Z"
                                            fill="black" />
                                        <path
                                            d="M9.26751 20.0001L19.635 30.3651C19.8697 30.5998 20.0016 30.9182 20.0016 31.2501C20.0016 31.5821 19.8697 31.9004 19.635 32.1351C19.4003 32.3698 19.0819 32.5017 18.75 32.5017C18.4181 32.5017 18.0997 32.3698 17.865 32.1351L6.61501 20.8851C6.4986 20.769 6.40624 20.6311 6.34323 20.4792C6.28021 20.3273 6.24777 20.1645 6.24777 20.0001C6.24777 19.8357 6.28021 19.6729 6.34323 19.521C6.40624 19.3692 6.4986 19.2312 6.61501 19.1151L17.865 7.86511C18.0997 7.6304 18.4181 7.49854 18.75 7.49854C19.0819 7.49854 19.4003 7.6304 19.635 7.86511C19.8697 8.09983 20.0016 8.41817 20.0016 8.75011C20.0016 9.08205 19.8697 9.4004 19.635 9.63511L9.26751 20.0001Z"
                                            fill="black" />
                                    </svg>
                                </a>
                                <p class="text-xl sm:text-2xl font-medium sm:font-semibold">User Profile</p>
                            </div>
                            <div class="w-full flex flex-col xl:flex-row justify-start items-center gap-4">
                                <img src="{{ $user->profile_pic_url }}"
                                    class="h-14 w-14 xl:h-20 xl:w-20 object-cover rounded-full border shadow"
                                    alt="user_photo" />
                                <div class="flex flex-col justify-center items-center xl:items-start">
                                    <p
                                        class="text-lg lg:text-base xl:text-lg text-gray-800 font-medium md:font-semibold break-words">
                                        {{ $user->name }} </p>
                                    <p class="text-sm text-gray-600"> {{ $user->email }} </p>
                                    <p class="text-sm text-gray-600"> {{ $user->constituent }} </p>
                                </div>
                            </div>
                        </div>

                        <!-- PASABUY INFO -->
                        <div class="flex justify-start rounded-md bg-white shadow w-full gap-4">
                            <div class="w-full xl:w-5/6 flex flex-col py-6 px-8 lg:px-5 lg:py-4 xl:py-6 xl:px-8">
                                <p class="text-lg font-medium md:font-semibold">PASABUY Information</p>
                                <div class="flex flex-row gap-1 items-center text-sm" x-data="{ open: false }">
                                    <p>PASABUY points</p>
                                    <div @mouseenter="open = true" @mouseleave="open = false"
                                        class="flex self-center relative">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                            </svg>
                                        </button>
                                        <!-- Tooltip -->
                                        <div x-show="open"
                                            class="absolute left-0 mt-2 z-50 border rounded-lg bg-gray-100 text-gray-800 shadow p-2 w-64">
                                            <p class="text-sm">
                                                If your PASABUY point is below 80, you will not be able to order items
                                                or do
                                                transactions.
                                            </p>
                                        </div>
                                    </div>
                                    <p>: {{ $user->pasabuy_points }}</p>
                                </div>
                                <hr class="my-5 lg:my-3 xl:my-5" />
                                <div class="flex flex-col gap-1">
                                    <div class="flex flex-row gap-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-5 xl:size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <p class="font-medium text-lg">Customer</p>
                                    </div>
                                    <div class="flex flex-col text-sm gap-1">
                                        <p>Successful purchase: {{ $user->successful_orders }}</p>
                                        <p>Cancelled items: {{ $user->cancelled_orders }}</p>
                                    </div>
                                </div>
                                <hr class="my-5 lg:my-3 xl:my-5" />
                                <div class="flex flex-col gap-1">
                                    <div class="flex flex-row gap-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-5 xl:size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                        </svg>
                                        <p class="font-medium text-lg">Provider</p>
                                    </div>
                                    <div class="flex flex-col text-sm gap-1" x-data="{ wordcloudOpen: false }">
                                        <div class="flex flex-row items-center gap-1">
                                            <p class="">Rating:</p>
                                            <div class="flex flex-row">
                                                @php
                                                $averageRating = round($user->ratings->avg('star_rating'), 1); 
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++) @if ($i <=floor($averageRating)) <!-- Solid
                                                    Star for full rating -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 xl:w-6 text-yellow-500" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    @elseif ($i - $averageRating < 1) <!-- Half Star for fractional
                                                        rating -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 xl:w-6 text-yellow-400" viewBox="0 0 24 24"
                                                            fill="currentColor">
                                                            <defs>
                                                                <linearGradient id="half">
                                                                    <stop offset="50%" stop-color="currentColor" />
                                                                    <stop offset="50%" stop-color="transparent" />
                                                                </linearGradient>
                                                            </defs>
                                                            <path fill="url(#half)"
                                                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        @else
                                                        <!-- Outline Star for empty rating -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 xl:w-6 text-gray-300" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                        </svg>
                                                        @endif
                                                        @endfor
                                            </div>
                                            <p x-show="transactions > 0">{{ $averageRating . "/5" }}</p>
                                            <p>({{ count($user->ratings) }})</p>
                                        </div>
                                        <p>Successful Deliveries: {{ $user->successful_deliveries }}</p>
                                        <p>Cancelled transactions: {{ $user->cancelled_transactions }}</p>
                                        <button @click="wordcloudOpen = !wordcloudOpen" :disabled="rating_count == 0"
                                            class="flex items-center gap-2 w-fit py-2 px-4 mt-1 xl:mt-3 enabled:bg-[#014421] enabled:hover:bg-green-900 text-white disabled:bg-gray-300 disabled:cursor-not-allowed text-sm rounded-md font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                                            </svg>
                                            <span
                                                x-text="!wordcloudOpen ? 'View word cloud' : 'Hide word cloud'"></span>
                                        </button>

                                        @php
                                        $remarks = $user->ratings->pluck('remarks')->implode(' ');
                                        $wordCloudUrl = 'https://quickchart.io/wordcloud?' . http_build_query([
                                        'text' => $remarks,
                                        'format' => 'png',
                                        'width' => 450,
                                        'height' => 450,
                                        'backgroundColor' => '#ffffff',
                                        'fontFamily' => 'Arial',
                                        'fontWeight' => 'bold',
                                        'fontScale' => 45,
                                        'scale' => 'sqrt',
                                        'padding' => 4,
                                        'rotation' => 0,
                                        'maxNumWords' => 100,
                                        'minWordLength' => 3,
                                        'case' => 'lower',
                                        'colors' => json_encode(['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728']),
                                        'removeStopwords' => false,
                                        'cleanWords' => true,
                                        'language' => 'en',
                                        'useWordList' => false,
                                        ]);
                                        @endphp
                                        <img x-show="wordcloudOpen" src="{{ $wordCloudUrl }}" alt="provider_wordcloud"
                                            class="w-2/3 max-w-[250px] sm:w-1/2 lg:w-full border rounded-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-2/3 bg-white rounded-lg shadow py-4 px-6">
                    <h2 class="text-lg md:text-xl text-gray-800 font-medium md:font-semibold mb-2">Customer Feedbacks</h2>

                    <!-- Feedback Grid - 2 per row on larger screens, 1 on mobile -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:max-h-[calc(100svh-11rem)] md:overflow-y-auto">
                        <!-- Feedback Card 1 -->
                        @foreach ($user->ratings as $rating)
                        @php
                        $post = App\Models\Post::where('id', $rating->post_id)->first();
                        $customer = App\Models\User::where('id', $rating->customer_id)->first();
                        @endphp
                        <div class="bg-gray-100 rounded-lg shadow p-4 hover:bg-gray-200">
                            <div class="flex items-center mb-3">
                                <div
                                    class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                    <img src="{{ $customer->profile_pic_url }}" alt="customer_pic" class="rounded-full">
                                </div>
                                <div class="ml-3">
                                    <h3 class="font-semibold text-gray-800">{{ $customer->name }}</h3>
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $rating->star_rating)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#facc15"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#4b5563"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                </svg>
                                            @endif
                                        @endfor                                        
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm">Item: {{ $post->item_name }}</p>
                            <p class="text-gray-600 text-sm">{{ $rating->remarks }}</p>
                            <p class="text-gray-400 text-xs mt-2">
                                {{ $rating->created_at->Timezone('Singapore')->format('M d, Y \a\t h:i a') }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>