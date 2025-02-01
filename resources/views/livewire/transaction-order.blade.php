<div class="font-poppins bg-gray-50"
    x-data="{ openBurger: false, isChangeRoleModalOpen: false, deleteOrderModalOpen: false, status: '{{ $order->item_status }}', firstClicked: '{{ in_array($order->item_status, ['Acquired', 'Delivered', 'Rated']) }}', secondClicked: '{{ in_array($order->item_status, ['Delivered', 'Rated']) }}', thirdClicked: '{{ in_array($order->item_status, ['Rated']) }}', updateMode: false, openTransactionDots: false, transactionStatus: '{{ $transaction->status }}' }"
    x-cloak>

    @if(session('start_success'))
        <div
            class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 mid:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                    {{ session('start_success') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
    @elseif(session('error'))
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
    @endif

    <livewire:navbar />
    <livewire:sidebar />

    <!-- LOADING STATE -->
    @teleport('body')
    <div wire:loading.delay wire:target="updateStatus, deleteOrder"
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

    <!-- CONTENT -->
    <div class="sm:transition-all sm:duration-300 sm:transform relative flex flex-col-reverse mid:flex-row"
        style="margin-top: 4.3rem;" :class="{'lg:ml-64 xl:ml-96': openBurger, 'mid:ml-0': !openBurger}">
        <div class="p-4 w-full">
            <div class="relative overflow-x-auto shadow-md rounded-lg w-full">
                <div class="p-5 text-left rtl:text-right text-gray-800 bg-white overflow-hidden flex flex-col">
                    <div class="flex flex-row gap-2 items-center">
                        <a href="{{ route('transaction.view', ['id' => $order->post_id]) }}"
                            class="p-1.5 hover:bg-gray-100 hover:rounded-full hidden mid:block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </a>
                        <p class="text-lg mid:text-xl font-semibold">Order details: </p>
                        <p class="text-lg mid:text-xl font-semibold text-gray-600">#{{ $order->id }}</p>
                    </div>
                    <hr class="mt-4">
                    <div class="p-0 py-4 md:p-4">
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <p class="text-lg font-semibold">Order tracking</p>
                                <div class="flex gap-2 ml-auto">
                                    <!-- Update/Save Button -->
                                    <button type="button" @click="updateMode = true"
                                        class="px-3 py-1.5 text-xs md:text-sm font-medium text-white inline-flex items-center justify-center sm:justify-start bg-[#014421] hover:bg-green-800 rounded-lg text-center">

                                        <!-- SVG Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white sm:me-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>

                                        <!-- Dynamic Text -->
                                        <span class="hidden sm:block" x-text="!updateMode ? 'Update' : 'Save'"></span>
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button" @click="deleteOrderModalOpen = true; document.body.style.overflow = 'hidden';"
                                        class="px-3 py-1.5 text-xs md:text-sm font-medium text-white inline-flex items-center justify-center sm:justify-start bg-red-800 hover:bg-[#7b1113] rounded-lg text-center">

                                        <!-- SVG Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4 text-white sm:me-2">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <!-- Dynamic Text -->
                                        <span class="hidden sm:block">Delete order</span>
                                    </button>
                                </div>

                            </div>
                            <div class="mt-4 flex justify-center">
                                <ol class="hidden md:flex w-full gap-8 items-center">
                                    <!-- Step 1: Item purchased -->
                                    <li class="group relative flex-1 after:content-[''] after:bg-gray-200 after:h-0.5 after:w-full after:absolute after:top-1/2 after:right-[-50%] after:z-0"
                                        :class="{ 'hover:after:bg-green-800': updateMode , 'after:bg-green-800' : firstClicked || secondClicked || thirdClicked}"
                                        @click="if (updateMode){firstClicked = !firstClicked; secondClicked = false; thirdClicked = false;}">
                                        <div :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : firstClicked || secondClicked || thirdClicked}"
                                            class="flex items-center gap-4 h-24 p-4 bg-gray-50 rounded-lg shadow z-10 relative">
                                            <div class="rounded-lg flex items-center justify-center h-10 w-10 bg-gray-200"
                                                :class="{'group-hover:bg-green-700' : updateMode , 'bg-green-700' : firstClicked || secondClicked || thirdClicked}">
                                                <span class="'text-gray-600'"
                                                    :class="{'group-hover:text-white group-hover:bg-green-700' : updateMode, 'text-white' : firstClicked || secondClicked || thirdClicked}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M15.9998 7C15.9998 9.20914 14.2089 11 11.9998 11C9.79067 11 7.99981 9.20914 7.99981 7C7.99981 4.79086 9.79067 3 11.9998 3C14.2089 3 15.9998 4.79086 15.9998 7Z"
                                                            stroke="currentColor" stroke-width="1.6" />
                                                        <path
                                                            d="M11.9998 14C9.15153 14 6.65091 15.3024 5.23341 17.2638C4.48341 18.3016 4.10841 18.8204 4.6654 19.9102C5.2224 21 6.1482 21 7.99981 21H15.9998C17.8514 21 18.7772 21 19.3342 19.9102C19.8912 18.8204 19.5162 18.3016 18.7662 17.2638C17.3487 15.3024 14.8481 14 11.9998 14Z"
                                                            stroke="currentColor" stroke-width="1.6" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <!-- Text Section -->
                                            <div class="flex flex-col">
                                                <h6 class="text-base font-semibold text-black mb-0.5">Item purchased
                                                </h6>
                                                <p class="text-xs font-normal text-gray-500">Item acquired by the
                                                    provider</p>
                                            </div>
                                        </div>
                                    </li>


                                    <!-- Step 2: Item Delivered -->
                                    <li class="group relative flex-1 after:content-[''] after:h-0.5 after:w-full after:bg-gray-200 after:absolute after:top-1/2 after:right-[-50%] after:z-0"
                                        :class="{'hover:after:bg-green-700 cursor-pointer' : updateMode, 'after:bg-green-700' : secondClicked || thirdClicked }"
                                        @click="if (updateMode) {secondClicked = !secondClicked; firstClicked = false; thirdClicked = false;}">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow z-10 relative"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : secondClicked || thirdClicked }">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode, 'bg-green-700' : secondClicked || thirdClicked }">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : secondClicked || thirdClicked }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M8 5.99985H7C5.11438 5.99985 4.17157 5.99985 3.58579 6.58564C3 7.17142 3 8.11423 3 9.99985V16.9998C3 18.8855 3 19.8283 3.58579 20.4141C4.17157 20.9998 5.11438 20.9998 7 20.9998H17C18.8856 20.9998 19.8284 20.9998 20.4142 20.4141C21 19.8283 21 18.8855 21 16.9998V9.99985C21 8.11423 21 7.17142 20.4142 6.58564C19.8284 5.99985 18.8856 5.99985 17 5.99985H16M12 17.9998V17.9284C12 17.53 12 17.3308 11.9624 17.1661C11.8342 16.6043 11.3955 16.1657 10.8338 16.0375C10.669 15.9998 10.4698 15.9998 10.0714 15.9998H8C7.53501 15.9998 7.30252 15.9998 7.11177 16.051C6.59413 16.1897 6.18981 16.594 6.05111 17.1116C6 17.3024 6 17.5349 6 17.9998M15 12.9998H18M15 15.9998H18M10.5 12.4998C10.5 13.3283 9.82843 13.9998 9 13.9998C8.17157 13.9998 7.5 13.3283 7.5 12.4998C7.5 11.6714 8.17157 10.9998 9 10.9998C9.82843 10.9998 10.5 11.6714 10.5 12.4998ZM10.25 5.47472V6.24985C10.25 6.95208 10.25 7.3032 10.4185 7.55542C10.4915 7.66461 10.5852 7.75836 10.6944 7.83132C10.9467 7.99985 11.2978 7.99985 12 7.99985C12.7022 7.99985 13.0533 7.99985 13.3056 7.83132C13.4148 7.75836 13.5085 7.66461 13.5815 7.55542C13.75 7.3032 13.75 6.95208 13.75 6.24985V5.47472C13.75 5.16873 13.75 5.01573 13.7069 4.87378C13.6879 4.8111 13.6628 4.75043 13.6319 4.69267C13.562 4.56185 13.4538 4.45366 13.2374 4.23729C12.7409 3.74073 12.4926 3.49246 12.1951 3.43328C12.0663 3.40766 11.9337 3.40766 11.8049 3.43328C11.5074 3.49246 11.2591 3.74073 10.7626 4.23729C10.5462 4.45366 10.438 4.56185 10.3681 4.69267C10.3372 4.75043 10.3121 4.8111 10.2931 4.87378C10.25 5.01573 10.25 5.16873 10.25 5.47472Z"
                                                            stroke="currentColor" stroke-width="1.6"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex flex-col">
                                                <h6 class="text-base font-semibold text-black mb-0.5">Item Delivered
                                                </h6>
                                                <p class="text-xs font-normal text-gray-500">Item received by the
                                                    customer</p>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- Step 3: Transaction rating -->
                                    <li class="relative flex-1 group"
                                        @click="if (updateMode) {thirdClicked = !thirdClicked; firstClicked = false; secondClicked = false;}">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : thirdClicked}">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode, 'bg-green-700' : thirdClicked}">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : thirdClicked}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M15.9998 7C15.9998 9.20914 14.2089 11 11.9998 11C9.79067 11 7.99981 9.20914 7.99981 7C7.99981 4.79086 9.79067 3 11.9998 3C14.2089 3 15.9998 4.79086 15.9998 7Z"
                                                            stroke="currentColor" stroke-width="1.6" />
                                                        <path
                                                            d="M11.9998 14C9.15153 14 6.65091 15.3024 5.23341 17.2638C4.48341 18.3016 4.10841 18.8204 4.6654 19.9102C5.2224 21 6.1482 21 7.99981 21H15.9998C17.8514 21 18.7772 21 19.3342 19.9102C19.8912 18.8204 19.5162 18.3016 18.7662 17.2638C17.3487 15.3024 14.8481 14 11.9998 14Z"
                                                            stroke="currentColor" stroke-width="1.6" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex flex-col">
                                                <h6 class="text-base font-semibold text-black mb-0.5">Transaction rating
                                                </h6>
                                                <p class="text-xs font-normal text-gray-500">Transaction rated by the
                                                    customer</p>
                                            </div>
                                        </div>
                                    </li>
                                </ol>

                                <ol class="block md:hidden space-y-8">
                                    <li class="group after:bg-gray-200 relative flex-1 after:content-[''] after:w-0.5 after:h-full after:inline-block after:absolute after:-bottom-11 after:left-1/2"
                                        :class="{ 'hover:after:bg-green-800': updateMode , 'after:bg-green-800' : firstClicked || secondClicked || thirdClicked}"
                                        @click="if (updateMode){firstClicked = !firstClicked; secondClicked = false; thirdClicked = false;}">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow z-10 relative"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421] cursor-pointer' : firstClicked || secondClicked || thirdClicked}">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode,'bg-green-700' : firstClicked || secondClicked || thirdClicked}">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : firstClicked || secondClicked || thirdClicked }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M15.9998 7C15.9998 9.20914 14.2089 11 11.9998 11C9.79067 11 7.99981 9.20914 7.99981 7C7.99981 4.79086 9.79067 3 11.9998 3C14.2089 3 15.9998 4.79086 15.9998 7Z"
                                                            stroke="currentColor" stroke-width="1.6" />
                                                        <path
                                                            d="M11.9998 14C9.15153 14 6.65091 15.3024 5.23341 17.2638C4.48341 18.3016 4.10841 18.8204 4.6654 19.9102C5.2224 21 6.1482 21 7.99981 21H15.9998C17.8514 21 18.7772 21 19.3342 19.9102C19.8912 18.8204 19.5162 18.3016 18.7662 17.2638C17.3487 15.3024 14.8481 14 11.9998 14Z"
                                                            stroke="currentColor" stroke-width="1.6" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex flex-col">
                                                <h6 class="text-base font-semibold text-black mb-0.5">Item purchased
                                                </h6>
                                                <p class="text-xs font-normal text-gray-500">Item acquired by the
                                                    provider</p>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- Step 2: Item Delivered -->
                                    <li class="group relative flex-1 after:content-[''] after:w-0.5 after:h-full after:bg-gray-200 after:inline-block after:absolute after:-bottom-11 after:left-1/2"
                                        :class="{'hover:after:bg-green-700 cursor-pointer' : updateMode, 'after:bg-green-700' : secondClicked || thirdClicked }"
                                        @click="if (updateMode) {secondClicked = !secondClicked; firstClicked = false; thirdClicked = false;}">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow z-10 relative"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : secondClicked || thirdClicked }">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode, 'bg-green-700' : secondClicked || thirdClicked  }">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : secondClicked || thirdClicked }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M8 5.99985H7C5.11438 5.99985 4.17157 5.99985 3.58579 6.58564C3 7.17142 3 8.11423 3 9.99985V16.9998C3 18.8855 3 19.8283 3.58579 20.4141C4.17157 20.9998 5.11438 20.9998 7 20.9998H17C18.8856 20.9998 19.8284 20.9998 20.4142 20.4141C21 19.8283 21 18.8855 21 16.9998V9.99985C21 8.11423 21 7.17142 20.4142 6.58564C19.8284 5.99985 18.8856 5.99985 17 5.99985H16M12 17.9998V17.9284C12 17.53 12 17.3308 11.9624 17.1661C11.8342 16.6043 11.3955 16.1657 10.8338 16.0375C10.669 15.9998 10.4698 15.9998 10.0714 15.9998H8C7.53501 15.9998 7.30252 15.9998 7.11177 16.051C6.59413 16.1897 6.18981 16.594 6.05111 17.1116C6 17.3024 6 17.5349 6 17.9998M15 12.9998H18M15 15.9998H18M10.5 12.4998C10.5 13.3283 9.82843 13.9998 9 13.9998C8.17157 13.9998 7.5 13.3283 7.5 12.4998C7.5 11.6714 8.17157 10.9998 9 10.9998C9.82843 10.9998 10.5 11.6714 10.5 12.4998ZM10.25 5.47472V6.24985C10.25 6.95208 10.25 7.3032 10.4185 7.55542C10.4915 7.66461 10.5852 7.75836 10.6944 7.83132C10.9467 7.99985 11.2978 7.99985 12 7.99985C12.7022 7.99985 13.0533 7.99985 13.3056 7.83132C13.4148 7.75836 13.5085 7.66461 13.5815 7.55542C13.75 7.3032 13.75 6.95208 13.75 6.24985V5.47472C13.75 5.16873 13.75 5.01573 13.7069 4.87378C13.6879 4.8111 13.6628 4.75043 13.6319 4.69267C13.562 4.56185 13.4538 4.45366 13.2374 4.23729C12.7409 3.74073 12.4926 3.49246 12.1951 3.43328C12.0663 3.40766 11.9337 3.40766 11.8049 3.43328C11.5074 3.49246 11.2591 3.74073 10.7626 4.23729C10.5462 4.45366 10.438 4.56185 10.3681 4.69267C10.3372 4.75043 10.3121 4.8111 10.2931 4.87378C10.25 5.01573 10.25 5.16873 10.25 5.47472Z"
                                                            stroke="currentColor" stroke-width="1.6"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex flex-col">
                                                <h6 class="text-base font-semibold text-black mb-0.5">Item Delivered
                                                </h6>
                                                <p class="text-xs font-normal text-gray-500">Item received by the
                                                    customer</p>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- Step 3: Transaction rating -->
                                    <li class="relative flex-1 group"
                                        @click="if (updateMode) {thirdClicked = !thirdClicked; firstClicked = false; secondClicked = false;}">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : thirdClicked}">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode, 'bg-green-700' : thirdClicked}">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : thirdClicked}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M15.9998 7C15.9998 9.20914 14.2089 11 11.9998 11C9.79067 11 7.99981 9.20914 7.99981 7C7.99981 4.79086 9.79067 3 11.9998 3C14.2089 3 15.9998 4.79086 15.9998 7Z"
                                                            stroke="currentColor" stroke-width="1.6" />
                                                        <path
                                                            d="M11.9998 14C9.15153 14 6.65091 15.3024 5.23341 17.2638C4.48341 18.3016 4.10841 18.8204 4.6654 19.9102C5.2224 21 6.1482 21 7.99981 21H15.9998C17.8514 21 18.7772 21 19.3342 19.9102C19.8912 18.8204 19.5162 18.3016 18.7662 17.2638C17.3487 15.3024 14.8481 14 11.9998 14Z"
                                                            stroke="currentColor" stroke-width="1.6" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex flex-col">
                                                <h6 class="text-base font-semibold text-black mb-0.5">Transaction rating
                                                </h6>
                                                <p class="text-xs font-normal text-gray-500">Transaction rated by the
                                                    customer</p>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-lg font-semibold">Other details:</p>
                            <div class="flex flex-wrap items-start gap-4 text-gray-700">
                                <img src="{{ $transaction->item_image }}" alt="order_image"
                                    class="rounded-full w-20 h-20 sm:w-32 sm:h-32 object-cover self-center sm:self-start">
                                <div class="text-sm flex flex-col items-start gap-1">
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Created on:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $order->created_at->Timezone('Singapore')->format('F j, Y') . " at " . Carbon\Carbon::parse($order->created_at)->format('g:i A') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Order:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">{{ $order->order }}</p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Other notes:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $order->additional_notes ? $order->additional_notes : 'none' }}</p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1 mt-auto">
                                        <span class="font-medium whitespace-nowrap">
                                            Payment status:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $order->is_paid ? 'Paid' : 'Pending' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex flex-col gap-2 text-md">
                            <div class="flex flex-row">
                                <p class="text-lg font-semibold">Customer details:</p>
                                <button type="button"
                                    class="ml-auto px-3 py-1.5 text-xs md:text-sm font-medium text-white inline-flex items-center justify-center bg-[#014421] hover:bg-green-800 rounded-lg text-center">

                                    <!-- SVG Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-4 h-4 text-white sm:me-2">
                                        <path
                                            d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                                    </svg>

                                    <!-- Dynamic Text -->
                                    <span class="hidden sm:block">Message</span>
                                </button>
                            </div>

                            <div class="flex flex-wrap items-start gap-4 text-gray-700">
                                <img src="{{ $user->profile_pic_url }}" alt="customer_image"
                                    class="rounded-full w-20 h-20 sm:w-32 sm:h-32 object-cover self-center sm:self-start">
                                <div class="text-sm flex flex-col items-start gap-1">
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Customer name:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">{{ $user->name }}</p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            College:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">{{ $user->college }}</p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Degree program:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">{{ $user->degree_program }}</p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Contact number:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">{{ $user->contact_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-4 pb-0 mid:pb-4 pr-4 pl-4 mid:pl-0 w-full mid:w-1/3">
            <a href="{{ route('transaction.view', ['id' => $order->post_id ]) }}"
                class="w-fit p-1.5 hover:bg-gray-100 hover:rounded-full block mid:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div class="relative h-fit bg-white rounded-lg shadow-md px-5 pt-5 pb-5 mid:pb-0 flex flex-col lg:gap-0">
                <div>
                    <p class="text-lg text-[#014421] font-semibold mb-2">Transaction details: </p>
                    <button class="absolute right-2 top-2 p-2 hover:bg-gray-100 hover:rounded-full"
                        @click="openTransactionDots = !openTransactionDots">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </button>
                    <div x-show="openTransactionDots" @click.outside="openTransactionDots = false"
                        class="text-gray-700 absolute right-2 top-10 text-sm w-20 bg-white shadow rounded mx-2 z-10 flex flex-col">
                        <button
                            class="enabled:hover:bg-gray-100 bg-white py-2 px-3 text-start rounded disabled:cursor-not-allowed"
                            :disabled="transactionStatus === 'open'" @click="$wire.updateStatus('open')">Open</button>
                        <button
                            class="enabled:hover:bg-gray-100 bg-white py-2 px-3 text-start rounded disabled:cursor-not-allowed"
                            :disabled="transactionStatus === 'ongoing'"
                            @click="$wire.updateStatus('ongoing')">Start</button>
                        <button
                            class="enabled:hover:bg-gray-100 bg-white py-2 px-3 text-start rounded disabled:cursor-not-allowed"
                            :disabled="transactionStatus === 'cancelled'"
                            @click="$wire.updateStatus('cancelled')">Cancel</button>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row mid:flex-col gap-4">
                    @if ($transaction->item_image)
                    <img src="{{ $transaction->item_image }}" alt="{{ $transaction->item_name ?? 'Item Image' }}"
                        class="w-2/5 sm:w-1/3 md:w-1/4 mid:w-1/2 sm:mb-0 self-start h-auto rounded bg-gray-100">
                    @else
                    <img src="https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg"
                        alt="" class="w-2/5 sm:w-1/3 md:w-1/4 mid:w-1/2 sm:mb-0 self-start h-auto rounded bg-gray-100">
                    @endif
                    <div class="mid:pb-4 text-sm flex flex-col gap-2 items-start">
                        <div class="flex flex-wrap items-center gap-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5 flex-shrink-0">
                                <path fill-rule="evenodd"
                                    d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium whitespace-nowrap">
                                Transaction status:
                            </span>
                            <p class="text-gray-600 font-normal break-words">{{ ucwords($transaction->status) }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5 flex-shrink-0">
                                <path fill-rule="evenodd"
                                    d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium whitespace-nowrap">
                                Item name:
                            </span>
                            <p class="text-gray-600 font-normal break-words">{{ $transaction->item_name }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5 flex-shrink-0">
                                <path
                                    d="M5.223 2.25c-.497 0-.974.198-1.325.55l-1.3 1.298A3.75 3.75 0 0 0 7.5 9.75c.627.47 1.406.75 2.25.75.844 0 1.624-.28 2.25-.75.626.47 1.406.75 2.25.75.844 0 1.623-.28 2.25-.75a3.75 3.75 0 0 0 4.902-5.652l-1.3-1.299a1.875 1.875 0 0 0-1.325-.549H5.223Z" />
                                <path fill-rule="evenodd"
                                    d="M3 20.25v-8.755c1.42.674 3.08.673 4.5 0A5.234 5.234 0 0 0 9.75 12c.804 0 1.568-.182 2.25-.506a5.234 5.234 0 0 0 2.25.506c.804 0 1.567-.182 2.25-.506 1.42.674 3.08.675 4.5.001v8.755h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3Zm3-6a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75v-3Zm8.25-.75a.75.75 0 0 0-.75.75v5.25c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-5.25a.75.75 0 0 0-.75-.75h-3Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium break-words">
                                Item origin:
                            </span>
                            <p class="text-gray-600 font-normal break-words">{{ $transaction->item_origin }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5">
                                <path
                                    d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                                <path fill-rule="evenodd"
                                    d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium break-words">
                                Delivery date:
                            </span>
                            <p class="text-gray-600 font-normal break-words">
                                {{ $transaction->delivery_date->Timezone('Singapore')->format('F j, Y') . " at " . Carbon\Carbon::parse($transaction->arrival_time)->format('g:i A') }}
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5">
                                <path fill-rule="evenodd"
                                    d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium break-words">
                                Meetup place:
                            </span>
                            <p class="text-gray-600 font-normal break-words">{{ $transaction->meetup_place }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div @keydown.escape.window="deleteOrderModalOpen = false; document.body.style.overflow = 'auto';"
        x-data="{ confirm: '', errors: {} }" x-show="deleteOrderModalOpen" x-transition:enter.duration.25ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative">
            <div class="flex flex-col items-center gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#ff4545" class="size-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-lg sm:text-xl font-medium text-black">Are you sure?</p>
                <p class="text-sm">Make sure to inform the customer before deleting the order. Deleting order without
                    the customer's consent might cause conflicts.</p>
                <button @click="deleteOrderModalOpen = false; document.body.style.overflow = 'auto';"
                    class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="#000000" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-5 flex gap-2">
                <button @click="deleteOrderModalOpen = false; document.body.style.overflow = 'auto';"
                    class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                <button @click="$wire.deleteOrder()"
                    class="px-2 sm:px-3 py-1.5 text-sm bg-red-800 text-white rounded-md hover:bg-[#7b1113]">
                    Confirm
                </button>

            </div>
        </div>
    </div>
</div>


<script>
setTimeout(() => {
    document.querySelector('.flash').style.display = 'none';
}, 3000); // 3 seconds
</script>