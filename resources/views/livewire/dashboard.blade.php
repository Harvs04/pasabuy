<div class="font-poppins bg-gray-100" x-data="{ openBurger: true, createPostModalOpen:false, isChangeRoleModalOpen: false, clicked: false }" x-cloak>
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
   @endif
   <nav class="fixed top-0 z-40 w-full bg-[#014421] border-b">
      <div class="px-3 py-1.5 lg:px-5 lg:pl-3">
         <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end w-4/6">
               <div class="flex flex-row gap-2 items-center ml-2 sm:ml-5">
                  <button @click="openBurger = !openBurger">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-6 sm:size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                     </svg>
                  </button>
                  <a href={{ route('dashboard') }}  class="flex ms-2 md:me-24">
                     <img src={{ asset('assets/Pasabuy-logo-no-name.png') }} class="h-14 me-3" alt="FlowBite Logo" />
                     <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">PASABUY</span>
                  </a>
               </div>
            </div>
            <div class="relative flex items-center gap-2" x-data="{ open: false }">
                  <button class="sm:hidden block" @click="openBurger = true">
                     <svg class="w-5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                     </svg>
                  </button>
                  <div class="flex items-center ms-3">
                  <div>
                     <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" @click="open = !open">
                        <img class="size-9 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                     </button>
                  </div>
                  <div class="absolute right-0 top-5  z-40 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user" x-show="open" @click.outside="open = false">
                     <div class="px-4 py-3 hover:bg-gray-100 hover:rounded-md">
                        <a href="{{ route('profile', ['name' => $user->name]) }}">
                        <p class="text-sm text-gray-900 ">
                           {{ $user-> name }}
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate ">
                           {{ $user->email }}
                        </p>
                        </a>
                     </div>
                     <ul class="py-1">
                        <li>
                        <button type="button" @click="isChangeRoleModalOpen = true" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Switch to {{ $user->role === 'customer' ? 'Provider' : 'Customer' }} </button>
                        </li>
                        <li>
                        <button type="button" wire:click="signOut" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white" role="menuitem">Log out</button>
                        </li>
                     </ul>
                  </div>
                  </div>
            </div>
         </div>
      </div>
   </nav>
   <div wire:loading  class="w-full">
      <livewire:dashboard-skeleton />
   </div>
   <!-- SIDEBAR -->
   <div id="logo-sidebar" 
     class="fixed top-0 left-0 z-30 w-64 xl:w-96 h-screen pt-20 bg-gray-50 border-r border-gray-200"
     aria-label="Sidebar" 
     x-show="openBurger"
     x-transition:enter="transition ease-out duration-300 transform"
     x-transition:enter-start="-translate-x-full"
     x-transition:enter-end="translate-x-0"
     x-transition:leave="transition ease-in duration-100 transform"
     x-transition:leave-start="translate-x-0"
     x-transition:leave-end="-translate-x-full"
     @click.outside="if (openBurger && window.innerWidth < 640) { openBurger = false; }">
      <div class="h-full px-3 pb-4 overflow-y-auto">
         <ul class="space-y-2 text-[15px]">
               <li>
                  <div class="relative block w-full sm:hidden mt-2">
                     <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                     <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                     </svg>
                     </div>
                     <input type="text" id="search-sidebar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50" placeholder="Search items, stores, ...">
                  </div>
               </li>
            <li>
               <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group hover:font-medium">
                  <!-- <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                     <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                     <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                  </svg> -->
                  <svg class="w-5 h-5 sm:w-6 sm:h-6  text-gray-500 transition duration-75 group-hover:text-gray-900 " aria-hidden="true" viewBox="0 0 40 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                     <path d="M16.6666 33.3333V23.3333H23.3333V33.3333H31.6666V20H36.6666L20 5L3.33331 20H8.33331V33.3333H16.6666Z"/>
                  </svg>

                  <span class="ms-3">Dashboard</span>
               </a>
            </li>
            <li>
               <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group hover:font-medium">
                  <svg class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                     <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                  </svg>
                  <span class="flex-1 ms-3 whitespace-nowrap">Messages</span>
                  <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span>
               </a>
            </li>
            @if($user->role === 'customer')
               <li>
                  <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group hover:font-medium">
                     <svg class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                     <path d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z"/>
                     </svg>


                     <span class="flex-1 ms-3 whitespace-nowrap">Saved</span>
                  </a>
               </li>
               <li>
               <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group hover:font-medium">
                  <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                  <span class="flex-1 ms-3 whitespace-nowrap">My Orders</span>
               </a>
               </li>
            @elseif($user->role === 'provider')
               <li>
                  <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group hover:font-medium">
                     <svg class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                     <path fill-rule="evenodd" d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                     </svg>

                     <span class="flex-1 ms-3 whitespace-nowrap">Transactions</span>
                  </a>
               </li>
               <li>
                  <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group hover:font-medium">
                     <!-- <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                     </svg> -->
                     <svg class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32.5 13.3332H28.3334V9.99984C28.3334 8.1665 26.8334 6.6665 25 6.6665H5.00002C3.16669 6.6665 1.66669 8.1665 1.66669 9.99984V24.9998C1.66669 26.8332 3.16669 28.3332 5.00002 28.3332C5.00002 31.0998 7.23335 33.3332 10 33.3332C12.7667 33.3332 15 31.0998 15 28.3332H25C25 31.0998 27.2334 33.3332 30 33.3332C32.7667 33.3332 35 31.0998 35 28.3332H36.6667C37.5834 28.3332 38.3334 27.5832 38.3334 26.6665V21.1165C38.3334 20.3998 38.1 19.6998 37.6667 19.1165L33.8334 13.9998C33.5167 13.5832 33.0167 13.3332 32.5 13.3332ZM10 29.9998C9.08335 29.9998 8.33335 29.2498 8.33335 28.3332C8.33335 27.4165 9.08335 26.6665 10 26.6665C10.9167 26.6665 11.6667 27.4165 11.6667 28.3332C11.6667 29.2498 10.9167 29.9998 10 29.9998ZM32.5 15.8332L35.7667 19.9998H28.3334V15.8332H32.5ZM30 29.9998C29.0834 29.9998 28.3334 29.2498 28.3334 28.3332C28.3334 27.4165 29.0834 26.6665 30 26.6665C30.9167 26.6665 31.6667 27.4165 31.6667 28.3332C31.6667 29.2498 30.9167 29.9998 30 29.9998Z" fill="currentColor"/>
                     </svg>
   
                     <span class="flex-1 ms-3 whitespace-nowrap">Deliveries</span>
                  </a>
               </li>
               @endif
            <li>
               <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group hover:font-medium">
                  <svg class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                     <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                  </svg>

                  <span class="flex-1 ms-3 whitespace-nowrap">Pasabuy History</span>
               </a>
            </li>
         </ul>
      </div>
   </div>
   <!-- MAIN CONTENT -->
   <div class="sm:transition-all sm:duration-300 sm:transform relative" style="margin-top: 4.3rem;":class="{
      'lg:ml-64 xl:ml-96': openBurger,
      'md:ml-0': !openBurger
   }"
   wire:loading.class="hidden"
   >
      <div class="p-4 border-r border-gray-200" :class="'w-full lg:w-4/6'">
         <div class="flex flex-col gap-4">
            @if ($user->contact_number === null || $user->college === null || $user->degree_program === null)
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
                     <span class="font-medium underline">contact number</span>, 
                     <span class="font-medium underline">college</span>, and 
                     <span class="font-medium underline">degree program</span>, in order to do transactions.
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
                  <p x-show="'{{ $user->role }}' === 'customer'" class="ml-2 text- sm:text-sm text-[#7b1113]">You do not have enough PASABUY points to create item requests and avail transactions.</p>
                  <p x-show="'{{ $user->role }}' === 'provider'" class="ml-2 text- sm:text-sm text-[#7b1113]">You do not have enough PASABUY points to create and perform transactions.</p>
               </div>
            @endif
            <div class="px-3 md:px-4 py-3 bg-white border border-gray-50 shadow-sm rounded-md">
               <div class="flex flex-row items-center gap-3 md:gap-4">
                  <img class="w-9 md:w-10 h-9 md:h-10 rounded-full object-cover" 
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" 
                        alt="user photo">
                  <button 
                        @click="createPostModalOpen = true;" 
                        class="text-gray-600 text-start text-xs md:text-sm px-3 sm:px-4 py-1 md:py-2 border bg-gray-100 rounded-full w-full">
                        @if ($user->role === 'customer')
                           Looking for items, {{ $user->name }}?
                        @else
                           Planning to buy items in bulk, {{ $user->name }}?
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
   <div class="lg:text-gray-800 lg:mb-4 lg:z-10 md:block lg:fixed lg:right-0 lg:top-0 lg:p-4 lg:ml-auto lg:w-1/3 bg-gray-100 lg:transition-all lg:duration-300 md:overflow-y-auto 2xl:overflow-y-hidden md:h-[600px] lg:h-[620px] 2xl:h-screen"
     :class="openBurger ? 'md:hidden lg:block lg:w-3/12 xl:w-[300px] 2xl:w-3/12' : 'hidden'" 
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
                     wire:model="delivery_date"
                     class="block w-full pl-10 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421]"
                     placeholder="Select date"
               />
            </div>
         </div>
         <div class="flex flex-row w-full mt-3 gap-2">
            <button x-bind:disabled="post_type === '' && item_type.length === 0 && mode_of_payment.length === 0 && delivery_date === ''" @click="" class="font-medium px-2 sm:px-3 py-1.5 text-sm  bg-[#014421] enabled:hover:bg-green-800 disabled:bg-gray-500 text-white rounded-md ml-auto" >Apply</button>
            <button @click="post_type = ''; item_type = []; mode_of_payment = []; delivery_date = '';" x-bind:disabled="post_type === '' && item_type.length === 0 && mode_of_payment.length === 0 && delivery_date === ''"  class="font-medium px-2 sm:px-3 py-1.5 text-sm disabled:bg-gray-500 bg-white enabled:text-black disabled:text-white rounded-md enabled:hover:bg-slate-200 enabled:border enabled:hover:border-slate-200 enabled:hover:text-black">Clear</button>
         </div>
      </div>
   </div>
   <!-- CREATE POST MODAL -->
   <div 
      x-show="createPostModalOpen" 
      @keydown.escape.window="if (!clicked) { createPostModalOpen = false; }" 
      x-transition:enter.duration.50ms 
      x-transition:leave.duration.50ms 
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
   >
      <livewire:make-post />
   </div>
   <!-- CHANGE ROLE MODAL -->
   <div x-show="isChangeRoleModalOpen" x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/3">
         <div class="flex flex-row items-center gap-2 sm:gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#014421" class="size-5 sm:size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <p class="text-xl font-semibold text-[#014421]">Reminder</p>
         </div>
         @if($user->role === 'customer')
            <p class="text-xs md:text-sm mt-2 md:mt-5 sm:ml-2 text-justify">By changing role to Provider, you will be able to:</p>
            <ul class="text-xs md:text-sm mt-2 md:mt-4 list-disc list-inside ml-5">
            <li>Create and initiate transactions</li>
            <li>Gather item orders from customers</li>
            <li>Manage orders</li>
            <li>Update order statuses</li>
            </ul>
         @else
            <p class="text-xs md:text-sm mt-2 md:mt-5 sm:ml-2 text-justify">
            By changing your role to Customer, you will be able to:
            </p>
            <ul class="text-xs md:text-sm mt-2 md:mt-4 list-disc list-inside ml-5">
            <li>Create item requests</li>
            <li>Place item orders to providers</li>
            <li>Track item orders</li>
            <li>Rate the transaction and provider</li>
            </ul>
         @endif
         <div class="mt-5 flex justify-end gap-2">
            <button @click="isChangeRoleModalOpen = false" class="font-medium px-2 sm:px-3 py-1 sm:py-1.5 text-sm sm:text-base bg-white border border-[#014421] text-[#014421] rounded-md hover:bg-slate-100">Cancel</button>
            <button @click="$wire.switchRole(); isChangeRoleModalOpen = false;" class=" font-medium px-2 sm:px-3 py-1 sm:py-1.5 text-sm sm:text-base bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
         </div>
      </div>
   </div>
</div>

