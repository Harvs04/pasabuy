<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, openFilter: false, commentDetailsModalOpen:false, deleteCommentModalOpen:false, postDetailsModalOpen:false, isChangeRoleModalOpen: false, search: $wire.entangle('search'), selectedComment: null, post: null, poster: null, commenter: null }"
    x-cloak>

    @if(session('error'))
    <div
        class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div class="text-center text-sm">
                {{ session('error') }}
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
    @elseif(session('comment_deleted'))
    <div
        class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-center text-sm">
                {{ session('comment_deleted') }}
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

    <!-- NAVBAR -->
    <livewire:navbar />

    @teleport('body')
    <div wire:loading wire:target="deleteComment"
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

    <div class="sm:transition-all sm:duration-300 sm:transform relative flex-grow flex items-center justify-center md:p-4"
        style="margin-top: 4.3rem;" wire:loading.class="hidden" wire:target="switchRole, applyFilter, clearFilter">
        <div class="w-full overflow-x-auto rounded-lg">
            <div class="min-w-full inline-block align-middle rounded-lg">
                <div class="overflow-hidden breport breport-gray-200 rounded-lg shadow-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <caption
                            class="p-5 text-lg mid:text-2xl text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('dashboard') }}" class="p-1.5 hover:bg-gray-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4 md:size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                </a>
                                <p class="font-semibold">Comment list</p>
                            </div>
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Post by</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Commenter</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Comment</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($comments as $comment)
                                @php
                                    $post = App\Models\Post::where('id', $comment->post_id)->first();
                                    $poster = App\Models\User::where('id', $post->user_id)->first();
                                    $commenter = App\Models\User::where('id', $comment->user_id)->first();
                                @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ $poster->profile_pic_url }}"
                                                alt="{{ $poster->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $poster->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $poster->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ $commenter->profile_pic_url }}"
                                                alt="{{ $commenter->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $commenter->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $commenter->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $comment->comment }}
                                        </div>
                                        <div class="text-xs text-gray-500">Added:
                                            {{ $comment->created_at->Timezone('Singapore')->format('M d, Y \a\t H:i a') }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button
                                            @click="commentDetailsModalOpen = true; selectedComment = {{ $comment }}; commenter = {{ $commenter }}; post = {{ $post }};"
                                            class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteCommentModalOpen = true; selectedComment = {{ $comment }}; commenter = {{ $commenter }}; post = {{ $post }};"
                                            class="text-red-600 hover:text-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    No comments found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Details Popover -->
                    @teleport('body')
                    <div x-show="commentDetailsModalOpen"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 font-poppins"
                        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @keydown.escape.window="commentDetailsModalOpen = false">
                        
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[80vh] overflow-y-auto"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            @click.outside="commentDetailsModalOpen = false">

                            <!-- Popover Header -->
                            <div class="flex items-center justify-between p-4 border-b">
                                <h3 class="text-xl font-medium" x-text="post.item_name"></h3>
                                <button @click="commentDetailsModalOpen = false"
                                    class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Popover Content -->
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- Left Column - Image -->
                                    <div class="md:w-1/3">
                                        <img :src="post.item_image" :alt="post.item_name"
                                            class="w-full h-auto rounded-lg shadow-sm"
                                            onerror="this.src='/api/placeholder/400/400'; this.onerror=null;">

                                        <div class="mt-4 flex flex-wrap gap-2">
                                            @php
                                            $statusClasses = [
                                            'open' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                            'ongoing' => 'bg-yellow-100 text-yellow-800',
                                            'completed' => 'bg-blue-100 text-blue-800',
                                            'converted' => 'bg-gray-100 text-gray-800',
                                            ];
                                            @endphp

                                            <span
                                                class="px-3 py-1 text-sm font-medium rounded-full {{ $statusClasses[$post->status] ?? 'bg-gray-100 text-gray-800' }}" x-text="(post.status).toUpperCase()">
                                            </span>
                                            <span class="px-3 py-1 text-sm font-medium rounded-full {{ 
                                             $post->type === 'transaction' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800'
                                             }}" 
                                                x-text="post.type === 'transaction' ? 'Transaction' : 'Item Request'">
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Right Column - Details -->
                                    <div class="md:w-2/3">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500">Posted By</h4>
                                                <p class="text-gray-900" x-text="post.poster_name"></p>
                                            </div>

                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500">Item Origin</h4>
                                                <p class="text-gray-900" x-text="post.item_origin"></p>
                                            </div>

                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500">Item Type</h4>
                                                <p class="text-gray-900"
                                                    x-text="post.item_type"></p>
                                                </p>
                                            </div>
                                            
                                                                                   
                                            <div x-show="post.subtype">
                                                <h4 class="text-sm font-medium text-gray-500">Sub Type</h4>
                                                <p class="text-gray-900">
                                                    <span x-text="post.subtype"></span>
                                                </p>
                                            </div>

                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500">Delivery Date</h4>
                                                <p class="text-gray-900"
                                                    x-text="post.delivery_date ? new Date(post.delivery_date).toLocaleDateString('en-SG', { year: 'numeric', month: '2-digit', day: '2-digit' }) : 'No delivery date'">
                                                </p>
                                            </div>
                                    
                                            <div x-show="post.arrival_time">
                                                <h4 class="text-sm font-medium text-gray-500">Arrival Time</h4>
                                                <p class="text-gray-900" 
                                                    x-text="new Date(`1970-01-01T${post.arrival_time}Z`).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true })">
                                                </p>

                                            </div>

                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500">Payment Methods</h4>
                                                <p class="text-gray-900"
                                                x-text="post.mode_of_payment"></p>
                                                </p>
                                            </div>
                                            
                                                                                
                                            <div x-show="post.transaction_fee">
                                                <h4 class="text-sm font-medium text-gray-500">Transaction Fee</h4>
                                                <p class="text-gray-900" x-text="post.transaction_fee"></p>
                                            </div>
                                    
                                            <div x-show="post.max_orders">
                                                <h4 class="text-sm font-medium text-gray-500">Max Orders</h4>
                                                <p class="text-gray-900" x-text="post.max_orders"></p>
                                            </div>
                                                                                
                                            <div x-show="post.cutoff_date">
                                                <h4 class="text-sm font-medium text-gray-500">Cutoff Date</h4>
                                                <p class="text-gray-900"
                                                    x-text="post.cutoff_date ? new Date(post.cutoff_date).toLocaleDateString('en-SG', { year: 'numeric', month: '2-digit', day: '2-digit' }) : 'No cutoff date'">                                                    
                                                </p>
                                            </div>
                                        </div>
                                        
                                                                            
                                        <div x-show="post.meetup_place" class="mt-4">
                                            <h4 class="text-sm font-medium text-gray-500">Meetup Place</h4>
                                            <p class="text-gray-900"
                                                x-text="post.meetup_place">
                                            </p>
                                        </div>
                                                                              
                                        <div x-show="post.additional_notes" class="mt-4">
                                            <h4 class="text-sm font-medium text-gray-500">Additional Notes</h4>
                                            <p class="text-gray-900 whitespace-pre-line"
                                                x-text="post.additional_notes"></p>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="mt-6 flex gap-3 justify-end">
                                            <button
                                                @click="commentDetailsModalOpen = false"
                                                class="px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-50">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    @endteleport

                    <!-- DELETE USER MODAL -->
                    @teleport('body')
                        <div x-show="deleteCommentModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            @keydown.escape.window="deleteCommentModalOpen = false"
                            >
                            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full p-6 font-poppins"
                                @click.outside="deleteCommentModalOpen = false"
                                x-data="{ deleteConfirmation: '' }">
                                <!-- Header -->
                                <div class="text-center mb-6">
                                    <div
                                        class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                                        <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">Delete Comment</h3>
                                    <p class="text-sm text-gray-500 mt-1">This action cannot be undone.</p>
                                </div>

                                <!-- Comment Information -->
                                <div class="flex flex-col p-4 mb-6 bg-gray-50 rounded-lg">
                                    <div class="flex items-center mb-2 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <img class="h-12 w-12 rounded-full object-cover" x-bind:src="commenter?.profile_pic_url"
                                                x-bind:alt="commenter?.name">
                                        </div>
                                        <div class="ml-4 flex-grow">
                                            <div class="text-base font-medium text-gray-900" x-text="commenter?.name"></div>
                                            <div class="text-sm text-gray-500" x-text="commenter?.email"></div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1.5 p-3 bg-gray-100 rounded-md text-gray-700">
                                        <p class="text-sm text-gray-900">
                                            Comment:
                                        </p>
                                        <p class="text-sm italic font-medium break-all" x-text="selectedComment?.comment"></p>
                                        <p class="text-xs" x-text="'Added: ' + new Date(selectedComment?.created_at).toLocaleString()"></p>
                                    </div>
                                </div>

                                <!-- Warning -->
                                <div class="mb-6">
                                    <p class="text-sm text-gray-600">
                                        Are you sure you want to delete this comment? All data associated with this comment
                                        will be permanently removed. This action cannot be reversed.
                                    </p>
                                </div>

                                <!-- Confirmation Input -->
                                <div class="mb-6">
                                    <label for="confirm-delete" class="block text-sm font-medium text-gray-700 mb-1">
                                        Type <span class="font-semibold text-red-600" x-text="'DELETE'"></span> to confirm
                                    </label>
                                    <input type="text" id="confirm-delete" x-model="deleteConfirmation"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                        placeholder="DELETE">
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-end space-x-3">
                                    <button @click="deleteCommentModalOpen = false"
                                        class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Cancel
                                    </button>
                                    <button @click="deleteCommentModalOpen = false; $wire.deleteComment(selectedComment?.id);" :disabled="deleteConfirmation !== 'DELETE'"
                                        :class="{'bg-red-600 hover:bg-red-700 cursor-pointer': deleteConfirmation === 'DELETE', 'bg-red-300 cursor-not-allowed': deleteConfirmation !== 'DELETE'}"
                                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Delete Comment
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endteleport
                </div>
            </div>
        </div>
    </div>
</div>