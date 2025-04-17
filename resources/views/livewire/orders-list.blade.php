<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, openFilter: false, createPostModalOpen:false, isChangeRoleModalOpen: false, clicked: false, change: false, search: $wire.entangle('search'), post_type: $wire.entangle('post_type'), item_type: $wire.entangle('item_type'), mode_of_payment: $wire.entangle('mode_of_payment'), delivery_date: $wire.entangle('delivery_date') }"
    x-cloak>

    <!-- NAVBAR -->
    <livewire:navbar />

    <div class="sm:transition-all sm:duration-300 sm:transform relative flex-grow flex items-center justify-center p-4" style="margin-top: 4.3rem;"
    wire:loading.class="hidden"
    wire:target="switchRole, applyFilter, clearFilter"
    >   
    <div class="w-11/12 overflow-x-auto rounded-lg">
    <div class="min-w-full inline-block align-middle rounded-lg">
        <div class="overflow-hidden border border-gray-200 rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                        <caption class="p-5 text-lg mid:text-2xl text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('dashboard') }}" class="p-1.5 hover:bg-gray-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 md:size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                </a>
                                <p class="font-semibold">Order list</p>
                            </div>
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Additional notes</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date delivered</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ App\Models\User::where('id', $order->provider_id)->first()->profile_pic_url }}" alt="{{ App\Models\User::where('id', $order->provider_id)->first()->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ App\Models\User::where('id', $order->provider_id)->first()->name }}</div>
                                                <div class="text-xs text-gray-500">Transaction made: {{ App\Models\Post::where('id', $order->post_id)->first()->created_at->Timezone('Singapore')->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ App\Models\User::where('id', $order->customer_id)->first()->profile_pic_url }}" alt="{{ App\Models\User::where('id', $order->customer_id)->first()->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ App\Models\User::where('id', $order->customer_id)->first()->name }}</div>
                                                <div class="text-xs text-gray-500">Order added: {{ $order->created_at->Timezone('Singapore')->format('M d, Y') }}</div>
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
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ in_array($order->item_status, ['Cancelled', 'Unavailable']) ? 'bg-red-100 text-red-800' : '' }}
                                            {{ in_array($order->item_status, ['Pending', 'Waiting']) ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ in_array($order->item_status, ['Acquired', 'Delivered', 'Rated']) ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst($order->item_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $order->additional_notes ?? 'No additional notes' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="font-medium {{ $user->pasabuy_points >= 100 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $order->date_delivered ? \Carbon\Carbon::parse($order->date_delivered)->format('M d, Y') : 'Not yet delivered' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="text-indigo-600 hover:text-indigo-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
    </div>

</div>