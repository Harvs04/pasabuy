<div class="font-poppins bg-gray-50" x-data="{ openBurger: false, isChangeRoleModalOpen: false, search: '' }" x-cloak>

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
    @endif

    <livewire:navbar />
    <livewire:sidebar />
    <!-- CHATBOT -->
   <livewire:chatbot :current_route="'history'"/>
    <div class="sm:transition-all sm:duration-300 sm:transform relative flex flex-row" style="margin-top: 4.3rem;" :class="{'lg:ml-64 xl:ml-96': openBurger, 'md:ml-0': !openBurger}">
    <div class="p-4 w-full">
         <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500" x-data="{ role: '{{ $user->role }}', f_order: $wire.entangle('f_order'), f_provider: $wire.entangle('f_provider'), f_customer: $wire.entangle('f_customer'), f_ostatus: $wire.entangle('f_ostatus'), f_deliverydate: $wire.entangle('f_deliverydate') }">
               <caption class="p-5 text-lg mid:text-xl text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                  @if ($user->role === 'customer')
                     <p class="font-semibold">Order history</p>
                     <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 break-words">
                     Browse your previous orders, view detailed order history, and revisit your past purchases for easy reference or reordering.
                     </p>
                  @elseif ($user->role === 'provider')
                     <p class="font-semibold">Delivery history</p>
                     <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 break-words">
                        Browse your previous transactions and view ratings from customers.
                     </p>
                  @endif
                  <div class="flex items-center gap-2 sm:gap-4 mt-4">
                     <div class="relative w-1/2 sm:w-1/3">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                           <svg class="w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                           </svg>
                        </div>
                        <input type="text" id="search-filter-transactions" x-model="search" class="block w-full p-2 ps-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-[#014421]" placeholder="Search orders, item origin, meetup place...">
                     </div>
                  </div>
               </caption>
               <thead class="text-xs sm:text-sm text-gray-700 uppercase bg-gray-200 border-y">
                     <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                                <p>
                                    Order
                                </p>
                                <button @click="$wire.set('f_order', $wire.f_order === '' ? 'asc' : $wire.f_order === 'asc' ? 'desc' : 'asc'); f_customer = ''; f_provider = ''; f_ostatus = ''; f_deliverydate = '';">
                                    <svg x-show="f_order === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                    <!-- UP -->
                                    <svg x-show="f_order === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <!-- DOWN -->
                                    <svg x-show="f_order === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                        <div class="flex items-start justify-center gap-1">
                                <p>
                                 @if ($user->role === 'customer')
                                    Provider
                                 @elseif ($user->role === 'provider')
                                    Customer                           
                                 @endif
                                </p>
                                <button @click="role === 'customer' ? 
                                    $wire.set('f_provider', $wire.f_provider === '' ? 'asc' : $wire.f_provider === 'asc' ? 'desc' : 'asc') : 
                                    $wire.set('f_customer', $wire.f_customer === '' ? 'asc' : $wire.f_customer === 'asc' ? 'desc' : 'asc'); 
                                    f_order = '';
                                    f_ostatus = ''; 
                                    f_deliverydate = '';">
                                    <svg x-show="f_provider === '' && f_customer === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                    <!-- UP -->
                                    <svg x-show="f_provider === 'asc' || f_customer === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <!-- DOWN -->
                                    <svg x-show="f_provider === 'desc' || f_customer === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                                <p>
                                    Order status
                                </p>
                                <button @click="$wire.set('f_ostatus', $wire.f_ostatus === '' ? 'asc' : $wire.f_ostatus === 'asc' ? 'desc' : 'asc'); f_customer = ''; f_provider = ''; f_order = ''; f_deliverydate = '';">
                                    <svg x-show="f_ostatus === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                    <!-- UP -->
                                    <svg x-show="f_ostatus === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <!-- DOWN -->
                                    <svg x-show="f_ostatus === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <div class="flex items-start justify-center gap-1">
                                <p>
                                    Date delivered
                                </p>
                                <button @click="$wire.set('f_deliverydate', $wire.f_deliverydate === '' ? 'asc' : $wire.f_deliverydate === 'asc' ? 'desc' : 'asc'); f_customer = ''; f_provider = ''; f_order = ''; f_ostatus = '';">
                                    <svg x-show="f_deliverydate === ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                    <!-- UP -->
                                    <svg x-show="f_deliverydate === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <!-- DOWN -->
                                    <svg x-show="f_deliverydate === 'desc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                           </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           <span class="">Actions</span>
                        </th>
                     </tr>
               </thead>
               <tbody wire:loading.class="hidden">
                     @forelse ($list as $order)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100"
                           x-show="search === '' || 
                                ['{{ strtolower($order->order) }}',
                                '{{ strtolower(App\Models\User::where('id', $order->provider_id)->first()->name) }}',
                                '{{ strtolower($order->item_status) }}'
                                ].some(value => value.includes(search.toLowerCase()))
                            "    
                        >
                           <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                              {{ $order->order }}
                           </th>
                           <td class="px-6 py-4 text-center">
                              @if ($user->role === 'customer')
                                 {{ App\Models\User::where('id', $order->provider_id)->first()->name }}
                              @elseif ($user->role === 'provider')
                                 {{ App\Models\User::where('id', $order->customer_id)->first()->name }}
                              @endif
                           </td>
                           <td class="px-6 py-4 text-center">
                              <div class="flex items-start justify-center gap-1 w-fit mx-auto
                                 {{ $order->item_status === 'Delivered' ? 'bg-green-900 text-green-300' : '' }}
                                 {{ $order->item_status === 'Rated' ? 'bg-yellow-700 text-yellow-300' : '' }}
                                 {{ in_array($order->item_status, ['Cancelled', 'Unavailable']) ? 'bg-red-900 text-red-300' : '' }}
                                 text-xs font-medium px-2 py-1 rounded-full">
                                 @if ($order->item_status === 'Delivered')   
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                       <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                    </svg>                              
                                 @elseif($order->item_status === 'Rated')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" 
                                          stroke-width="1.5" stroke="currentColor" class="size-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" 
                                             d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>            
                                 @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                       <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                    </svg>                    
                                 @endif
                                 <span>
                                       {{ ucwords($order->item_status) }}
                                 </span>
                              </div>
                           </td>

                           <td class="px-6 py-3 text-center">
                              @if (in_array($order->item_status, ['Delivered', 'Rated']))                    
                                 {{ $order->date_delivered ? $order->date_delivered->timezone('Asia/Singapore')->format('F j, Y \a\t g:i A') : 'N/A' }}   
                              @elseif(in_array($order->item_status, ['Cancelled', 'Unavailable']))
                                 ---
                              @endif
                           </td>
                           <td class="px-6 text-center" x-data="{ transactionStatus: '{{ $order->item_status }}' }">
                              <div class="flex flex-row gap-4 items-center justify-center">
                                 <a href="{{ route('history.view', ['order_id' => $order->id]) }}" class="">
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
                                 <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No PASABUY history.
                                 </td>
                           </tr>
                     @endforelse
               </tbody>
            </table>
         </div>
      </div>
    </div>
</div>