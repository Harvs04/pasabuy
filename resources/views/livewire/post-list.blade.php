<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, openFilter: false, deletePostModalOpen:false, isChangeRoleModalOpen: false, clicked: false, change: false }"
    x-cloak>

    @if(session('error'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
    @elseif(session('post_deleted'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                {{ session('post_deleted') }}
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

    @teleport('body')
        <div wire:loading wire:target="deletePost"
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

    <!-- NAVBAR -->
    <livewire:navbar />

    <div class="sm:transition-all sm:duration-300 sm:transform relative flex-grow flex items-center justify-center p-4"
        style="margin-top: 4.3rem;" wire:loading.class="hidden" wire:target="switchRole, applyFilter, clearFilter">
        <div class="flex flex-col items-center justify-center w-full max-w-5xl px-4">
            <div class="flex items-center gap-2 text-center w-full md:w-9/12 p-4 rounded-md bg-white shadow-sm border">
                <a href="{{ route('dashboard') }}" class="p-1.5 hover:bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4 md:size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <p class="text-black text-2xl font-medium">Post list</p>
            </div>

            <!-- Card List -->
            <div class="w-full mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" x-data="{ 
             activePost: null,
             showDetails: false,
             toggleDetails(post) {
                 this.activePost = post;
                 this.showDetails = true;
             },
             closeDetails() {
                 this.showDetails = false;
             }
         }">

                @forelse($posts as $post)
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden cursor-pointer hover:shadow-md transition-all"
                    @click="toggleDetails({
                     id: '{{ $post->id }}',
                     type: '{{ $post->type }}',
                     status: '{{ $post->status }}',
                     poster_name: '{{ $post->poster_name }}',
                     item_name: '{{ $post->item_name }}',
                     item_origin: '{{ $post->item_origin }}',
                     item_type: {{ json_encode($post->item_type) }},
                     sub_type: {{ json_encode($post->sub_type) }},
                     item_image: '{{ $post->item_image }}',
                     delivery_date: '{{ $post->delivery_date }}',
                     arrival_time: '{{ $post->arrival_time }}',
                     mode_of_payment: {{ json_encode($post->mode_of_payment) }},
                     transaction_fee: '{{ $post->transaction_fee }}',
                     max_orders: '{{ $post->max_orders }}',
                     cutoff_date: '{{ $post->cutoff_date }}',
                     meetup_place: '{{ $post->meetup_place }}',
                     additional_notes: '{{ $post->additional_notes }}'
                 })">
                    <div class="relative">
                        <img src="{{ $post->item_image }}" alt="{{ $post->item_name }}" class="w-full h-40 object-cover"
                            onerror="this.src='/api/placeholder/400/200'; this.onerror=null;">

                        <div class="absolute top-2 right-2 flex gap-2">
                            <!-- Status Badge -->
                            @php
                            $statusColors = [
                            'open' => 'bg-green-100 text-green-800',
                            'full' => 'bg-red-100 text-red-800',
                            'ongoing' => 'bg-yellow-100 text-yellow-800',
                            'completed' => 'bg-blue-100 text-blue-800',
                            'cancelled' => 'bg-gray-100 text-gray-800',
                            ];

                            $statusClass = $statusColors[$post->status] ?? 'bg-purple-100 text-purple-800';
                            @endphp

                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                {{ ucfirst($post->status) }}
                            </span>


                            <!-- Type Badge -->
                            @php
                            $typeClass = $post->type === 'item_request'
                            ? 'bg-blue-100 text-blue-800'
                            : 'bg-indigo-100 text-indigo-800';

                            $typeLabel = $post->type === 'item_request' ? 'Request' : 'Transaction';
                            @endphp

                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $typeClass }}">
                                {{ $typeLabel }}
                            </span>

                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 truncate">{{ $post->item_name }}</h3>
                        <p class="text-sm text-gray-500">by {{ $post->poster_name }}</p>

                        <div class="mt-3 grid grid-cols-2 gap-x-4 text-sm">
                            <div>
                                <span class="text-gray-500">Origin:</span>
                                <p class="font-medium">{{ $post->item_origin }}</p>
                            </div>
                            <div>
                                <span class="text-gray-500">Delivery:</span>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($post->delivery_date)->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="mt-3 text-center">
                            <span class="text-sm text-blue-600">Click for details</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full p-8 text-center">
                    <p class="text-gray-500">No posts found.</p>
                </div>
                @endforelse

                <!-- Details Popover -->
                @teleport('body')
                <div x-show="showDetails"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 font-poppins"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click.self="closeDetails()">

                    <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] overflow-y-auto"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                        <!-- Popover Header -->
                        <div class="flex items-center justify-between p-4 border-b">
                            <h3 class="text-xl font-medium" x-text="activePost?.item_name"></h3>
                            <button @click="closeDetails()" class="text-gray-400 hover:text-gray-600">
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
                                    <img x-bind:src="activePost?.item_image" x-bind:alt="activePost?.item_name"
                                        class="w-full h-auto rounded-lg shadow-sm"
                                        onerror="this.src='/api/placeholder/400/400'; this.onerror=null;">

                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <span class="px-3 py-1 text-sm font-medium rounded-full" :class="{
                                          'bg-green-100 text-green-800': activePost?.status === 'open',
                                          'bg-red-100 text-red-800': activePost?.status === 'full',
                                          'bg-yellow-100 text-yellow-800': activePost?.status === 'ongoing',
                                          'bg-blue-100 text-blue-800': activePost?.status === 'completed',
                                          'bg-gray-100 text-gray-800': activePost?.status === 'cancelled'
                                      }"
                                            x-text="activePost?.status ? activePost.status.charAt(0).toUpperCase() + activePost.status.slice(1) : ''">
                                        </span>

                                        <span class="px-3 py-1 text-sm font-medium rounded-full" :class="{
                                          'bg-blue-100 text-blue-800': activePost?.type === 'item_request',
                                          'bg-indigo-100 text-indigo-800': activePost?.type === 'transaction'
                                      }" x-text="activePost?.type === 'item_request' ? 'Item Request' : 'Transaction'">
                                        </span>
                                    </div>
                                </div>

                                <!-- Right Column - Details -->
                                <div class="md:w-2/3">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Posted By</h4>
                                            <p class="text-gray-900" x-text="activePost?.poster_name"></p>
                                        </div>

                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Item Origin</h4>
                                            <p class="text-gray-900" x-text="activePost?.item_origin"></p>
                                        </div>

                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Item Type</h4>
                                            <p class="text-gray-900"
                                                x-text="Array.isArray(activePost?.item_type) ? activePost?.item_type.join(', ') : activePost?.item_type">
                                            </p>
                                        </div>

                                        <div x-show="activePost?.sub_type">
                                            <h4 class="text-sm font-medium text-gray-500">Sub Type</h4>
                                            <p class="text-gray-900"
                                                x-text="Array.isArray(activePost?.sub_type) ? activePost?.sub_type.join(', ') : activePost?.sub_type">
                                            </p>
                                        </div>

                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Delivery Date</h4>
                                            <p class="text-gray-900"
                                                x-text="new Date(activePost?.delivery_date).toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'})">
                                            </p>
                                        </div>

                                        <div x-show="activePost?.arrival_time">
                                            <h4 class="text-sm font-medium text-gray-500">Arrival Time</h4>
                                            <p class="text-gray-900" x-text="activePost?.arrival_time"></p>
                                        </div>

                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Payment Methods</h4>
                                            <p class="text-gray-900"
                                                x-text="Array.isArray(activePost?.mode_of_payment) ? activePost?.mode_of_payment.join(', ') : activePost?.mode_of_payment">
                                            </p>
                                        </div>

                                        <div x-show="activePost?.transaction_fee">
                                            <h4 class="text-sm font-medium text-gray-500">Transaction Fee</h4>
                                            <p class="text-gray-900" x-text="activePost?.transaction_fee"></p>
                                        </div>

                                        <div x-show="activePost?.max_orders">
                                            <h4 class="text-sm font-medium text-gray-500">Max Orders</h4>
                                            <p class="text-gray-900" x-text="activePost?.max_orders"></p>
                                        </div>

                                        <div x-show="activePost?.cutoff_date">
                                            <h4 class="text-sm font-medium text-gray-500">Cutoff Date</h4>
                                            <p class="text-gray-900"
                                                x-text="activePost?.cutoff_date ? new Date(activePost.cutoff_date).toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'}) : ''">
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4" x-show="activePost?.meetup_place">
                                        <h4 class="text-sm font-medium text-gray-500">Meetup Place</h4>
                                        <p class="text-gray-900 whitespace-pre-line" x-text="activePost?.meetup_place">
                                        </p>
                                    </div>

                                    <div class="mt-4" x-show="activePost?.additional_notes">
                                        <h4 class="text-sm font-medium text-gray-500">Additional Notes</h4>
                                        <p class="text-gray-900 whitespace-pre-line"
                                            x-text="activePost?.additional_notes"></p>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="mt-6 flex gap-3 justify-end">
                                        <!-- Add Delete Button Here -->
                                        <button @click="deletePostModalOpen = true"
                                            class="px-4 py-2 text-sm bg-red-600 text-white rounded-md hover:bg-red-700">
                                            Delete
                                        </button>
                                        <button @click="closeDetails()"
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

                @teleport('body')
                <div x-show="deletePostModalOpen"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 font-poppins"
                    x-transition:enter="transition ease-out duration-200" 
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" 
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" 
                    x-transition:leave-end="opacity-0"
                    @click.self="deletePostModalOpen = false"
                    @keydown.escape.window="deletePostModalOpen = false">

                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" 
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" 
                        x-transition:leave-end="opacity-0 scale-95"
                        x-data="{ deleteConfirmation: '' }">

                        <!-- Modal Header -->
                        <div class="flex items-center justify-between p-4 border-b">
                            <h3 class="text-xl font-medium text-gray-900">Delete Post</h3>
                            <button @click="deletePostModalOpen = false" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <div class="p-6">
                            <div class="flex items-center mb-5">
                                <div class="flex-shrink-0 h-12 w-12 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900" x-text="activePost?.item_name"></h4>
                                    <p class="text-sm text-gray-500" x-text="activePost?.type === 'item_request' ? 'Item Request' : 'Transaction'"></p>
                                </div>
                            </div>

                            <p class="text-gray-600 mb-6">
                                Are you sure you want to delete this post? This action cannot be undone, and all related orders and communications will be permanently removed.
                            </p>

                            <!-- Confirmation input -->
                            <div class="mb-5">
                                <label for="confirm-delete-post" class="block text-sm font-medium text-gray-700 mb-1">
                                    Type <span class="font-semibold text-red-600">DELETE</span> to confirm
                                </label>
                                <input type="text" id="confirm-delete-post" x-model="deleteConfirmation" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                    placeholder="DELETE">
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end gap-3">
                                <button @click="deletePostModalOpen = false"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                    <p class="text-sm">Cancel</p>
                                </button>
                                <button @click="$wire.deletePost(activePost?.id); deletePostModalOpen = false; showDetails = false; " 
                                    :disabled="deleteConfirmation !== 'DELETE'"
                                    :class="{'bg-red-600 hover:bg-red-700 cursor-pointer': deleteConfirmation === 'DELETE', 'bg-red-300 cursor-not-allowed': deleteConfirmation !== 'DELETE'}"
                                    class="px-4 py-2 text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <p class="text-sm">
                                        Delete Post
                                    </p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endteleport
            </div>
        </div>
    </div>

</div>