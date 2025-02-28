<div class="font-poppins bg-gray-50" x-data="{ openBurger: false, search: '', all: false, selected: [], startIndeces: [], cancelIndeces: [], startTransactionModalOpen: false, cancelTransactionModalOpen: false, isChangeRoleModalOpen: false, deleteTransactionModalOpen: false, deleteIndex: null }" x-cloak>

   @if(session('change_role_success'))
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
   @elseif(session('action_success'))
      <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
         <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
               <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-center text-sm">
               {{ session('action_success') }}
            </div>
         </div>
         <!-- Close Button -->
         <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
            &times;
         </button>
      </div>
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
   @endif

   @teleport('body')
      <div wire:loading.delay wire:target="updateTransaction, switchRole"
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

   <livewire:navbar />
   <livewire:sidebar />

   <div class="sm:transition-all sm:duration-300 sm:transform relative flex flex-row" style="margin-top: 4.3rem;":class="{'lg:ml-64 xl:ml-96': openBurger, 'md:ml-0': !openBurger}">
      <div class="p-4 w-full">
         <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 border-t">
               <caption class="px-5 pt-5 pb-3 text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                  <p class="text-lg mid:text-xl font-semibold">
                     Your transactions
                  </p>
                  <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 break-words">
                     Browse a list of your transactions, buy and manage customers' orders, update status, and deliver them to your desired meeting place.
                  </p>
                  <div class="flex items-center gap-2 sm:gap-4 mt-4">
                     <div class="relative w-1/2 sm:w-1/3">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                           <svg class="w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                           </svg>
                        </div>
                        <input type="text" id="search-filter-transactions" x-model="search" class="block w-full p-2 ps-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-[#014421]" placeholder="Search orders, item origin, meetup place...">
                     </div>
                     <div class="inline-block h-[35px] w-[0.5px] self-stretch bg-gray-200"></div>
                     <div class="flex items-center gap-2 h-fit text-gray-700">
                        <p class="font-medium">Set transaction status:</p>
                        <button class="flex items-center gap-1 px-2.5 py-1.5 bg-transparent enabled:hover:bg-gray-100 disabled:cursor-not-allowed rounded-md"
                           x-bind:disabled="selected.length === 0 || selected.some(id => {
                              const transactionStatuses = {{ json_encode($transactions->pluck('status', 'id')) }};
                              return transactionStatuses[id] !== 'open' && transactionStatuses[id] !== 'full' || transactionStatuses[id] === 'cancelled';
                           })"
                           @click="startTransactionModalOpen = true; document.body.style.overflow = 'hidden'; startIndeces = selected;"
                        >
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                           </svg>
                           <p class="hidden lg:block">Start</p>
                        </button>
                        <button  class="flex items-center gap-1 px-2.5 py-1.5 bg-transparent enabled:hover:bg-gray-100 disabled:cursor-not-allowed rounded-md"
                           x-bind:disabled="selected.length === 0 || selected.some(id => {
                              const transactionStatuses = {{ json_encode($transactions->pluck('status', 'id')) }};
                              return transactionStatuses[id] !== 'open' && transactionStatuses[id] !== 'full' || transactionStatuses[id] === 'cancelled';
                           })"
                           @click="cancelTransactionModalOpen = true; document.body.style.overflow = 'hidden'; cancelIndeces = selected;"
                        >
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-x"><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/><path d="m17 13 5 5m-5 0 5-5"/></svg>
                           <p class="hidden lg:block">Cancel</p>
                        </button>
                     </div>
                  </div>
               </caption>
               <thead class="text-xs sm:text-sm text-gray-700 uppercase bg-gray-50">
                     <tr>
                        <th scope="col" class="pl-6 py-3 text-center">
                           <input type="checkbox" x-model="all" @change="selected = all ? {{ $transactions->pluck('id') }} : []">
                        </th>
                        <th scope="col" class="pr-6 pl-3 py-3 text-center">
                           Transaction status
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Item name
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Item origin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           Order count
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           Meetup place
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <span class="">Action</span>
                        </th>
                     </tr>
               </thead>
               <tbody>
                     @forelse ($transactions as $transaction)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100"
                           x-show="search === '' || 
                                ['{{ strtolower($transaction->item_name) }}',
                                '{{ strtolower($transaction->status) }}', 
                                '{{ strtolower($transaction->item_origin) }}',
                                ].some(value => value.includes(search.toLowerCase()))
                            "    
                        >
                           <th scope="row" class="pl-6 py-3 font-medium text-gray-900 whitespace-nowrap text-center">
                                <input type="checkbox" :value="{{ $transaction->id }}" x-model="selected">
                            </th>
                           <th scope="row" class="pr-6 pl-3 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                              <span class="
                                 {{ $transaction->status === 'open' ? 'bg-green-900 text-green-300' : '' }}
                                 {{ $transaction->status === 'ongoing' ? 'bg-yellow-900 text-yellow-300' : '' }}
                                 {{ $transaction->status === 'completed' ? 'bg-gray-800 text-gray-300' : '' }}
                                 {{ in_array($transaction->status, ['cancelled', 'full']) ? 'bg-red-900 text-red-300' : '' }}
                                 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full
                              ">
                                 {{ ucwords($transaction->status) }}
                              </span>
   
                           </th>
                           <td class="px-6 py-4">
                                 {{ $transaction->item_name }}
                           </td>
                           <td class="px-6 py-4">
                                 {{ $transaction->item_origin }}
                           </td>
                           <td class="px-6 py-3 text-center">
                                 {{ count($transaction->orders) . "/" . $transaction->max_orders }}
                           </td>
                           <td class="px-6 py-3 text-center">
                                 {{ $transaction->meetup_place }}
                           </td>
                           <td class="px-6 text-center" x-data="{ transactionStatus: '{{ $transaction->status }}' }">
                              <div class="flex flex-row gap-4 items-center justify-center">
                                 <a href="{{ route('transaction.view', ['id' => $transaction->id]) }}" class="">
                                    <div class="flex">
                                       <svg class="block sm:hidden size-5 text-gray-600 hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                       </svg>
                                       <span class="hidden sm:block font-semibold text-gray-600 hover:text-gray-900 hover:underline">View</span>
                                    </div>
                                 </a>            
                              </div>
                           </td>
                        </tr>
                     @empty
                           <tr>
                                 <td colspan="5" class="px-6 py-2 text-center text-gray-500">
                                    No transactions yet.
                                 </td>
                           </tr>
                     @endforelse
               </tbody>
            </table>
            <div class="px-6 py-2">
            </div>
         </div>
      </div>

      <!-- ACQUIRE ORDER MODAL -->
      @teleport('body')
      <div @keydown.escape.window="startTransactionModalOpen = false; document.body.style.overflow = 'auto';"
         x-data="{ confirm: '', errors: {} }" x-show="startTransactionModalOpen" x-transition:enter.duration.25ms
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 font-poppins">
         <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative">
               <div class="flex flex-col items-center gap-2 sm:gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#014421">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                  </svg>
                  <p class="text-lg sm:text-xl font-medium text-black">Are you sure?</p>
                  <p class="text-sm text-center">You will be <span class="text-[#014421] font-medium underline">starting</span> the transaction which will prevent other people from ordering more items.</p>
                  <div class="p-2 border rounded-lg w-full">
                     <ul class="list-disc pl-5" 
                           x-data="{ orders: {{ json_encode($transactions->pluck('item_name', 'id')) }} }">
                           <template x-for="id in selected" :key="id">
                              <li class="text-sm" x-text="orders[id]" x-show="orders[id]"></li>
                           </template>
                     </ul>
                  </div>
                  <button @click="startTransactionModalOpen = false; document.body.style.overflow = 'auto';"
                     class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                           stroke="#000000" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                     </svg>
                  </button>
               </div>
               <div class="mt-5 flex gap-2">
                  <button @click="startTransactionModalOpen = false; document.body.style.overflow = 'auto';"
                     class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                  <button x-data="{ disabled: false }" :disabled="disabled"
                     @click="disabled = true; startTransactionModalOpen = false; $wire.updateTransaction(startIndeces, 'ongoing'); startIndeces = []; selected = [];"
                     class="px-2 sm:px-3 py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">
                     Confirm
                  </button>
               </div>
         </div>
      </div>
      @endteleport

      <!-- UNAVAILABLE ORDER MODAL -->
      @teleport('body')
      <div @keydown.escape.window="cancelTransactionModalOpen = false; document.body.style.overflow = 'auto';"
         x-data="{ confirm: '', errors: {} }" x-show="cancelTransactionModalOpen" x-transition:enter.duration.25ms
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 font-poppins">
         <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative">
               <div class="flex flex-col items-center gap-2 sm:gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ff002b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-x"><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/><path d="m17 13 5 5m-5 0 5-5"/></svg>
                  <p class="text-lg sm:text-xl font-medium text-black">Are you sure?</p>
                  <p class="text-sm text-center">You will be <span class="text-red-600 font-medium underline">cancelling</span> the following transaction/s:</p>
                  <div class="p-2 border rounded-lg w-full">
                     <ul class="list-disc pl-5" 
                           x-data="{ orders: {{ json_encode($transactions->pluck('item_name', 'id')) }} }">
                           <template x-for="id in selected" :key="id">
                              <li class="text-sm" x-text="orders[id]" x-show="orders[id]"></li>
                           </template>
                     </ul>
                  </div>
                  <button @click="cancelTransactionModalOpen = false; document.body.style.overflow = 'auto';"
                     class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                           stroke="#000000" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                     </svg>
                  </button>
               </div>
               <div class="mt-5 flex gap-2">
                  <button @click="cancelTransactionModalOpen = false; document.body.style.overflow = 'auto';"
                     class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                  <button x-data="{ disabled: false }" :disabled="disabled"
                     @click="disabled = true; cancelTransactionModalOpen = false; $wire.updateTransaction(cancelIndeces, 'cancelled'); cancelIndeces = []; selected = [];"
                     class="px-2 sm:px-3 py-1.5 text-sm bg-red-700 text-white rounded-md hover:bg-red-600">
                     Confirm
                  </button>
               </div>
         </div>
      </div>
      @endteleport

      <!-- MODAL -->
      @teleport('body')
         <div @keydown.escape.window="deleteTransactionModalOpen = false; document.body.style.overflow = 'auto';" x-data="{ confirm: '', errors: {} }" x-show="deleteTransactionModalOpen" x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 font-poppins">
            <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/2 lg:w-1/3 relative">
                  <div class="flex flex-col items-center gap-2 sm:gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff4545" class="size-12">
                     <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
                  <p class="text-lg sm:text-xl font-medium text-black">Are you sure?</p>
                  <p class="text-sm">Cancelling this transaction will also cancel all pending orders.</p>
                  <button @click="deleteTransactionModalOpen = false; document.body.style.overflow = 'auto';" class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#000000" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                     </svg>
                  </button>
                  </div>
                  <div class="mt-5 flex gap-2">
                     <button @click="deleteTransactionModalOpen = false; document.body.style.overflow = 'auto';" class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                     <button 
                        x-data="{ disabled: false }"
                        :disabled="disabled"
                        @click="disabled = true; deleteTransactionModalOpen = false; $wire.cancelTransaction(deleteIndex); deleteIndex = null;"
                        class="px-2 sm:px-3 py-1.5 text-sm bg-red-800 text-white rounded-md hover:bg-[#7b1113]"
                     >
                        Confirm
                     </button>
                  </div>
            </div>
         </div>
      @endteleport
   </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', () => {
      setTimeout(() => {
         const flash = document.querySelector('.flash');
         if (flash) {
            flash.style.display = 'none';
         }
      }, 3000); // 3 seconds
   });
</script>
