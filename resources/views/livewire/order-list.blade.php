<div class="font-poppins bg-gray-50"
    x-data="{ openBurger: false, isChangeRoleModalOpen: false, cancelOrderModalOpen: false, rateTransactionModalOpen: false, confirmIndeces: [], cancelIndeces: [], search: '', all: false, selected: [], changeTransactionStatus: false, confirmModalOpen: false, statusChange: '', transactionStatus: '{{ $transaction->status }}' }"
    x-init="
    allOrders = {{ json_encode($orders->map(function($order) {
        return [
            'id' => $order->id,
            'provider' => strtolower(App\Models\User::where('id', $order->provider_id)->first()->name),
            'order' => strtolower($order->order),
            'status' => strtolower($order->item_status),
            'is_paid' => $order->is_paid == 1 ? 'Paid' : 'Pending',
        ];
    })) }}
"
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
    @elseif(session('order_updated_success'))
    <div
        class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 mid:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-center text-sm">
                {{ session('order_updated_success') }}
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
    @elseif(session('cancel_success'))
    <div
        class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-center text-sm">
                {{ session('cancel_success') }}
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

    @teleport('body')
    <div wire:loading.delay wire:target="confirmDelivery, rateTransaction, cancelOrder"
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

    <!-- LOADING STATE -->

    <!-- CONTENT -->
    <div class="sm:transition-all sm:duration-300 sm:transform relative flex flex-col-reverse mid:flex-row"
        style="margin-top: 4.3rem;">
        <div class="p-4 w-full">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 border-t">
                    <caption class="px-5 pt-5 pb-3 text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                        <div class="flex flex-row gap-2 items-center">
                            <a href="{{ route('my-orders') }}"
                                class="p-1.5 hover:bg-gray-100 hover:rounded-full hidden mid:block">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                            </a>
                            <p class="text-lg mid:text-xl font-semibold">Orders list:
                            </p>
                        </div>
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 break-words">
                            Browse a list of your orders in a transaction, confirm delivery, and rate the transaction is applicable.
                        </p>
                        <div class="flex items-center gap-2 sm:gap-4 mt-4">
                            <div class="relative w-1/2">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" id="search-filter-list-orders" @input="change = true" x-model="search" class="block w-full p-2 ps-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-[#014421]" placeholder="Search orders, status, etc..." required>
                            </div>
                            <div class="inline-block h-[35px] w-[0.5px] self-stretch bg-gray-200"></div>
                            <div class="flex items-center gap-2 h-fit text-gray-700">
                                <p class="font-medium">Set order status:</p>
                                <button x-bind:disabled="selected.length === 0 || transactionStatus === 'cancelled' || !selected.every(id => {
                                    const orderStatuses = {{ json_encode($orders->pluck('item_status', 'id')) }};
                                    return orderStatuses[id] === 'Waiting';
                                })" class="flex items-center gap-1 px-2.5 py-1.5 bg-transparent enabled:hover:bg-gray-100 disabled:cursor-not-allowed rounded-md"
                                    @click="confirmModalOpen = true; document.body.style.overflow = 'hidden'; confirmIndeces = selected;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-check"><path d="m16 16 2 2 4-4"/><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
                                    <p class="hidden lg:block">Confirm</p>
                                </button>
                                <button x-bind:disabled="selected.length !== 1 || transactionStatus === 'cancelled' || !selected.every(id => {
                                    const orderStatuses = {{ json_encode($orders->pluck('item_status', 'id')) }};
                                    return orderStatuses[id] === 'Delivered';
                                })" class="flex items-center gap-1 px-2.5 py-1.5 bg-transparent enabled:hover:bg-gray-100 disabled:cursor-not-allowed rounded-md"
                                    @click="rateTransactionModalOpen = true; document.body.style.overflow = 'hidden';">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/></svg>
                                    <p class="hidden lg:block">Rate</p>
                                </button>
                                <button class="flex items-center gap-1 px-2.5 py-1.5 bg-transparent enabled:hover:bg-gray-100 disabled:cursor-not-allowed rounded-md"
                                        x-bind:disabled="selected.length === 0 || transactionStatus === 'cancelled' || !selected.every(id => {
                                    const orderStatuses = {{ json_encode($orders->pluck('item_status', 'id')) }};
                                    return orderStatuses[id] === 'Pending';
                                })"
                                    @click="cancelOrderModalOpen = true; document.body.style.overflow = 'hidden'; cancelIndeces = selected;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-x"><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/><path d="m17 13 5 5m-5 0 5-5"/></svg>
                                    <p class="hidden lg:block">Cancel</p>
                                </button>
                            </div>
                        </div>
                    </caption>
                    <thead class="text-xs sm:text-sm text-gray-700 uppercase bg-gray-200 border-b">
                        <tr>
                            <th scope="col" class="pl-6 sm:pl-3 pr-3 py-3 text-center">
                                <input type="checkbox" 
                                        x-model="all" 
                                        @change="
                                    selected = all ? 
                                        allOrders
                                            .filter(order => 
                                                search === '' || 
                                                [order.provider, order.order, order.status, order.is_paid]
                                                    .some(value => value.includes(search.toLowerCase()))
                                            )
                                            .map(order => order.id) 
                                        : []
                                ">
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <p>
                                        Order
                                    </p>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" class="px-1 py-0 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <p>
                                        Payment status
                                    </p>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </div>
                            <th scope="col" class="px-1 py-0 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <p>
                                        Order status
                                    </p>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" class="px-1 py-0 text-center">
                                <div class="flex items-center justify-center gap-1">
                                <p>
                                    Other notes
                                </p>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </div>
                            <th scope="col" class="px-6 py-4 text-center">
                                <span class="">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100"
                            x-show="search === '' || 
                                ['{{ strtolower(App\Models\User::where("id", $order->provider_id)->first()->name) }}',
                                '{{ strtolower($order->order) }}', 
                                '{{ strtolower($order->item_status) }}',
                                '{{ $order->is_paid == 1 ? 'paid' : 'pending' }}'
                                ].some(value => value.includes(search.toLowerCase()))
                            "    
                        >
                            <th scope="row" class="pl-6 sm:pl-3 pr-3 py-3 font-medium text-gray-900 whitespace-nowrap text-center">
                                <input type="checkbox" :value="'{{ $order->id }}'" x-model="selected">
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $order->order }}
                            </td>
                            <td class="px-1 py-4 text-center">
                                @if($order->is_paid)
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Paid
                                </span>
                                @elseif(!$order->is_paid)
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                                @endif
                            </td>
                            <td 
                                class="px-1 py-4 align-middle text-center"
                                x-data="{ waitingInfo: false, status: '{{ $order->item_status }}' }">

                                <span class="
                                    {{ in_array($order->item_status, ['Acquired', 'Delivered', 'Rated']) ? 'bg-green-900 text-green-300' : '' }}
                                    {{ in_array($order->item_status, ['Pending', 'Waiting']) ? 'bg-yellow-900 text-yellow-300' : '' }}
                                    {{ $order->item_status == 'Unavailable' ? 'bg-gray-800 text-gray-300' : '' }}
                                    {{ $order->item_status == 'Cancelled' ? 'bg-red-900 text-red-300' : '' }}
                                    w-fit text-xs font-medium px-2.5 py-0.5 rounded-full inline-flex text-center relative
                                ">
                                    {{ $order->item_status === 'Waiting' ? "Delivered - " . ucwords($order->item_status) : ucwords($order->item_status) }}

                                    <!-- Info Icon -->
                                    <svg x-show="status === 'Waiting'" @mouseenter="waitingInfo = true"
                                        @mouseleave="waitingInfo = false" xmlns="http://www.w3.org/2000/svg"
                                        class="w-3.5 h-3.5 ml-1 cursor-pointer inline-block" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                    </svg>

                                    <!-- Tooltip -->
                                    <div x-show="waitingInfo && status === 'Waiting'"
                                        class="absolute bottom-full mb-1 -right-12 bg-white text-gray-600 p-2 text-xs shadow-lg rounded-md z-10 
                                                whitespace-wrap sm:whitespace-nowrap max-w-max"
                                        x-cloak>
                                        You must confirm whether the order has been delivered.
                                    </div>
                                </span>
                            </td>
                            <td class="px-1 py-4 text-center">
                                <p>{{ $order->notes ? $order->notes : 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-4 align-middle">
                                <span class="flex flex-row gap-4 items-center justify-center">
                                    <a href="{{ route('my-orders-order.view', ['transaction_id' => $order->post_id, 'order_id' => $order->id ]) }}"
                                        class="">
                                        <div class="flex gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="block sm:hidden size-5 text-gray-600 hover:text-gray-900">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <span
                                                class="font-semibold hidden sm:block hover:underline hover:text-gray-900">View</span>
                                        </div>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No orders yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if (count($orders) > 0)
                    <div class="py-2">
                    </div>
                @endif    
            </div>
        </div>
        <div class="pt-4 pb-0 mid:pb-4 pr-4 pl-4 mid:pl-0 w-full mid:w-1/3">
            <a href="{{ route('my-orders') }}"
                class="w-fit p-1.5 hover:bg-gray-100 hover:rounded-full block mid:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div
                class="relative bg-white rounded-lg shadow-md h-fit px-5 pt-5 pb-5 lg:pb-0 flex flex-col mid:gap-4 lg:gap-0">
                <div class="">
                    <p class="text-lg text-[#014421] font-semibold mb-2">Transaction details: </p>
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
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 flex-shrink-0">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium whitespace-nowrap">
                                Provider:
                            </span>
                            <p class="text-gray-600 font-normal break-words">{{ ucwords(App\Models\User::where('id', $transaction->user_id)->first()->name) }}</p>
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

    <!-- CONFIRM ORDER MODAL -->
    <div @keydown.escape.window="confirmModalOpen = false; document.body.style.overflow = 'auto';"
        x-data="{ confirm: '', errors: {} }" x-show="confirmModalOpen" x-transition:enter.duration.25ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 font-poppins">
        <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative">
            <div class="flex flex-col items-center gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#014421" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-check"><path d="m16 16 2 2 4-4"/><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
                <p class="text-lg sm:text-xl font-medium text-black">Are you sure?</p>
                <p class="text-sm text-center">
                    You are confirming that your <span x-text="selected.length > 1 ? 'orders' : 'order'"></span> 
                    <span x-text="selected.length > 1 ? 'have been' : 'has been'"></span> 
                        delivered by provider, 
                    <span
                        class="font-semibold"> {{ App\Models\User::where('id', $order->provider_id)->first()->name }}
                    </span> at 
                    <span class="font-semibold">
                        {{ App\Models\Post::where('id', $order->post_id)->first()->meetup_place }}?
                    </span>
                </p>
                <div class="p-2 border rounded-lg w-full">
                    <p class="font-medium">Order/s:</p>
                    <ul class="list-disc pl-5" 
                        x-data="{ orders: {{ json_encode($orders->pluck('order', 'id')) }} }">
                        <template x-for="id in selected" :key="id">
                            <li class="text-sm" x-text="orders[id]" x-show="orders[id]"></li>
                        </template>
                    </ul>
                </div>
                <button @click="confirmModalOpen = false; document.body.style.overflow = 'auto';"
                    class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="#000000" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-5 flex gap-2">
                <button @click="confirmModalOpen = false; document.body.style.overflow = 'auto';"
                    class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                <button x-data="{ disabled: false }" x-bind:disabled="disabled"
                    @click="disabled = true; confirmModalOpen = false; document.body.style.overflow = 'auto'; $wire.confirmDelivery('{{$transaction->id}}', confirmIndeces); confirmIndeces = []; selected = [];"
                    class="px-2 sm:px-3 py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <!-- RATE TRANSACTION MODAL -->
    <div @keydown.escape.window="rateTransactionModalOpen = false; document.body.style.overflow = 'auto';"
        x-show="rateTransactionModalOpen" x-transition:enter.duration.25ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-11/12 sm:w-5/6 lg:w-7/12 xl:w-4/12 relative flex flex-col items-center" x-data="{ rating: $wire.entangle('star_rating'), tempRating: 0, remarks: $wire.entangle('remarks') }">
            
            <div class="flex self-start items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#014421" class="size-6 md:size-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-xl font-semibold text-[#014421]">Transaction rating</p>
            </div>

            <!-- Image at the Top Center -->
            <img src="https://res.cloudinary.com/dflz6bik9/image/upload/v1743413568/1_fn4u76.png" alt="Rating_Image"
                class="w-36 h-36 sm:w-48 sm:h-48 object-cover">

            <p class="text-center">We want to hear from you!</p>

            <!-- Star Rating -->
            <div class="flex justify-center mb-4">
                <template x-for="star in 5">
                    <svg @mouseover="tempRating = star" @mouseleave="tempRating = rating" @click="rating = star"
                        x-bind:class="(star <= tempRating || star <= rating) ? 'fill-yellow-400' : 'fill-gray-100'"
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
                placeholder="Leave feedback for the provider..." rows="5"
                style="resize: none; max-height: 200px;" x-model="remarks"></textarea>

            <!-- Buttons -->
            <div class="flex justify-end w-full gap-2">
                <button @click="rateTransactionModalOpen = false; document.body.style.overflow = 'auto';"
                    class="px-3 py-1 text-sm border rounded-md hover:bg-slate-200">Cancel</button>

                <button x-data="{ disabled: false }"
                    @click="rateTransactionModalOpen = false; disabled = true; document.body.style.overflow = 'auto'; $wire.rateTransaction('{{ $transaction->id }}', selected[0]);"
                    x-bind:disabled="rating === 0 || !remarks || disabled"
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

    <!-- CANCEL ORDER MODAL -->
    <div @keydown.escape.window="cancelOrderModalOpen = false; document.body.style.overflow = 'auto';"
        x-data="{ confirm: '', errors: {} }" x-show="cancelOrderModalOpen" x-transition:enter.duration.25ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 font-poppins">
        <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative">
            <div class="flex flex-col items-center gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ff002b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-x"><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/><path d="m17 13 5 5m-5 0 5-5"/></svg>
                <p class="text-lg sm:text-xl font-medium text-black">Are you sure?</p>
                <p class="text-sm text-center">You will be <span class="font-medium underline">cancelling</span> the following order/s:</p>
                <div class="p-2 border rounded-lg w-full">
                    <ul class="list-disc pl-5" 
                        x-data="{ orders: {{ json_encode($orders->pluck('order', 'id')) }} }">
                        <template x-for="id in selected" :key="id">
                            <li class="text-sm" x-text="orders[id]" x-show="orders[id]"></li>
                        </template>
                    </ul>
                </div>
                <!-- <p x-show="transactionStatus === 'ongoing'" class="text-sm text-center">Cancelling in an ongoing transaction will incur a decrease of 5 pasabuy points.</p>
                <p x-show="['open', 'full'].includes(transactionStatus)" class="text-sm text-center">Cancelling will notify the provider and remove your order from the order list.</p> -->
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
                <button x-data="{ disabled: false }" x-bind:disabled="disabled"
                    @click="disabled = true; cancelOrderModalOpen = false; $wire.cancelOrder('{{$transaction->id}}', cancelIndeces); cancelIndeces = []; selected = [];"
                    class="px-2 sm:px-3 py-1.5 text-sm bg-red-700 text-white rounded-md hover:bg-red-600">
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