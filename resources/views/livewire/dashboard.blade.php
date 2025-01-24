<div class="font-poppins bg-gray-50" x-data="{ openBurger: false, createPostModalOpen:false, isChangeRoleModalOpen: false, clicked: false }" x-cloak>
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
   @endif

   <!-- SKELETON -->
   <div wire:loading wire:targe="switchRole"  class="w-full">
      <livewire:dashboard-skeleton />
   </div>

   <!-- NAVBAR --> 
   <livewire:navbar />

   <!-- SIDEBAR -->
   <livewire:sidebar />
   
   <!-- MAIN CONTENT -->
   <div class="sm:transition-all sm:duration-300 sm:transform relative" style="margin-top: 4.3rem;":class="{
      'lg:ml-64 xl:ml-96': openBurger,
      'md:ml-0': !openBurger
   }"
   wire:loading.class="hidden"
   wire:target="switchRole"
   >
      <div class="p-4 border-r border-gray-200" :class="'w-full lg:w-4/6'">
         <div class="flex flex-col gap-4">
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
            <div class="px-3 md:px-4 py-3 bg-white shadow rounded-md">
               <div class="flex flex-row items-center gap-3 md:gap-4">    
                  <img class="w-9 md:w-10 h-9 md:h-10 rounded-full object-cover" 
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" 
                        alt="user photo">
                  <button 
                        @click="createPostModalOpen = true; document.body.style.overflow = 'hidden';" 
                        class="text-gray-600 text-start text-sm px-3 sm:px-4 py-2 border bg-gray-50 rounded-full w-full">
                        @if ($user->role === 'customer')
                           Looking for items? Click here.
                        @else
                           Making a transaction? Click here.
                        @endif
                  </button>
               </div>
            </div>

            <div class="">
               <!-- POSTS STREAM -->
               <livewire:posts-stream />
            </div>
         </div>
      </div>
   </div>
   <!-- FILTERS -->
   <div class="lg:text-gray-800 lg:mb-4 lg:z-10 lg:block lg:fixed lg:right-0 lg:top-0 lg:p-4 lg:ml-auto lg:w-1/3 bg-gray-50 lg:transition-all lg:duration-300 md:overflow-y-auto 2xl:overflow-y-hidden md:h-[600px] lg:h-[620px] 2xl:h-screen"
     :class="openBurger ? 'hidden lg:block lg:w-3/12 xl:w-[300px] 2xl:w-3/12' : 'hidden'" 
     style="margin-top: 4.3rem;">
      <div class="flex flex-col sm:overflow-y-visible 2xl:overflow-y-hidden" x-data="{ post_type: $wire.entangle('post_type'), item_type: $wire.entangle('item_type'), mode_of_payment: $wire.entangle('mode_of_payment'), delivery_date: $wire.entangle('delivery_date') }">
         <div class="mt-2 relative hidden sm:block w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
               <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
               </svg>
            </div>
            <input type="text" id="search-filter" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421]" placeholder="Search posts, items...">
         </div>
         <div class="mt-2">
            <p class="font-medium">Post type</p>
            <div class="ml-4 text-sm" :class="openBurger ? 'flex flex-col' : 'xl:flex xl:flex-row xl:gap-4'">
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="radio" id="all" value="all" name="post_type" x-model="post_type">
                  <label for="all">All Posts</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="radio" id="transaction" value="transaction" name="post_type" x-model="post_type">
                  <label for="transaction">Transactions</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="radio" id="item_request" value="item_request" name="post_type" x-model="post_type">
                  <label for="item_request">Item Requests</label>
               </div>
            </div>
         </div>
         <hr class="mt-4">
         <div class="mt-2">
            <p class="font-medium">Item type</p>
            <div class="lg:grid lg:grid-cols-2 ml-3 text-sm">
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="food" value="Food" x-model="item_type">
                  <label for="food">Food</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="grocery" value="Grocery item" x-model="item_type">
                  <label for="grocery">Grocery items</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="produce" value="Local produce" x-model="item_type">
                  <label for="produce">Local produce</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="pet" value="Pet needs" x-model="item_type">
                  <label for="pet">Pet needs</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="apparel" value="Apparel" x-model="item_type">
                  <label for="apparel">Apparel</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="footwear" value="Footwear" x-model="item_type">
                  <label for="footwear">Footwear</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="merchandise" value="Merchandise" x-model="item_type">
                  <label for="merchandise">Merchandise</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="personal_care" value="Personal care" x-model="item_type">
                  <label for="personal_care">Personal care</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="celebratory" value="Celebratory" x-model="item_type">
                  <label for="celebratory">Celebratory</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="hobbies" value="Hobbies" x-model="item_type">
                  <label for="hobbies">Hobbies</label>
               </div>
            </div>
         </div>
         <hr class="mt-4">
         <div class="mt-2">
            <p class="font-medium">Mode of payment</p>
            <div class="lg:grid lg:grid-cols-2 ml-3 text-sm">
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="cash" value="Cash" x-model="mode_of_payment">
                  <label for="cash">Cash</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="digital_wallet" value="Digital Wallet" x-model="mode_of_payment">
                  <label for="digital_wallet">Digital wallet</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="debit_credit" value="Debit/Credit" x-model="mode_of_payment">
                  <label for="debit_credit">Debit/Credit card</label>
               </div>
               <div class="flex flex-row items-center gap-2 mt-2">
                  <input type="checkbox" id="bank_transfer" value="Bank Transfer" x-model="mode_of_payment">
                  <label for="bank_transfer">Bank transfer</label>
               </div>
            </div>
         </div>
         <hr class="mt-4">
         <div class="mt-2">
            <p class="font-medium">Date of delivery</p>
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
                     type="text"
                     readonly
                     wire:model="delivery_date"
                     class="block w-full pl-10 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421]"
                     placeholder="Select date"
               />
            </div>
         </div>
         <div class="flex flex-row w-full mt-3 gap-2">
            <button x-bind:disabled="post_type === '' && item_type.length === 0 && mode_of_payment.length === 0 && delivery_date === ''" @click="" class="font-medium px-2 sm:px-3 py-1.5 text-sm  bg-[#014421] enabled:hover:bg-green-800 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-md ml-auto" >Apply</button>
            <button @click="post_type = ''; item_type = []; mode_of_payment = []; delivery_date = '';" x-bind:disabled="post_type === '' && item_type.length === 0 && mode_of_payment.length === 0 && delivery_date === ''"  class="font-medium px-2 sm:px-3 py-1.5 text-sm disabled:bg-gray-300 bg-white enabled:text-black disabled:text-white rounded-md disabled:cursor-not-allowed enabled:hover:bg-slate-200 enabled:border enabled:hover:border-slate-200 enabled:hover:text-black">Clear</button>
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
   <!-- CHANGE ROLE MODAL -->
   <div x-show="isChangeRoleModalOpen" x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30">
      <div @keydown.escape.window="isChangeRoleModalOpen = false; document.body.style.overflow = 'auto';" class="bg-white p-6 rounded-lg w-5/6 md:w-2/3 lg:w-1/2 2xl:w-1/3 relative">
         <div class="flex flex-row items-center gap-2 sm:gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#014421" class="size-6 md:size-7">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="text-xl font-semibold text-[#014421]">Confirmation</p>
            <button @click="isChangeRoleModalOpen = false; document.body.style.overflow = 'auto';" class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#000000" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
               </svg>
            </button>
         </div>
         @if($user->role === 'customer')
            <p class="text-sm md:text-base mt-2 md:mt-5 sm:ml-2 text-justify">By changing role to Provider, you will be able to:</p>
            <ul class="text-sm mt-2 md:mt-4 list-disc list-inside ml-5">
               <li>Create and initiate transactions</li>
               <li>Gather item orders from customers</li>
               <li>Manage orders</li>
               <li>Update order statuses</li>
            </ul>
         @else
            <p class="text-sm md:text-base mt-2 md:mt-5 sm:ml-2 text-justify">
            By changing your role to Customer, you will be able to:
            </p>
            <ul class="text-sm mt-2 md:mt-4 list-disc list-inside ml-5">
               <li>Create item requests</li>
               <li>Place item orders to providers</li>
               <li>Track item orders</li>
               <li>Rate the transaction and provider</li>
            </ul>
         @endif
         <div  class="mt-5 flex justify-end gap-2">
            <button @click="isChangeRoleModalOpen = false; document.body.style.overflow = 'auto';" class="font-medium px-2 sm:px-3 py-1.5 text-sm bg-white text-black  rounded-md hover:bg-slate-200 border hover:border-slate-200 hover:text-black">Cancel</button>
            <button @click="$wire.switchRole(); isChangeRoleModalOpen = false; document.body.style.overflow = 'auto';" class=" px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
         </div>
      </div>
   </div>
</div>

