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
                <div class="hidden sm:flex sm:flex-col pt-2 px-4 w-60 md:w-80 lg:w-96 bg-white flex-shrink-0 border-r" x-data="{ search: '' }">
                    <div class="self-start flex flex-row items-center justify-start h-12 w-full">
                        <a href="{{ route('messages') }}" class="p-1.5 mr-1 text-gray-700 hover:bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <div class="font-bold text-2xl">Messages</div>
                        <span class="ml-auto inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium w-fit {{ $user->role === 'customer' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div
                        class="flex flex-col md:flex-row gap-2 items-start bg-gray-50 border border-gray-200 mt-2 w-full py-6 px-4 rounded-lg">
                        <div class="rounded-full border flex-shrink-0 overflow-hidden">
                            @if ($user->role === 'provider')
                            <img src="{{ App\Models\User::where('id', $conversation->customer_id)->first()->profile_pic_url }}"
                                alt="Avatar" class="h-20 w-20 rounded-full object-contain" />
                            @elseif ($user->role === 'customer')
                            <img src="{{ App\Models\User::where('id', $conversation->provider_id)->first()->profile_pic_url }}"
                                alt="Avatar" class="h-20 w-20 rounded-full object-contain" />
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
                                <input type="text" id="simple-search" x-model="search"
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
                        <div class="flex flex-col mt-2 h-[calc(100svh-35rem)] md:h-[calc(100svh-30rem)] overflow-y-auto scrollbar-hide gap-0.5" >
                            @php
                                $conversations = $user->role === 'provider' ? $user->conversations_as_provider :
                                $user->conversations_as_customer;
                            @endphp
                            @if ($user->role === 'provider')
                                <div class="flex flex-row items-start bg-gray-200 rounded-md p-1.5 gap-2"
                                    x-show="search === ''"
                                    >
                                    <div class="flex flex-shrink-0">
                                        <img src="{{ App\Models\User::where('id', $conversation->customer_id)->first()->profile_pic_url }}"
                                            alt="customer_image"
                                            class="object-contain h-10 w-10 bg-gray-200 rounded-full border shadow">
                                    </div>
                                    <div class="flex flex-col text-sm font-semibold truncate">
                                        <p>
                                            {{ App\Models\User::where('id', $conversation->customer_id)->first()->name }}
                                        </p>
                                        <div class="flex items-center gap-1 text-gray-500 text-xs font-normal w-full">
                                        @php
                                        $lastMessage = optional($conversation->messages->first())->message ?? "Start messaging
                                        now.";
                                        $shouldTruncate = $lastMessage !== "Start messaging now.";
                                        $lastMessageTime =
                                        optional($conversation->messages->first())->created_at?->timezone('Asia/Singapore')->diffForHumans();
                                        @endphp

                                        <p id="last_message_view_current-{{ $conversation->id }}"
                                            class="{{ isset($shouldTruncate) && $shouldTruncate ? 'sm:truncate sm:max-w-[100px] lg:max-w-[170px]' : '' }}">

                                            @php
                                            $firstMessage = $conversation->messages->first();
                                            $sender = $firstMessage ? App\Models\User::find($firstMessage->sender_id) :
                                            null;
                                            $lastMessage = $firstMessage->message ?? "Start messaging now.";
                                            @endphp

                                            @if ($sender && $sender->id === $user->id)
                                            You:
                                            @elseif ($sender)
                                            {{ $sender->name }}:
                                            @endif
                                            {{ $lastMessage }}
                                        </p>

                                        @if($lastMessage !== 'Start messaging now.')
                                        <p id="last_message_view_time-{{ $conversation->id }}" class="ml-auto sm:ml-0">
                                            ⋅ {{ $lastMessageTime }}
                                        </p>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            @elseif($user->role === 'customer')
                                <div class="flex flex-row items-start bg-gray-200 rounded-md p-1.5 gap-2" x-show="search === ''"
                                    >
                                    <div class="flex flex-shrink-0">
                                        <img src="{{ App\Models\User::where('id', $conversation->provider_id)->first()->profile_pic_url }}"
                                            alt="customer_image"
                                            class="object-contain h-10 w-10 bg-gray-200 rounded-full border shadow">
                                    </div>
                                    <div class="flex flex-col text-sm font-semibold truncate">
                                        <p>
                                            {{ App\Models\User::where('id', $conversation->provider_id)->first()->name }}
                                        </p>
                                        <div class="flex items-center gap-1 text-gray-500 text-xs font-normal w-full">
                                        @php
                                        $lastMessage = optional($conversation->messages->first())->message ?? "Start messaging
                                        now.";
                                        $shouldTruncate = $lastMessage !== "Start messaging now.";
                                        $lastMessageTime =
                                        optional($conversation->messages->first())->created_at?->timezone('Asia/Singapore')->diffForHumans();
                                        @endphp

                                        <p id="last_message_view_current-{{ $conversation->id }}"
                                            class="{{ isset($shouldTruncate) && $shouldTruncate ? 'sm:truncate sm:max-w-[100px] lg:max-w-[170px]' : '' }}">

                                            @php
                                            $firstMessage = $conversation->messages->first();
                                            $sender = $firstMessage ? App\Models\User::find($firstMessage->sender_id) :
                                            null;
                                            $lastMessage = $firstMessage->message ?? "Start messaging now.";
                                            @endphp

                                            @if ($sender && $sender->id === $user->id)
                                            You:
                                            @elseif ($sender)
                                            {{ $sender->name }}:
                                            @endif
                                            {{ $lastMessage }}
                                        </p>

                                        @if($lastMessage !== 'Start messaging now.')
                                        <p id="last_message_view_time-{{ $conversation->id }}" class="ml-auto sm:ml-0">
                                            ⋅ {{ $lastMessageTime }}
                                        </p>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            @endif
                            @foreach ($conversations as $convo)
                            @php
                            $isProvider = $user->role === 'provider';
                            $otherUser = App\Models\User::find($isProvider ? $convo->customer_id : $convo->provider_id);
                            $lastMessage = optional($convo->messages->first())->message ?? "Start messaging now.";
                            $lastMessageTime =
                            optional($convo->messages->first())->created_at?->timezone('Asia/Singapore')->diffForHumans();
                            @endphp

                            <!-- Filtering based on name -->
                                @if ($convo_id !== $convo->id)
                                    <a x-show="search === '' || '{{ strtolower($otherUser->name) }}'.includes(search.toLowerCase())"
                                        class="flex flex-row items-start hover:bg-gray-200 rounded-md p-1.5 gap-2 truncate"
                                        href="{{ route('message.view', ['convo_id' => $convo->id]) }}">

                                        <div class="flex flex-shrink-0">
                                            <img src="{{ $otherUser->profile_pic_url }}" alt="profile_image"
                                                class="object-contain h-10 w-10 bg-gray-200 rounded-full border shadow">
                                        </div>

                                        <div class="flex flex-col text-sm font-semibold w-full">
                                            <p class="truncate">{{ $otherUser->name }}</p>

                                            <div class="flex items-center gap-1 text-gray-500 text-xs font-normal w-full">
                                                <p id="last_message_view_base-{{ $convo->id }}"
                                                    class="{{ $lastMessage !== 'Start messaging now.' ? 'sm:truncate sm:max-w-[100px] lg:max-w-[170px]' : '' }}">
                                                    @php
                                                    $firstMessage = $convo->messages->first();
                                                    $sender = $firstMessage ? App\Models\User::find($firstMessage->sender_id) :
                                                    null;
                                                    @endphp

                                                    @if ($sender && $sender->id === $user->id)
                                                    You:
                                                    @elseif ($sender)
                                                    {{ $sender->name }}:
                                                    @endif
                                                    {{ $lastMessage }}
                                                </p>

                                                @if ($lastMessage !== 'Start messaging now.')
                                                <p id="last_message_view_time-{{ $convo->id }}" class="ml-auto sm:ml-0">
                                                    ⋅ {{ $lastMessageTime }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-col mt-auto gap-2 mb-2">
                        <hr class="">
                        <div class="flex flex-col space-y-1 overflow-y-auto">
                            <a href="{{ route('profile', ['name' => $user->name] ) }}"
                                class="flex flex-row items-center hover:bg-gray-200 rounded-md p-1 gap-2">
                                <div class="flex flex-shrink-0">
                                    <img src="{{ $user->profile_pic_url }}" alt="user_img"
                                        class="object-contain h-10 w-10 bg-gray-200 rounded-full border shadow">
                                </div>
                                <div class="text-sm font-semibold"> {{ $user->name }} </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- MESSAGES CONTENT -->

                <!-- MESSAGE INPUT ROW -->
                <div class="flex flex-col w-full" x-data="{ showDetailsOpen: false }">
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
                                class="h-10 w-10 object-contain rounded-full flex-shrink-0 border shadow">
                            <p class="font-medium">{{ $receiver->name }}</p>
                        </div>
                    </div>
                    @teleport('body')
                    <div @keydown.escape.window="showDetailsOpen = false; document.body.style.overflow = 'auto';"
                        x-show="showDetailsOpen" 
                        class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 backdrop-blur-sm">
                        <div class="bg-white p-8 rounded-xl w-11/12 sm:w-4/6 xl:w-4/12 relative space-y-6 shadow-2xl">
                            <!-- Header with improved design -->
                            <div class="flex flex-row items-center gap-3 border-b border-gray-100 pb-4">
                                <div class="bg-[#014421] bg-opacity-10 p-2 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#014421"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-xl font-semibold text-[#014421]">User Details</p>
                                <button @click="showDetailsOpen = false; document.body.style.overflow = 'auto';"
                                    class="absolute top-6 right-6 p-2 hover:bg-gray-100 rounded-full transition duration-150 focus:outline-none focus:ring-2 focus:ring-[#014421] focus:ring-opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="#000000" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- User profile area with improved design -->
                            <div class="flex flex-row items-center space-x-4">
                                <div class="h-24 w-24 rounded-full border-4 border-[#014421] border-opacity-20 overflow-hidden shadow-md">
                                    <img src="{{ $receiver->profile_pic_url }}" alt="{{ $receiver->name }}'s Avatar"
                                        class="h-full w-full object-cover flex-shrink-0" onerror="this.src='/images/default-avatar.png';" />
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-gray-800">{{ $receiver->name }}</p>
                                    <p class="text-sm text-[#014421] italic font-medium">
                                        {{ $user->role === 'provider' ? 'Your customer' : 'Your provider' }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Transaction details with improved design -->
                            <div class="bg-gray-50 p-4 rounded-lg space-y-2 mt-4">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-medium text-gray-500">Transaction ID</p>
                                    <p class="text-sm font-semibold">#{{ App\Models\Post::where('id', $order->post_id)->first()->id }}</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-gray-200 pt-2">
                                    <p class="text-sm font-medium text-gray-500">Item</p>
                                    <p class="text-sm font-semibold">{{ App\Models\Post::where('id', $order->post_id)->first()->item_name }}</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-gray-200 pt-2">
                                    <p class="text-sm font-medium text-gray-500">Order</p>
                                    <p class="text-sm font-semibold">{{ $order->order }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endteleport
                    <div class="overflow-y-auto flex flex-col-reverse h-[calc(100vh-12rem)] sm:h-[calc(100vh-8rem)]"
                        id="messages-container">
                        @foreach ($conversation->messages as $message)
                        @if ($message->sender_id === $user->id)
                        <div class="ml-auto p-3 rounded-lg mr-2">
                            <div class="flex items-center justify-start flex-row-reverse"
                                x-data="{ showDateOpen: false }">
                                <div class="flex items-center justify-center">
                                    <img src="{{ $user->profile_pic_url }}" alt=""
                                        class="h-10 w-10 object-contain rounded-full flex-shrink-0 border shadow">
                                </div>
                                <div class="relative mr-3 text-sm bg-green-100 py-1.5 px-4 shadow rounded-md max-w-[250px] sm:max-w-[275x] md:max-w-[300px] lg:max-w-lg xl:max-w-3xl"
                                    @mouseenter="showDateOpen = true" @mouseleave="showDateOpen = false">
                                    <div class="relative break-words"> {{ $message->message }} </div>
                                    <div class="absolute -top-8 right-0 bg-gray-100 p-1.5 opacity-90 font-medium text-xs border rounded-md shadow w-fit whitespace-nowrap inline-flex"
                                        x-show="showDateOpen">
                                        @if ($message->created_at->timezone('Singapore')->isToday())
                                        {{ $message->created_at->timezone('Singapore')->format('g:i A') }}
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
                                    class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-200 flex-shrink-0">
                                    <!-- image of chatter -->
                                    <img src="{{ App\Models\User::where('id', $receiver->id)->first()->profile_pic_url }}"
                                        alt="" class="h-10 w-10 object-contain rounded-full flex-shrink-0 border shadow">
                                </div>
                                <div class="relative ml-3 text-sm bg-white py-1.5 px-4 shadow rounded-md max-w-[250px] sm:max-w-[275x] md:max-w-[300px] lg:max-w-lg xl:max-w-3xl"
                                    @mouseenter="showDateOpen = true" @mouseleave="showDateOpen = false">
                                    <div class="break-words relative">{{ $message->message }}</div>
                                    <div class="absolute -top-8 left-0 bg-gray-100 p-1.5 opacity-90 font-medium text-xs border rounded-md shadow w-fit whitespace-nowrap inline-flex"
                                        x-show="showDateOpen">
                                        @if ($message->created_at->timezone('Singapore')->isToday())
                                        {{ $message->created_at->timezone('Singapore')->format('g:i A') }}
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
                                    class="flex w-full border rounded-full text-sm focus:outline-none focus:border-gray-300 pl-4 h-10 pe-6"
                                    x-model="chatMessage" @keydown.enter.window="if (chatMessage.trim().length > 0) { 
                                    if (role === 'provider') { 
                                        $wire.sendMessage(chatMessage, '{{ $conversation->customer_id }}'); 
                                    } else if (role === 'customer') { 
                                        $wire.sendMessage(chatMessage, '{{ $conversation->provider_id }}'); 
                                    } 
                                    chatMessage = ''; 
                                    }" />
                            </div>
                        </div>
                        <div class="">
                            <button
                                class="w-fit flex items-center justify-center enabled:hover:bg-gray-100 rounded-full text-gray-400 p-1.5 flex-shrink-0 disabled:cursor-not-allowed"
                                x-bind:disabled="chatMessage.trim().length === 0" @click="
                                if (chatMessage.trim().length > 0) { 
                                    if (role === 'provider') { 
                                        $wire.sendMessage(chatMessage, '{{ $conversation->customer_id }}'); 
                                    } else if (role === 'customer') { 
                                        $wire.sendMessage(chatMessage, '{{ $conversation->provider_id }}'); 
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

<script>
    let messagesContainer = document.getElementById("messages-container");
    messagesContainer.scrollTo(0, messageContainer.scrollHeight);
</script>
