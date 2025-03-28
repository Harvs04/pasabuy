<div>
   <nav class="fixed top-0 z-30 w-full bg-[#014421] border-b font-poppins" x-data="{ openNotification: false }">
      <div class="px-3 py-1.5 lg:px-5 lg:pl-3">
         <div class="flex items-center justify-between relative">
   
            <div class="flex items-center justify-start rtl:justify-end w-4/6">
               <div class="flex flex-row gap-2 items-center ml-2 sm:ml-5">
                  <!-- BURGER MENU --> 
                  <button @click="openBurger = !openBurger" class="relative p-1.5 -m-1.5 hover:bg-green-900 hover:rounded-full">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-6 sm:size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                     </svg>
                  </button>
   
                  <!-- LOGO -->
                  <a href={{ route('dashboard') }}  class="flex ms-2 sm:ms-4 gap-2">
                     <img src="https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png" class="h-14" alt="FlowBite Logo" />
                     <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">PASABUY</span>
                  </a>
               </div>
            </div>
   
            <!-- NOTIFS, SEARCH (mobile), PROFILE -->
            <div class="flex items-center gap-2" x-data="{ open: false }">
               <div @click.outside="openNotification = false">
                  <!-- NOTIFICATIONS --> 
                  <button @click="openNotification = !openNotification; $wire.updateIsSeen();" class="relative mt-1 p-1.5 hover:bg-green-900 hover:rounded-full">
                     <div class="relative flex items-center">
                        <!-- Notification Bell Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-7 sm:size-8 transform scale-90">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>

                        <!-- Notification Counter -->
                        <span class="absolute top-0 right-0 transform translate-x-1 -translate-y-1 bg-[#7b1113] text-white text-xs font-medium px-1.5 py-0.5 rounded-full">
                              {{ $user->notification_as_poster->where('isSeen', false)->count() }}
                        </span>
                     </div>
                  </button>
   
                  <!-- NOTIFICATION FIELD -->
                  <div x-show="openNotification" x-data="{ notifDetailsOpen: false }" class="break-words w-full sm:w-96 overflow-y-auto max-h-[600px] absolute -right-0 md:-right-4 top-[62px] bg-white rounded-md shadow border px-3 py-4">
                     <h1 class="text-lg md:text-xl font-semibold text-gray-800 ml-1">Notifications</h1>
                     <div class="mt-4">
                        @forelse ($user->notification_as_poster as $notif)
                           <button class="flex flex-row gap-3 p-1 hover:bg-gray-100 hover:rounded text-sm justify-start items-start w-full" @click="notifDetailsOpen = true; openNotification = false; document.body.style.overflow = 'hidden'; $wire.openNotif('{{ $notif->id }}');">
                              <img class="size-9 md:size-12 flex-shrink-0 object-contain rounded-full border" src="{{ App\Models\User::where('id', $notif->actor_id)->first()->profile_pic_url }}" alt="user photo"> 
                              <div class="flex flex-col items-start">
                                 <span class="font-medium leading-tight text-start">
                                    @if ($notif->actor_id !== $notif->poster_id)
                                       {{ App\Models\User::find($notif->actor_id)->name }}
                                    @endif
                                    @if ($notif->type === 'like')
                                       <span class="font-normal">liked your post.</span>
                                    @elseif ($notif->type === 'comment')
                                       <span class="font-normal">commented on your post.</span>
                                    @elseif ($notif->type === 'new order')
                                       @if ($notif->actor_id !== $notif->poster_id)
                                          <span class="font-normal">added {{ $notif->order_count > 1 ? $notif->order_count . ' orders' : 'an order' }}.</span>
                                       @else
                                          <span class="font-normal">You have added {{ $notif->order_count > 1 ? $notif->order_count . ' orders' : 'an order' }}.</span>
                                       @endif
                                    @elseif ($notif->type === 'cancelled order')
                                       <span class="font-normal">cancelled {{ $notif->order_count > 1 ? $notif->order_count . ' orders' : 'an order' }}.</span>
                                    @elseif ($notif->type === 'converted post')
                                       <span class="font-normal">converted your post to a transaction.</span>
                                    @elseif ($notif->type === 'item bought')
                                       <p class="font-normal">successfully acquired your <span> {{ $notif->order_count > 1 ? $notif->order_count . ' orders' : 'order' }}</span>.</p>
                                    @elseif ($notif->type === 'item unavailable')
                                       <p class="font-normal">was not able to buy your <span> {{ $notif->order_count > 1 ? $notif->order_count . ' orders' : 'order' }}</span>.</p>
                                    @elseif ($notif->type === 'item waiting')
                                       <p class="font-normal">marked your <span> {{ $notif->order_count > 1 ? $notif->order_count . ' orders' : 'order' }}</span> as delivered.</p>
                                    @elseif ($notif->type === 'item confirmed')
                                       <span class="font-normal">has confirmed your delivery.</span>
                                    @elseif ($notif->type === 'item rated')
                                       <span class="font-normal">has rated the transaction.</span>
                                    @elseif ($notif->type === 'item deleted')
                                       <span class="font-normal">deleted your order.</span>
                                    @elseif ($notif->type === 'transaction cancelled')
                                       <span class="font-normal">cancelled the transaction.</span>
                                    @elseif ($notif->type === 'new item request')
                                       <span class="font-normal">You have created a new item request.</span>
                                    @elseif ($notif->type === 'new transaction')
                                       <span class="font-normal">You have created a new transaction.</span>
                                    @endif
                                 </span>
                                 <span class="text-xs">{{ $notif->created_at->Timezone('Singapore')->format('F j, Y \\a\\t h:i A') }}</span>
                              </div>
                           </button>
                        @empty
                           <p class="text-sm text-center">
                              Seems empty. Try ordering items or making transactions.
                           </p>
                        @endforelse
                        @teleport('body')
                           <div x-show="notifDetailsOpen">
                              <div x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30">
                                 <div @click.outside="notifDetailsOpen = false; document.body.style.overflow = 'auto';" @keydown.escape.window="notifDetailsOpen = false; document.body.style.overflow = 'auto';" class="bg-white p-6 rounded-lg w-11/12 md:w-2/3 lg:w-1/2 2xl:w-1/3 relative">
                                    <div class="flex flex-row items-center gap-2">
                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#014421" class="size-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                       </svg>
                                       <p class="text-xl font-semibold text-[#014421]">Notification</p>
                                       <button @click="notifDetailsOpen = false; document.body.style.overflow = 'auto';" class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#000000" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                          </svg>
                                       </button>
                                    </div>
                                    <div class="text-center w-full" wire:loading="fetchNotif">                        
                                       <div role="status" class="w-full p-4 border-gray-200 rounded-sm shadow-sm animate-pulse md:p-6 dark:border-gray-500">
                                          <div class="flex items-center mb-4">
                                             <svg class="w-10 h-10 me-3 text-gray-200 dark:text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                   <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                             </svg>
                                             <div>
                                                   <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-full mb-2"></div>
                                                   <div class="w-48 h-2 bg-gray-200 rounded-full dark:bg-gray-500"></div>
                                             </div>
                                          </div>
                                          <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded-sm dark:bg-gray-500">
                                             <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                                   <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z"/>
                                                   <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                                             </svg>
                                          </div>
                                          <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-500 w-full mb-4"></div>
                                          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-500 mb-2.5"></div>
                                          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-500 mb-2.5"></div>
                                          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-500"></div>
                                          <span class="sr-only">Loading...</span>
                                       </div>
                                    </div>
                                    <div class="text-center w-full" wire:loading.class="hidden">                        
                                       <div role="status" class="w-full p-4 border-gray-200 rounded-sm shadow-sm md:p-6 dark:border-gray-500">
                                          <div class="flex items-center mb-4">
                                             <img src="{{ $actor->profile_pic_url ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif' }}" alt="" class="w-10 h-10 border rounded-full object-contain me-3 text-gray-200 dark:text-gray-700">
                                             <div>
                                                   <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-full mb-2"></div>
                                                   <div class="w-48 h-2 bg-gray-200 rounded-full dark:bg-gray-500"></div>
                                             </div>
                                          </div>
                                          <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded-sm dark:bg-gray-500">
                                             <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                                   <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z"/>
                                                   <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                                             </svg>
                                          </div>
                                          <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-500 w-full mb-4"></div>
                                          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-500 mb-2.5"></div>
                                          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-500 mb-2.5"></div>
                                          <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-500"></div>
                                          <span class="sr-only">Loading...</span>
                                       </div>
                                    </div>
                                    <div wire:loading.class="hidden">
                                       ITEM NAME# {{ $post_in_notif->item_name ?? 'N/A'}}
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endteleport
                     </div>
                  </div>
               </div>
            
   
               <!-- PROFILE, LOG OUT, CHANGE ROLE -->
               <div class="flex items-center ms-3">
                  <div>
                     <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" @click="open = !open">
                        <img class="size-9 object-cover rounded-full" src="{{ $user->profile_pic_url }}" alt="user photo">
                     </button>
                  </div>
                  <div class="absolute right-1 sm:right-0 top-10 z-40 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user" x-show="open" @click.outside="open = false">
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
                        <button type="button" @click="$wire.signOut()" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white" role="menuitem">Log out</button>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </nav>
   <!-- CHANGE ROLE MODAL -->
   <div x-show="isChangeRoleModalOpen" x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30">
      <div @keydown.escape.window="isChangeRoleModalOpen = false; document.body.style.overflow = 'auto';" class="bg-white p-6 rounded-lg w-11/12 md:w-2/3 lg:w-1/2 2xl:w-1/3 relative">
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
            <button @click="$wire.switchRole(); isChangeRoleModalOpen = false;" class=" px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
         </div>
      </div>
   </div>
   @teleport('body')
    <div wire:loading.delay wire:target="switchRole"
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
</div>