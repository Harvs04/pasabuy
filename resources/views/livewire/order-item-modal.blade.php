<div class="bg-black bg-opacity-50 fixed inset-0 z-50 flex items-center justify-center font-poppins" x-transition:enter.duration.25ms x-data="{ max_count_reached: false, order: '', orders: $wire.entangle('orders'), order_list_modal_open: false, notes: $wire.entangle('notes'),  order_info_modal_open: false, edit_order: false, edit_index: null }">
    <div @keydown.escape.window="orderItemModalOpen = false; document.body.style.overflow = 'auto';" class="bg-white p-4 md:p-6 rounded-lg w-11/12 md:w-4/6 xl:w-5/12">
        <div class="flex flex-row items-center gap-2 sm:gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#014421" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            <p class="text-xl sm:text-2xl font-semibold text-[#014421]">Add order</p>
            <button @click="orderItemModalOpen = false; document.body.style.overflow = 'auto';" class="ml-auto hover:bg-gray-100 hover:rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <p class="mt-2 ml-1 sm:ml-0 text-sm sm:text-base">Make sure that you want this item before confirming.</p>
        <div class="mt-2 border border-gray-200 p-4 rounded-md">
            <div class="flex flex-col gap-4 text-sm text-gray-800">
                <div>
                    <p class="text-base font-semibold md:font-medium text-[#014421] md:underline">Item details:</p>
                    <ul class="flex flex-col gap-1 mt-1 list-disc ml-4 md:ml-6 lg:ml-8">
                        <li class=""> <span class="font-medium">Item name:</span> {{ $post->item_name }}</li>
                        <li class=""> <span class="font-medium">Item origin:</span> {{ $post->item_origin }}</li>
                    </ul>
                </div>
                <div>
                    <p class="text-base font-semibold md:font-medium text-[#014421] md:underline">Transaction details:</p>
                    <ul class="flex flex-col gap-1 mt-1 list-disc ml-4 md:ml-6 lg:ml-8">
                        <li class=""> <span class="font-medium">Transaction fee:</span> {{ $post->transaction_fee }} </li>
                        <li class=""> <span class="font-medium">Mode of payment:</span> {{ implode(', ', json_decode($post->mode_of_payment)) }} </l>
                        <li class=""> <span class="font-medium">Delivery date and time:</span> {{ $post->delivery_date->format('F j, Y') }} at {{ $post->arrival_time ? \DateTime::createFromFormat('H:i:s', $post->arrival_time)?->format('g:i a') ?? 'Invalid time' : 'No time provided' }} </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-4 border border-gray-200 p-4 rounded-md">
            <p class="text-base font-semibold md:font-medium text-[#014421] md:underline">Order details:</p>
            <div class="flex flex-row gap-1 items-center mt-4 mb-1 relative text-gray-800 ">
                <div class="w-full flex flex-row gap-1 relative items-center">
                    <label for="order" class="block text-sm font-medium">Order</label>
                    <button @click="order_list_modal_open = true" class="text-sm" x-text="'(' + orders.length + ')'"></button>

                    <!-- order list modal -->
                    <div class="flex flex-col w-full gap-2 absolute bottom-6 left-0 z-50 border rounded-lg bg-white text-gray-800 shadow p-3" @click.outside="order_list_modal_open = false" x-show="order_list_modal_open">
                        <div class="flex flex-row ml-1">
                            <p class="font-semibold text-base" x-text="'Your orders (' + orders.length + ')'"></p>
                            <button 
                                @click="order_list_modal_open = false" 
                                class="ml-auto p-0.5 text-gray-700 hover:bg-gray-100 hover:rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="overflow-x-hidden overflow-y-auto border rounded-lg max-h-52">
                            <table class="w-full table-fixed text-sm text-gray-500 rounded-lg">
                                <thead class="text-sm text-gray-700 bg-gray-50 text-center border-b">
                                    <tr>
                                        <th scope="col" class="px-3 py-3">
                                            Order
                                        </th>
                                        <th scope="col" class="py-3 w-28">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr x-show="orders.length === 0" class="bg-white">
                                        <td colspan="2" class="text-center text-gray-600 text-xs md:text-sm py-2">
                                            --- No orders yet ---
                                        </td>
                                    </tr>
                                    <template x-for="(order_item, index) in orders" :key="index">
                                        <tr class="bg-white border-b text-center hover:bg-gray-100">
                                            <td class="px-3 py-4 break-words max-w-xs text-gray-600" x-text="order_item"></td>
                                            <td class="py-2 w-28 whitespace-nowrap text-ellipsis overflow-hidden">
                                                <div class="flex justify-center items-center">
                                                    <button
                                                        @click="order = ''; order = order_item; order_list_modal_open = false; edit_order = true; edit_index = index;"
                                                        class="ml-2 text-gray-600 hover:text-green-800"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                    </button>
                                                    <button 
                                                        @click="orders.splice(index, 1); max_count_reached = false;" 
                                                        class="ml-2 text-gray-600 hover:text-red-700"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <svg @mouseenter="order_info_modal_open = true" @mouseleave="order_info_modal_open = false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1f2937" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                </div>

                <!-- order add modal -->
                <div class="text-xs absolute -top-10 left-24 z-50 border rounded-lg bg-gray-100 text-gray-800 shadow px-2 py-1" x-show="order_info_modal_open">
                    To enter or make another order, click the + button after typing.
                </div>
                <button class="ml-auto p-1 text-gray-400 text-xs md:text-sm rounded-full hover:bg-gray-200" 
                    @click="if (order && !edit_order && ('{{ $post->max_orders - $post->order_count }}' > orders.length)) { orders.push(order); order = ''; } else if (order && edit_order) { orders[edit_index] = order; order = ''; edit_order = false; edit_index = null; } else if ({{ $post->max_orders }} - {{ $post->order_count }} <= orders.length && order) { max_count_reached = true; }">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1f2937" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>
            <textarea
                id="order"
                x-model="order"
                @input="max_count_reached = false"
                class="block w-full p-2 ps-3 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421] resize-none overflow-hidden"
                :class="{ 'border-red-500': max_count_reached }"
                placeholder="Order name, quantity..."
                rows="1"
                @keydown.enter.prevent="if (order && !edit_order && ('{{ $post->max_orders - $post->order_count }}' > orders.length)) { orders.push(order); order = ''; } else if (order && edit_order) { orders[edit_index] = order; order = ''; edit_order = false; edit_index = null; } else if ({{ $post->max_orders }} - {{ $post->order_count }} <= orders.length && order) { max_count_reached = true; }">
            </textarea>
            <p x-show="max_count_reached" class="text-sm text-red-500 mt-1">Maximum orders reached!</p>

            <div class="mt-2 flex flex-col gap-1">
                <label for="additional_notes" class="block text-sm font-medium text-gray-800">Additional notes:</label>
                <textarea
                    id="additional_notes"
                    x-model="notes"
                    class="block w-full p-2 ps-3 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421] resize-none overflow-hidden"
                    placeholder="Other notes, special requests..."
                    @input="adjustHeight($event.target)"
                    rows="1"
                    @keydown.enter.window="adjustHeight($event.target)">
                </textarea>
            </div>
        </div>
        <div class="mt-5 flex justify-end gap-2">
            <button @click="orderItemModalOpen = false; document.body.style.overflow = 'auto';" class="font-medium px-2 sm:px-3 py-1.5 text-sm bg-white text-black  rounded-md hover:bg-slate-200 border hover:border-slate-200 hover:text-black">Cancel</button>
            <button x-data="{ disabled: false }" @click="disabled = true; $wire.addOrder();" class="font-medium px-2 sm:px-3 py-1.5 text-sm  bg-[#014421] enabled:hover:bg-green-800 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-md" :disabled="orders.length === 0 || disabled">Confirm</button>
        </div>
        <div wire:loading.delay wire:target="addOrder" class="fixed inset-0 bg-white bg-opacity-50 z-[51] flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" class="absolute top-1/2 left-1/2 w-12 h-12 text-gray-200 animate-spin fill-[#014421]">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </div>
    </div>
</div>
<script>
    function adjustHeight(textarea) {
        textarea.style.height = ''; // Reset the height
        textarea.style.height = textarea.scrollHeight + 'px'; // Adjust to fit content
    }
</script>