<div x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30">
      <div @keydown.escape.window="notifDetailsOpen = false; document.body.style.overflow = 'auto';" class="bg-white p-6 rounded-lg w-11/12 md:w-2/3 lg:w-1/2 2xl:w-1/3 relative">
         <div class="flex flex-row items-center gap-2 sm:gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#014421" class="size-6 md:size-7">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="text-xl font-semibold text-[#014421]">Confirmation</p>
            <button @click="notifDetailsOpen = false; document.body.style.overflow = 'auto';" class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
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
            <button @click="notifDetailsOpen = false; document.body.style.overflow = 'auto';" class="font-medium px-2 sm:px-3 py-1.5 text-sm bg-white text-black  rounded-md hover:bg-slate-200 border hover:border-slate-200 hover:text-black">Cancel</button>
            <button @click="" class=" px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
         </div>
      </div>
   </div>