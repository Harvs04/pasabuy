<div class="" x-cloak>

    @teleport('body')
    <div wire:loading wire:target="reportUser"
        class="fixed inset-0 bg-white bg-opacity-50 z-50 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101"
            class="w-12 h-12 text-gray-200 animate-spin fill-[#014421]"
            style="position: absolute; top: 50%; left: 50%;">
            <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor" />
            <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill" />
        </svg>
    </div>
    @endteleport

    <div class="flex flex-col sm:gap-4" x-data="{ selectedPost: '' }">
        @if($posts->count() === 0)
        <script>
        document.body.style.overflow = "hidden";
        </script>
        <div
            class="h-[calc(100vh-7rem)] fixed top-1/2 flex flex-col sm:flex-row self-center items-center gap-2 text-sm sm:text-base text-gray-400 -z-10">
            <p class="">Seems empty in here.</p>
            @if ($type === 'dashboard')
            <button @click="createPostModalOpen = true" class="underline">Create a post</button>
            @elseif($type === 'saved')
            <a href="{{ route('dashboard') }}" class="underline">Back to dashboard</a>
            @endif
        </div>
        @else
        @foreach($posts as $post)
        <div class="bg-white border sm:rounded-md text-gray-800 text-sm relative"
            x-data="{ openComment: false, openList: false, show: true, reportModalOpen: false, post_id: $wire.entangle('post_id'), reported_id: $wire.entangle('reported_id') }">
            <div x-show="show" class="pt-3 px-3 pb-2">
                <div class="flex flex-row items-start gap-3">
                    <a href="{{ $post->user_id !== $user->id ? route('user-profile', ['id' => $post->user_id]) : route('profile', ['name' => $user->name]) }}">
                        <img class="w-9 h-9 md:w-10 md:h-10 object-cover rounded-full"
                            src="{{ App\Models\User::where('id', $post->user_id)->first()->profile_pic_url }}"
                            alt="user_photo">
                    </a>
                    <div class="flex flex-col">
                        <div class="flex flex-col sm:flex-row sm:items-center text-sm gap-0 sm:gap-1">
                            <a href="{{ $post->user_id !== $user->id ? route('user-profile', ['id' => $post->user_id]) : route('profile', ['name' => $user->name]) }}" class="font-semibold">{{ $post->poster_name }}</a>
                            <p class="">{{  $post->type === 'item_request' ? 'is looking for:' : 'is buying:' }} </p>
                        </div>
                        <p class="text-xs">
                            {{ $post->created_at->timezone('Asia/Singapore')->format('F j, Y \a\t H:i') }}</p>
                        <div class="flex gap-1.5 items-center {{ $post->type === 'item_request' ? 'hidden' : 'block' }}">
                            <div class="flex">
                                @php
                                $poster = App\Models\User::where('id', $post->user_id)->first();
                                $averageRating = round($poster->ratings->avg('star_rating'), 1); // Rounded to 1 decimal place
                                @endphp
                                @for ($i = 1; $i <= 5; $i++) @if ($i <=floor($averageRating)) <!-- Solid Star for full
                                    rating -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-yellow-500"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    @elseif ($i - $averageRating < 1) <!-- Half Star for fractional rating -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-yellow-400"
                                            viewBox="0 0 24 24" fill="currentColor">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-gray-300" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                        </svg>
                                        @endif
                                        @endfor
                            </div>
                            <div class="flex gap-0.5">
                                <p class="text-gray-600 text-xs">{{ $averageRating . "/5" }}</p>
                                <p class="text-gray-600 text-xs">({{ count($poster->ratings) }})</p>
                            </div>
                        </div>
                    </div>
                    @php
                    $colorClass = match($post->status) {
                    'open' => 'font-medium px-2.5 py-1 rounded bg-green-900 text-gray-50',
                    'ongoing' => 'bg-yellow-100 text-yellow-800 font-medium px-2.5 py-1 rounded dark:bg-yellow-900
                    dark:text-yellow-300',
                    'converted' => 'bg-gray-100 text-gray-800 font-medium px-2.5 py-1 rounded dark:bg-gray-700
                    dark:text-gray-300',
                    'completed' => 'bg-gray-100 text-gray-800 font-medium px-2.5 py-1 rounded dark:bg-gray-700
                    dark:text-gray-300',
                    'full' => 'bg-red-100 text-red-800 font-medium px-2.5 py-1 rounded dark:bg-red-900
                    dark:text-red-300',
                    'cancelled' => 'bg-red-100 text-red-800 font-medium px-2.5 py-1 rounded dark:bg-red-900
                    dark:text-red-300'
                    };
                    @endphp
                    <div class="flex flex-row items-center ml-auto gap-2">
                        <span class="h-fit text-xs {{ $colorClass }}">
                            <!-- For larger screens (>=640px) -->
                            <span class="hidden md:inline">
                                {{ ucwords($post->status) }}
                                @if($post->status !== 'completed' && $post->status !== 'cancelled' && $post->type ===
                                'transaction')
                                {{ $post->type === 'item_request' ? 'Item request' : 'transaction'}}:
                                {{ count($post->orders) }}/{{ $post->max_orders }}
                                @else
                                {{ $post->type === 'item_request' ? 'Item request' : 'transaction'}}
                                @endif
                            </span>

                            <!-- For smaller screens (<640px) -->
                            <span class="flex flex-row gap-1 md:hidden">
                                @if($post->type === 'item_request')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="size-4 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                @elseif($post->type === 'transaction')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="size-4 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                @endif
                                @if($post->status !== 'completed' && $post->status !== 'cancelled' && $post->type ===
                                'transaction')
                                {{ count($post->orders) }}/{{ $post->max_orders }}
                                @endif
                            </span>
                        </span>
                        <button
                            @click="openList = true; post_id = '{{ $post->id }}'; reported_id = '{{ $post->user_id }}';"
                            class="p-1.5 hover:bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                <circle cx="12" cy="12" r="1" />
                                <circle cx="19" cy="12" r="1" />
                                <circle cx="5" cy="12" r="1" />
                            </svg>
                        </button>
                    </div>

                    <!-- LIST OF ACTIONS -->
                    <div class="flex flex-col items-start absolute top-12 right-4 border rounded-md" x-show="openList"
                        @click.outside="openList = false">
                        <button class="flex gap-1.5 items-center p-2 hover:bg-gray-100 rounded-sm"
                            @click="show = false; openList = false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                            <p class="text-start text-sm">Hide post</p>
                        </button>
                        @if ($user->id !== $post->user_id)
                        <button
                            class="flex items-center gap-1.5 py-2 px-3 enabled:hover:bg-red-500 enabled:hover:text-white disabled:cursor-not-allowed rounded-sm w-full"
                            @click="reportModalOpen = true; document.body.style.overflow = 'hidden';">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>
                            <p class="text-start text-sm">Report</p>
                        </button>
                        @endif
                    </div>
                </div>
                @if($post->type === 'item_request')
                <div class="mt-4 ml-1 flex flex-col gap-2 md:gap-3">
                    <p class="text-[#014421] text-base font-semibold underline">Item Details:</p>
                    <div class="flex flex-col gap-2 md:gap-3 ml-2">
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold">Item name:</p>
                                <p class="font-medium sm:font-normal">{{ $post->item_name }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold">Item origin:</p>
                                <p class="font-medium sm:font-normal">{{ $post->item_origin }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Item type:</p>
                                <div class="flex flex-row flex-wrap gap-1">
                                    @foreach(json_decode($post->item_type) as $type)
                                    @php
                                    $colorClass = match($type) {
                                    'Food', 'Grocery item' => 'bg-green-100 text-green-800',
                                    'Local produce', 'Pet needs' => 'bg-yellow-100 text-yellow-800 ',
                                    'Apparel', 'Footwear' => 'bg-indigo-100 text-indigo-800',
                                    'Merchandise', 'Personal care' => 'bg-purple-100 text-purple-800',
                                    'Celebratory', 'Hobbies' => 'bg-pink-100 text-pink-800',
                                    default => 'bg-gray-100 text-gray-800', // Fallback color
                                    };
                                    @endphp
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $colorClass }}">
                                        {{ $type }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-[#014421] text-base font-semibold underline">Request Details:</p>
                    <div class="flex flex-col gap-2 md:gap-3 ml-2">
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Mode of payment:</p>
                                <p class="font-medium sm:font-normal">
                                    {{ implode(', ', json_decode($post->mode_of_payment)) }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Delivery date:</p>
                                <p class="font-medium sm:font-normal">{{ $post->delivery_date->format('F j, Y') }}</p>
                            </div>
                        </div>
                        @if($post->additional_notes !== null)
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 md:size-5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <div class="flex flex-row flex-wrap gap-1 overflow-hidden">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Additional notes:</p>
                                <p class="break-all pr-1 font-medium sm:font-normal">{{ $post->additional_notes }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @elseif($post->type === 'transaction')
                <div class="mt-4 ml-1 flex flex-col gap-3">
                    <p class="text-[#014421] text-base font-semibold underline">Item Details:</p>
                    <div class="flex flex-col gap-2 md:gap-3 ml-2">
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold">Item name:</p>
                                <p class="font-medium sm:font-normal">{{ $post->item_name }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold">Item origin:</p>
                                <p class="font-medium sm:font-normal">{{ $post->item_origin }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Item type:</p>
                                <div class="flex flex-row flex-wrap gap-1">
                                    @foreach(json_decode($post->item_type) as $type)
                                    @php
                                    $colorClass = match($type) {
                                    'Food', 'Grocery item' => 'bg-green-100 text-green-800',
                                    'Local produce', 'Pet needs' => 'bg-yellow-100 text-yellow-800 ',
                                    'Apparel', 'Footwear' => 'bg-indigo-100 text-indigo-800',
                                    'Merchandise', 'Personal care' => 'bg-purple-100 text-purple-800',
                                    'Celebratory', 'Hobbies' => 'bg-pink-100 text-pink-800',
                                    default => 'bg-gray-100 text-gray-800', // Fallback color
                                    };
                                    @endphp
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $colorClass }}">
                                        {{ $type }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($post->sub_type !== null)
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Subtags:</p>
                                <div class="flex flex-row flex-wrap gap-1">
                                    @php
                                    $subTypeArray = json_decode($post->sub_type, true);
                                    @endphp
                                    @if (is_array($subTypeArray))
                                    @foreach($subTypeArray as $subtype)
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded bg-gray-100 text-gray-800">
                                        {{ $subtype }}
                                    </span>
                                    @endforeach
                                    @else
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded bg-gray-100 text-gray-800">
                                        Invalid subtag data
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <p class="text-[#014421] text-base font-semibold underline">Transaction Details:</p>
                    <div class="flex flex-col gap-2 md:gap-3 ml-2" x-data="{ openOrdersUntil: false }">
                        <div class="flex flex-row gap-2 items-start text-sm relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5" @mouseenter="openOrdersUntil = true"
                                @mouseleave="openOrdersUntil = false">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold">Taking orders until:</p>
                                <p class="font-medium sm:font-normal">{{ $post->cutoff_date->format('F j, Y') }}</p>
                            </div>
                            <p x-show="openOrdersUntil"
                                class="absolute -top-8 rounded-lg bg-gray-200 text-xs text-gray-700 px-2 py-1.5">Orders
                                are only catered until this date</p>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Transaction fee:</p>
                                <p class="font-medium sm:font-normal">{{ $post->transaction_fee }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Mode of payment:</p>
                                <p class="font-medium sm:font-normal">
                                    {{ implode(', ', json_decode($post->mode_of_payment)) }}</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-[#014421] text-base font-semibold underline">Delivery Details:</p>
                    <div class="flex flex-col gap-2 md:gap-3 ml-2">
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Delivery date:</p>
                                <p class="font-medium sm:font-normal">{{ $post->delivery_date->format('F j, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Arrival time:</p>
                                <p class="font-medium sm:font-normal">
                                    {{ DateTime::createFromFormat('H:i:s', $post->arrival_time)->format('g:i a') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <div class="flex flex-row gap-2 items-start">
                                <p class="hidden sm:block font-semibold whitespace-nowrap">Meetup place:</p>
                                <p class="font-medium sm:font-normal">{{ $post->meetup_place }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if ($post->item_image !==
                "https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png")
                <img src="{{ $post->item_image }}" alt="product_image"
                    class="w-1/3 ml-2 my-4 object-cover rounded-lg" />
                @endif
                <!-- LIKE, COMMENT, SAVE -->
                <div>
                    <livewire:comments lazy :$post />
                </div>
            </div>
            <div x-show="!show" class="p-2">
                <button class="flex items-center gap-1.5 justify-center md:justify-end w-full md:w-auto"
                    @click="show = true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-eye-icon lucide-eye">
                        <path
                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <p class="font-medium">Show post</p>
                </button>
            </div>
            <!-- REPORT MODAL -->
            @teleport('body')
            <div @keydown.escape.window="reportModalOpen = false; document.body.style.overflow = 'auto';"
                x-data="{ confirm: '', errors: {} }" x-show="reportModalOpen" x-transition:enter.duration.25ms
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 font-poppins">
                <div class="bg-white py-4 px-2 md:px-6 md:py-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative"
                    @click.outside="reportModalOpen = false; document.body.style.overflow = 'auto';">
                    <div class="flex flex-col items-center gap-2 sm:gap-3"
                        x-data="{ reportPageOne: true, reportPageTwo: false, reportType: '', reportText: $wire.entangle('complaint'), post_id: '{{ $post->id }}', reported_id: '{{ $post->user_id }}' }">
                        <svg class="size-7 md:size-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="#dc2626"
                                d="M14.55 12.22a4.92 4.92 0 0 0 1.7-3.72a5 5 0 0 0-10 0A4.92 4.92 0 0 0 8 12.22a8 8 0 0 0-4.7 7.28a1 1 0 0 0 2 0a6 6 0 0 1 12 0a1 1 0 0 0 2 0a8 8 0 0 0-4.75-7.28Zm-3.3-.72a3 3 0 1 1 3-3a3 3 0 0 1-3 3Zm8.5-5a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2a1 1 0 0 0-1-1ZM19 11.79a1.05 1.05 0 0 0-.29.71a1 1 0 0 0 .29.71a1.15 1.15 0 0 0 .33.21a.94.94 0 0 0 .76 0a.9.9 0 0 0 .54-.54a.84.84 0 0 0 .08-.38a1 1 0 0 0-1.71-.71Z" />
                        </svg>
                        <p class="text-lg sm:text-xl font-medium text-black">Report user</p>
                        <div class="w-full text-gray-600" x-show="reportPageOne">
                            <p class="text-sm md:text-base text-center font-medium text-gray-700">Why are you reporting
                                this user?</p>
                            <div class="w-full rounded-md flex flex-col gap-0.5 text-medium text-sm md:text-base mt-2">
                                <button @click="reportPageOne = false; reportPageTwo = true; reportType = 'Spam';"
                                    class="w-full flex items-center justify-between hover:bg-gray-100 p-1.5 md:p-2 rounded md:rounded-md">
                                    <p>Spam</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4b5563"
                                        class="size-5 md:size-6">
                                        <path fill-rule="evenodd"
                                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button
                                    @click="reportPageOne = false; reportPageTwo = true; reportType = 'Selling illegal items';"
                                    class="w-full flex items-center justify-between hover:bg-gray-100 p-1.5 md:p-2 rounded md:rounded-md">
                                    <p>Selling illegal items</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4b5563"
                                        class="size-5 md:size-6">
                                        <path fill-rule="evenodd"
                                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button
                                    @click="reportPageOne = false; reportPageTwo = true; reportType = 'Bullying, harassment, or abuse';"
                                    class="w-full flex items-center justify-between hover:bg-gray-100 p-1.5 md:p-2 rounded md:rounded-md">
                                    <p>Bullying, harassment, or abuse</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4b5563"
                                        class="size-5 md:size-6">
                                        <path fill-rule="evenodd"
                                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button
                                    @click="reportPageOne = false; reportPageTwo = true; reportType = 'Scam or false information';"
                                    class="w-full flex items-center justify-between hover:bg-gray-100 p-1.5 md:p-2 rounded md:rounded-md">
                                    <p>Scam or false information</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4b5563"
                                        class="size-5 md:size-6">
                                        <path fill-rule="evenodd"
                                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button
                                    @click="reportPageOne = false; reportPageTwo = true; reportType = 'Fake identity';"
                                    class="w-full flex items-center justify-between hover:bg-gray-100 p-1.5 md:p-2 rounded md:rounded-md">
                                    <p>Fake identity</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4b5563"
                                        class="size-5 md:size-6">
                                        <path fill-rule="evenodd"
                                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button @click="reportPageOne = false; reportPageTwo = true; reportType = 'Others';"
                                    class="w-full flex items-center justify-between hover:bg-gray-100 p-1.5 md:p-2 rounded md:rounded-md">
                                    <p>Others</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4b5563"
                                        class="size-5 md:size-6">
                                        <path fill-rule="evenodd"
                                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div x-show="reportPageTwo" class="w-full flex flex-col gap-0.5">
                            <p class="text-sm md:text-base text-center font-medium text-gray-700">We want to hear what
                                happened.</p>
                            <div class="flex gap-1 items-center mt-4 mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-5">
                                    <path fill-rule="evenodd"
                                        d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="text-sm md:text-base text-start font-medium text-gray-700"
                                    for="report_field" x-text="reportType"></label>
                            </div>
                            <textarea x-model="reportText" id="report_field" rows="5"
                                placeholder="Enter your complaint here..."
                                class="w-full border rounded-md p-2 resize-none text-sm text-gray-700"></textarea>
                            <div class="mt-5 flex gap-2">
                                <button @click="reportPageOne = true; reportPageTwo = false; reportType = '';"
                                    class="px-2.5 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Back</button>
                                <button x-data="{ disabled: false }"
                                    x-bind:disabled="disabled || reportText.trim().length === 0"
                                    @click="disabled = true; $wire.reportUser(post_id, reported_id, reportType); reportModalOpen = false;"
                                    class="px-2.5 sm:px-3 py-1.5 text-sm enabled:bg-red-700 text-white rounded-md enabled:hover:bg-red-600 disabled:bg-gray-400 disabled:cursor-not-allowed">
                                    Submit
                                </button>
                            </div>
                        </div>
                        <button @click="reportModalOpen = false; document.body.style.overflow = 'auto';"
                            class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="#000000" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endteleport
        </div>
        @endforeach
        <p class="text-center text-sm text-gray-400">-- End of results --</p>
        @endif
    </div>
</div>