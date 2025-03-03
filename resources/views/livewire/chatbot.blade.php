<div x-data="{ openBot: false }">
    <div x-show="openBot" 
         x-transition:enter="scale-in-br" 
         x-transition:leave="scale-out-br"
         @click.outside="openBot = false"
         class="fixed bottom-20 right-6 w-2/3 sm:w-80 bg-white max-h-3/5 h-3/5 border border-slate-200 rounded-l-xl rounded-t-xl shadow p-2 z-50"
    >
         <div class="">Low</div>
    </div>    

    <button class="fixed flex items-center justify-center z-50 bottom-4 right-4 w-12 h-12 rounded-full bg-[#014421] hover:bg-green-800 shadow-xl" 
            @click="openBot = !openBot">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot">
            <path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/>
            <path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/>
        </svg>
    </button>

    <style>
        /* Scale In Animation */
        .scale-in-br {
            animation: scale-in-br 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
        }

        @keyframes scale-in-br {
            0% {
                transform: scale(0);
                transform-origin: 100% 100%;
                opacity: 0;
            }
            100% {
                transform: scale(1);
                transform-origin: 100% 100%;
                opacity: 1;
            }
        }

        /* Scale Out Animation */
        .scale-out-br {
            animation: scale-out-br 0.4s ease-in forwards;
        }

        @keyframes scale-out-br {
            0% {
                transform: scale(1);
                transform-origin: 100% 100%;
                opacity: 1;
            }
            100% {
                transform: scale(0);
                transform-origin: 100% 100%;
                opacity: 0;
            }
        }
    </style>
</div>
