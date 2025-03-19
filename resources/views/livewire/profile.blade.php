<div class="text-gray-800 mx-2 my-4" x-data="{ orders: '{{ count($user->orders) }}', transactions: '{{ count($user->transactions) }}', rating_count: '{{ count($user->ratings) }}' }">
    
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
        @if(session('error'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
            <div wire:loading.delay wire:target="changeRole, saveInfoChanges, savePassChanges, deleteAccount, logOut, uploadImage"
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

        <!-- CHATBOT -->
        <livewire:chatbot :current_route="'profile'"/>
        <div class="flex justify-center">
            <div class="w-full sm:w-5/6 flex flex-col lg:flex-row gap-4">
                <!-- PASABUY INFO & IMAGE -->
                <div class="flex flex-col">
                    <div class="flex flex-row items-center lg:items-start xl:items-center gap-2 mb-2">
                        <a href={{ route('dashboard') }} class="p-1.5 hover:bg-gray-200 hover:rounded-full">
                            <svg class="w-5 md:w-6"
                                viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.75 18.75H33.75C34.0815 18.75 34.3995 18.8817 34.6339 19.1161C34.8683 19.3505 35 19.6685 35 20C35 20.3315 34.8683 20.6495 34.6339 20.8839C34.3995 21.1183 34.0815 21.25 33.75 21.25H8.75C8.41848 21.25 8.10054 21.1183 7.86612 20.8839C7.6317 20.6495 7.5 20.3315 7.5 20C7.5 19.6685 7.6317 19.3505 7.86612 19.1161C8.10054 18.8817 8.41848 18.75 8.75 18.75Z"
                                    fill="black" />
                                <path
                                    d="M9.26751 20.0001L19.635 30.3651C19.8697 30.5998 20.0016 30.9182 20.0016 31.2501C20.0016 31.5821 19.8697 31.9004 19.635 32.1351C19.4003 32.3698 19.0819 32.5017 18.75 32.5017C18.4181 32.5017 18.0997 32.3698 17.865 32.1351L6.61501 20.8851C6.4986 20.769 6.40624 20.6311 6.34323 20.4792C6.28021 20.3273 6.24777 20.1645 6.24777 20.0001C6.24777 19.8357 6.28021 19.6729 6.34323 19.521C6.40624 19.3692 6.4986 19.2312 6.61501 19.1151L17.865 7.86511C18.0997 7.6304 18.4181 7.49854 18.75 7.49854C19.0819 7.49854 19.4003 7.6304 19.635 7.86511C19.8697 8.09983 20.0016 8.41817 20.0016 8.75011C20.0016 9.08205 19.8697 9.4004 19.635 9.63511L9.26751 20.0001Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <p class="text-xl sm:text-2xl font-medium sm:font-semibold">Profile & Settings</p>
                    </div>
                    <div class="flex flex-col gap-4" x-data="{ openUpload: false }">
                        <!-- IMAGE -->
                        <div class="rounded-md bg-white shadow w-full p-4">
                            <div class="w-full flex flex-col xl:flex-row justify-start items-center gap-4">
                                <img src="{{ $user->profile_pic_url }}"
                                    class="h-14 w-14 xl:h-20 xl:w-20 object-cover rounded-full border shadow" alt="user_photo" />
                                <div class="flex flex-col justify-center items-center xl:items-start">
                                    <p class="text-lg lg:text-base xl:text-lg font-medium md:font-semibold break-words">
                                        {{ $user->name }} </p>
                                    <p class="text-sm"> {{ $user->constituent }} </p>
                                    <button class="py-1 px-2 mt-2 bg-[#014421] hover:bg-green-900 text-white text-xs rounded-md" @click="openUpload = true; document.body.style.overflow = 'hidden';"> Change picture </button>
                                </div>
                            </div>
                        </div>
                        <div @keydown.escape.window="openUpload = false; document.body.style.overflow = 'auto';"
                            x-show="openUpload" x-transition:enter.duration.25ms
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-lg w-11/12 sm:w-4/6 md:w-5/12 xl:w-4/12 relative">
                                <div class="flex flex-row items-center gap-2 sm:gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#014421" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus"><path d="M16 5h6"/><path d="M19 2v6"/><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/><circle cx="9" cy="9" r="2"/></svg>
                                    <p class="text-xl font-semibold text-[#014421]">Profile image upload</p>
                                    <button @click="openUpload = false; document.body.style.overflow = 'auto';"
                                        class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="#000000" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-sm mt-2 sm:ml-2"></p>
                                @if ($image_upload)
                                    <div class="flex justify-center items-center w-full my-4">
                                        <img src="{{ $image_upload->temporaryUrl() }}" alt="profile_preview" class="h-40 w-40 object-cover rounded-full border shadow">
                                    </div>
                                @endif
                                <label class="block mb-2 text-sm font-medium text-gray-700" for="file_input">Upload file</label>
                                <input type="file" accept="image/png, image/jpeg" id="file_input" wire:model="image_upload"
                                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2" />
                                <div class="mt-5 flex justify-end gap-2">
                                    <button @click="openUpload = false; document.body.style.overflow = 'auto';"
                                        class="px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                                    <button x-data="{ disabled: false }" :disabled="disabled" @click="disabled = true; $wire.uploadImage();"
                                        class="px-3 py-1.5 text-sm enabled:bg-[#014421] text-white rounded-md enabled:hover:bg-green-800 disabled:bg-gray-400" x-bind:disabled="{{ $image_upload === null }}">Upload</button>
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
                                                If your PASABUY point is below 80, you will not be able to order items or do
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
                                                    $averageRating = round($user->ratings->avg('star_rating'), 1); // Rounded to 1 decimal place
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
                                                    @elseif ($i - $averageRating < 1) <!-- Half Star for fractional rating
                                                        -->
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
                                                            class="w-5 xl:w-6 text-gray-300" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor" stroke-width="1.5">
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
                                        <button 
                                            @click="wordcloudOpen = !wordcloudOpen" 
                                            :disabled="rating_count == 0"
                                            class="flex items-center gap-2 w-fit py-2 px-4 mt-1 xl:mt-3 enabled:bg-[#014421] enabled:hover:bg-green-900 text-white disabled:bg-gray-300 disabled:cursor-not-allowed text-sm rounded-md font-medium"
                                        >
                                        <svg 
                                                xmlns="http://www.w3.org/2000/svg" 
                                                fill="none" 
                                                viewBox="0 0 24 24" 
                                                stroke-width="1.5" 
                                                stroke="currentColor" 
                                                class="size-5"
                                            >
                                                <path 
                                                    stroke-linecap="round" 
                                                    stroke-linejoin="round" 
                                                    d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z"
                                                />
                                            </svg>
                                            <span x-text="!wordcloudOpen ? 'View word cloud' : 'Hide word cloud'"></span>                                    
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
                                    <img x-show="wordcloudOpen" src="{{ $wordCloudUrl }}" alt="provider_wordcloud" class="w-2/3 max-w-[250px] sm:w-1/2 lg:w-full border rounded-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start rounded-md bg-white shadow w-full gap-4"
                            x-data="{ deleteAccountModalOpen: false }">
                            <div class="flex flex-col py-6 px-8 lg:px-5 lg:py-4 xl:py-6 xl:px-8">
                                <p class="text-lg font-medium md:font-semibold">Account Management</p>
                                <button class="w-fit mt-1" x-data="{ disabled: false }" :disabled="disabled"
                                    @click="disabled = true; $wire.logOut();">
                                    <div
                                        class="flex items-center justify-center gap-2 w-fit font-medium px-2 py-1 text-sm bg-white text-[#014421] border border-[#014421] rounded-md hover:bg-gray-100">
                                        <svg class="w-4 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                        </svg>
                                        <p class="">Log Out</p>
                                    </div>
                                </button>
                                <hr class="my-5 lg:my-3 xl:my-5">
                                <div class="flex flex-col gap-2">
                                    <p
                                        class="text-sm inline-flex w-fit items-center rounded-full bg-rose-200 px-3 py-1 text-[#7b1113]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Proceed with caution
                                    </p>
                                    <p class="text-sm">This action will completely delete your data in our database.</p>
                                    <button @click="deleteAccountModalOpen = true; document.body.style.overflow = 'hidden';"
                                        x-bind:disabled="orders > 0 || transactions > 0"
                                        class="w-fit font-medium px-2 sm:px-3 py-1 text-sm enabled:bg-white enabled:text-[#7b1113] enabled:border enabled:border-[#7b1113] rounded-md enabled:hover:bg-rose-300 disabled:bg-gray-300 disabled:text-white disabled:cursor-not-allowed">Delete
                                        Account</button>
                                </div>
                            </div>
                            <!-- DELETE ACCOUNT MODAL -->
                            <div @keydown.escape.window="deleteAccountModalOpen = false; document.body.style.overflow = 'auto';"
                                x-data="{ confirm: '', errors: {} }" x-show="deleteAccountModalOpen"
                                x-transition:enter.duration.25ms
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative">
                                    <div class="flex flex-col items-center gap-2 sm:gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#ff4545" class="size-12">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <p class="text-lg sm:text-xl font-medium text-black">Are you sure?</p>
                                        <p class="text-sm">Deleting your account will remove all of your information from
                                            our database. This cannot be undone.</p>
                                        <p class="text-xs sm:text-sm text-gray-600 self-start">To confirm this action, type
                                            "CONFIRM"</p>
                                        <input type="text" x-model="confirm"
                                            class="self-start w-1/2 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-black block p-2.5"
                                            x-bind:class="{'border-red-500': errors.confirm}" />
                                        <button
                                            @click="deleteAccountModalOpen = false; document.body.style.overflow = 'auto';"
                                            class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="#000000" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="mt-5 flex gap-2">
                                        <button
                                            @click="deleteAccountModalOpen = false; delete errors.confirm; confirm = ''; document.body.style.overflow = 'auto';"
                                            class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                                        <button x-data="{ disabled: false }" :disabled="disabled" @click="
                                      if (confirm === 'CONFIRM') {
                                          disabled = true;
                                          $wire.deleteAccount();
                                      } else {
                                          errors.confirm = true;
                                      }
                                  " class="px-2 sm:px-3 py-1.5 text-sm bg-red-800 text-white rounded-md hover:bg-[#7b1113]">
                                            Confirm
                                        </button>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- GENERAL INFO -->
                <div class="flex flex-col gap-4">
                    <div class="bg-white rounded-lg shadow w-full">
                        <div class="flex flex-col py-6 px-8 justify-center"
                            x-data="{ contact: $wire.entangle('contact'), originalContact:  '{{ $user->contact_number }}', constituent: '{{ $user->constituent }}', selectedConstituent: '{{ $user->constituent }}' , college: '{{ $user->college }}', selectedCollege: '{{ $user->college }}', degprog: '{{ $user->degree_program }}', selectedDegprog: '{{ $user->degree_program }}', degProgs: {{ json_encode($degprogs) }}, isModalOpen: false, infoModalOpen: false, errors: {} }">
                            <div class="flex flex-row items-center">
                                <p class="text-lg font-medium md:font-semibold">General Information</p>
                                <button @click="isModalOpen = true; document.body.style.overflow = 'hidden';"
                                    class="ml-auto py-1.5 px-3 bg-[#014421] hover:bg-green-900 text-white text-sm rounded-md">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                        <p class="hidden sm:block font-medium">
                                            Change role 
                                        </p>
                                    </div>
                                </button>
                            </div>
                            <p class="text-sm">You are logged in as <span class="font-semibold">
                                    {{ $user->role === 'customer' ? 'Customer' : 'Provider' }} </span></p>
                            <!-- MODAL -->
                            <div @keydown.escape.window="isModalOpen = false; document.body.style.overflow = 'auto';"
                                x-show="isModalOpen" x-transition:enter.duration.25ms
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white p-6 rounded-lg w-11/12 md:w-6/12 xl:w-4/12 relative">
                                    <div class="flex flex-row items-center gap-2 sm:gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#014421" class="size-6 md:size-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <p class="text-xl font-semibold text-[#014421]">Confirmation</p>
                                        <button @click="isModalOpen = false; document.body.style.overflow = 'auto';"
                                            class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="#000000" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    @if($user->role === 'customer')
                                    <p class="text-sm mt-2 md:mt-5 sm:ml-2 text-justify">By changing role to <span
                                            class="font-semibold">Provider</span>, you will be able to:</p>
                                    <ul class="text-sm mt-2 md:mt-4 list-disc list-inside ml-5">
                                        <li>Create and initiate transactions</li>
                                        <li>Gather item orders from customers</li>
                                        <li>Manage orders</li>
                                        <li>Update order statuses</li>
                                    </ul>
                                    @else
                                    <p class="text-sm mt-2 md:mt-5 sm:ml-2 text-justify">
                                        By changing your role to <span class="font-semibold">Customer</span>, you will
                                        be able to:
                                    </p>
                                    <ul class="text-sm mt-2 md:mt-4 list-disc list-inside ml-5">
                                        <li>Create item requests</li>
                                        <li>Place item orders to providers</li>
                                        <li>Track item orders</li>
                                        <li>Rate the transaction and provider</li>
                                    </ul>
                                    @endif
                                    <div class="mt-5 flex justify-end gap-2">
                                        <button @click="isModalOpen = false; document.body.style.overflow = 'auto';"
                                            class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                                        <button @click="isModalOpen = false; document.body.style.overflow = 'auto';"
                                            wire:click="changeRole"
                                            class="px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-900">Confirm</button>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                                <div class="flex flex-col mt-4">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-800">Name</label>
                                    <input type="text" id="name"
                                        class="w-full sm:w-11/12 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                        placeholder="{{ $user->name }}" disabled />
                                </div>
                                <div class="flex flex-col mt-4">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-800 ">Email</label>
                                    <input type="text" id="email"
                                        class="w-full sm:w-11/12 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                        placeholder="{{ $user->email }}" disabled />
                                </div>
                                <div class="flex flex-col mt-4">
                                    <label for="contact" class="block mb-2 text-sm font-medium text-gray-800 ">Contact
                                        Number</label>
                                    <input x-model="contact" wire:model="contact" type="tel" id="contact"
                                        class="w-full sm:w-11/12 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                        x-bind:class="{'border-red-500': ((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 ) || (contact === originalContact && contact !== '') || (contact === '' && originalContact === '')}"
                                        placeholder="{{ $user->contact_number }}" />
                                    <p x-show="((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0) && contact !== originalContact"
                                        class="text-red-500 text-sm ml-1">Invalid contact number format (09***).</p>
                                    <p x-show="contact === originalContact && contact !== ''"
                                        class="text-red-500 text-sm ml-1">Contact number is already in use.</p>
                                    <p x-show="contact === '' && originalContact === ''"
                                        class="text-red-500 text-sm ml-1">Contact number is required for transactions.
                                    </p>
                                </div>
                                <div class="flex flex-col mt-4">
                                    <label for="constituent" class="block mb-2 text-sm font-medium text-gray-800 ">Type
                                        of Constituent</label>
                                    <select x-model="constituent" wire:model="constituent" type="text" id="constituent"
                                        @change="if (constituent === 'staff') { degprog = 'Not Applicable'; } if (constituent !== 'staff' && college === selectedCollege) { degprog = selectedDegprog; } "
                                        x-bind:class="{'border-red-500': constituent === '' && selectedConstituent === ''}"
                                        class="w-full sm:w-11/12 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5">
                                        <option value="{{ $user->constituent }}" selected>
                                            @if ($user->constituent === 'student')
                                            Student
                                            @elseif ($user->constituent === 'faculty')
                                            Faculty Member
                                            @elseif ($user->constituent === 'staff')
                                            Administrative Staff
                                            @elseif ($user->constituent === 'alumnus')
                                            Alumnus
                                            @endif
                                        </option>
                                        @foreach ($types as $label => $value)
                                        @if($user->constituent !== $value)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <p x-show="constituent === '' && selectedConstituent === ''"
                                        class="text-red-500 text-sm ml-1">Constituent type is required for transactions.
                                    </p>
                                </div>
                                <div class="flex flex-col mt-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-800"
                                        for="college">College</label>
                                    <select x-model="college" wire:model="selectedCollege" id="college"
                                        @change="if(college !== selectedCollege) { degprog = ''; } if (college === selectedCollege) { degprog = selectedDegprog; }"
                                        x-bind:class="{'border-red-500': (college === '' && selectedCollege === '')}"
                                        class="w-full sm:w-11/12 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5">
                                        <option value="{{ $user->college }}" selected>{{ $user->college }}</option>
                                        @foreach ($colleges as $college)
                                        @if($college !== $user->college)
                                        <option value="{{ $college }}">{{ $college }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <p x-show="college === '' && selectedCollege === ''"
                                        class="text-red-500 text-sm ml-1">College is required for transactions.</p>
                                </div>
                                <div class="flex flex-col mt-4">
                                    <!-- <p x-text="constituent"></p> -->
                                    <!-- <p x-text="college"></p>  -->
                                    <!-- <p x-text="degprog"></p>  -->
                                    <label for="degprog" class="block mb-2 text-sm font-medium text-gray-800">Degree
                                        Program</label>
                                    <select x-model="degprog" wire:model="degprog" id="degprog"
                                        x-bind:class="{'border-red-500': degprog === '' && constituent !== 'staff'}"
                                        class="w-full sm:w-11/12 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                        :disabled="constituent === 'staff'">

                                        <!-- Placeholder option when no degree program is selected -->
                                        <option value="" disabled
                                            x-show="!degProgs[college] || degprog === '' || college !== selectedCollege ">
                                            Select a degree program
                                        </option>

                                        <!-- Default option when college matches the original registered value -->
                                        <option x-text="selectedDegprog" :value="selectedDegprog"
                                            x-show="college === selectedCollege && degprog === selectedDegprog">
                                        </option>

                                        <!-- Render degree programs dynamically based on selected college -->
                                        <template x-for="program in degProgs[college]" :key="program">
                                            <option x-text="program" :value="program"></option>
                                        </template>
                                    </select>
                                    <p x-show="degprog === '' && constituent !== 'staff'"
                                        class="text-red-500 text-sm ml-1">A new degree program is required.</p>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-start">
                                <button
                                    class="font-medium py-2 px-3 bg-[#014421] enabled:hover:bg-green-900 disabled:bg-gray-300 disabled:cursor-not-allowed text-white text-sm rounded-md"
                                    x-bind:disabled="
                    (((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 || contact === originalContact) || 
                    (contact === '' && constituent === selectedConstituent && college === selectedCollege && degprog === selectedDegprog)) ||
                    (degprog === '' && constituent !== 'staff')
                  " @click="
                                  errors = {};
                                  if ((degprog === undefined || degprog === '') && constituent !== 'staff') errors.deg_undefined = true;
                                  if (((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 )) errors.contact_length = true;
                                  if (contact === originalContact) errors.same = true;
                                  if (Object.keys(errors).length === 0) {
                                    infoModalOpen = true;
                                    document.body.style.overflow = 'hidden';
                                  }
                              ">Save
                                    changes</button>
                            </div>
                            <div @keydown.escape.window="infoModalOpen = false; document.body.style.overflow = 'auto';"
                                x-show="infoModalOpen" x-transition:enter.duration.25ms
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white p-6 rounded-lg w-11/12 md:w-2/3 lg:w-1/2 2xl:w-1/3 relative">
                                    <div class="flex flex-col">
                                        <div class="flex flex-row items-center gap-2 sm:gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#014421" class="size-6 md:size-7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <p class="text-xl font-semibold text-[#014421]">Confirmation</p>
                                        </div>
                                        <p class="text-sm mt-2 sm:ml-2 text-justify">Do you wish to save your changes?
                                        </p>
                                    </div>
                                    <div class="mt-2 md:mt-5 border border-gray-200 rounded-md p-2">
                                        <p class="font-medium text-base ml-1">Summary of changes</p>
                                        <div class="flex flex-col gap-1 text-sm ml-5 px-3 py-1">
                                            <ul class="list-inside list-disc mt-2">
                                                <li x-show="contact" x-text="'Contact Number: ' + contact"></li>
                                                <li x-show="constituent !== selectedConstituent"
                                                    x-text="'Type of constituent: ' + (constituent.charAt(0).toUpperCase() + constituent.slice(1))">
                                                </li>
                                                <li x-show="college !== selectedCollege" x-text="'College: ' + college">
                                                </li>
                                                <li x-show="degprog !== selectedDegprog && constituent !== 'staff'"
                                                    x-text="degprog !== 'Not Applicable'? 'Degree Program: ' + degprog : ''">
                                                </li>
                                            </ul>
                                        </div>
                                        <button @click="infoModalOpen = false; document.body.style.overflow = 'auto';"
                                            class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="#000000" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="mt-5 flex justify-end gap-2">
                                        <button @click="infoModalOpen = false; document.body.style.overflow = 'auto';"
                                            class="px-2 sm:px-3 py-1.5 text-sm bg-white text-black  rounded-md hover:bg-slate-200 border hover:border-slate-200 hover:text-black">Cancel</button>
                                        <button @click="infoModalOpen = false; document.body.style.overflow = 'auto';"
                                            wire:click="saveInfoChanges"
                                            class="px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-900">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PASSWORD INFO -->
                    <div x-data="{ current_password: $wire.entangle('current_password'), new_password: $wire.entangle('new_password'), confirm_new_pass: '', showCurrentPassword: false, showNewPassword: false, showConfirmPassword: false, wrong_password: $wire.entangle('wrong_password'), passModalOpen: $wire.entangle('open_modal') }"
                        class="mb-4">
                        <div class="bg-white rounded-lg shadow py-6 px-8">
                            <p class="text-lg font-medium md:font-semibold">Password Information</p>
                            <div class="flex flex-col sm:flex-row">
                                <div class="flex flex-col w-full mt-4">
                                    <label for="current_password"
                                        class="block mb-2 text-sm font-medium text-gray-800 ">Current Password</label>
                                    <div class="relative w-full">
                                        <input :type="showCurrentPassword ? 'text' : 'password'" id="current_password"
                                            x-model="current_password"
                                            class="relative w-full sm:w-11/12 bg-gray-50 pe-10 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                            {{ $user->google_id == '' ? '' : "disabled" }}
                                            x-bind:class="{'border-red-500': wrong_password}">
                                        <button type="button" @click="showCurrentPassword = !showCurrentPassword"
                                            class="absolute top-1/2 right-4 sm:right-12 transform -translate-y-1/2 text-slate-400 focus:outline-none">
                                            <svg x-show="!showCurrentPassword" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg x-show="showCurrentPassword" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p x-show="wrong_password" class="text-red-500 text-sm ml-1">Current password is
                                        incorrect.</p>
                                </div>
                                <div class="flex flex-col w-full mt-4">
                                    <label for="new_password" class="block mb-2 text-sm font-medium text-gray-800 ">New
                                        Password</label>
                                    <div class="relative w-full">
                                        <input :type="showNewPassword ? 'text' : 'password'" id="new_password"
                                            x-model="new_password"
                                            class="relative w-full sm:w-11/12 bg-gray-50 border pe-10 border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                            {{ $user->google_id == '' ? '' : "disabled" }}
                                            x-bind:class="{'border-red-500': ((new_password.length < 8 || !/[A-Z]/.test(new_password)) && new_password.length > 0) || new_password.length > 40}">
                                        <button type="button" @click="showNewPassword = !showNewPassword"
                                            class="absolute top-1/2 right-4 sm:right-12 transform -translate-y-1/2 text-slate-400 focus:outline-none">
                                            <svg x-show="!showNewPassword" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg x-show="showNewPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p x-show="new_password.length < 8 && new_password.length > 0"
                                        class="text-red-500 text-sm ml-1">New password must be at least 8 characters
                                        long.</p>
                                    <p x-show="new_password.length > 40" class="text-red-500 text-sm ml-1">New password
                                        length limit of 40 is reached.</p>
                                    <p x-show="!/[A-Z]/.test(new_password) && new_password.length > 0"
                                        class="text-red-500 text-sm ml-1">New password must contain at least 1 uppercase
                                        letter.</p>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row mt-4">
                                <div class="flex flex-col w-full">
                                    <label for="confirm_new_pass"
                                        class="block mb-2 text-sm font-medium text-gray-800 ">Confirm New
                                        Password</label>
                                    <div class="relative w-full">
                                        <input :type="showConfirmPassword ? 'text' : 'password'" id="confirm_new_pass"
                                            x-model="confirm_new_pass"
                                            class="relative w-full sm:w-11/12 bg-gray-50 pe-10 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                            {{ $user->google_id == '' ? '' : "disabled" }}
                                            x-bind:class="{'border-red-500': new_password !== confirm_new_pass && (new_password.length > 0 && confirm_new_pass.length > 0)}">
                                        <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                            class="absolute top-1/2 right-4 sm:right-12 transform -translate-y-1/2 text-slate-400 focus:outline-none">
                                            <svg x-show="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg x-show="showConfirmPassword" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p x-show="new_password !== confirm_new_pass && (new_password.length > 0 && confirm_new_pass.length > 0)"
                                        class="text-red-500 text-sm ml-1">Passwords do not match.</p>
                                </div>
                                <!-- HIDDEN -->
                                <div class="flex flex-col w-full">
                                    <label for="new_password" class="mb-2 text-sm font-medium text-gray-900 hidden">New
                                        Password</label>
                                    <input type="password"
                                        class="hidden w-full sm:w-11/12 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:border-[#014421] p-2.5"
                                        placeholder="{{ $user->new_password }}" />
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col w-full 2xl:w-1/2 text-sm">
                                <p class="font-medium text-sm"> Password requirements: </p>
                                <div class="sm:ml-5">
                                    <p class="mt-2">Ensure that these requirements are met:</p>
                                    <ul class="list-disc list-inside">
                                        <li class="">At least 8 characters (and up to 40 characters)</li>
                                        <li>At least one uppercase character</li>
                                    </ul>
                                </div>

                            </div>
                            <div class="mt-6 flex justify-start">
                                <button x-data="{ disabled: false }"
                                    class="font-medium py-2 px-3 bg-[#014421] enabled:hover:bg-green-900 disabled:bg-gray-300 disabled:cursor-not-allowed text-white text-sm rounded-md"
                                    x-bind:disabled="disabled || (new_password !== confirm_new_pass && new_password.length > 0 && confirm_new_pass.length > 0) || (new_password.length < 8 && new_password.length > 0) || new_password.length > 40 || current_password === '' || (!current_password || !new_password || !confirm_new_pass) || !/[A-Z]/.test(new_password)"
                                    type="button"
                                    @click="disabled = true; $wire.checkPassword(); document.body.style.overflow = 'hidden';">Save
                                    changes</button>
                            </div>
                            <div @keydown.escape.window="passModalOpen = false; document.body.style.overflow = 'auto';"
                                x-show="passModalOpen" x-transition:enter.duration.25ms
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white p-6 rounded-lg w-11/12 md:w-2/3 lg:w-7/12 xl:w-1/3 relative">
                                    <div class="flex flex-col">
                                        <div class="flex flex-row items-center gap-2 sm:gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#014421" class="size-6 md:size-7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <p class="text-xl font-semibold text-[#014421]">Confirmation</p>
                                        </div>
                                        <p class="text-sm mt-2 sm:ml-2 text-justify">Do you wish to change your
                                            password?</p>
                                        <button @click="passModalOpen = false; document.body.style.overflow = 'auto';"
                                            class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="#000000" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="mt-5 flex justify-end gap-2">
                                        <button @click="passModalOpen = false; document.body.style.overflow = 'auto';"
                                            class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                                        <button @click="passModalOpen = false; document.body.style.overflow = 'auto';"
                                            wire:click="savePassChanges"
                                            class="px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-900">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>