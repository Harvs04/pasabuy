<div class="font-poppins bg-gray-50"
    x-data="{ openBurger: false, isPaid: {{ $order->is_paid ? 'true' : 'false' }}, paymentStatus: '', isChangeRoleModalOpen: false, cancelOrderModalOpen:false, saveChangesModalOpen: false, rateTransactionModalOpen: false, status: '{{ $order->item_status }}', firstClicked: {{ in_array($order->item_status, ['Acquired', 'Waiting', 'Delivered','Rated']) ? 'true' : 'false' }}, secondClicked: {{ in_array($order->item_status, ['Delivered', 'Rated']) ? 'true' : 'false'  }}, thirdClicked: {{ in_array($order->item_status, ['Rated']) ? 'true' : 'false' }}, updateMode: false, openTransactionDots: false, changeStatusModalOpen: false, statusChange : '' }"
    x-cloak>

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
    @elseif(session('item_rated_success'))
    <div
        class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 mid:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-center text-sm">
                {{ session('item_rated_success') }}
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
    <div wire:loading.delay wire.target="rateTransaction"
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
        style="margin-top: 4.3rem;">
        <div class="p-4 w-full">
            <div class="relative overflow-x-auto shadow-md rounded-lg w-full">
                <div class="p-5 text-left rtl:text-right text-gray-700 bg-white overflow-hidden flex flex-col">
                    <div class="flex flex-row gap-2 items-center">
                        <a href="{{ route('pasabuy-history') }}"
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
                                <p class="text-lg font-semibold">Order tracking: {{ $order->item_status }}</p>
                                <button x-show="status === 'Delivered'" type="button"
                                    @click="rateTransactionModalOpen = true; document.body.style.overflow = 'hidden';"
                                    class="px-3 py-1.5 text-xs md:text-sm font-medium text-white inline-flex items-center justify-center sm:justify-start bg-[#014421] enabled:hover:bg-green-800 rounded-lg text-center disabled:bg-gray-300 disabled:cursor-not-allowed ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white sm:me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>

                                    <!-- Dynamic Text -->
                                    <span class="hidden sm:block">Rate transaction</span>
                                </button>
                            </div>
                            <div class="mt-4 flex justify-center">
                                <ol class="hidden md:flex w-full gap-8 items-center">
                                    <!-- Step 1: Item purchased -->
                                    <li class="group relative flex-1 after:content-[''] after:bg-gray-200 after:h-0.5 after:w-full after:absolute after:top-1/2 after:right-[-50%] after:z-0"
                                        :class="{ 'hover:after:bg-green-800': updateMode , 'after:bg-green-800' : firstClicked || secondClicked || thirdClicked}">
                                        <div :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : firstClicked || secondClicked || thirdClicked}"
                                            class="flex items-center gap-4 h-24 p-4 bg-gray-50 rounded-lg shadow z-10 relative">
                                            <div class="rounded-lg flex items-center justify-center h-10 w-10 bg-gray-200"
                                                :class="{'group-hover:bg-green-700' : updateMode , 'bg-green-700' : firstClicked || secondClicked || thirdClicked}">
                                                <span class="'text-gray-600'"
                                                    :class="{'group-hover:text-white group-hover:bg-green-700' : updateMode, 'text-white' : firstClicked || secondClicked || thirdClicked}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
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
                                        :class="{'hover:after:bg-green-700 cursor-pointer' : updateMode, 'after:bg-green-700' : secondClicked || thirdClicked }">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow z-10 relative"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : secondClicked || thirdClicked }">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode, 'bg-green-700' : secondClicked || thirdClicked }">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : secondClicked || thirdClicked }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
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
                                    <li class="relative flex-1 group">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : thirdClicked}">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode, 'bg-green-700' : thirdClicked}">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : thirdClicked}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
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
                                        :class="{ 'hover:after:bg-green-800': updateMode , 'after:bg-green-800' : firstClicked || secondClicked || thirdClicked}">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow z-10 relative"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421] cursor-pointer' : firstClicked || secondClicked || thirdClicked}">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode,'bg-green-700' : firstClicked || secondClicked || thirdClicked}">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : firstClicked || secondClicked || thirdClicked }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
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
                                        :class="{'hover:after:bg-green-700 cursor-pointer' : updateMode, 'after:bg-green-700' : secondClicked || thirdClicked }">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow z-10 relative"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : secondClicked || thirdClicked }">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode, 'bg-green-700' : secondClicked || thirdClicked  }">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : secondClicked || thirdClicked }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
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
                                    <li class="relative flex-1 group">
                                        <div class="flex items-center gap-4 bg-gray-50 h-24 p-4 rounded-lg shadow"
                                            :class="{'group-hover:bg-green-50 group-hover:border group-hover:border-[#014421] cursor-pointer' : updateMode, 'bg-green-50 border border-[#014421]' : thirdClicked}">
                                            <div class="rounded-lg bg-gray-200 flex items-center justify-center h-10 w-10"
                                                :class="{'group-hover:bg-green-700' : updateMode, 'bg-green-700' : thirdClicked}">
                                                <span class="text-gray-600"
                                                    :class="{'group-hover:text-white' : updateMode, 'text-white' : thirdClicked}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
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
                                            Order added:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $order->created_at->timezone('Asia/Singapore')->format('F j, Y \a\t g:i A') }}
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
                                    <div class="mt-6">
                                        <div class="flex flex-row items-start gap-1 mt-auto"
                                            :class="updateMode ? 'hidden' : 'block'">
                                            <span class="font-medium whitespace-nowrap">
                                                Payment status:
                                            </span>
                                            <p class="text-gray-600 font-normal break-words">
                                                {{ $order->is_paid ? 'Paid' : 'Pending' }}</p>
                                        </div>
                                        <div class="flex flex-row items-center gap-1 mt-auto"
                                            :class="updateMode ? 'block' : 'hidden'">
                                            <span class="font-medium whitespace-nowrap">
                                                Payment status:
                                            </span>
                                            <label class="ml-2 inline-flex items-center me-5 cursor-pointer">
                                                <input x-model="isPaid" type="checkbox" class="sr-only peer">
                                                <div
                                                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring peer-focus:ring-green-800  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-green-800 ">
                                                </div>
                                                <span class="ms-1 text-sm font-medium text-gray-700"
                                                    x-text="isPaid ? 'Paid' : 'Pending'"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex flex-col gap-2 text-md">
                            <div class="flex flex-row">
                                <p class="text-lg font-semibold">
                                    {{ $user->role === 'customer' ? 'Provider details:' : 'Customer details:' }} </p>

                                <a href="{{ route('message.view', ['convo_id' => $convo_id]) }}"
                                    class="ml-auto px-3 py-1.5 text-xs md:text-sm font-medium text-white inline-flex items-center justify-center bg-[#014421] enabled:hover:bg-green-800 rounded-lg text-center disabled:cursor-not-allowed">
                                    <!-- TODO: CHANGE PROVIDER DETAILS IN CUSTOMER VIEW -->
                                    <!-- SVG Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-4 h-4 text-white sm:me-2">
                                        <path
                                            d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                                    </svg>

                                    <!-- Dynamic Text -->
                                    <span class="hidden sm:block">Message</span>
                                </a>
                            </div>

                            <div class="flex flex-wrap items-start gap-4 text-gray-700">
                                <img src="{{ $user->role === 'customer' ? App\Models\User::where('id', $order->provider_id)->first()->profile_pic_url : App\Models\User::where('id', $order->customer_id)->first()->profile_pic_url }}"
                                    alt="provider_image"
                                    class="rounded-full w-20 h-20 sm:w-32 sm:h-32 object-cover self-center sm:self-start">
                                <div class="text-sm flex flex-col items-start gap-1">
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Name:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $user->role === 'customer' ? App\Models\User::where('id', $order->provider_id)->first()->name : App\Models\User::where('id', $order->customer_id)->first()->name }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Email:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $user->role === 'customer' ? App\Models\User::where('id', $order->provider_id)->first()->email : App\Models\User::where('id', $order->customer_id)->first()->email }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            College:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $user->role === 'customer' ? App\Models\User::where('id', $order->provider_id)->first()->college : App\Models\User::where('id', $order->customer_id)->first()->college }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Degree program:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $user->role === 'customer' ? App\Models\User::where('id', $order->provider_id)->first()->degree_program : App\Models\User::where('id', $order->customer_id)->first()->degree_program }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-start gap-1">
                                        <span class="font-medium whitespace-nowrap">
                                            Contact number:
                                        </span>
                                        <p class="text-gray-600 font-normal break-words">
                                            {{ $user->role === 'customer' ? App\Models\User::where('id', $order->provider_id)->first()->contact_number : App\Models\User::where('id', $order->customer_id)->first()->contact_number }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-4 pb-0 mid:pb-4 pr-4 pl-4 mid:pl-0 w-full mid:w-1/3">
            <div class="relative h-fit bg-white rounded-lg shadow-md px-5 py-5 flex flex-col lg:gap-0">
                <div class="flex items-center mb-2 gap-1">
                    <a href="{{ route('pasabuy-history') }}"
                        class="w-fit p-1.5 hover:bg-gray-100 hover:rounded-full block mid:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <p class="text-lg text-gray-700 font-semibold">Transaction details: </p>
                </div>
                <div class="flex flex-col sm:flex-row mid:flex-col gap-4">
                    @if ($transaction->item_image)
                    <img src="{{ $transaction->item_image }}" alt="{{ $transaction->item_name ?? 'Item Image' }}"
                        class="w-2/5 sm:w-1/3 md:w-1/4 mid:w-1/2 sm:mb-0 self-start h-auto rounded bg-gray-100">
                    @else
                    <img src="https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg"
                        alt="" class="w-2/5 sm:w-1/3 md:w-1/4 mid:w-1/2 sm:mb-0 self-start h-auto rounded bg-gray-100">
                    @endif
                    <div class="text-sm flex flex-col gap-2 items-start">
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
                <hr class="my-4">
                <div class="transaction-rating p-4 bg-white rounded-lg shadow-sm border border-gray-100">
                    <div class="flex flex-col sm:flex-row mid:flex-col items-start sm:items-center mid:items-start justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-700">Rating</h3>
                        <span class="mt-1 sm:mt-0 mid:mt-1 px-2 py-1 bg-gray-100 text-gray-700 text-sm rounded-md {{ $has_rating ? 'block' : 'hidden' }}">
                            ID: #{{ $has_rating ? $rating_instance->id : '' }}
                        </span>
                    </div>
                    @if($has_rating)
                        <!-- Star Rating Display -->
                        <div class="flex items-center mb-4">
                            <div class="flex mr-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating_instance->star_rating)
                                        <!-- Filled Star -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-400">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <!-- Empty Star -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-300">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-lg font-medium text-gray-700">{{ $rating_instance->star_rating }}/5</span>
                        </div>
                        
                        <!-- Remarks Section -->
                        <div class="mb-3">
                            <h4 class="text-sm font-medium text-gray-600 mb-1">Customer Remarks:</h4>
                            @if(empty($rating_instance->remarks))
                                <p class="text-gray-500 italic">No remarks provided</p>
                            @else
                                <div class="p-3 bg-gray-50 rounded-md text-gray-700">
                                    <p>{{ $rating_instance->remarks }}</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Timestamp and Reference -->
                        <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100 text-xs text-gray-500">
                            <div>Rated on: {{ \Carbon\Carbon::parse($rating_instance->created_at)->setTimezone('Asia/Singapore')->format('M d, Y \a\t h:i A') }}</div>
                        </div>
                    @else
                        <div class="py-2 text-gray-500 text-sm text-center">No rating yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    @teleport('body')
    <div @keydown.escape.window="cancelOrderModalOpen = false; document.body.style.overflow = 'auto';"
        x-data="{ confirm: '', errors: {} }" x-show="cancelOrderModalOpen" x-transition:enter.duration.25ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 font-poppins">
        <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative">
            <div class="flex flex-col items-center gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#ff4545" class="size-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-lg sm:text-xl font-medium text-black">Are you sure?</p>
                <p class="text-sm">Cancelling your order will incur a decrease of 5 pasabuy points</p>
                <button @click="cancelOrderModalOpen = false; document.body.style.overflow = 'auto';"
                    class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="#000000" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-5 flex gap-2">
                <button @click="cancelOrderModalOpen = false; document.body.style.overflow = 'auto';"
                    class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                <button x-data="{ disabled: false }" :disabled="disabled"
                    @click="disabled = true; cancelOrderModalOpen = false; $wire.cancelOrder();"
                    class="px-2 sm:px-3 py-1.5 text-sm bg-red-700 text-white rounded-md hover:bg-red-600">
                    Confirm
                </button>
            </div>
        </div>
    </div>
    @endteleport

    <!-- SAVE MODAL -->
    <div @keydown.escape.window="saveChangesModalOpen = false; document.body.style.overflow = 'auto';"
        x-show="saveChangesModalOpen" x-transition:enter.duration.25ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-11/12 sm:w-4/6 md:w-5/12 xl:w-4/12 relative">
            <div class="flex flex-row items-center gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#014421" class="size-6 md:size-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-xl font-semibold text-[#014421]">Confirmation</p>
                <button @click="saveChangesModalOpen = false; document.body.style.overflow = 'auto';"
                    class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="#000000" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-sm mt-2 sm:mt-8 sm:ml-2">Do you confirm that your order has been delivered by provider, <span
                    class="font-semibold"> {{ App\Models\User::where('id', $order->provider_id)->first()->name }}
                </span> at <span class="font-semibold">
                    {{ App\Models\Post::where('id', $order->post_id)->first()->meetup_place }}</span>?</p>

            <div class="mt-5 flex justify-end gap-2">
                <button @click="saveChangesModalOpen = false; document.body.style.overflow = 'auto';"
                    class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                <button x-data="{ disabled: false }" :disabled="disabled"
                    @click="disabled = true; saveChangesModalOpen = false; document.body.style.overflow = 'auto'; $wire.confirmDelivery();"
                    class="px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
            </div>
        </div>
    </div>

    <!-- RATE -->
    <div @keydown.escape.window="rateTransactionModalOpen = false; document.body.style.overflow = 'auto';"
        x-show="rateTransactionModalOpen" x-transition:enter.duration.25ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-11/12 sm:w-5/6 lg:w-7/12 xl:w-4/12 relative flex flex-col items-center"
            x-data="{ rating: $wire.entangle('star_rating'), tempRating: 0, remarks: $wire.entangle('remarks') }">

            <div class="flex self-start items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#014421" class="size-6 md:size-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-xl font-semibold text-[#014421]">Transaction rating</p>
            </div>

            <!-- Image at the Top Center -->
            <img src="https://res.cloudinary.com/dflz6bik9/image/upload/v1738989291/1_fn3fqa.png" alt="Rating_Image"
                class="w-36 h-36 sm:w-48 sm:h-48 object-cover">

            <p class="text-sm text-center">We want to hear from you!</p>

            <!-- Star Rating -->
            <div class="flex justify-center mb-4">
                <template x-for="star in 5">
                    <svg @mouseover="tempRating = star" @mouseleave="tempRating = rating" @click="rating = star"
                        :class="(star <= tempRating || star <= rating) ? 'fill-yellow-400' : 'fill-gray-100'"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#014421"
                        class="w-8 h-8 cursor-pointer transition-colors duration-200">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                </template>
            </div>

            <!-- Textual Feedback -->
            <textarea
                class="text-sm w-full border border-gray-300 rounded-md p-2 mb-4 focus:outline-none focus:border-[#014421]"
                placeholder="Leave feedback for the provider..." rows="5" style="resize: none; max-height: 200px;"
                x-model="remarks"></textarea>

            <!-- Buttons -->
            <div class="flex justify-end w-full gap-2">
                <button @click="rateTransactionModalOpen = false; document.body.style.overflow = 'auto';"
                    class="px-3 py-1 text-sm border rounded-md hover:bg-slate-200">Cancel</button>

                <button x-data="{ disabled: false }"
                    @click="rateTransactionModalOpen = false; disabled = true; document.body.style.overflow = 'auto'; $wire.rateTransaction();"
                    :disabled="rating === 0 || !remarks || disabled"
                    class="px-3 py-1 text-sm enabled:bg-[#014421] text-white rounded-md enabled:hover:bg-green-800 disabled:cursor-not-allowed disabled:bg-gray-300">Submit</button>
            </div>

            <!-- Close Button -->
            <button @click="rateTransactionModalOpen = false; document.body.style.overflow = 'auto';"
                class="absolute top-4 right-4 p-2 hover:bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="#000000" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>



    <!-- UPDATE STATUS MODAL -->
    <div @keydown.escape.window="changeStatusModalOpen = false; document.body.style.overflow = 'auto';"
        x-show="changeStatusModalOpen" x-transition:enter.duration.25ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-9/12 sm:w-4/6 md:w-5/12 xl:w-4/12 relative">
            <div class="flex flex-row items-center gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#014421" class="size-6 md:size-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-xl font-semibold text-[#014421]">Confirmation</p>
                <button @click="changeStatusModalOpen = false; document.body.style.overflow = 'auto';"
                    class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="#000000" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-sm mt-2 sm:ml-2">Do you wish to save your changes?</p>

            <div class="mt-5 flex justify-end gap-2">
                <button @click="changeStatusModalOpen = false; document.body.style.overflow = 'auto';"
                    class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                <button x-data="{ disabled: false }" :disabled="disabled"
                    @click="disabled = true; changeStatusModalOpen = false; document.body.style.overflow = 'auto'; $wire.updateStatus(statusChange); statusChange = '';"
                    class="px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
            </div>
        </div>
    </div>

</div>


<script>
setTimeout(() => {
    document.querySelector('.flash').style.display = 'none';
}, 3000); // 3 seconds
</script>