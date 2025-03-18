<div class="bg-black bg-opacity-50 fixed inset-0 z-50 flex items-center justify-center font-poppins" x-transition:enter.duration.25ms>
    <div @keydown.escape.window="makeTransactionModalOpen = false; document.body.style.overflow = 'auto';" class="bg-white px-4 pt-6 pb-4 sm:px-8 rounded-lg w-11/12 lg:w-2/3 xl:w-1/2 font-poppins relative overflow-y-auto max-h-[80vh] sm:max-h-[95vh]"
    x-data="{
        item_name_post: '{{ $post->item_name }}', 
        item_origin_post: $wire.entangle('item_origin'), 
        item_type_post: {{ $post->item_type }},
        item_subtype_post: $wire.entangle('subtype'),
        subtag_item: '',
        item_image_post: $wire.entangle('item_image'), 
        delivery_date_post: $wire.entangle('delivery_date'), 
        mode_of_payment_post: {{ $post->mode_of_payment }}, 
        max_orders: $wire.entangle('max_orders'),
        cutoff_date_orders: $wire.entangle('cutoff_date_orders'),
        transaction_fee: $wire.entangle('transaction_fee'),
        arrival_time: $wire.entangle('arrival_time'),
        meetup_place: $wire.entangle('meetup_place'),
        openDropdown:false,
        firstPicker: null,
        secondPicker: null,
        item_details: true,
        transaction_details: false
    }">
        <div class="flex flex-row items-start sm:items-center gap-2 sm:gap-3 w-11/12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#014421" class="mt-1 sm:mt-0 size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            <p class="text-xl sm:text-2xl font-semibold text-[#014421]">Create transaction</p>
            <button @click="makeTransactionModalOpen = false; document.body.style.overflow = 'auto';" class="absolute top-4 right-4 ml-auto hover:bg-gray-100 hover:rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <p class="mt-2 ml-1 sm:ml-0 text-sm sm:text-base">Item request created by <span class="font-medium">{{ App\Models\User::find($post->user_id)->name }}</span>.</p>
        <div class="mt-2 flex flex-col gap-2 w-full border p-4 border-gray-300 bg-white rounded-md">
            <div class="flex flex-col md:flex-row gap-2 items-start md:items-center">
                <p class="text-lg sm:text-xl font-medium text-[#014421]" :class="item_details ? 'underline' : 'hidden md:block md:no-underline'">Item Details</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden md:block md:size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <p class="text-lg sm:text-xl font-medium text-[#014421]" :class="item_details ? 'hidden md:block md:no-underline' : 'block underline'">Transaction Details</p>
            </div>
            <div x-show="item_details && !transaction_details" class="">
                <div class="mt-4 flex flex-col gap-4">
                    <div class="w-full flex flex-col">
                        <label for="item_name_post" class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Item Name</label>
                        <input type="text" id="item_name_post" x-model="item_name_post" wire:model="item_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="What items are you going to buy?" disabled/>
                    </div>
                    <div class="w-full flex flex-col">
                        <label for="item_origin_post" class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Item Origin</label>
                        <input type="text" id="item_origin_post" x-model="item_origin_post" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="What are store's name and location?"/>
                    </div>
                    <div>
                        <p class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Item Type</p>
                        <div class="text-gray-600 text-xs sm:text-sm grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 justify-items-start">
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="food_post_convert" value="Food" x-model="item_type_post">
                                <label for="food_post_convert">Food</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="grocery_post_convert" value="Grocery item" x-model="item_type_post">
                                <label for="grocery_post_convert">Grocery items</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="produce_post_convert" value="Local produce" x-model="item_type_post">
                                <label for="produce_post_convert">Local produce</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="pet_post_convert" value="Pet needs" x-model="item_type_post">
                                <label for="pet_post_convert">Pet needs</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="apparel_post_convert" value="Apparel" x-model="item_type_post">
                                <label for="apparel_post_convert">Apparel</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="footwear_post_convert" value="Footwear" x-model="item_type_post">
                                <label for="footwear_post_convert">Footwear</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="merchandise_post_convert" value="Merchandise" x-model="item_type_post">
                                <label for="merchandise_post_convert">Merchandise</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="personal_care_post_convert" value="Personal care" x-model="item_type_post">
                                <label for="personal_care_post_convert">Personal care</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="celebratory_post_convert" value="Celebratory" x-model="item_type_post">
                                <label for="celebratory_post_convert">Celebratory</label>
                            </div>
                            <div class="flex flex-row items-center gap-2 mt-1">
                                <input type="checkbox" id="hobbies_post_convert" value="Hobbies" x-model="item_type_post">
                                <label for="hobbies_post_convert">Hobbies</label>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex flex-col sm:flex-row gap-4">
                        <div class="w-full flex flex-col" x-data="{ duplicate: false, max_count: false }">
                            <label for="subtag" class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Item subtag</label>
                            <div class="relative w-full">
                                <input type="text" id="subtag" x-model="subtag_item" class="w-full pe-12 bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5" x-bind:class="{'border-red-500': duplicate || max_count}" @input="duplicate = false; max_count = false;" placeholder="e.g., fruits, baguio, imported"
                                @keydown.enter.prevent="if (subtag_item !== '') {
                                    if (item_subtype_post.length < 5) {
                                        if (item_subtype_post.includes(subtag_item.trim())) {
                                            duplicate = true;
                                        } else if (subtag_item.trim() !== '') {
                                            item_subtype_post.push(subtag_item.trim());
                                            subtag_item = '';
                                            duplicate = false;
                                            max_count = false;
                                        }
                                    } else if (item_subtype_post.length === 5) {
                                        max_count = true;
                                    }
                                }" 
                                />
                                <button class="absolute top-1/2 right-2 transform -translate-y-1/2 px-1.5 py-1.5 text-gray-400 text-xs md:text-sm rounded-full hover:bg-gray-200" 
                                @click="if (subtag_item !== '') {
                                    if (item_subtype_post.length < 5) {
                                        if (item_subtype_post.includes(subtag_item.trim())) {
                                            duplicate = true;
                                        } else if (subtag_item.trim() !== '') {
                                            item_subtype_post.push(subtag_item.trim());
                                            subtag_item = '';
                                            duplicate = false;
                                            max_count = false;
                                        }
                                    } else if (item_subtype_post.length === 5) {
                                        max_count = true;
                                    }
                                }">
                                <div class="flex flex-row items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            </div>
                            <p x-show="duplicate" class="text-red-500 text-xs mt-1">This subtag already exists.</p>
                            <p x-show="max_count" class="text-red-500 text-xs mt-1">You can only add 5 subtags.</p>
                            <div class="flex flex-row flex-wrap space-y-2 gap-1">
                                <template x-for="subtag in item_subtype_post" :key="subtag">
                                    <span class="flex flex-row gap-1 items-center text-xs font-medium px-2.5 py-0.5 rounded bg-gray-100 text-gray-800">
                                        <span x-text="subtag"></span>
                                        <button @click="item_subtype_post.splice(item_subtype_post.indexOf(subtag), 1);">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>
                            </div>
                        </div>
                        <div class="w-full flex flex-col">
                            <p class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Item Image</p>
                            <input type="file" accept="image/png, image/jpeg" id="item_image_post" wire:model="item_image" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="transaction_details && !item_details" class="">
                <div class="mt-4 flex flex-col">
                    <!-- MAX ORDERS AND CUTOFF DATE -->
                    <div class="flex flex-col sm:flex-row gap-2 md:gap-4" @click="openDropdown = false">
                        <div class="w-full flex flex-col">
                            <label for="transaction_max_orders" class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Orders to cater</label>
                            <input type="number" id="transaction_max_orders" x-model="max_orders" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5" min="1" max="10000" placeholder="How many orders can you handle?"/>
                        </div>
                        <div class="w-full">
                            <p class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Cutoff for ordering</p>
                            <div class="relative">
                                <input id="datepicker-cutoff-convert"
                                        @change="
                                            delivery_date_post = '';
                                            console.log($event.target.value);
                                            let selectedDate = new Date($event.target.value);
                                            selectedDate.setHours(selectedDate.getHours() + 8);  // Adjusting for GMT+8
                                            $wire.set('cutoff_date_orders', selectedDate.toISOString().split('T')[0], false);
                                        
                                        "
                                        x-data
                                        x-ref="cutoff_convert"
                                        x-init="$refs.cutoff_convert.min = new Date().toISOString().split('T')[0];" type="date" onkeydown="return false;"
                                    
                                        wire:model="cutoff_date_orders"
                                        class="block w-full p-2.5 text-xs sm:text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421]"
                                        placeholder="Select date"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- TRANSACTION FEE AND MODE OF PAYMENT -->
                    <div class="flex flex-col sm:flex-row gap-2 md:gap-4 mt-2 md:mt-4">
                        <div class="w-full flex flex-col">
                            <label for="transaction_fee" class="block mb-2 text-sm sm:text-base font-medium text-gray-900 ">Transaction fee</label>
                            <input type="text" id="transaction_fee" x-model="transaction_fee" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5" @click="openDropdown = false" placeholder="How much? e.g., 50% down payment" />
                        </div>
                        <div class="w-full">
                            <p class="block mb-1 text-sm sm:text-base font-medium text-gray-900 " @click="openDropdown = !openDropdown">Mode of payment</p>
                            <div class="flex flex-col mt-2" x-data="{ clickCheckbox: false }">
                                <button 
                                    x-on:click="openDropdown = !openDropdown" 
                                    @click.outside="if (!clickCheckbox) { openDropdown = false; }" 
                                    class="text-gray-400 bg-gray-50 hover:bg-slate-100 border border-gray-300 focus:outline-none focus:border-[#014421] rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center w-full" 
                                    type="button">
                                    <p class="text-xs sm:text-sm" x-text="mode_of_payment_post.length === 0 ? 'Choose' : (window.innerWidth > 640 ? (mode_of_payment_post.length > 2 ? (mode_of_payment_post.slice(0, 2).join(', ') + ' +' + (mode_of_payment_post.length - 2)) : mode_of_payment_post.join(', ')) : (mode_of_payment_post.length > 1 ? mode_of_payment_post[0] + ' +' + (mode_of_payment_post.length - 1) : mode_of_payment_post[0]))"></p>
                                    <svg class="w-2.5 h-2.5 ml-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
    
                                <div @click="clickCheckbox = true" @click.outside="clickCheckbox = false" :class="openDropdown ? 'block' : 'hidden'" class="fixed mt-10 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow z-50">
                                    <ul class="p-3 space-y-3 text-sm text-gray-600">
                                        <li>
                                            <label for="checkbox-item-1-convert" class="flex items-center cursor-pointer">
                                                <input id="checkbox-item-1-convert" type="checkbox" value="Cash" x-model="mode_of_payment_post" class="w-3 bg-gray-100 border-gray-300 rounded">
                                                <span class="ms-2 text-xs sm:text-sm">Cash</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for="checkbox-item-2-convert" class="flex items-center cursor-pointer">
                                                <input id="checkbox-item-2-convert" type="checkbox" value="Digital Wallet" x-model="mode_of_payment_post" class="w-3 bg-gray-100 border-gray-300 rounded" checked>
                                                <span class="ms-2 text-xs sm:text-sm">Digital wallet</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for="checkbox-item-3-convert" class="flex items-center cursor-pointer">
                                                <input id="checkbox-item-3-convert" type="checkbox" value="Debit Credit" x-model="mode_of_payment_post" class="w-3 bg-gray-100 border-gray-300 rounded">
                                                <span class="ms-2 text-xs sm:text-sm">Debit/Credit card</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for="checkbox-item-4-convert" class="flex items-center cursor-pointer">
                                                <input id="checkbox-item-4-convert" type="checkbox" value="Bank Transfer" x-model="mode_of_payment_post" class="w-3 bg-gray-100 border-gray-400 rounded">
                                                <span class="ms-2 text-xs sm:text-sm">Bank transfer</span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DATE OF DELIVERY AND ARRIVAL TIME -->
                    <div class="flex flex-col sm:flex-row gap-2 md:gap-4 mt-2 md:mt-4" @click="openDropdown = false">
                        <div class="w-full">
                            <p class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Date of delivery</p>
                            <div class="relative">
                                <input id="datepicker-delivery-convert"
                                        :disabled="!cutoff_date_orders"
                                        @change="
                                            console.log($event.target.value);
                                            let selectedDate = new Date($event.target.value);
                                            selectedDate.setHours(selectedDate.getHours() + 8);  // Adjusting for GMT+8
                                            $wire.set('delivery_date', selectedDate.toISOString().split('T')[0], false);
                                        "
                                        x-data
                                        x-ref="delivery_convert"
                                        x-init="
                                            // Set min date based on cutoff_date_orders
                                            $refs.delivery_convert.min = new Date(cutoff_date_orders).toISOString().split('T')[0];
                                            // Watch for changes in cutoff_date_orders to update min date dynamically
                                            $watch('cutoff_date_orders', (newValue) => {
                                                if (newValue) {
                                                    $refs.delivery_convert.min = new Date(newValue).toISOString().split('T')[0];
                                                }
                                            });
                                        "
                                        type="date"
                                        onkeydown="return false;" 
                                        wire:model="delivery_date"
                                        class="block w-full p-2.5 text-xs sm:text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421]"
                                        placeholder="Select date"
                                />
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="time" class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Arrival Time</label>
                            <div class="relative">
                                <div class="fixed inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"/>
                                    </svg>
                                </div>
                                <input type="time" id="time" wire:model="arrival_time" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" min="09:00" max="18:00" value="00:00" />
                            </div>
                        </div>
                    </div>
                    <!-- MEETUP PLACE -->
                    <div class="flex flex-col mt-2 md:mt-4" @click="openDropdown = false">
                        <label for="transaction_meetup_place" class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Meetup place</label>
                        <input type="text" id="transaction_meetup_place" x-model="meetup_place" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5" placeholder="Where do you deliver the items?"/>  
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 flex justify-end gap-2">
            <button x-text="item_details ? 'Cancel' : 'Return'" @click="if (item_details) {makeTransactionModalOpen = false; document.body.style.overflow = 'auto';} else if (transaction_details) { item_details = true; transaction_details = false; }" class="font-medium w-20 py-1 sm:py-1.5 text-sm bg-white text-black  rounded-md hover:bg-slate-200 border hover:border-slate-200 hover:text-black"></button>
            <button x-data="{ disabled: false }" x-text="item_details ? 'Next' : 'Post'" @click="if (item_details) { item_details = false; transaction_details = true; } else if (transaction_details) { disabled = true; $wire.makePost(item_name_post, item_origin_post, item_type_post, item_subtype_post, mode_of_payment_post); }" x-bind:disabled="item_details ? (!item_name_post || !item_origin_post || item_origin_post.trim().length === 0 || item_type_post.length === 0) : (!max_orders || !cutoff_date_orders || !transaction_fee || transaction_fee.trim().length === 0 || mode_of_payment_post.length === 0 || !delivery_date_post || !arrival_time || !meetup_place || meetup_place.trim().length === 0) || disabled"  class="font-medium w-20 py-1 sm:py-1.5 text-sm  bg-[#014421] enabled:hover:bg-green-800 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-md"></button>
        </div>
        <div wire:loading.delay wire:target="makePost" class="fixed inset-0 bg-white bg-opacity-50 z-[51] flex items-center justify-center">
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