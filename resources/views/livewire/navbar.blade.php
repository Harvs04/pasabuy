<div class="">
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
                  <div x-show="openNotification" x-data="{ notifDetailsOpen: false }" class="break-words w-full sm:w-96 overflow-y-auto max-h-[600px] absolute -right-0 md:-right-4 top-[62px] bg-white rounded-md shadow border px-2 py-4">
                     <h1 class="text-lg md:text-xl font-semibold text-gray-800 ml-2">Notifications</h1>
                     <div class="mt-4">
                        @forelse ($user->notification_as_poster as $notif)
                           <button class="flex flex-row gap-2 p-2 hover:bg-gray-100 hover:rounded text-sm justify-start items-start w-full" @click="notifDetailsOpen = true; openNotification = false; document.body.style.overflow = 'hidden'; $wire.openNotif('{{ $notif->id }}');">
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
                                    @elseif ($notif->type === 'transaction started')
                                       <span class="font-normal">started the transaction.</span>
                                    @elseif ($notif->type === 'transaction cancelled')
                                       <span class="font-normal">cancelled the transaction.</span>
                                    @elseif ($notif->type === 'new item request')
                                       <span class="font-normal">You have created a new item request.</span>
                                    @elseif ($notif->type === 'new transaction')
                                       <span class="font-normal">You have created a new transaction.</span>
                                    @elseif ($notif->type === 'report added')
                                       <span class="font-normal">Your report has been submitted to the admin and will be reviewed.</span>
                                    @elseif ($notif->type === 'report resolved')
                                       <span class="font-normal">We have a verdict about your reported user.</span>
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
                           <div x-show="notifDetailsOpen" class="font-poppins">
                              <div x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30">
                                 <div @click.outside="notifDetailsOpen = false; document.body.style.overflow = 'auto';" @keydown.escape.window="notifDetailsOpen = false; document.body.style.overflow = 'auto';" class="bg-white rounded-lg w-11/12 md:w-2/3 lg:w-1/2 2xl:w-2/5 relative">
                                    <div class="py-4 flex flex-row items-center gap-2 border-b">
                                       <div class="flex justify-center w-full" wire:loading="fetchNotif">                        
                                          <div role="status" class="w-1/2 rounded-sm shadow-sm animate-pulse md:p-2 mx-auto">
                                             <div class="flex items-center">
                                                   <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-full"></div>
                                             </div>
                                          </div>
                                       </div>   
                                       <p wire:loading.class="hidden" class="text-center text-lg md:text-xl font-semibold mx-auto w-full">{{ ucwords($notif_instance->type ?? 'N/A') }}</p>
                                       <button @click="notifDetailsOpen = false; document.body.style.overflow = 'auto';" class="absolute top-3 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#000000" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                          </svg>
                                       </button>
                                    </div>
                                    <div class="text-center w-full" wire:loading="fetchNotif">                        
                                       <div role="status" class="w-full px-3 md:px-6 py-4 border-gray-200 rounded-sm shadow-sm animate-pulse dark:border-gray-500">
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
                                       <div role="status" class="w-full px-3 md:px-6 border-gray-200 rounded-sm shadow-sm dark:border-gray-500 max-h-[500px] overflow-auto {{ in_array($notif_instance->type ?? 'N/A', ['like', 'comment', 'new item request', 'new transaction', 'converted post']) ? 'py-3' : '' }}">
                                          <div class="flex items-center">
                                             @if (in_array($notif_instance->type ?? 'N/A', ['like', 'comment', 'new item request', 'new transaction']))
                                                <img src="{{ $user->profile_pic_url ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif' }}" alt="user_image" class="w-10 h-10 border rounded-full object-contain me-3 text-gray-200 dark:text-gray-700">
                                                <div class="text-start">
                                                   <div class="text-gray-800 text-sm font-semibold">{{ $user->name ?? '...' }}</div>
                                                   <div class="text-gray-700 text-xs">{{ $post_in_notif && $post_in_notif->created_at ? $post_in_notif->created_at->timezone('Singapore')->format('j F Y \a\t H:i') : '...' }}</div>
                                                </div>
                                             @elseif(($notif_instance->type ?? 'N/A') === 'converted post')
                                                <img src="{{ $actor->profile_pic_url ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif' }}" alt="user_image" class="w-10 h-10 border rounded-full object-contain me-3 text-gray-200 dark:text-gray-700">
                                                <div class="text-start">
                                                   <div class="text-gray-800 text-sm font-semibold">{{ $actor->name ?? '...' }}</div>
                                                   <div class="text-gray-700 text-xs">{{ $post_in_notif && $post_in_notif->created_at ? $post_in_notif->created_at->timezone('Singapore')->format('j F Y \a\t H:i') : '...' }}</div>
                                                </div>
                                             @endif                  
                                          </div>
                                          <div class="flex flex-col {{ in_array(($notif_instance->type ?? ''), ['like', 'comment', 'new item request', 'new transaction', 'converted post']) ? 'border-b mb-2 py-2' : 'py-1' }}">
                                             <div class="flex items-center justify-center mb-2 bg-gray-100 rounded-lg {{ in_array($notif_instance->type ?? 'N/A', ['like', 'comment', 'new item request', 'new transaction', 'converted post']) ? 'block' : 'hidden' }}">
                                                <img src="{{ $post_in_notif->item_image ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png' }}" alt="post_image" class="w-1/3 object-cover">                                                                                             
                                             </div>
                                             <div class="text-start">
                                                @if (in_array(($notif_instance->type ?? ''), ['like', 'comment', 'new item request', 'new transaction', 'converted post']))
                                                   @if(($post_in_notif->type ?? '') === 'item_request')
                                                      <div class="ml-2 flex flex-col gap-2">
                                                         <p class="text-[#014421] text-base font-semibold underline">Item Details:</p>
                                                         <div class="flex flex-col gap-2 md:gap-3 ml-2">
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold">Item name:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ $post_in_notif->item_name ?? '' }}</p>
                                                                  </div>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold">Item origin:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ $post_in_notif->item_origin ?? '' }}</p>
                                                                  </div>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Item type:</p> 
                                                                     <div class="flex flex-row flex-wrap gap-1">
                                                                        @foreach(json_decode($post_in_notif->item_type ?? '') as $type)
                                                                              @php
                                                                                 $colorClass = match($type) {
                                                                                    'Food', 'Grocery item' => 'bg-green-100 text-green-800',
                                                                                    'Local produce', 'Pet needs' => 'bg-yellow-100 text-yellow-800 ',
                                                                                    'Apparel', 'Footwear' => 'bg-indigo-100 text-indigo-800',
                                                                                    'Merchandise', 'Personal care' => 'bg-purple-100 text-purple-800',
                                                                                    'Celebratory', 'Hobbies' => 'bg-pink-100 text-pink-800',
                                                                                    default => 'bg-gray-100 text-gray-800', // Fallback color
                                                                                 };
                                                                              @endphp
                                                                              <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $colorClass }}">
                                                                                 {{ $type }}
                                                                              </span>
                                                                        @endforeach
                                                                     </div>
                                                                  </div>
                                                            </div>
                                                         </div>
                                                         <p class="text-[#014421] text-base font-semibold underline">Request Details:</p>
                                                         <div class="flex flex-col gap-2 md:gap-3 ml-2">
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Mode of payment:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ implode(', ', json_decode($post_in_notif->mode_of_payment ?? '')) }}</p>
                                                                  </div>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Delivery date:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ $post_in_notif->delivery_date->format('F j, Y') ?? ''}}</p>
                                                                  </div>
                                                            </div>
                                                            @if(($post_in_notif->additional_notes ?? '') !== null)
                                                                  <div class="flex flex-row gap-2 items-start text-sm">
                                                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5 flex-shrink-0">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                                     </svg>
                                                                     <div class="flex flex-row flex-wrap gap-1 overflow-hidden">
                                                                        <p class="hidden sm:block font-semibold whitespace-nowrap">Additional notes:</p>
                                                                        <p class="break-all pr-1 font-medium sm:font-normal">{{ $post_in_notif->additional_notes ?? '' }}</p>
                                                                     </div>
                                                                  </div>
                                                            @endif
                                                         </div>
                                                      </div>
                                                   @elseif(($post_in_notif->type ?? '') === 'transaction')
                                                      <div class="ml-2 flex flex-col gap-2">
                                                         <p class="text-[#014421] text-base font-semibold underline">Item Details:</p>
                                                         <div class="flex flex-col gap-2 md:gap-3 ml-2">
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold">Item name:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ $post_in_notif->item_name ?? '' }}</p>
                                                                  </div>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold">Item origin:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ $post_in_notif->item_origin ?? '' }}</p>
                                                                  </div>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 flex-shrink-0">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Item type:</p> 
                                                                     <div class="flex flex-row flex-wrap gap-1">
                                                                        @foreach(json_decode($post_in_notif->item_type ?? '') as $type)
                                                                              @php
                                                                                 $colorClass = match($type) {
                                                                                    'Food', 'Grocery item' => 'bg-green-100 text-green-800',
                                                                                    'Local produce', 'Pet needs' => 'bg-yellow-100 text-yellow-800 ',
                                                                                    'Apparel', 'Footwear' => 'bg-indigo-100 text-indigo-800',
                                                                                    'Merchandise', 'Personal care' => 'bg-purple-100 text-purple-800',
                                                                                    'Celebratory', 'Hobbies' => 'bg-pink-100 text-pink-800',
                                                                                    default => 'bg-gray-100 text-gray-800', // Fallback color
                                                                                 };
                                                                              @endphp
                                                                              <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $colorClass }}">
                                                                                 {{ $type }}
                                                                              </span>
                                                                        @endforeach
                                                                     </div>
                                                                  </div>
                                                            </div>
                                                            @if(($post_in_notif->sub_type ?? '') !== null)
                                                                  <div class="flex flex-row gap-2 items-start text-sm">
                                                                     <div class="flex flex-row gap-2 items-start">
                                                                        @php
                                                                           $subTypeArray = json_decode($post_in_notif->sub_type ?? '', true);
                                                                        @endphp
                                                                        @if (is_array($subTypeArray))
                                                                        <p class="hidden sm:block font-semibold whitespace-nowrap">Subtags:</p>
                                                                        <div class="flex flex-row flex-wrap gap-1">                                                                  
                                                                           @foreach($subTypeArray as $subtype)
                                                                              <span class="text-xs font-medium px-2.5 py-0.5 rounded bg-gray-100 text-gray-800">
                                                                                    {{ $subtype }}
                                                                              </span>
                                                                           @endforeach
                                                                        </div>
                                                                        @endif
                                                                     </div>
                                                                  </div>
                                                            @endif
                                                         </div>
                                                         <p class="text-[#014421] text-base font-semibold underline">Transaction Details:</p>
                                                         <div class="flex flex-col gap-2 md:gap-3 ml-2" x-data="{ openOrdersUntil: false }">
                                                            <div class="flex flex-row gap-2 items-start text-sm relative" >
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5" @mouseenter="openOrdersUntil = true" @mouseleave="openOrdersUntil = false">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold">Taking orders until:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ ($post_in_notif->cutoff_date->format('F j, Y') ?? '') }}</p>
                                                                  </div>
                                                                  <p x-show="openOrdersUntil" class="absolute -top-8 rounded-lg bg-gray-200 text-xs text-gray-700 px-2 py-1.5">Orders are only catered until this date</p>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Transaction fee:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ $post_in_notif->transaction_fee ?? '' }}</p>
                                                                  </div>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Mode of payment:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ implode(', ', json_decode($post_in_notif->mode_of_payment ?? '')) }}</p>
                                                                  </div>
                                                            </div>
                                                         </div>
                                                         <p class="text-[#014421] text-base font-semibold underline">Delivery Details:</p>
                                                         <div class="flex flex-col gap-2 md:gap-3 ml-2">
                                                         <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Delivery date:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ ($post_in_notif->delivery_date->format('F j, Y') ?? '') }}</p>
                                                                  </div>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Arrival time:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ DateTime::createFromFormat('H:i:s', $post_in_notif->arrival_time ?? '')->format('g:i a') }}</p>
                                                                  </div>
                                                            </div>
                                                            <div class="flex flex-row gap-2 items-start text-sm">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 flex-shrink-0">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                                  </svg>
                                                                  <div class="flex flex-row gap-2 items-start">
                                                                     <p class="hidden sm:block font-semibold whitespace-nowrap">Meetup place:</p> 
                                                                     <p class="font-medium sm:font-normal">{{ $post_in_notif->meetup_place ?? '' }}</p>
                                                                  </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   @endif
                                                @elseif(in_array(($notif_instance->type ?? ''), ['new order','cancelled order', 'transaction started', 'transaction cancelled', 'item bought', 'item waiting', 'item confirmed', 'item delivered', 'item rated', 'item unavailable']))      
                                                   <div class="">
                                                      <!-- Content -->
                                                      <div class="px-4 py-2">
                                                            <div class="mb-4">
                                                               <div class="flex items-center mb-4">
                                                                  <img src="{{ $actor->profile_pic_url ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif' }}" 
                                                                        alt="Staff profile" 
                                                                        class="w-10 h-10 rounded-full border object-cover mr-3">
                                                                  <div>
                                                                        <p class="font-semibold text-gray-800">{{ $actor->name ?? 'Provider' }}</p>
                                                                        <p class="text-xs text-gray-500">{{ $notif_instance->created_at->timezone('Singapore')->format('j F Y \a\t H:i') ?? '' }}</p>
                                                                  </div>
                                                               </div>
                                                               <p class="text-sm font-medium mb-2 text-gray-700 {{ in_array(($notif_instance->type ?? ''), ['cancelled order', 'item unavailable']) ? 'block' : 'hidden' }}">
                                                                  {{ ($notif_instance->order_count ?? '') == 1 ? 'This order has' : 'These orders have'}} been removed from the active orders list.
                                                               </p>
                                                               @if (($notif_instance->order_count ?? '') > 1)
                                                                  @foreach ($notif_instance->order_id ?? '' as $order_id)
                                                                     <div class="border text-gray-700 text-sm {{ in_array(($notif_instance->type ?? ''), ['cancelled order', 'item unavailable', 'transaction cancelled']) ? 'bg-red-100' : (in_array(($notif_instance->type ?? ''), ['item bought', 'item confirmed', 'item waiting', 'item delivered', 'item rated', 'transaction started']) ? 'bg-green-100' : 'bg-gray-100' ) }} rounded-lg p-3 mb-2">
                                                                        <p class="text-gray-700 text-base font-medium mb-2 {{ ($notif_type ?? '') === 'transaction started' ? 'block' : 'hidden' }}">Provider <span class="font-semibold">{{ $actor->name ?? 'Anonymous' }}</span> is on the way to buy your orders.</p>
                                                                        <p class="text-gray-700 text-base font-medium mb-2 {{ ($notif_type ?? '') !== 'transaction started' ? 'block' : 'hidden' }}">Order #{{ $order_id ?? '1234' }} has been <span class="font-semibold underline">{{ in_array($notif_type, ['cancelled order', 'transaction cancelled']) ? 'cancelled' : ($notif_type === 'item waiting' ? 'marked as delivered' : ($notif_type === 'new order' ? 'added' : explode(' ', $notif_type ?? '')[1])) }}</span>.</p>
                                                                        <p class="">Item name: <span class="font-medium">{{ $post_in_notif->item_name ?? 'mystery item' }}</span></p>
                                                                        <p class="">Order: <span class="font-medium">{{ App\Models\Order::where('id', $order_id)->first()->order ?? 'mystery item' }}</span></p>
                                                                        <p class="">Payment status: <span class="font-medium">{{ (App\Models\Order::where('id', $order_id)->first()->is_paid ?? 'Unknown status') == 0 ? 'Pending payment' : 'Paid' }}</span></p>
                                                                        <p class="">Other notes: <span class="font-medium">{{ App\Models\Order::where('id', $order_id)->first()->additional_notes ?? 'Some notes' }}</span></p>
                                                                     </div>
                                                                  @endforeach
                                                               @else                                                   
                                                                  <div class="border text-gray-700 text-sm {{ in_array(($notif_instance->type ?? ''), ['cancelled order', 'item unavailable', 'transaction cancelled']) ? 'bg-red-100' : (in_array(($notif_instance->type ?? ''), ['item bought', 'item confirmed', 'item waiting', 'item delivered', 'item rated']) ? 'bg-green-100' : 'bg-gray-100' ) }} rounded-lg p-3 mb-2">
                                                                     <p class="text-gray-700 text-base font-medium mb-2 {{ ($notif_type ?? '') === 'transaction started' ? 'block' : 'hidden' }}">Provider <span class="font-semibold">{{ $actor->name ?? 'Anonymous' }}</span> is on the way to buy your orders.</p>
                                                                     <p class="text-gray-700 text-base font-medium mb-2 {{ ($notif_type ?? '') !== 'transaction started' ? 'block' : 'hidden' }}">Order #{{ $notif_instance->order_id[0] ?? '1234' }} has been <span class="font-semibold underline">{{ in_array($notif_type, ['cancelled order', 'transaction cancelled']) ? 'cancelled' : ($notif_type === 'item waiting' ? 'marked as delivered' : ($notif_type === 'new order' ? 'added' : explode(' ', $notif_type ?? '')[1])) }}</span>.</p>
                                                                     <p class="">Item name: <span class="font-medium">{{ $post_in_notif->item_name ?? 'mystery item' }}</span></p>
                                                                     <p class="">Order: <span class="font-medium">{{ App\Models\Order::where('id', $notif_instance->order_id[0])->first()->order ?? 'mystery item' }}</span></p>
                                                                     <p class="">Payment status: <span class="font-medium">{{ (App\Models\Order::where('id', $notif_instance->order_id[0])->first()->is_paid ?? 'Unknown status') == 0 ? 'Pending payment' : 'Paid' }}</span></p>
                                                                     <p class="">Other notes: <span class="font-medium">{{ App\Models\Order::where('id', $notif_instance->order_id[0])->first()->additional_notes ?? 'Some notes' }}</span></p>
                                                                     <span class="mt-2 flex items-center gap-1 {{ $notif_type === 'item rated' ? 'block' : 'hidden' }}">
                                                                        @php
                                                                           $rating_instance = App\Models\Rating::where('order_id', $notif_instance->order_id[0])->first();
                                                                        @endphp
                                                                        <p class="">Star rating:</p>
                                                                        @if($rating_instance)
                                                                        <div class="flex items-center">
                                                                           <div class="flex">
                                                                              @for ($i = 1; $i <= 5; $i++)
                                                                                    @if ($i <= $rating_instance->star_rating)
                                                                                       <!-- Filled Star -->
                                                                                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-yellow-400">
                                                                                          <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                                                       </svg>
                                                                                    @else
                                                                                       <!-- Empty Star -->
                                                                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-300">
                                                                                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                                                                       </svg>
                                                                                    @endif
                                                                              @endfor
                                                                           </div>
                                                                        </div>
                                                                        @endif
                                                                        <p><span class="font-medium">{{ $rating_instance->star_rating ?? '' }}/5</span></p>
                                                                     </span>
                                                                     <p class="text-gray-600 text-sm {{ $notif_type === 'item rated' ? 'block' : 'hidden' }}">Remarks: <span class="font-medium"> {{ $rating_instance->remarks ?? '' }}</span></p>
                                                                  </div>
                                                               @endif
                                                            </div>
                                                            
                                                            <!-- Actions -->
                                                            <div class="flex flex-col text-sm sm:flex-row sm:justify-between gap-3">
                                                               @if (in_array(($notif_instance->type ?? ''), ['cancelled order', 'transaction started', 'transaction cancelled', 'item bought', 'item waiting', 'item confirmed', 'item delivered', 'item rated', 'item unavailable']))
                                                                  <a href="{{ route('message.view', ['convo_id' => $convo_id ]) }}" class="w-full py-2 px-4 bg-white border border-gray-300 rounded-md text-gray-700 text-center font-medium hover:bg-gray-50 sm:w-auto">
                                                                     {{ $user->role === 'provider' ? 'Contact Customer' : 'Contact Provider'}}
                                                                  </a>
                                                               @endif
                                                               @if (($notif_instance->order_count ?? '') == 1)                                                               
                                                               <a href="{{ $user->role === 'customer' ? route('my-orders-order.view', ['transaction_id' => $notif_instance->post_id, 'order_id' => $notif_instance->order_id[0] ]) : route('transaction-order.view', ['transaction_id' => $notif_instance->post_id, 'order_id' => $notif_instance->order_id[0] ]) }}" class="w-full ml-auto text-center py-2 px-4 bg-gray-600 border border-transparent rounded-md text-white font-medium hover:bg-gray-700 sm:w-auto">
                                                                  View Order Details
                                                               </a>
                                                               @else
                                                               <a href="{{ $user->role === 'customer' ? route('my-orders.view', ['id' => $notif_instance->post_id]) : route('transaction.view', ['id' => $notif_instance->post_id]) }}" class="w-full ml-auto text-center py-2 px-4 bg-gray-600 border border-transparent rounded-md text-white font-medium hover:bg-gray-700 sm:w-auto">
                                                                  View Order Details
                                                               </a>
                                                               @endif
                                                            </div>    
                                                      </div>                                                                                           
                                                   </div>
                                                @elseif(($notif_type ?? 'N/A') === 'report added')
                                                <div class="flex flex-col p-4 bg-red-50 rounded-lg border border-red-100 mt-1.5">
                                                   @php  
                                                      $report = App\Models\Report::where('id', ($notif_instance->order_id ?? ''))->first();
                                                      $post = App\Models\Post::where('id', ($report->post_id ?? ''))->first();
                                                      $reported = App\Models\User::where('id', $report->reported_id)->first();
                                                   @endphp
                                                   
                                                   <div class="flex items-center mb-3">
                                                      <div class="mr-3">
                                                            <div class="bg-red-100 p-2 rounded-full">
                                                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                               </svg>
                                                            </div>
                                                      </div>
                                                      <div class="flex-1">
                                                            <p class="font-medium text-gray-700">Your report about user <span class="font-medium underline">{{ $reported->name }}</span> has been submitted!</p>
                                                            <div class="text-xs text-gray-500 mt-1">{{ $notif_instance->created_at->Timezone('Singapore')->format('M d, Y · h:i A') }}</div>
                                                      </div>
                                                   </div>
                                                   <p class="text-sm text-gray-600 mb-2">We'll review this report and take appropriate action.</p>
                                                   
                                                   <div class="bg-white p-3 rounded-md mb-3">
                                                      @if($report && $report->type)
                                                         <div class="flex flex-col gap-1.5 items-start">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                               {{ ucfirst($report->type) }}
                                                            </span>
                                                            <span class="text-sm text-gray-700">{{ $report->complaint }}</span>
                                                         </div>
                                                      @endif
                                                   </div>
                                                   
                                                   <div class="flex items-center justify-between">
                                                      <div class="flex items-center">
                                                            <div class="relative">
                                                               <img src="{{ $user->profile_pic_url }}" alt="Your profile" class="w-8 md:w-10 h-8 md:h-10 rounded-full object-cover border-2 border-white shadow-sm">
                                                               <div class="absolute -bottom-1 -right-1 bg-green-500 rounded-full w-3 h-3 border-2 border-white"></div>
                                                            </div>
                                                            <p class="ml-2 text-xs font-medium text-gray-600">You</p>
                                                      </div>
                                                      
                                                      <div class="flex items-center justify-center">
                                                            <div class="h-px w-16 bg-gray-300"></div>
                                                            <div class="mx-2">
                                                               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                                               </svg>
                                                            </div>
                                                            <div class="h-px w-16 bg-gray-300"></div>
                                                      </div>
                                                      
                                                      <div class="flex items-center">
                                                            <p class="mr-2 text-xs font-medium text-gray-600">Reported</p>
                                                            <div class="relative">
                                                               <img src="{{ $reported->profile_pic_url }}" alt="{{ $reported->name }}'s profile" class="w-8 md:w-10 h-8 md:h-10 rounded-full object-cover border-2 border-white shadow-sm">
                                                               <div class="absolute -bottom-1 -right-1 bg-red-500 rounded-full w-3 h-3 border-2 border-white"></div>
                                                            </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                @endif
                                             </div>
                                          </div>
                                          <!-- TEXT CONTENT -->
                                          <div class="mb-2 text-gray-800 text-start text-sm font-semibold">                              
                                             @if (($notif_instance->type ?? 'N/A') === 'comment')
                                                <p class="">Comment</p>
                                             @elseif (($notif_instance->type ?? 'N/A') === 'like')
                                                <p class="">{{ $like_count > 1 ? $like_count . ' Reactors' : $like_count . ' Reactor' }}</p>
                                             @endif
                                          </div>
                                          <div class="flex items-start rounded-sm mb-2 {{ in_array(($notif_instance->type ?? ''), ['like', 'comment']) ? 'block' : 'hidden' }}">
                                             <img src="{{ $actor->profile_pic_url ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif' }}" alt="actor_image" class="w-10 h-10 border rounded-full object-contain me-3 text-gray-200 dark:text-gray-700">
                                             <div class="flex flex-col text-start text-sm">
                                                <div class="{{ $notif_type === 'comment' ? 'bg-gray-100 px-2.5 py-1.5' : ''}} w-fit rounded-xl">                                                
                                                   <p class="text-gray-800 font-medium">{{ $actor->name ?? '' }}</p>
                                                   <p class="text-gray-700 {{ $notif_type === 'like' ? 'block' : 'hidden' }}">
                                                      @if($like_count - 1 > 0)
                                                         and {{ $like_count - 1 }} {{ $like_count - 1 == 1 ? 'other person' : 'others' }} liked your post.
                                                      @else
                                                         liked your post.
                                                      @endif
                                                   </p>
                                                   <p class="text-gray-700 {{ $notif_type === 'comment' ? 'block' : 'hidden' }}">{{ App\Models\Comment::where('post_id', $post_in_notif->id ?? '')->where('user_id', $actor->id ?? '')->where('created_at', $notif_instance->created_at ?? '')->first()->comment ?? '' }}</p>                              
                                                </div>
                                             </div>
                                          </div>
                                       </div>
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