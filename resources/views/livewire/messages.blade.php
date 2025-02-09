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
        <div class="flex antialiased text-gray-800">
            <div class="flex flex-row h-full w-full overflow-hidden">
                <div
                    class="hidden sm:flex sm:flex-col pt-2 px-4 w-60 md:w-80 lg:w-96 bg-white flex-shrink-0">
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
                        class="flex flex-col items-center bg-gray-50 border border-gray-200 mt-2 w-full py-6 px-4 rounded-lg">
                        <div class="h-20 w-20 rounded-full border overflow-hidden">
                            <img src="https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif"
                                alt="Avatar" class="h-full w-full" />
                        </div>
                        <div class="text-sm font-semibold mt-2">Aminos Co.</div>
                        <div class="text-xs text-gray-500">Lead UI/UX Designer</div>
                        <div class="flex flex-row items-center mt-3">
                            <div class="flex flex-col justify-center h-4 w-8 bg-indigo-500 rounded-full">
                                <div class="h-3 w-3 bg-white rounded-full self-end mr-1"></div>
                            </div>
                            <div class="leading-none ml-1 text-xs">Active</div>
                        </div>
                    </div>
                    <hr class="mt-4 mb-2">
                    <div class="mt-2">
                        <form class="flex items-center max-w-sm mx-auto">
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
                    </div>
                    <div class="flex flex-col mt-auto mb-2">
                        <div class="flex flex-row gap-2 items-center text-xs">
                            <span class="font-bold">Active Conversations</span>
                            <span class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full">
                                @if ($user->role === 'provider')
                                {{ count($user->conversations_as_provider) }}
                                @elseif ($user->role === 'customer')
                                {{ count($user->conversations_as_customer) }}
                                @endif
                            </span>
                        </div>
                        <div class="flex flex-col mt-2 h-48 overflow-y-auto scrollbar-hide">
                            @if ($user->role === 'provider')
                                @foreach ($user->conversations_as_provider as $convo)
                                    <button class="flex flex-row items-center hover:bg-gray-100 rounded-md p-1.5 gap-2" @click="$wire.messageView({{ $convo->customer_id }})">
                                        <div class="flex flex-shrink-0">
                                            <img src="{{ App\Models\User::where('id', $convo->customer_id)->first()->profile_pic_url }}"
                                                alt="customer_image"
                                                class="object-contain h-10 w-10 bg-indigo-200 rounded-full border shadow">
                                        </div>
                                        <div class="text-sm font-semibold">
                                            {{ App\Models\User::where('id', $convo->customer_id)->first()->name }}</div>
                                    </button>
                                @endforeach
                            @elseif($user->role === 'customer')
                                @foreach ($user->conversations_as_customer as $convo)
                                    <button class="flex flex-row items-center hover:bg-gray-100 rounded-md p-1.5 gap-2" @click="$wire.messageView({{ $convo->provider_id }})">
                                        <div class="flex flex-shrink-0">
                                            <img src="{{ App\Models\User::where('id', $convo->provider_id)->first()->profile_pic_url }}"
                                                alt="customer_image"
                                                class="object-contain h-10 w-10 bg-indigo-200 rounded-full border shadow">
                                        </div>
                                        <div class="text-sm font-semibold">
                                            {{ App\Models\User::where('id', $convo->provider_id)->first()->name }}</div>
                                    </button>
                                @endforeach
                            @endif
                        </div>
                        <hr class="mt-4 mb-2">
                        <div class="flex flex-col space-y-1 overflow-y-auto">
                            <button class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2 gap-2">
                                <div class="flex flex-shrink-0">
                                    <img src="{{ $user->profile_pic_url }}" alt="user_img"
                                        class="object-contain h-10 w-10 bg-indigo-200 rounded-full border shadow">
                                </div>
                                <div class="text-sm font-semibold"> {{ $user->name }} </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col flex-auto h-full">
                    <div class="flex flex-col flex-auto flex-shrink-0 bg-gray-100 h-full px-4 pt-4 pb-2">
                        <div class="flex flex-col h-full overflow-x-auto mb-2">
                            <div class="flex flex-col h-full">
                                <div class="grid grid-cols-12 gap-y-2">
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                        <div class="flex flex-row items-center">
                                            <div
                                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                A
                                            </div>
                                            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                <div>Hey How are you today?</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                        <div class="flex flex-row items-center">
                                            <div
                                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                A
                                            </div>
                                            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                <div>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                                    elit. Vel ipsa commodi illum saepe numquam maxime
                                                    asperiores voluptate sit, minima perspiciatis.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                        <div class="flex items-center justify-start flex-row-reverse">
                                            <div
                                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                A
                                            </div>
                                            <div
                                                class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                <div>I'm ok what about you?</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                        <div class="flex items-center justify-start flex-row-reverse">
                                            <div
                                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                A
                                            </div>
                                            <div
                                                class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                <div>
                                                    Lorem ipsum dolor sit, amet consectetur adipisicing. ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                        <div class="flex flex-row items-center">
                                            <div
                                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                A
                                            </div>
                                            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                <div>Lorem ipsum dolor sit amet !</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                        <div class="flex items-center justify-start flex-row-reverse">
                                            <div
                                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                A
                                            </div>
                                            <div
                                                class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                <div>
                                                    Lorem ipsum dolor sit, amet consectetur adipisicing. ?
                                                </div>
                                                <div class="absolute text-xs bottom-0 right-0 -mb-5 mr-2 text-gray-500">
                                                    Seen
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                        <div class="flex flex-row items-center">
                                            <div
                                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                A
                                            </div>
                                            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                <div>
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                    Perspiciatis, in.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                        <div class="flex flex-row items-center">
                                            <div
                                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                A
                                            </div>
                                            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                <div class="flex flex-row items-center">
                                                    <button
                                                        class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-800 rounded-full h-8 w-10">
                                                        <svg class="w-6 h-6 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </button>
                                                    <div class="flex flex-row items-center space-x-px ml-4">
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-4 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-8 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-8 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-10 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-10 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-12 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-10 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-6 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-5 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-4 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-3 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-10 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-10 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-8 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-8 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-1 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-1 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-8 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-8 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-2 w-1 bg-gray-500 rounded-lg"></div>
                                                        <div class="h-4 w-1 bg-gray-500 rounded-lg"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- MESSAGE INPUT ROW -->
                        <div class="flex flex-row items-center h-16 rounded-md bg-white w-full px-2 gap-2">
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
                                        class="flex w-full border rounded-full focus:outline-none focus:border-gray-300 pl-4 h-10" />
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
                                    class="w-fit flex items-center justify-center hover:bg-gray-100 rounded-full text-gray-400 p-1.5 flex-shrink-0">
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
</div>