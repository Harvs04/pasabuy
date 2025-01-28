<div class="font-poppins bg-gray-50" x-data="{ openBurger: window.innerWidth > 640 ? true : false, isChangeRoleModalOpen: false }" x-cloak>

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

   <div class="sm:transition-all sm:duration-300 sm:transform relative flex flex-row" style="margin-top: 4.3rem;":class="{'lg:ml-64 xl:ml-96': openBurger, 'md:ml-0': !openBurger}">
      <div class="p-4 w-full">
         <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
               <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                  Your transactions
                  <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 break-words">
                     Browse a list of your transactions, buy and manage customers' orders, update status, and deliver them to your desired meeting place.
                  </p>
               </caption>
               <thead class="text-xs sm:text-sm text-gray-700 uppercase bg-gray-50">
                     <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                           Transaction status
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Item name
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Item origin
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Order count
                        </th>
                        <th scope="col" class="px-6 py-3">
                           <span class="">Actions</span>
                        </th>
                     </tr>
               </thead>
               <tbody>
                     @foreach ($transactions as $transaction)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100">
                           <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                              <span class="
                                 {{ $transaction->status == 'open' ? 'bg-green-900 text-green-300' : '' }}
                                 {{ $transaction->status == 'ongoing' ? 'bg-yellow-900 text-yellow-300' : '' }}
                                 {{ $transaction->status == 'closed' ? 'bg-gray-800 text-gray-300' : '' }}
                                 {{ $transaction->status == 'cancelled' ? 'bg-red-900 text-red-300' : '' }}
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
                           <td class="px-6 py-4">
                                 {{ $transaction->order_count . "/" . $transaction->max_orders }}
                           </td>
                           <td class="px-6 py-4 text-right">
                              <div class="flex flex-row gap-2">
                                 <a href="{{ route('transaction.view', ['id' => $transaction->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-gray-600 hover:text-gray-900">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                 </a>
                                 <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-green-600 hover:text-green-500">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                 </a>
                                 <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-red-600 hover:text-red-400">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                 </button>
                              </div>
                           </td>
                        </tr>
                     @endforeach
               </tbody>
            </table>
            <div class="px-6 py-2">
               {{ $transactions->links() }}  <!-- Pagination links -->
            </div>
         </div>
      </div>

   </div>
</div>