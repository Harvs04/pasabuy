<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, openFilter: false, createPostModalOpen:false, isChangeRoleModalOpen: false, clicked: false, change: false }"
    x-cloak>

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
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
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
                                        <button @click="closeDetails()"
                                            class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                            Close
                                        </button>
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

</div>