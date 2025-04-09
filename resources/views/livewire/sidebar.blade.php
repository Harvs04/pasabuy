<div id="logo-sidebar" 
     class="fixed top-0 left-0 z-20 w-64 xl:w-96 h-screen pt-20 bg-white border-r border-gray-200 shadow-lg"
     aria-label="Sidebar" 
     x-show="openBurger"
     x-transition:enter="transition ease-out duration-300 transform"
     x-transition:enter-start="-translate-x-full"
     x-transition:enter-end="translate-x-0"
     x-transition:leave="transition ease-in duration-100 transform"
     x-transition:leave-start="translate-x-0"
     x-transition:leave-end="-translate-x-full"
     @click.outside="if (openBurger) { openBurger = false; }">
      <div class="h-full px-3 pb-4 overflow-y-auto">
         <ul class="space-y-2 text-[15px]">
            <li>
               <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::routeIs('dashboard') ? 'bg-gray-100' : 'hover:bg-gray-100 group hover:font-medium' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::routeIs('dashboard') ? 'text-gray-900' : '' }}">
                     <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                     <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                  </svg>
                  <span class="ms-3 {{ Request::routeIs('dashboard') ? 'font-medium' : '' }}">Dashboard</span>
               </a>
            </li>
            <li>
               <a href="{{ route('messages') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::routeIs('messages') ? 'bg-gray-100' : 'hover:bg-gray-100 group hover:font-medium' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::routeIs('messages') ? 'text-gray-900' : '' }}">
                     <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                     <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                  </svg>
                  <span class="flex-1 ms-3 whitespace-nowrap {{ Request::routeIs('messages') ? 'font-medium' : '' }}">Messages</span>
                  <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">
                     @if ($user->role === 'provider')
                     {{ count($user->conversations_as_provider) }}
                     @elseif ($user->role === 'customer')
                     {{ count($user->conversations_as_customer) }}
                     @endif
                  </span>
               </a>
            </li>
            <li>
               <a href="{{ route('saved')}}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::routeIs('saved') ? 'bg-gray-100' : 'hover:bg-gray-100 group hover:font-medium' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::routeIs('saved') ? 'text-gray-900' : '' }}">
                     <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                  </svg>
                  <span class="ms-3 {{ Request::routeIs('saved') ? 'font-medium' : '' }}">Saved</span>
               </a>
            </li>
            @if($user->role === 'customer')
               <li>
               <a href="{{ route('my-orders')}}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::routeIs('my-orders') ? 'bg-gray-100' : 'hover:bg-gray-100 group hover:font-medium' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::routeIs('my-orders') ? 'text-gray-900' : '' }}">
                     <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                  </svg>
                  <span class="ms-3 {{ Request::routeIs('my-orders') ? 'font-medium' : '' }}">My Orders</span>
               </a>
               </li>
            @elseif($user->role === 'provider')
               <li>
                  <a href="{{ route('transactions')}}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::routeIs('transactions') ? 'bg-gray-100' : 'hover:bg-gray-100 group hover:font-medium' }}">
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::routeIs('transactions') ? 'text-gray-900' : '' }}">
                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                     </svg>
                     <span class="ms-3 {{ Request::routeIs('transactions') ? 'font-medium' : '' }}">Transactions</span>
                  </a>
               </li>
            @endif
            <li>
               <a href="{{ route('pasabuy-history')}}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::routeIs('pasabuy-history') ? 'bg-gray-100' : 'hover:bg-gray-100 group hover:font-medium' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::routeIs('pasabuy-history') ? 'text-gray-900' : '' }}">
                     <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                  </svg>
                  <span class="ms-3 {{ Request::routeIs('pasabuy-history') ? 'font-medium' : '' }}">Pasabuy History</span>
               </a>
            </li>
         </ul>
      </div>
   </div>