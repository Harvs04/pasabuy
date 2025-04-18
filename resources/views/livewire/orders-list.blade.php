<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, openFilter: false, orderDetailsModalOpen:false, deleteOrderModalOpen:false, isChangeRoleModalOpen: false, search: $wire.entangle('search'), selectedOrder: null }"
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
    <script>
    setTimeout(() => {
        document.querySelector('.flash').style.display = 'none';
    }, 3000); // 3 seconds
    </script>
    @elseif(session('order_deleted'))
    <div
        class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-center text-sm">
                {{ session('order_deleted') }}
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

    <!-- NAVBAR -->
    <livewire:navbar />

    @teleport('body')
    <div wire:loading wire:target="deleteOrder"
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

    <div class="sm:transition-all sm:duration-300 sm:transform relative flex-grow flex items-center justify-center md:p-4"
        style="margin-top: 4.3rem;" wire:loading.class="hidden" wire:target="switchRole, applyFilter, clearFilter">
        <div class="w-full overflow-x-auto rounded-lg">
            <div class="min-w-full inline-block align-middle rounded-lg">
                <div class="overflow-hidden border border-gray-200 rounded-lg shadow-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <caption
                            class="p-5 text-lg mid:text-2xl text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('dashboard') }}" class="p-1.5 hover:bg-gray-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4 md:size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                </a>
                                <p class="font-semibold">Order list</p>
                            </div>
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Provider</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Customer</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Item status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Additional notes</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date delivered</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ App\Models\User::where('id', $order->provider_id)->first()->profile_pic_url }}"
                                                alt="{{ App\Models\User::where('id', $order->provider_id)->first()->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ App\Models\User::where('id', $order->provider_id)->first()->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">Transaction made:
                                                {{ App\Models\Post::where('id', $order->post_id)->first()->created_at->Timezone('Singapore')->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ App\Models\User::where('id', $order->customer_id)->first()->profile_pic_url }}"
                                                alt="{{ App\Models\User::where('id', $order->customer_id)->first()->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ App\Models\User::where('id', $order->customer_id)->first()->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">Order added:
                                                {{ $order->created_at->Timezone('Singapore')->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $order->order }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $order->is_paid == 1 ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $order->is_paid == 0 ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $order->is_paid == 1 ? 'Paid' : 'Unpaid' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ in_array($order->item_status, ['Cancelled', 'Unavailable']) ? 'bg-red-100 text-red-800' : '' }}
                                                {{ in_array($order->item_status, ['Pending', 'Waiting']) ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ in_array($order->item_status, ['Acquired', 'Delivered', 'Rated']) ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ ucfirst($order->item_status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $order->additional_notes ?? 'No additional notes' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="font-medium {{ $user->pasabuy_points >= 100 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $order->date_delivered ? \Carbon\Carbon::parse($order->date_delivered)->format('M d, Y') : 'Not yet delivered' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button
                                            @click="orderDetailsModalOpen = true; selectedOrder = {{ $order }}; $wire.set('customer_id', '{{ $order->customer_id }}'); $wire.set('provider_id', '{{ $order->provider_id }}');"
                                            class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteOrderModalOpen = true; selectedOrder = {{ $order }}; $wire.set('customer_id', '{{ $order->customer_id }}'); $wire.set('provider_id', '{{ $order->provider_id }}');"
                                            class="text-red-600 hover:text-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    No order found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ORDER DETAILS MODAL -->
        @teleport('body')
        <div x-show="orderDetailsModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @keydown.escape.window="orderDetailsModalOpen = false">

            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6 font-poppins"
                @click.outside="orderDetailsModalOpen = false">

                <!-- Header with order info -->
                <div class="flex items-center justify-between mb-4 pb-3 border-b">
                    <h3 class="text-xl font-medium text-gray-900">Order Details</h3>
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full" x-bind:class="{
                        'bg-yellow-100 text-yellow-800': ['Pending', 'Waiting'].includes(selectedOrder?.item_status),
                        'bg-green-100 text-green-800': ['Acquired', 'Delivered', 'Rated'].includes(selectedOrder?.item_status),
                        'bg-red-100 text-red-800': ['Unavailable', 'Cancelled'].includes(selectedOrder?.item_status)
                      }" x-text="selectedOrder?.item_status">
                    </span>
                </div>

                <!-- Order Information -->
                <div class="mb-4">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Main order details -->
                        <div class="col-span-2 bg-gray-50 p-3 rounded-lg mb-2">
                            <h4 class="font-medium text-gray-900 mb-2">Order Information</h4>
                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div>
                                    <p class="text-gray-500">Order ID</p>
                                    <p class="font-medium text-gray-900 truncate" x-text="selectedOrder?.id"></p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Date Ordered</p>
                                    <p class="font-medium text-gray-900"
                                        x-text="new Date(selectedOrder?.created_at).toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'})">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Customer info -->
                        <div>
                            <p class="text-sm font-medium text-gray-500">Customer</p>
                            <div class="flex items-center mt-1">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ $customer->profile_pic_url ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif' }}"
                                        alt="user profile picture">
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm font-medium text-gray-900" wire:loading.class="hidden">
                                        {{ $customer->name ?? 'Customer'}}
                                    </p>
                                    <p class="text-sm" wire:loading>
                                        Loading...
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Provider info -->
                        <div>
                            <p class="text-sm font-medium text-gray-500">Provider</p>
                            <div class="flex items-center mt-1">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ $provider->profile_pic_url ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif'}}"
                                        alt="user profile picture">
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm font-medium text-gray-900" wire:loading.class="hidden">
                                        {{ $provider->name ?? 'Provider'}}
                                    </p>
                                    <p class="text-sm" wire:loading>
                                        Loading...
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Orders -->
                        <div class="text-sm">
                            <p class="text-gray-500 font-medium">Order</p>
                            <p class="font-medium text-gray-900 truncate" x-text="selectedOrder?.order"></p>
                        </div>

                        <!-- Payment status -->
                        <div>
                            <p class="text-sm font-medium text-gray-500">Payment Status</p>
                            <span class="mt-1 px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                x-bind:class="selectedOrder?.is_paid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                x-text="selectedOrder?.is_paid ? 'Paid' : 'Unpaid'">
                            </span>
                        </div>

                        <!-- Delivery date -->
                        <div x-show="selectedOrder?.date_delivered">
                            <p class="text-sm font-medium text-gray-500">Date Delivered</p>
                            <p class="text-sm text-gray-900"
                                x-text="selectedOrder?.date_delivered ? new Date(selectedOrder?.date_delivered).toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'}) : 'Not delivered yet'">
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Additional Notes -->
                <div class="mb-4" x-show="selectedOrder?.additional_notes">
                    <h1 class="text-sm font-medium text-gray-500 mb-2">Additional Notes</h1>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-sm text-gray-900 whitespace-pre-line" x-text="selectedOrder?.additional_notes">
                        </p>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button @click="orderDetailsModalOpen = false"
                        class="px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
        @endteleport


        @teleport('body')
        <div x-show="deleteOrderModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @keydown.escape.window="deleteOrderModalOpen = false">

            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6 font-poppins"
                @click.outside="deleteOrderModalOpen = false" x-data="{ deleteConfirmation: '' }">

                <!-- Header -->
                <div class="text-center mb-6">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                        <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Delete Order</h3>
                    <p class="text-sm text-gray-500 mt-1">This action cannot be undone.</p>
                </div>

                <!-- Order Information -->
                <div class="flex items-center p-4 mb-5 bg-gray-50 rounded-lg">
                    <div class="w-full">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs font-medium text-gray-500">Order</p>
                                <p class="text-sm font-medium text-gray-900" x-text="selectedOrder?.order"></p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500">Item Status</p>
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full" :class="{
                                    'bg-yellow-100 text-yellow-800': ['Pending', 'Waiting'].includes(selectedOrder?.item_status),
                                    'bg-green-100 text-green-800': ['Acquired', 'Delivered', 'Rated'].includes(selectedOrder?.item_status),
                                    'bg-red-100 text-red-800': ['Unavailable', 'Cancelled'].includes(selectedOrder?.item_status)
                                }" x-text="selectedOrder?.item_status">
                                </span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500">Customer</p>
                                <p class="text-sm font-medium text-gray-900" wire:loading.class="hidden">
                                    {{ $customer->name ?? 'Customer'}}
                                </p>
                                <p class="text-sm" wire:loading>
                                    Loading...
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500">Provider</p>
                                <p class="text-sm font-medium text-gray-900" wire:loading.class="hidden">
                                    {{ $provider->name ?? 'Provider'}}
                                </p>
                                <p class="text-sm" wire:loading>
                                    Loading...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Warning -->
                <div class="mb-5">
                    <p class="text-sm text-gray-600">
                        Are you sure you want to delete this order? This action cannot be reversed. All related data
                        will be permanently removed from the system.
                    </p>
                </div>

                <!-- Confirmation Input -->
                <div class="mb-5">
                    <label for="confirm-delete-order" class="block text-sm font-medium text-gray-700 mb-1">
                        Type <span class="font-semibold text-red-600">DELETE</span> to confirm
                    </label>
                    <input type="text" id="confirm-delete-order" x-model="deleteConfirmation"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        placeholder="DELETE">
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3">
                    <button @click="deleteOrderModalOpen = false"
                        class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button @click="$wire.deleteOrder(selectedOrder?.id); deleteOrderModalOpen = false;" :disabled="deleteConfirmation !== 'DELETE'"
                        :class="{'bg-red-600 hover:bg-red-700 cursor-pointer': deleteConfirmation === 'DELETE', 'bg-red-300 cursor-not-allowed': deleteConfirmation !== 'DELETE'}"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete Order
                    </button>
                </div>
            </div>
        </div>
        @endteleport
    </div>
</div>