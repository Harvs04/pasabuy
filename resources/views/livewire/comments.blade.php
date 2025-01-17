<div>
    <hr class="my-2">
    <div class="px-3 py-1">
        <div class="" x-data="{ comment: '', comments: $wire.entangle('comments')  }">

            <!-- COMMENTS STREAM --> 
            
            <div>
                <p x-text="comments"></p>
            </div>
            <!-- COMMENT INPUT FIELD -->
            <div class="flex flex-row items-center gap-3 md:gap-4">
                <img class="w-8 md:w-9 h-8 md:h-9 rounded-full object-cover" 
                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" 
                    alt="user photo">
                <div class="relative w-full">
                    <textarea
                        id="comment"
                        x-model="comment"
                        wire:model="comment"
                        class="block w-full p-2 ps-3 pe-8 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-[#014421] resize-none overflow-hidden"
                        placeholder="Write comment..."
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';"
                        rows="1">
                    </textarea>
                    <button class="ml-auto absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" @click="if (comment) { comments.push(comment); $wire.addComment({{ $post->id }}, {{ $user->id }}); comment = ''; } ">
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
