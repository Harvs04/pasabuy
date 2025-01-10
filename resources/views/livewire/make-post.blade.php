<div class="bg-white px-4 sm:px-8 py-6 rounded-lg w-11/12 lg:w-2/3 xl:w-1/2 font-poppins">
    <div class="flex flex-col">
        <div class="flex flex-row items-center gap-2 sm:gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#014421" class="size-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
            <div class="flex flex-row w-full">
                <p class="text-xl sm:text-2xl font-semibold text-[#014421]">{{ $user->role === 'customer' ? 'Create Item Request' : 'Create Transaction' }}</p>
                <button @click="createPostModalOpen = false; if (window.innerWidth > 640) { openBurger = true; }" class="ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#000000" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
        <div class="mt-4 w-full border p-4 border-gray-300 bg-white rounded-md" x-data="{ item_name_post: $wire.entangle('item_name'), item_origin_post: $wire.entangle('item_origin'), item_type_post: $wire.entangle('item_type'), delivery_date_post: $wire.entangle('delivery_date'), notes_post: $wire.entangle('notes'), mode_of_payment_post: $wire.entangle('mode_of_payment'), openDropdown:false }">
            
            @if($user->role === 'customer')
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="w-full flex flex-col">
                        <label for="item_name_post" class="block mb-2 text-sm sm:text-base font-medium text-gray-900 ">Item Name</label>
                        <input type="text" id="item_name_post" x-model="item_name_post" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="What items are you looking for?" />
                    </div>
                    <div class="w-full flex flex-col">
                        <label for="item_origin_post" class="block mb-2 text-sm sm:text-base font-medium text-gray-900 ">Item Origin</label>
                        <input type="text" id="item_origin_post" x-model="item_origin_post" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="Where will your item come from?"/>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Item Type</p>
                    <div class="text-gray-600 text-xs sm:text-sm grid grid-cols-2 xl:grid-cols-4 2xl:grid-cols-5 justify-items-start">
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="food_post" value="food_post" x-model="item_type_post">
                            <label for="food_post">Food</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="grocery_post" value="grocery_post" x-model="item_type_post">
                            <label for="grocery_post">Grocery items</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="produce_post" value="produce_post" x-model="item_type_post">
                            <label for="produce_post">Local produce</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="pet_post" value="pet_post" x-model="item_type_post">
                            <label for="pet_post">Pet needs</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="apparel_post" value="apparel_post" x-model="item_type_post">
                            <label for="apparel_post">Apparel</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="footwear_post" value="footwear_post" x-model="item_type_post">
                            <label for="footwear_post">Footwear</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="merchandise_post" value="merchandise_post" x-model="item_type_post">
                            <label for="merchandise_post">Merchandise</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="personal_care_post" value="personal_care_post" x-model="item_type_post">
                            <label for="personal_care_post">Personal care</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="celebratory_post" value="celebratory_post" x-model="item_type_post">
                            <label for="celebratory_post">Celebratory</label>
                        </div>
                        <div class="flex flex-row items-center gap-2 mt-1">
                            <input type="checkbox" id="hobbies_post" value="hobbies_post" x-model="item_type_post">
                            <label for="hobbies_post">Hobbies</label>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row items-start gap-4">
                    <div class="mt-4 w-full">
                        <p class="block mb-1 text-sm sm:text-base font-medium text-gray-900 " @click="openDropdown = !openDropdown">Mode of payment</p>
                        <div class="flex flex-col mt-2" x-data="{ clickCheckbox: false }">
                            <button 
                                x-on:click="openDropdown = !openDropdown" 
                                @click.outside="if (!clickCheckbox) { openDropdown = false; }" 
                                class="text-gray-400 bg-gray-50 hover:bg-slate-100 border border-gray-300 focus:outline-none focus:border-[#014421] rounded-lg text-sm px-5 py-2 text-center inline-flex items-center w-full" 
                                type="button">
                                <p class="text-xs sm:text-sm" :class="mode_of_payment_post.length === 4 ? 'text-xs' : ''"  x-text="mode_of_payment_post.length === 0 ? 'Choose' : (window.innerWidth > 640 ? (mode_of_payment_post.length > 2 ? (mode_of_payment_post.slice(0, 2).join(', ') + ' +' + (mode_of_payment_post.length - 2)) : mode_of_payment_post.join(', ')) : (mode_of_payment_post.length > 1 ? mode_of_payment_post[0] + ' +' + (mode_of_payment_post.length - 1) : mode_of_payment_post[0]))"></p>
                                <svg class="w-2.5 h-2.5 ml-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <div @click="clickCheckbox = true" @click.outside="clickCheckbox = false;" :class="openDropdown ? 'block' : 'hidden'" class="fixed mt-10 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow">
                                <ul class="p-3 space-y-3 text-sm text-gray-600">
                                    <li>
                                        <label for="checkbox-item-1" class="flex items-center cursor-pointer">
                                            <input id="checkbox-item-1" type="checkbox" value="Cash" x-model="mode_of_payment_post" class="w-3 bg-gray-100 border-gray-300 rounded">
                                            <span class="ms-2 text-xs sm:text-sm">Cash</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="checkbox-item-2" class="flex items-center cursor-pointer">
                                            <input id="checkbox-item-2" type="checkbox" value="Digital Wallet" x-model="mode_of_payment_post" class="w-3 bg-gray-100 border-gray-300 rounded" checked>
                                            <span class="ms-2 text-xs sm:text-sm">Digital wallet</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="checkbox-item-3" class="flex items-center cursor-pointer">
                                            <input id="checkbox-item-3" type="checkbox" value="Debit/Credit" x-model="mode_of_payment_post" class="w-3 bg-gray-100 border-gray-300 rounded">
                                            <span class="ms-2 text-xs sm:text-sm">Debit/Credit card</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="checkbox-item-4" class="flex items-center cursor-pointer">
                                            <input id="checkbox-item-4" type="checkbox" value="Bank Transfer" x-model="mode_of_payment_post" class="w-3 bg-gray-100 border-gray-400 rounded">
                                            <span class="ms-2 text-xs sm:text-sm">Bank transfer</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>
                    <div class="mt-4 w-full">
                        <p class="block mb-1 text-sm sm:text-base font-medium text-gray-900 ">Date of delivery</p>
                        <div class="relative mt-2">
                        <svg class="absolute left-3 top-2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <input id="datepicker"
                                x-data
                                x-ref="input"
                                x-init="new Pikaday({ 
                                    field: $refs.input, 
                                    format: 'MM/DD/YYYY', 
                                    minDate: new Date(),
                                    onSelect: function() {
                                    console.log(this.getDate());
                                    let date = new Date(this.getDate());
                                    date.setHours(date.getHours() + 8);  // Adjusting for GMT+8

                                    $wire.set('delivery_date', date.toISOString().split('T')[0], false);

                                    }
                                })"
                                id="datepicker"
                                type="text"
                                wire:model="delivery_date"
                                class="block w-full pl-10 p-2 text-xs sm:text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421]"
                                placeholder="Select date"
                        />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col mt-4">
                    <label for="notes" class="block mb-2 text-sm sm:text-base font-medium text-gray-900 ">Other notes</label>
                    <textarea id="notes" rows="4" class="w-full resize-none bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5" placeholder="Enter any additional notes or special requests for your item here..."></textarea>
                </div>
            @elseif($user->role === 'provider')
                <div class="flex flex-col mt-4">
                    <label for="item_name_post" class="block mb-2 text-sm font-medium text-gray-900 ">Item Name</label>
                    <input type="text" id="item_name_post" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="What items are you planning to buy?" />
                </div>
                <div class="flex flex-col mt-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="text" id="email" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="{{ $user->email }}" disabled/>
                </div>
            @endif
        </div>
    </div>
    <div class="mt-5 flex justify-end gap-2">
        <button @click="createPostModalOpen = false; openBurger = true;" class="font-medium w-20 py-1 sm:py-1.5 text-sm bg-white border border-[#014421] text-[#014421] rounded-md hover:bg-slate-100">Cancel</button>
        <button class="font-medium w-20 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">Post</button>
    </div>
</div>