<div>
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
                    <hr class="my-2">
                </div>
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
