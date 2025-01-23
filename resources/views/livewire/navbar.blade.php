<nav class="fixed top-0 z-30 w-full bg-[#014421] border-b">
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
            <button class="ml-auto">
               <div class="flex flex-row justify-start items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-8 transform scale-90">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                  </svg>
                  <span class="self-start bg-white p-0.5 rounded-full">
                     <p class="text-[#7b1113] text-xs font-medium leading-none">3</p>
                  </span>
               </div>
            </button>



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
                     <div class="px-4 py-3 hover:bg-gray-100 hover:rounded-t-md">
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
                        <button type="button" @click="isChangeRoleModalOpen = true; document.body.style.overflow = 'hidden';" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Switch to {{ $user->role === 'customer' ? 'Provider' : 'Customer' }} </button>
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