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
    <!-- CHATBOT -->
    <livewire:chatbot :current_route="'messages'"/>
    <div class="sm:transition-all sm:duration-300 sm:transform flex w-full"
        style="margin-top: 4.3rem; height: calc(100vh - 4.3rem); overflow: hidden;">
        <div class="flex antialiased text-gray-800 w-full">
            <div class="flex flex-row h-full w-full overflow-hidden">
                <div class="flex flex-col pt-2 px-4 w-full sm:w-80 md:w-80 lg:w-96 bg-white flex-shrink-0 border-r"
                    x-data="{ search: '' }">
                    <div class="self-start flex flex-row items-center justify-start h-12 w-full">
                        <a href="{{ route('dashboard') }}" class="p-1.5 mr-1 text-gray-700 hover:bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <div class="font-bold text-2xl">Messages</div>
                        <span class="ml-auto inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium w-fit {{ $user->role === 'customer' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div class="mt-2 w-full">
                        <form class="flex items-center max-w-full mx-auto w-full">
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
                    </div>
                    <div class="flex flex-col mt-4">
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
                        <div
                            class="flex flex-col mt-2 h-[calc(100svh-16rem)] sm:h-[calc(100svh-20rem)] overflow-y-auto scrollbar-hide gap-0.5">
                            @php
                            $conversations = $user->role === 'provider' ? $user->conversations_as_provider :
                            $user->conversations_as_customer;
                            @endphp

                            @foreach ($conversations as $convo)
                            @php
                            $isProvider = $user->role === 'provider';
                            $otherUser = App\Models\User::find($isProvider ? $convo->customer_id : $convo->provider_id);
                            $lastMessage = optional($convo->messages->first())->message ?? "Start messaging now.";
                            $lastMessageTime =
                            optional($convo->messages->first())->created_at?->timezone('Asia/Singapore')->diffForHumans();
                            @endphp

                            <!-- Filtering based on name -->
                            <a x-show="search === '' || '{{ strtolower($otherUser->name) }}'.includes(search.toLowerCase())"
                                class="flex flex-row items-start hover:bg-gray-200 rounded-md p-1.5 gap-2"
                                href="{{ route('message.view', ['convo_id' => $convo->id]) }}">

                                <div class="flex flex-shrink-0">
                                    <img src="{{ $otherUser->profile_pic_url }}" alt="profile_image"
                                        class="object-contain h-10 w-10 bg-gray-200 rounded-full border shadow">
                                </div>

                                <div class="flex flex-col text-sm font-semibold w-full">
                                    <p class="truncate">{{ $otherUser->name }}</p>

                                    <div class="flex items-center gap-1 text-gray-500 text-xs font-normal w-full">
                                        <p id="last_message_base-{{ $convo->id }}"
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
                                        <p id="last_message_time-{{ $convo->id }}" class="ml-auto sm:ml-0">
                                            ⋅ {{ $lastMessageTime }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="hidden sm:block mt-auto mb-2">
                        <hr class="mt-4 mb-2">
                        <div class="flex flex-col space-y-1 overflow-y-auto">
                            <a href="{{ route('profile', ['name' => $user->name]) }}"
                                class="flex flex-row items-center hover:bg-gray-200 rounded-md p-1 gap-2">
                                <div class="flex flex-shrink-0">
                                    <img src="{{ $user->profile_pic_url }}" alt="user_img"
                                        class="object-contain h-10 w-10 bg-gray-200 rounded-full border shadow">
                                </div>
                                <div class="text-sm font-semibold"> {{ $user->name }} </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium w-fit {{ $user->role === 'customer' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden sm:flex items-center justify-center w-full">
                    No conversation selected.
                </div>
            </div>
        </div>
    </div>
</div>
</div>