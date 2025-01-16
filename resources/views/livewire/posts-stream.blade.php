<div class="{{ $posts->count() <= 1 ? 'h-[calc(100vh-13rem)]' : 'h-full' }}">
    <div class="flex flex-col gap-4">
        @if($posts->count() === 0)
            <div class="flex flex-row gap-2 self-center text-sm sm:text-base text-gray-400">
                <p class="">Seems empty in here.</p>
                <button @click="createPostModalOpen = true" class="underline">Create a post</button>
            </div>
        @else
            @foreach($posts as $post)
                <div class="pt-3 px-3 pb-2 bg-white border-2 border-white shadow-sm rounded-md text-gray-800 text-sm">
                    <div class="flex flex-row items-start gap-3">
                        <img class="w-9 md:w-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        <div class="flex flex-col">
                            <div class="flex flex-row text-sm gap-1">
                                <p class="font-semibold"> {{ $post->poster_name }} </p>
                                <p class="">{{  $post->type === 'item_request' ? 'is looking for:' : 'is buying:' }} </p>
                            </div>
                            <p class="text-xs"> {{ $post->created_at->timezone('Asia/Singapore')->format('F j, Y \a\t H:i') }}</p>
                        </div>
                        @php
                            $colorClass = match($post->status) {
                                'open' => 'text-xs font-medium px-2.5 py-1 rounded bg-green-900 text-white',
                                'ongoing' => 'bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300',
                                'closed' => 'bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-gray-700 dark:text-gray-300',
                                'cancelled' => 'bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-red-900 dark:text-red-300'
                            };
                        @endphp
                        <div class="flex flex-row gap-1 ml-auto">
                            <span class="{{ $colorClass }}">
                                <!-- For larger screens (>=640px) -->
                                <span class="hidden lg:inline">
                                    {{ ucwords($post->status) }}
                                    @if($post->status !== 'closed' && $post->status !== 'cancelled' && $post->type === 'transaction')
                                        {{ $post->type === 'item_request' ? 'Item request' : 'transaction'}}: {{ $post->order_count }}/{{ $post->max_orders }}
                                    @else
                                        {{ $post->type === 'item_request' ? 'Item request' : 'transaction'}}
                                    @endif
                                </span>

                                <!-- For smaller screens (<640px) -->
                                <span class="flex flex-row gap-1 lg:hidden">
                                    @if($post->type === 'item_request')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    @elseif($post->type === 'transaction')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    @endif
                                    @if($post->status !== 'closed' && $post->status !== 'cancelled' && $post->type === 'transaction')
                                        {{ $post->order_count }}/{{ $post->max_orders }}
                                    @endif
                                </span>
                            </span>
                        </div>

                    </div>
                    @if($post->type === 'item_request')
                        <div class="mt-4 ml-1 flex flex-col gap-3">
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold">Item name:</p> 
                                    <p class="">{{ $post->item_name }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold">Item origin:</p> 
                                    <p class="">{{ $post->item_origin }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Item type:</p> 
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
                            <div class="flex flex-row gap-2 items-start text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Mode of payment:</p> 
                                    <p>{{ implode(', ', json_decode($post->mode_of_payment)) }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Delivery date:</p> 
                                    <p>{{ $post->delivery_date->format('F j, Y') }}</p>
                                </div>
                            </div>
                            @if($post->additional_notes !== null)
                                <div class="flex flex-row gap-2 items-start text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <div class="flex flex-row flex-wrap gap-1 overflow-hidden">
                                        <p class="font-semibold whitespace-nowrap">Other details:</p>
                                        <p class="break-all pr-1">{{ $post->additional_notes }}</p>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <hr class="my-2">
                                <div class="flex flex-row gap-1 text-gray-600 text-sm items-center">
                                    <p class="w-2/12 ml-2">5 others</p>
                                    <button class="ml-auto w-4/12 md:w-5/12 py-1.5 enabled:hover:bg-gray-200 enabled:hover:rounded-md disabled:bg-gray-300 disabled:text-gray-400 disabled:rounded-md" :disabled="'{{ $user->role }}' === 'provider'">
                                        <div class="flex flex-row items-center justify-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                            </svg>
                                            <p class="hidden md:block md:font-medium">I want this too!</p>
                                        </div>
                                    </button>
                                    <button class="w-4/12 md:w-5/12 py-1.5 enabled:hover:bg-gray-200 enabled:hover:rounded-md disabled:bg-gray-300 disabled:text-gray-400 disabled:rounded-md" :disabled="'{{ $user->role }}' === 'customer'">
                                        <div class="flex flex-row items-center justify-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                            <p  class="hidden md:block md:font-medium">Initiate Transaction</p>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @elseif($post->type === 'transaction')
                        <div class="mt-4 ml-1 flex flex-col gap-3">
                            <p class="text-[#014421] font-semibold underline">Item Details</p>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold">Item name:</p> 
                                    <p class="">{{ $post->item_name }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold">Item origin:</p> 
                                    <p class="">{{ $post->item_origin }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Item type:</p> 
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
                                        <p class="font-semibold whitespace-nowrap">Subtag:</p>
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
                            <hr>
                            <p class="text-[#014421] font-semibold underline">Transaction Details</p>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold">Taking orders until:</p> 
                                    <p class="">{{ $post->cutoff_date->format('F j, Y') }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Transaction fee:</p> 
                                    <p>{{ $post->transaction_fee }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Mode of payment:</p> 
                                    <p>{{ implode(', ', json_decode($post->mode_of_payment)) }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Delivery date:</p> 
                                    <p>{{ $post->delivery_date->format('F j, Y') }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Arrival time:</p> 
                                    <p>{{ DateTime::createFromFormat('H:i:s', $post->arrival_time)->format('g:i a') }}</p>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <div class="flex flex-row gap-2 items-start">
                                    <p class="font-semibold whitespace-nowrap">Meetup place:</p> 
                                    <p>{{ $post->meetup_place }}</p>
                                </div>
                            </div>
                            <div>
                                <hr class="my-2">
                                <div class="flex flex-row gap-1 text-gray-600 text-sm items-center">
                                    <p class="w-2/12 ml-2">5 others</p>
                                    <button class="ml-auto w-4/12 md:w-5/12 py-1.5 enabled:hover:bg-gray-200 enabled:hover:rounded-md disabled:bg-gray-300 disabled:text-gray-400 disabled:rounded-md" :disabled="'{{ $user->role }}' === 'provider'">
                                        <div class="flex flex-row items-center justify-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <p class="hidden md:block md:font-medium">I want this too!</p>
                                        </div>
                                    </button>
                                    <button class="w-4/12 md:w-5/12 py-1.5 enabled:hover:bg-gray-200 enabled:hover:rounded-md disabled:bg-gray-300 disabled:text-gray-400 disabled:rounded-md" :disabled="'{{ $user->role }}' === 'customer'">
                                        <div class="flex flex-row items-center justify-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                            <p  class="hidden md:block md:font-medium">Initiate Transaction</p>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            <p class="text-center text-sm text-gray-400">-- End of results --</p>
        @endif
    </div>
</div>  