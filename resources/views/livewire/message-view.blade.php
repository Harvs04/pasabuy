<div class="font-poppins bg-gray-50"
    x-data="{ openBurger: false, isChangeRoleModalOpen: false, role: '{{ $user->role }}' }" x-cloak>

    @if(session('change_role_success'))
    <div
        class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
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

    <livewire:navbar />
    <livewire:sidebar />

    <div class="sm:transition-all sm:duration-300 sm:transform flex"
        style="margin-top: 4.3rem; height: calc(100vh - 4.3rem); overflow: hidden;">
        <div class="flex antialiased text-gray-800 w-full">
            <div class="flex flex-row h-full w-full overflow-hidden ">
                <div class="hidden sm:flex sm:flex-col pt-2 px-4 w-60 md:w-80 lg:w-96 bg-white flex-shrink-0 border-r">
                    <div class="self-start flex flex-row items-center justify-start h-12 w-full">
                        <div class="flex items-center justify-center rounded-2xl h-10 w-10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                        </div>
                        <div class="font-bold text-2xl">Messages</div>
                    </div>
                    <div
                        class="flex flex-col md:flex-row gap-2 items-start bg-gray-50 border border-gray-200 mt-2 w-full py-6 px-4 rounded-lg">
                        <div class="h-20 w-20 rounded-full border overflow-hidden">
                            @if ($user->role === 'provider')
                            <img src="{{ App\Models\User::where('id', $conversation->customer_id)->first()->profile_pic_url }}"
                                alt="Avatar" class="h-full w-full object-contain flex-shrink-0" />
                            @elseif ($user->role === 'customer')
                            <img src="{{ App\Models\User::where('id', $conversation->provider_id)->first()->profile_pic_url }}"
                                alt="Avatar" class="h-full w-full object-contain flex-shrink-0" />
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-semibold mt-2">
                                @if ($user->role === 'provider')
                                {{ App\Models\User::where('id', $conversation->customer_id)->first()->name }} </p>
                            @elseif ($user->role === 'customer')
                            {{ App\Models\User::where('id', $conversation->provider_id)->first()->name }} </p>
                            @endif
                            <div class="text-xs text-gray-500">
                                <p> {{ $user->role === 'provider' ? 'your customer in transaction #' : 'your provider in transaction #' }}{{ App\Models\Post::where('id', $order->post_id)->first()->id }}
                                </p>
                                <p>Item: {{ App\Models\Post::where('id', $order->post_id)->first()->item_name }}</p>
                                <p>Order: {{ $order->order }}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4 mb-2">
                    <div class="flex flex-col gap-3 mt-2 w-full">
                        <form class="flex items-center max-w-sm mx-auto w-full">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-4 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search"
                                    class="bg-gray-50 border focus:outline-none focus:border-gray-300 text-gray-900 text-sm rounded-lg block w-full ps-9 p-2.5"
                                    placeholder="Search name..." required />
                            </div>
                        </form>
                        <div class="flex flex-row gap-2 items-center text-xs">
                            <span class="font-bold ml-2">Active Conversations</span>
                            <span class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full">
                                @if ($user->role === 'provider')
                                {{ count($user->conversations_as_provider) }}
                                @elseif ($user->role === 'customer')
                                {{ count($user->conversations_as_customer) }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col mt-2 mb-2">
                        <div class="flex flex-col mt-2 h-40 md:h-[268px] overflow-y-auto scrollbar-hide">
                            @if ($user->role === 'provider')
                            @foreach ($user->conversations_as_provider as $convo)
                            <a class="flex flex-row items-center hover:bg-gray-100 rounded-md p-1.5 gap-2"
                                href="{{ route('message.view', ['convo_id' => $convo['id']]) }}">
                                <div class="flex flex-shrink-0">
                                    <img src="{{ App\Models\User::where('id', $convo['customer_id'])->first()->profile_pic_url }}"
                                        alt="customer_image"
                                        class="object-contain h-10 w-10 bg-indigo-200 rounded-full border shadow">
                                </div>
                                <div class="text-sm font-semibold">
                                    {{ App\Models\User::where('id', $convo['customer_id'])->first()->name }}
                                </div>
                            </a>
                            @endforeach
                            @elseif($user->role === 'customer')
                            @foreach ($user->conversations_as_customer as $convo)
                            <a class="flex flex-row items-center hover:bg-gray-100 rounded-md p-1.5 gap-2"
                                href="{{ route('message.view', ['convo_id' => $convo['id']]) }}">
                                <div class="flex flex-shrink-0">
                                    <img src="{{ App\Models\User::where('id', $convo['provider_id'])->first()->profile_pic_url }}"
                                        alt="customer_image"
                                        class="object-contain h-10 w-10 bg-indigo-200 rounded-full border shadow">
                                </div>
                                <div class="text-sm font-semibold">
                                    {{ App\Models\User::where('id', $convo['provider_id'])->first()->name }}
                                </div>
                            </a>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="flex flex-col mt-auto gap-2 mb-2">
                        <hr class="">
                        <div class="flex flex-col space-y-1 overflow-y-auto">
                            <a href="{{ route('profile', ['name' => $user->name] ) }}"
                                class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2 gap-2">
                                <div class="flex flex-shrink-0">
                                    <img src="{{ $user->profile_pic_url }}" alt="user_img"
                                        class="object-contain h-10 w-10 bg-indigo-200 rounded-full border shadow">
                                </div>
                                <div class="text-sm font-semibold"> {{ $user->name }} </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- MESSAGES CONTENT -->

                <!-- MESSAGE INPUT ROW -->
                <div class="flex flex-col w-full mt-auto" x-data="{ showDetailsOpen: false }">
                    @php
                    if ($user->role === 'provider') {
                    $conversation = $user->conversations_as_provider->firstWhere('customer_id',
                    $conversation->customer_id);
                    $receiver = App\Models\User::where('id', $conversation->customer_id)->first();
                    } else if ($user->role === 'customer') {
                    $conversation = $user->conversations_as_customer->firstWhere('provider_id',
                    $conversation->provider_id);
                    $receiver = App\Models\User::where('id', $conversation->provider_id)->first();
                    }
                    @endphp
                    <div class="flex sm:hidden w-full bg-white border-b border-gray-400 p-3 gap-2 items-center">
                        <a href="{{ route('messages') }}" class="p-2 hover:bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="h-5 w-5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </a>
                        <div class="flex gap-2 items-center font-poppins" @click="showDetailsOpen = true"
                            @click.outside="showDetailsOpen = false">
                            <img src="{{ $receiver->profile_pic_url }}" alt=""
                                class="h-10 w-10 rounded-full flex-shrink-0 border shadow">
                            <p class="font-medium">{{ $receiver->name }}</p>
                        </div>
                    </div>
                    @teleport('body')
                    <div @keydown.escape.window="showDetailsOpen = false; document.body.style.overflow = 'auto';"
                        x-show="showDetailsOpen" x-transition:enter.duration.25ms
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded-lg w-9/12 sm:w-4/6 md:w-5/12 xl:w-4/12 relative space-y-4">
                            <div class="flex flex-row items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#014421"
                                    class="size-5">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-lg font-semibold text-[#014421]">User details</p>
                                <button @click="showDetailsOpen = false; document.body.style.overflow = 'auto';"
                                    class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="#000000" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex flex-col">
                                <div class="h-20 w-20 rounded-full border overflow-hidden">
                                    <img src="{{ $receiver->profile_pic_url }}" alt="Avatar"
                                        class="h-full w-full object-contain flex-shrink-0" />
                                </div>
                                <p class="text-sm font-semibold mt-2">{{ $receiver->name }} </p>
                                <div class="text-sm text-gray-500">
                                    <p> {{ $user->role === 'provider' ? 'your customer in transaction #' : 'your provider in transaction #' }}{{ App\Models\Post::where('id', $order->post_id)->first()->id }}
                                    </p>
                                    <p>Item: {{ App\Models\Post::where('id', $order->post_id)->first()->item_name }}</p>
                                    <p>Order: {{ $order->order }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endteleport
                    <div class="overflow-y-auto flex flex-col-reverse h-[calc(100vh-12rem)] sm:h-[calc(100vh-150px)]"
                        wire:poll.keep-alive.3000ms>
                        @foreach ($conversation->messages as $message)
                        @if ($message->sender_id === $user->id)
                        <div class="ml-auto p-3 rounded-lg mr-2">
                            <div class="flex items-center justify-start flex-row-reverse"
                                x-data="{ showDateOpen: false }">
                                <div class="flex items-center justify-center">
                                    <img src="{{ $user->profile_pic_url }}" alt=""
                                        class="h-10 w-10 rounded-full flex-shrink-0 border shadow">
                                </div>
                                <div class="relative mr-3 text-sm bg-green-100 py-1.5 px-4 shadow rounded-xl max-w-[250px] md:max-w-[500px]"
                                    @mouseenter="showDateOpen = true" @mouseleave="showDateOpen = false">
                                    <div class="relative break-all"> {{ $message->message }} </div>
                                    <div class="absolute -top-8 right-0 bg-gray-100 p-1.5 opacity-90 font-medium text-xs border rounded-md shadow w-fit whitespace-nowrap inline-flex"
                                        x-show="showDateOpen">
                                        @if ($message->created_at->timezone('Singapore')->isToday())
                                        {{ $message->created_at->timezone('Singapore')->format('g:i A') }}
                                        @elseif ($message->created_at->timezone('Singapore')->isYesterday())
                                        Yesterday at {{ $message->created_at->timezone('Singapore')->format('g:i A') }}
                                        @else
                                        {{ $message->created_at->timezone('Singapore')->format('M d, Y g:i A') }}
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        @elseif($message->receiver_id === $user->id)
                        <div class="p-3 rounded-lg ml-2">
                            <div class="flex flex-row items-center" x-data="{ showDateOpen : false }">
                                <div
                                    class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                    <!-- image of chatter -->
                                    <img src="{{ App\Models\User::where('id', $receiver->id)->first()->profile_pic_url }}"
                                        alt="" class="h-10 w-10 rounded-full flex-shrink-0 border shadow">
                                </div>
                                <div class="relative ml-3 text-sm bg-white py-1.5 px-4 shadow rounded-xl max-w-[250px] md:max-w-[500px]"
                                    @mouseenter="showDateOpen = true" @mouseleave="showDateOpen = false">
                                    <div class="break-all relative">{{ $message->message }}</div>
                                    <div class="absolute -top-8 left-0 bg-gray-100 p-1.5 opacity-90 font-medium text-xs border rounded-md shadow w-fit whitespace-nowrap inline-flex"
                                        x-show="showDateOpen">
                                        @if ($message->created_at->timezone('Singapore')->isToday())
                                        {{ $message->created_at->timezone('Singapore')->format('g:i A') }}
                                        @elseif ($message->created_at->timezone('Singapore')->isYesterday())
                                        Yesterday at {{ $message->created_at->timezone('Singapore')->format('g:i A') }}
                                        @else
                                        {{ $message->created_at->timezone('Singapore')->format('M d, Y g:i A') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="flex flex-row items-center h-16 bg-white w-full gap-2 border-t px-2.5"
                        x-data="{ chatMessage: '' }">
                        <div>
                            <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="flex-grow">
                            <div class="relative w-full">
                                <input type="text"
                                    class="flex w-full border rounded-full text-sm focus:outline-none focus:border-gray-300 pl-4 h-10"
                                    x-model="chatMessage" @keydown.enter.window="if (chatMessage) { 
                                    if (role === 'provider') { 
                                        $wire.sendMessage(chatMessage, {{ $conversation->customer_id }}); 
                                    } else if (role === 'customer') { 
                                        $wire.sendMessage(chatMessage, {{ $conversation->provider_id }}); 
                                    } 
                                    chatMessage = ''; 
                                    }" />
                                <button
                                    class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="">
                            <button
                                class="w-fit flex items-center justify-center enabled:hover:bg-gray-100 rounded-full text-gray-400 p-1.5 flex-shrink-0 disabled:cursor-not-allowed"
                                :disabled="!chatMessage" @click="
                                if (chatMessage) { 
                                    if (role === 'provider') { 
                                        $wire.sendMessage(chatMessage, {{ $conversation->customer_id }}); 
                                    } else if (role === 'customer') { 
                                        $wire.sendMessage(chatMessage, {{ $conversation->provider_id }}); 
                                    } 
                                    chatMessage = ''; 
                                }">
                                <span class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>