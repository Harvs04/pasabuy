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
        {{ $user->orders }}
    </div>
</div>