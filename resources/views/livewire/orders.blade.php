<div class="font-poppins bg-gray-50" x-data="{ openBurger: false, search: '', isChangeRoleModalOpen: false }" x-cloak>

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
   @endif

    <livewire:navbar />
    <livewire:sidebar />

    <!-- CHATBOT -->
   <livewire:chatbot :current_route="'orders'"/>
    <div class="sm:transition-all sm:duration-300 sm:transform relative flex flex-row" style="margin-top: 4.3rem;":class="{'lg:ml-64 xl:ml-96': openBurger, 'md:ml-0': !openBurger}">
      <div class="p-4 w-full">
         <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 border-t" x-data="{ f_status: $wire.entangle('f_status'), f_provider: $wire.entangle('f_provider'), f_itemname: $wire.entangle('f_itemname'), f_itemorigin: $wire.entangle('f_itemorigin'), f_ordercount: $wire.entangle('f_ordercount'), f_meetupplace: $wire.entangle('f_meetupplace') }">
               <caption class="px-5 pt-5 pb-3 text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                  <p class="text-lg mid:text-xl font-semibold">
                     List of transactions containing your orders:
                  </p>
                  <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 break-words">
                     Browse your order transactions, update and manage your orders, check item status, and receive them in your meeting place.
                  </p>
                  <div class="flex items-center gap-2 sm:gap-4 mt-4">
                     <div class="relative w-1/2 sm:w-1/3">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                           <svg class="w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                           </svg>
                        </div>
                        <input type="text" id="search-filter-transaction-list" x-model="search" class="block w-full p-2 ps-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-[#014421]" placeholder="Search orders, item origin, meetup place...">
                     </div>
                  </div>
               </caption>
               <thead class="text-xs sm:text-sm text-gray-700 uppercase bg-gray-200 border-b">
                     <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                              <p>
                                 Transaction status
                              </p>
                              <button @click="$wire.set('f_status', $wire.f_status === '' ? 'asc' : $wire.f_status === 'asc' ? 'desc' : 'asc'); f_provider = ''; f_itemname = ''; f_itemorigin = ''; f_ordercount = ''; f_meetupplace = '';">
                                 <svg x-show="f_status === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                 </svg>
                                 <!-- UP -->
                                 <svg x-show="f_status === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                 </svg>
                                 <!-- DOWN -->
                                 <svg x-show="f_status === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                 </svg>
                              </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                              <p>
                                 Provider
                              </p>
                              <button @click="$wire.set('f_provider', $wire.f_provider === '' ? 'asc' : $wire.f_provider === 'asc' ? 'desc' : 'asc'); f_status = ''; f_itemname = ''; f_itemorigin = ''; f_ordercount = ''; f_meetupplace = '';">
                                 <svg x-show="f_provider === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                 </svg>
                                 <!-- UP -->
                                 <svg x-show="f_provider === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                 </svg>
                                 <!-- DOWN -->
                                 <svg x-show="f_provider === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                 </svg>
                              </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                              <p>
                                 Item name
                              </p>
                              <button @click="$wire.set('f_itemname', $wire.f_itemname === '' ? 'asc' : $wire.f_itemname === 'asc' ? 'desc' : 'asc'); f_provider = ''; f_status = ''; f_itemorigin = ''; f_ordercount = ''; f_meetupplace = '';">
                                 <svg x-show="f_itemname === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                 </svg>
                                 <!-- UP -->
                                 <svg x-show="f_itemname === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                 </svg>
                                 <!-- DOWN -->
                                 <svg x-show="f_itemname === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                 </svg>
                              </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                              <p>
                                 Item origin
                              </p>
                              <button @click="$wire.set('f_itemorigin', $wire.f_itemorigin === '' ? 'asc' : $wire.f_itemorigin === 'asc' ? 'desc' : 'asc'); f_provider = ''; f_itemname = ''; f_status = ''; f_ordercount = ''; f_meetupplace = '';">
                                 <svg x-show="f_itemorigin === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                 </svg>
                                 <!-- UP -->
                                 <svg x-show="f_itemorigin === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                 </svg>
                                 <!-- DOWN -->
                                 <svg x-show="f_itemorigin === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                 </svg>
                              </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                              <p>
                                 Order count
                              </p>
                              <button @click="$wire.set('f_ordercount', $wire.f_ordercount === '' ? 'asc' : $wire.f_ordercount === 'asc' ? 'desc' : 'asc'); f_provider = ''; f_itemname = ''; f_itemorigin = ''; f_status = ''; f_meetupplace = '';">
                                 <svg x-show="f_ordercount === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                 </svg>
                                 <!-- UP -->
                                 <svg x-show="f_ordercount === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                 </svg>
                                 <!-- DOWN -->
                                 <svg x-show="f_ordercount === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                 </svg>
                              </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                              <p>
                                 Meetup place
                              </p>
                              <button @click="$wire.set('f_meetupplace', $wire.f_meetupplace === '' ? 'asc' : $wire.f_meetupplace === 'asc' ? 'desc' : 'asc'); f_provider = ''; f_itemname = ''; f_itemorigin = ''; f_ordercount = ''; f_status = '';">
                                 <svg x-show="f_meetupplace === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                 </svg>
                                 <!-- UP -->
                                 <svg x-show="f_meetupplace === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                 </svg>
                                 <!-- DOWN -->
                                 <svg x-show="f_meetupplace === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                 </svg>
                              </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <span class="">Action</span>
                        </th>
                     </tr>
               </thead>
               <tbody wire:loading.class="hidden">
                     @forelse ($transactions as $transaction)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100"
                           x-show="search === '' || 
                                ['{{ strtolower($transaction->item_name) }}',
                                '{{ strtolower($transaction->meetup_place) }}', 
                                '{{ strtolower($transaction->item_origin) }}',
                                '{{ strtolower(string: $transaction->status) }}'
                                ].some(value => value.includes(search.toLowerCase()))
                            "  
                        >
                           <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
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
                           <td class="px-6 py-4 text-center">
                                 {{ App\Models\User::where('id', $transaction->user_id)->first()->name }}
                           </td>
                           <td class="px-6 py-4 text-center">
                                 {{ $transaction->item_name }}
                           </td>
                           <td class="px-6 py-4 text-center">
                                 {{ $transaction->item_origin }}
                           </td>
                           <td class="px-6 py-3 text-center">
                                 {{ count($transaction->orders->where('customer_id', $user->id)) }}
                           </td>
                           <td class="px-6 py-3 text-center">
                                 {{ $transaction->meetup_place }}
                           </td>
                           <td class="px-6 text-center" x-data="{ transactionStatus: '{{ $transaction->status }}' }">
                              <div class="flex flex-row gap-4 items-center justify-center">
                                 <a href="{{ route('my-orders.view', ['id' => $transaction->id]) }}" class="">
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
                                 <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    No transactions yet.
                                 </td>
                           </tr>
                     @endforelse
               </tbody>
            </table>
            @if (count($transactions) > 0)
               <div class="py-2">
               </div>
            @endif
         </div>
      </div>
   </div>
</div>