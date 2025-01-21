<div x-data="{ orderItemModalOpen: false, usersShow: false, liked: {{ collect($user->like_posts)->pluck('post_id')->contains($post->id) ? 'true' : 'false' }}, saved: {{ collect($user->save_posts)->pluck('post_id')->contains($post->id) ? 'true' : 'false' }} }">
    @if ($post->type === 'item_request')
        <div>
            <hr class="my-2">
            <div class="flex flex-row gap-1 text-gray-600 text-sm items-center relative">
                <div @mouseenter="usersShow = true" @mouseleave="usersShow = false"  class="flex flex-row items-center">
                    <p class="ml-2">{{ $user_likes->count() }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <div x-show="usersShow" 
                        class="text-xs absolute -top-14 left-0 z-50 border rounded-lg bg-gray-200 text-gray-700 shadow px-2.5 py-2">
                        @if($user_likes->count() === 0)
                            <p>No likes yet.</p>
                        @else
                            @foreach($user_likes as $user_like)
                                <p>{{$user_like->liked_by}}</p>
                            @endforeach
                        @endif   
                    </div>
                </div>
                <div class="flex flex-row items-center gap-[2px]">
                    <p class="ml-2">{{ $db_comments->count() }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                </div>
                <div class="w-5/6 flex flex-row gap-1 ml-auto">
                    <button @click="liked = !liked; $wire.likePost({{ $post->id }}, liked).then(() => $wire.call('refresh')); " class="w-4/12 md:w-5/12 py-1.5 hover:bg-gray-200 hover:rounded-md" :class="'{{ $user->role }}' === 'provider' ? 'hidden' : 'block'">
                        <div class="flex flex-row items-center justify-center gap-3" :class="liked ? 'text-[#014421]' : ''">
                            
                            <div wire:loading.delay.long wire:target="likePost" role="status">
                                <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-[#014421]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                            </div>

                            <svg wire:loading.class="hidden" wire:target="likePost" xmlns="http://www.w3.org/2000/svg" :fill="liked ? '#014421' : 'none'" viewBox="0 0 24 24" stroke-width="2" :stroke="liked ? '#014421' : 'currentColor'" class="size-4 md:size-5" :class="openBurger ? 'lg:size-4 xl:size-5': 'size-5'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            <p class="hidden lg:font-medium lg:block" :class="openBurger ? 'hidden md:block md:text-sm lg:text-xs xl:text-sm' : 'md:block'">I want this too!</p>
                        </div>
                    </button>
                    <button class="w-4/12 md:w-5/12 py-1.5 enabled:hover:bg-gray-200 enabled:hover:rounded-md disabled:bg-gray-200 disabled:text-gray-300 disabled:cursor-not-allowed disabled:rounded-md" :class="{'hidden': '{{ $user->role }}' === 'customer' || '{{ $user->id }}' === '{{ $post->user_id }}', 'block': '{{ $user->role }}' !== 'customer' && '{{ $user->id }}' !== '{{ $post->user_id }}'}" :disabled="{{ $user->pasabuy_points < 80 }}">
                        <div class="flex flex-row items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5" :class="openBurger ? 'lg:size-4 xl:size-5': 'size-5'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                            </svg>
                            <p  class="hidden lg:font-medium lg:block" :class="openBurger ? 'hidden md:block md:text-sm lg:text-xs xl:text-sm' : 'md:block'">Initiate transaction</p>
                        </div>
                    </button>
                    <button @click="openComment = !openComment" class="w-4/12 md:w-5/12 py-1.5 enabled:hover:bg-gray-200 enabled:hover:rounded-md disabled:bg-gray-300 disabled:text-gray-400 disabled:rounded-md ml-auto">
                        <div class="flex flex-row items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5" :class="openBurger ? 'lg:size-4 xl:size-5': 'size-5'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                            <p class="hidden lg:font-medium lg:block" :class="openBurger ? 'hidden md:block md:text-sm lg:text-xs xl:text-sm' : 'md:block'">Comment</p>
                        </div>
                    </button>
                    <button @click=" saved = !saved; $wire.savePost({{ $post->id }}, saved).then(() => $wire.call('refresh')); " :class="saved ? 'text-[#014421]' : ''" class="w-4/12 md:w-5/12 py-1.5 hover:bg-gray-200 hover:rounded-md ">
                        <div class="flex flex-row items-center justify-center gap-3">
                            <div wire:loading.delay.long wire:target="savePost" role="status">
                                <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-[#014421]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                            </div>
                            <svg wire:loading.class="hidden" wire:target="savePost" xmlns="http://www.w3.org/2000/svg" :fill="saved ? '#014421' : 'none'" viewBox="0 0 24 24" stroke-width="2" :stroke="saved ? '#014421' : 'currentColor'" class="size-4 md:size-5" :class="openBurger ? 'lg:size-4 xl:size-5': 'size-5'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                            </svg>
                            <p  class="hidden lg:font-medium lg:block" :class="openBurger ? 'hidden md:block md:text-sm lg:text-xs xl:text-sm' : 'md:block'">Save post</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    @elseif($post->type === 'transaction')
        <div class="relative">
            <hr class="my-2">
            <div class="flex flex-row gap-1 text-gray-600 text-sm items-center">
                <div @mouseenter="usersShow = true" @mouseleave="usersShow = false"  class="flex flex-row items-center">
                    <p class="ml-2">{{ $user_likes->count() }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <div x-show="usersShow" 
                        class="text-xs absolute -top-14 left-0 z-50 border rounded-lg bg-gray-200 text-gray-700 shadow px-2.5 py-2">
                        @if($user_likes->count() === 0)
                            <p>No likes yet.</p>
                        @else
                            @foreach($user_likes as $user_like)
                                <p>{{$user_like->liked_by}}</p>
                            @endforeach
                        @endif   
                    </div>
                </div>
                <div class="flex flex-row items-center gap-[2px]">
                    <p class="ml-2">{{ $db_comments->count() }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                </div>
                <div class="w-5/6 flex flex-row gap-1 ml-auto">
                    <button @click="liked = !liked; $wire.likePost({{ $post->id }}, liked).then(() => $wire.call('refresh')); " class="w-4/12 md:w-5/12 py-1.5 hover:bg-gray-200 hover:rounded-md" :class="'{{ $user->role }}' === 'customer' ? 'hidden' : 'block'">
                        <div class="flex flex-row items-center justify-center gap-3" :class="liked ? 'text-[#014421]' : ''">
                            <div wire:loading.delay.long wire:target="likePost" role="status">
                                <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-[#014421]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                            </div>
                            <svg wire:loading.class="hidden" wire:target="likePost" xmlns="http://www.w3.org/2000/svg" :fill="liked ? '#014421' : 'none'" viewBox="0 0 24 24" stroke-width="2" :stroke="liked ? '#014421' : 'currentColor'" class="size-4 md:size-5" :class="openBurger ? 'lg:size-4 xl:size-5': 'size-5'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            <p class="hidden lg:font-medium lg:block" :class="openBurger ? 'hidden md:block md:text-sm lg:text-xs xl:text-sm' : 'md:block'">I want this too!</p>
                        </div>
                    </button>
                    
                    <button @click="orderItemModalOpen = true; document.body.style.overflow = 'hidden';" class="w-4/12 md:w-5/12 py-1.5 enabled:hover:bg-gray-200 enabled:hover:rounded-md disabled:bg-gray-200 disabled:text-gray-300 disabled:cursor-not-allowed disabled:rounded-md" :class="{'hidden': '{{ $user->role }}' === 'provider' || '{{ $user->id }}' === '{{ $post->user_id }}', 'block': '{{ $user->role }}' !== 'customer' && '{{ $user->id }}' !== '{{ $post->user_id }}'}" :disabled="{{ $user->pasabuy_points < 80 || !$user->contact_number || !$user->college || !$user->degree_program }}">
                        <div class="flex flex-row items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5" :class="openBurger ? 'lg:size-4 xl:size-5': 'size-5'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            <p class="hidden lg:font-medium lg:block" :class="openBurger ? 'hidden md:block md:text-sm lg:text-xs xl:text-sm' : 'md:block'">Order item</p>
                        </div>
                    </button>
                    <button @click="openComment = !openComment" class="ml-auto w-4/12 md:w-5/12 py-1.5 enabled:hover:bg-gray-200 enabled:hover:rounded-md disabled:bg-gray-300 disabled:text-gray-400 disabled:rounded-md">
                        <div class="flex flex-row items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 md:size-5" :class="openBurger ? 'lg:size-4 xl:size-5': 'size-5'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                            <p class="hidden lg:font-medium lg:block" :class="openBurger ? 'hidden md:block md:text-sm lg:text-xs xl:text-sm' : 'md:block'">Comment</p>
                        </div>
                    </button>
                    <button @click="saved = !saved; $wire.savePost({{ $post->id }}, saved).then(() => $wire.call('refresh')); " :class="saved ? 'text-[#014421]' : ''"  class="w-4/12 md:w-5/12 py-1.5 hover:bg-gray-200 hover:rounded-md ">
                        <div class="flex flex-row items-center justify-center gap-3">
                            <div wire:loading.delay.long wire:target="savePost" role="status">
                                <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-[#014421]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                            </div>
                            <svg wire:loading.class="hidden" wire:target="savePost" xmlns="http://www.w3.org/2000/svg" :fill="saved ? '#014421' : 'none'" viewBox="0 0 24 24" stroke-width="2" :stroke="saved ? '#014421' : 'currentColor'" class="size-4 md:size-5" :class="openBurger ? 'lg:size-4 xl:size-5': 'size-5'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                            </svg>
                            <p  class="hidden lg:font-medium lg:block" :class="openBurger ? 'hidden md:block md:text-sm lg:text-xs xl:text-sm' : 'md:block'">Save post</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- ORDER ITEM MODAL -->
    @teleport('body')
        <div 
            x-show="orderItemModalOpen" 
            x-transition:enter.duration.25ms 
            class="fixed inset-0 z-50"
        >
            <livewire:order-item-modal :$post/>
        </div>
    @endteleport
    <div x-show="openComment">
        <hr class="my-2">
        <div class="py-1">
            <div class="" x-data="{ comment: '', comments: $wire.entangle('comments')  }">
                
                <!-- COMMENTS STREAM -->
                @if($db_comments->count() > 0) 
                    <div class="flex flex-col gap-2">
                        @foreach($db_comments as $comment)
                            <div class="flex flex-row items-start gap-3 md:gap-4" x-data="{ showDate: false }">
                                <img class="w-8 md:w-9 h-8 md:h-9 rounded-full object-cover" 
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" 
                                    alt="user photo">
                                <div class="flex flex-col items-start w-full">
                                    <div class="flex flex-row gap-2 items-center relative">
                                        <p class="font-medium">{{ $comment->commenter }}</p>
                                        <p class="text-xs hover:underline" 
                                            @mouseenter="showDate = true" 
                                            @mouseleave="showDate = false">
                                            {{ $comment->created_at->diffForHumans(null, false, true) }}
                                        </p>
                                        <div x-show="showDate" 
                                            class="text-xs absolute -top-14 left-0 z-50 border rounded-lg bg-gray-200 text-gray-700 shadow px-2.5 py-2">
                                            <p>{{ $comment->created_at->timezone('Singapore')->format('l F j, Y \a\t H:i') }}</p>       
                                        </div>
                                    </div>

                                    <p class="text-sm break-all whitespace-pre-line">{{$comment->comment}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr class="mt-2 mb-3">
                @endif

                <!-- COMMENT INPUT FIELD -->
                <div class="flex flex-row items-center gap-3 md:gap-4">
                    <img class="w-8 md:w-9 h-8 md:h-9 rounded-full object-cover" 
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" 
                        alt="user photo">
                    <div class="relative w-full" x-data="{ shiftPressed: false }">
                        <textarea
                            id="comment"
                            x-model="comment"
                            wire:model="comment"
                            class="block w-full p-2 ps-3 pe-8 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421] resize-none overflow-hidden"
                            placeholder="Write comment..."
                            oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';"
                            rows="1"
                            @keydown.shift="shiftPressed = true"
                            @keyup.shift="shiftPressed = false"
                            @keydown.enter.prevent="if (!shiftPressed && comment) { comments.push(comment); $wire.addComment({{ $post->id }}); comment = ''; } else if (shiftPressed && comment) { $event.target.value = $event.target.value + '\n'; } ">
                        </textarea>
                        <button class="ml-auto absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" @click="if (comment) { comments.push(comment); $wire.addComment({{ $post->id }}); comment = ''; } " :class="{ 'cursor-not-allowed': !comment }">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class=""
                            >
                                <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
