<div x-data="{ openBot: false, firstOpen: true, stayInCurrent: false, firstClose: false, conversation: $wire.entangle('conversation')
    }" class="text-sm">
    <div x-show="openBot" 
         x-transition:enter="scale-in-br" 
         x-transition:leave="scale-out-br"
         @click.outside="openBot = false; firstOpen = false; firstClose = true;"
         class="fixed bottom-20 right-6 w-2/3 sm:w-80 bg-white max-h-3/5 h-3/5 border border-slate-200 rounded-l-xl rounded-t-xl shadow z-50"
    >
        <div class="flex items-center w-full h-10 bg-[#014421] rounded-t-xl px-3 text-white">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                <p class="">Helper bot</p>
            </div>
            <button class="ml-auto p-1 hover:bg-green-800 rounded-full" @click="openBot = false; firstClose = true;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                </svg>    
            </button>
        </div>
        <div class="flex flex-col gap-2 p-2.5">
            <div class=" flex items-start gap-2">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-[#014421] border border-[#014421] flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="px-2 border rounded-b-lg rounded-r-lg" :class="{ 'typewriter': openBot && firstOpen }">
                        <h1>Hi! If ever you feel lost, I am here to assist you.</h1>
                    </div>
                    <h1 class="px-2 border rounded-b-lg rounded-r-lg">You are currently in the <span class="font-medium underline">{{ $current_route }}</span>.</h1>
                    @php
                        $main_routes = $user->role === 'customer' 
                        ? [
                            'dashboard' => route('dashboard'),
                            'messages' => route('messages'),
                            'saved' => route('saved'),
                            'orders' => route('my-orders'),
                            'history' => route('pasabuy-history'),
                            'profile' => route('profile', ['name' => $user->name])
                        ] 
                        : [
                            'dashboard' => route('dashboard'),
                            'messages' => route('messages'),
                            'saved' => route('saved'),
                            'transactions' => route('transactions'),
                            'history' => route('pasabuy-history'),
                            'profile' => route('profile', ['name' => $user->name])
                        ];
                    @endphp
                    <div class="flex-wrap">
                        @foreach($main_routes as $route => $link)
                            @if($route !== $current_route)
                                <a href="{{ $link }}" class="border rounded-md w-fit px-1.5 py-0.5 hover:bg-gray-100">
                                    {{ $route }}
                                </a>
                            @else
                                <button class="border rounded-md w-fit px-1.5 py-0.5 hover:bg-gray-100" @click="stayInCurrent = true; if (!conversation.includes('stay here1')) { conversation.push('stay here1'); $wire.add_message('stay here1')}">
                                    Stay here
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="">
                <template x-for="convo in conversation">
                    <div class="flex" x-data="{ message: String(convo).trim() }">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-[#014421] border border-[#014421] flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot">
                                <path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/>
                            </svg>
                        </div>
                        <template x-if="message.length > 0 && !message.endsWith('1')">
                            <template x-for="reply in message.split(',')">
                                <div class="flex gap-2">
                                    <button class="px-2 border rounded-b-lg rounded-r-lg hover:bg-gray-100" x-text="reply.slice(0, -1)"></button>
                                </div>
                            </template>
                        </template>

                        <!-- If message ends with '1' -->
                        <template x-if="message.endsWith('1')">
                            <div class="flex ml-auto gap-2">
                                <p class="px-2 bg-green-800 text-white border rounded-b-lg rounded-l-lg" x-text="message.slice(0, -1)"></p>
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-[#014421] border border-[#014421] flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot">
                                        <path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/>
                                    </svg>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
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


        /* TYPING EFFECT */
        .typewriter h1 {
            animation: 
                typing 1s steps(40, end)
        }

        /* The typing effect */
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        /* fade in */
        .fade-in {
	        -webkit-animation: fade-in 1.2s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                    animation: fade-in 1.2s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        }

        @-webkit-keyframes fade-in {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
        }
        @keyframes fade-in {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
        }

        /* fade out */
        .fade-out {
            -webkit-animation: fade-out 1s ease-out both;
                    animation: fade-out 1s ease-out both;
        }
        @-webkit-keyframes fade-out {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
        }
        @keyframes fade-out {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
        }

    </style>
</div>
