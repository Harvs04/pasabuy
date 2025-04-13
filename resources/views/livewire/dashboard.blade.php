<div class="font-poppins bg-gray-50" x-data="{ openBurger: false, openFilter: false, createPostModalOpen:false, isChangeRoleModalOpen: false, clicked: false, change: false, search: $wire.entangle('search'), post_type: $wire.entangle('post_type'), item_type: $wire.entangle('item_type'), mode_of_payment: $wire.entangle('mode_of_payment'), delivery_date: $wire.entangle('delivery_date') }" x-cloak>
   @if(session('create_post_success'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div class="text-center text-sm">
               {{ session('create_post_success') }}
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
   @elseif(session('create_post_error'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
               </svg>
               <div class="text-center text-sm">
                  {{ session('create_post_error') }}
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
   @elseif(session('change_role_success'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
   @elseif(session('order_added'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div class="text-center text-sm">
               {{ session('order_added') }}
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
   @elseif(session('order_add_error'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
               </svg>
               <div class="text-center text-sm">
                  {{ session('order_add_error') }}
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
   @elseif(session('create_transaction_success'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div class="text-center text-sm">
               {{ session('create_transaction_success') }}
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
   @elseif(session('error'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
   @elseif(session('report_user_success'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-center text-sm">
               {{ session('report_user_success') }}
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
   <div class="fixed bottom-4 right-20 z-10 lg:hidden">
      <button @click="openFilter = true" class="bg-[#014421] hover:bg-green-800 shadow-lg rounded-full w-12 h-12 flex items-center justify-center transform transition-transform duration-300 hover:scale-110">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FFFFFF" class="size-5">
            <path fill-rule="evenodd" d="M3.792 2.938A49.069 49.069 0 0 1 12 2.25c2.797 0 5.54.236 8.209.688a1.857 1.857 0 0 1 1.541 1.836v1.044a3 3 0 0 1-.879 2.121l-6.182 6.182a1.5 1.5 0 0 0-.439 1.061v2.927a3 3 0 0 1-1.658 2.684l-1.757.878A.75.75 0 0 1 9.75 21v-5.818a1.5 1.5 0 0 0-.44-1.06L3.13 7.938a3 3 0 0 1-.879-2.121V4.774c0-.897.64-1.683 1.542-1.836Z" clip-rule="evenodd" />
         </svg>
      </button>
   </div>

   <div id="logo-sidebar" 
     class="lg:hidden fixed top-0 right-0 z-20 w-64 xl:w-96 h-full max-h-[calc(100svh-10rem)] my-20 bg-white rounded-l-3xl drop-shadow-md"
     aria-label="Filter" 
     x-show="openFilter"
     x-transition:enter="transition ease-out duration-300 transform"
     x-transition:enter-start="translate-x-full"
     x-transition:enter-end="-translate-x-0"
     x-transition:leave="transition ease-in duration-100 transform"
     x-transition:leave-start="-translate-x-0"
     x-transition:leave-end="translate-x-full"
     @click.outside="if (openFilter) { openFilter = false; }"
     x-data="{ openPostType: false, openItemType: false, openMOP: false, openDateFilter: false }">
     <div class="flex flex-col text-gray-800 overflow-y-auto p-4 h-full max-h-[calc(100svh-10rem)] gap-2">
         <p class="mb-2 text-lg font-medium">Filters</p>
         <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
               <svg class="w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
               </svg>
            </div>
            <input type="text" id="search-filter-mobile" @input="change = true" x-model="search" class="block w-full p-2 ps-8 text-sm text-gray-900 border border-gray-300 rounded-full bg-white focus:outline-none focus:border-[#014421]" placeholder="Search posts, items...">
         </div>
         <div class="mt-2">
            <button class="flex w-full" @click="openPostType = !openPostType">
               <p class="font-medium text-[15px]">Post Type</p>
               <div class="ml-auto">
                  <svg x-show="!openPostType" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                     <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                  </svg>
                  <svg x-show="openPostType" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                     <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                  </svg>
               </div>
            </button>
            <div class="" x-show="openPostType">
               <div class="ml-4 text-sm" >
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="radio" id="transaction" value="transaction" name="post_type" @change="change = true" x-model="post_type">
                     <label for="transaction">Transactions</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="radio" id="item_request" value="item_request" name="post_type" @change="change = true" x-model="post_type">
                     <label for="item_request">Item Requests</label>
                  </div>
               </div>
            </div>
         </div>
         <hr class="">
         <div class="">
            <button class="flex w-full" @click="openItemType = !openItemType">
               <p class="font-medium text-[15px]">Item Type</p>
               <div class="ml-auto">
                  <svg x-show="!openItemType" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                     <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                  </svg>
                  <svg x-show="openItemType" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                     <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                  </svg>
               </div>
            </button>
            <div class="" x-show="openItemType">
               <div class="lg:grid lg:grid-cols-2 ml-3 text-sm">
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="food" value="Food" @change="change = true" x-model="item_type">
                     <label for="food">Food</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="grocery" value="Grocery item" @change="change = true" x-model="item_type">
                     <label for="grocery">Grocery items</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="produce" value="Local produce" @change="change = true" x-model="item_type">
                     <label for="produce">Local produce</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="pet" value="Pet needs" @change="change = true" x-model="item_type">
                     <label for="pet">Pet needs</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="apparel" value="Apparel" @change="change = true" x-model="item_type">
                     <label for="apparel">Apparel</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="footwear" value="Footwear" @change="change = true" x-model="item_type">
                     <label for="footwear">Footwear</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="merchandise" value="Merchandise" @change="change = true" x-model="item_type">
                     <label for="merchandise">Merchandise</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="personal_care" value="Personal care" @change="change = true" x-model="item_type">
                     <label for="personal_care">Personal care</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="celebratory" value="Celebratory" @change="change = true" x-model="item_type">
                     <label for="celebratory">Celebratory</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="hobbies" value="Hobbies" @change="change = true" x-model="item_type">
                     <label for="hobbies">Hobbies</label>
                  </div>
               </div>
            </div>
         </div>
         <hr class="">
         <div class="">
            <button class="flex w-full" @click="openMOP = !openMOP">
               <p class="font-medium text-[15px]">Mode of Payment</p>
               <div class="ml-auto">
                  <svg x-show="!openMOP" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                     <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                  </svg>
                  <svg x-show="openMOP" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                     <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                  </svg>
               </div>
            </button>
            <div class="" x-show="openMOP">
               <div class="lg:grid lg:grid-cols-2 ml-3 text-sm">
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="cash" value="Cash" @change="change = true" x-model="mode_of_payment">
                     <label for="cash">Cash</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="digital_wallet" value="Digital Wallet" @change="change = true" x-model="mode_of_payment">
                     <label for="digital_wallet">Digital wallet</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="debit_credit" value="Debit Credit" @change="change = true" x-model="mode_of_payment">
                     <label for="debit_credit">Debit/Credit</label>
                  </div>
                  <div class="flex flex-row items-center gap-2 mt-2">
                     <input type="checkbox" id="bank_transfer" value="Bank Transfer" @change="change = true" x-model="mode_of_payment">
                     <label for="bank_transfer">Bank transfer</label>
                  </div>
               </div>
            </div>
         </div>
         <hr class="">
         <div class="">
            <button class="flex w-full" @click="openDateFilter = !openDateFilter">
               <p class="font-medium text-[15px]">Date of delivery</p>
               <div class="ml-auto">
                  <svg x-show="!openDateFilter" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                     <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                  </svg>
                  <svg x-show="openDateFilter" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                     <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                  </svg>
               </div>
            </button>
            <div class="mb-4  mt-2" x-show="openDateFilter">
               <div class="relative">
                  <input id="datepicker"
                        @change="
                              change = true;
                              console.log($event.target.value);
                              let selectedDate = new Date($event.target.value);
                              selectedDate.setHours(selectedDate.getHours() + 8);  // Adjusting for GMT+8
                              $wire.set('delivery_date', selectedDate.toISOString().split('T')[0], false);
                        "
                        type="date"
                        onkeydown="return false;" 
                        wire:model="delivery_date"
                        class="block w-full p-2 text-sm text-gray-500 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-[#014421]"
                        placeholder="Select date"
                  />
               </div>
            </div>
         </div>
         <div class="flex flex-row w-full gap-2 mt-auto">
            <button x-bind:disabled="search === '' && post_type === '' && item_type.length === 0 && mode_of_payment.length === 0 && delivery_date === ''" @click="$wire.applyFilter()" class="font-medium px-2 py-1.5 text-sm  bg-[#014421] enabled:hover:bg-green-800 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-md ml-auto" >Apply</button>
            <button @click="change = false; search = ''; post_type = ''; item_type = []; mode_of_payment = []; delivery_date = ''; $wire.clearFilter();" x-bind:disabled="search === '' && post_type === '' && item_type.length === 0 && mode_of_payment.length === 0 && delivery_date === ''"  class="font-medium px-2 py-1.5 text-sm disabled:bg-gray-300 bg-white enabled:text-black disabled:text-white rounded-md disabled:cursor-not-allowed enabled:hover:bg-slate-200 enabled:border enabled:hover:border-slate-200 enabled:hover:text-black">Clear</button>
         </div>
      </div>
   </div>
   
   <!-- SKELETON -->
   <div wire:loading wire:target="applyFilter, clearFilter"  class="w-full">
      <livewire:dashboard-skeleton />
   </div>
   
   @teleport('body')
   <div wire:loading wire:target="reportUser"
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

   <!-- NAVBAR --> 
   <livewire:navbar />

   <!-- SIDEBAR -->
   <livewire:sidebar />

   <!-- CHATBOT -->
   <livewire:chatbot :current_route="'dashboard'"/>
   
   <!-- MAIN CONTENT -->
   <div class="sm:transition-all sm:duration-300 sm:transform relative" style="margin-top: 4.3rem;"
   wire:loading.class="hidden"
   wire:target="switchRole, applyFilter, clearFilter"
   >
      <div class="pb-4 sm:p-4 border-gray-200 w-full lg:w-4/6">
         <div class="flex flex-col gap-2 md:gap-4">
            @if ($user->contact_number === null || $user->constituent === null || $user->college === null || $user->degree_program === null)
               <div class="flex flex-col w-full rounded-md bg-rose-200 px-3 py-2.5 text-[#7b1113] gap-2">
                  <div class="flex flex-row items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                     </svg>
                     <p class="text-sm sm:text-base font-semibold">
                        Missing profile information
                     </p>
                  </div>
                  <p class="ml-2 text-sm sm:text-sm text-[#7b1113]">
                     Please update your profile and make sure that you have a 
                     <span class="font-medium">contact number</span>, 
                     <span class="font-medium">constituent type</span>,
                     <span class="font-medium">college</span>, and 
                     <span class="font-medium">degree program</span>, in order to order items or make transactions.
                     <a href="{{ route('profile', ['name' => $user->name]) }}" class="font-medium underline">Update here.</a>
                  </p>
               </div>
            @endif
            @if ($user->pasabuy_points < 80)
               <div class="flex flex-col w-full rounded-md bg-rose-200 px-3 py-2.5 text-[#7b1113] gap-2">
                  <div class="flex flex-row items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                     </svg>
                     <p class="text-sm sm:text-base font-medium">
                        Insufficient PASABUY points
                     </p>
                  </div>
                  <p x-show="'{{ $user->role }}' === 'customer'" class="ml-2 text-sm sm:text-sm text-[#7b1113]">You do not have enough PASABUY points to create item requests or order items.</p>
                  <p x-show="'{{ $user->role }}' === 'provider'" class="ml-2 text-sm sm:text-sm text-[#7b1113]">You do not have enough PASABUY points to create and perform transactions.</p>
               </div>
            @endif
            <div class="flex items-center gap-3 px-3 py-3 bg-white border sm:rounded-md">  
               <a href="{{ route('profile', ['name' => $user->name]) }}" class="flex-shrink-0">
                  <img class="w-9 h-9 md:w-10 md:h-10 object-cover rounded-full border" 
                        src="{{ $user->profile_pic_url }}" 
                        alt="user_photo">
               </a>
               <button 
                     @click="createPostModalOpen = true; document.body.style.overflow = 'hidden';" 
                     class="text-gray-600 text-start text-sm px-3 py-2 border bg-gray-50 rounded-full w-full">
                     @if ($user->role === 'customer')
                        Looking for items? Click here.
                     @else
                        Making a transaction? Click here.
                     @endif
               </button>
            </div>
            <div class="">
                <!-- POSTS STREAM -->
                <livewire:posts-stream lazy key="{{ now() }}" :posts="$posts" :type="'dashboard'" />
            </div>
         </div>
      </div>
   </div>

   <!-- FILTERS -->
   <div class="hidden border-l border-b lg:text-gray-800 lg:mb-4 lg:z-10 lg:block lg:fixed lg:right-0 lg:top-0 lg:p-4 lg:ml-auto lg:w-1/3 bg-white lg:transition-all lg:duration-300 md:overflow-y-auto 2xl:overflow-y-hidden md:h-[600px] lg:h-[620px] 2xl:h-screen"

     style="margin-top: 4.3rem;">
      <div class="flex flex-col sm:overflow-y-visible 2xl:overflow-y-hidden">
         <div class="mt-2 relative hidden sm:block w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
               <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
               </svg>
            </div>
            <input type="text" id="search-filter" @input="change = true" x-model="search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-[#014421]" placeholder="Search posts, items...">
         </div>
         <div class="mt-2">
            <p class="font-medium">Post type</p>
            <div class="ml-4 text-sm" >
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="radio" id="transaction" value="transaction" name="post_type" @change="change = true" x-model="post_type">
                  <label for="transaction">Transactions</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="radio" id="item_request" value="item_request" name="post_type" @change="change = true" x-model="post_type">
                  <label for="item_request">Item Requests</label>
               </div>
            </div>
         </div>
         <hr class="mt-4">
         <div class="mt-2">
            <p class="font-medium">Item type</p>
            <div class="lg:grid lg:grid-cols-2 ml-3 text-sm">
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="food" value="Food" @change="change = true" x-model="item_type">
                  <label for="food">Food</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="grocery" value="Grocery item" @change="change = true" x-model="item_type">
                  <label for="grocery">Grocery items</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="produce" value="Local produce" @change="change = true" x-model="item_type">
                  <label for="produce">Local produce</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="pet" value="Pet needs" @change="change = true" x-model="item_type">
                  <label for="pet">Pet needs</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="apparel" value="Apparel" @change="change = true" x-model="item_type">
                  <label for="apparel">Apparel</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="footwear" value="Footwear" @change="change = true" x-model="item_type">
                  <label for="footwear">Footwear</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="merchandise" value="Merchandise" @change="change = true" x-model="item_type">
                  <label for="merchandise">Merchandise</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="personal_care" value="Personal care" @change="change = true" x-model="item_type">
                  <label for="personal_care">Personal care</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="celebratory" value="Celebratory" @change="change = true" x-model="item_type">
                  <label for="celebratory">Celebratory</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="hobbies" value="Hobbies" @change="change = true" x-model="item_type">
                  <label for="hobbies">Hobbies</label>
               </div>
            </div>
         </div>
         <hr class="mt-4">
         <div class="mt-2">
            <p class="font-medium">Mode of payment</p>
            <div class="lg:grid lg:grid-cols-2 ml-3 text-sm">
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="cash" value="Cash" @change="change = true" x-model="mode_of_payment">
                  <label for="cash">Cash</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="digital_wallet" value="Digital Wallet" @change="change = true" x-model="mode_of_payment">
                  <label for="digital_wallet">Digital wallet</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="debit_credit" value="Debit Credit" @change="change = true" x-model="mode_of_payment">
                  <label for="debit_credit">Debit/Credit</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="bank_transfer" value="Bank Transfer" @change="change = true" x-model="mode_of_payment">
                  <label for="bank_transfer">Bank transfer</label>
               </div>
            </div>
         </div>
         <hr class="mt-4">
         <div class="mt-2">
            <p class="font-medium">Date of delivery</p>
            <div class="relative mt-2">
               <input id="datepicker"
       @change="
            change = true;
            console.log($event.target.value);
            let selectedDate = new Date($event.target.value);
            selectedDate.setHours(selectedDate.getHours() + 8);  // Adjusting for GMT+8
            $wire.set('delivery_date', selectedDate.toISOString().split('T')[0], false);
       "
       type="date"
       onkeydown="return false;" 
       wire:model="delivery_date"
       class="block w-full p-2 text-sm text-gray-500 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-[#014421]"
       placeholder="Select date"
/>

            </div>
         </div>
         <div class="flex flex-row w-full mt-3 gap-2">
            <button x-bind:disabled="search === '' && post_type === '' && item_type.length === 0 && mode_of_payment.length === 0 && delivery_date === ''" @click="$wire.applyFilter()" class="font-medium px-2 sm:px-3 py-1.5 text-sm  bg-[#014421] enabled:hover:bg-green-800 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-md ml-auto" >Apply</button>
            <button @click="change = false; search = ''; post_type = ''; item_type = []; mode_of_payment = []; delivery_date = ''; $wire.clearFilter();" x-bind:disabled="search === '' && post_type === '' && item_type.length === 0 && mode_of_payment.length === 0 && delivery_date === ''"  class="font-medium px-2 sm:px-3 py-1.5 text-sm disabled:bg-gray-300 bg-white enabled:text-black disabled:text-white rounded-md disabled:cursor-not-allowed enabled:hover:bg-slate-200 enabled:border enabled:hover:border-slate-200 enabled:hover:text-black">Clear</button>
         </div>
      </div>
   </div>
   <!-- CREATE POST MODAL -->
   <div 
      x-show="createPostModalOpen" 
      @keydown.escape.window="if (!clicked) { createPostModalOpen = false; document.body.style.overflow = 'auto'; }" 
      x-transition:enter.duration.50ms 
      x-transition:leave.duration.50ms 
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30"
   >
      <livewire:make-post />
   </div>
</div>

