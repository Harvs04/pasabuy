<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, isChangeRoleModalOpen: false, deleteFeedbackModalOpen: false, search: $wire.entangle('search'), feedbackDetailsOpen: false, selectedFeedback: null }"
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
    @elseif(session('feedback_deleted'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                {{ session('feedback_deleted') }}
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
        <div wire:loading wire:target="deleteFeedback"
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

    <div class="sm:transition-all sm:duration-300 sm:transform relative flex-grow flex items-center justify-center py-2"
        style="margin-top: 4.3rem;" wire:loading.class="hidden" wire:target="deleteFeedback">
        <div class="w-full overflow-x-auto rounded-lg">
            <div class="min-w-full inline-block align-middle rounded-lg">
                <div class="hidden sm:block overflow-hidden border border-gray-200 rounded-lg shadow-md">
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
                                <p class="font-semibold">Feedback list</p>
                            </div>
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Customer</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Provider</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date delivered</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Star rating</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Remarks</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($feedbacks as $feedback)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ App\Models\User::where('id', $feedback->customer_id)->first()->profile_pic_url }}" alt="{{ App\Models\User::where('id', $feedback->customer_id)->first()->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ App\Models\User::where('id', $feedback->customer_id)->first()->name }}</div>
                                            <div class="text-xs text-gray-500">Added:
                                                {{ $feedback->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ App\Models\User::where('id', $feedback->provider_id)->first()->profile_pic_url }}" alt="{{ App\Models\User::where('id', $feedback->provider_id)->first()->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ App\Models\User::where('id', $feedback->provider_id)->first()->name }}</div>                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ App\Models\Order::where('id', $feedback->order_id)->first()->order }}</div>
                                    <div class="text-xs text-gray-500">
                                        Item origin: {{ App\Models\Post::where('id', $feedback->post_id)->first()->item_origin }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ App\Models\Order::where('id', $feedback->order_id)->first()->date_delivered->Timezone('Singapore')->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        at {{ App\Models\Order::where('id', $feedback->order_id)->first()->date_delivered->Timezone('Singapore')->format('h:i a') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++) @if ($i <=floor($feedback->star_rating)) <!-- Solid
                                                Star for full rating -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 xl:w-6 text-yellow-500" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                @elseif ($i - $feedback->star_rating < 1) <!-- Half Star for fractional rating
                                                    -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 xl:w-6 text-yellow-400" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <defs>
                                                            <linearGradient id="half">
                                                                <stop offset="50%" stop-color="currentColor" />
                                                                <stop offset="50%" stop-color="transparent" />
                                                            </linearGradient>
                                                        </defs>
                                                        <path fill="url(#half)"
                                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    @else
                                                    <!-- Outline Star for empty rating -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 xl:w-6 text-gray-300" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                    </svg>
                                                    @endif
                                                    @endfor
                                                    <span
                                                        class="ml-1 text-sm text-gray-500">{{ $feedback->star_rating . "/5" }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="text-gray-500">
                                        {{ $feedback->remarks }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button @click="deleteFeedbackModalOpen = true; selectedFeedback = {{ $feedback }}; $wire.set('customer_id', '{{ $feedback->customer_id }}'); $wire.set('provider_id', '{{ $feedback->provider_id }}'); $wire.set('feedback_id', '{{ $feedback->id }}');"
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
                                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    No feedbacks found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View (visible only on mobile) -->
                <div class="sm:hidden">
                    @forelse ($feedbacks as $feedback)
                    <div
                        class="bg-white p-4 border-b border-gray-200">
                        @php
                            $customer = App\Models\User::where('id', $feedback->customer_id)->first();
                            $provider = App\Models\User::where('id', $feedback->provider_id)->first();
                            $order = App\Models\Order::where('id', $feedback->order_id)->first();
                        @endphp
                        <div class="mb-3">
                            <div class="relative text-lg font-medium text-gray-900 pb-2 border-b border-gray-200">
                                <p class="text-base pe-4">
                                    Order #{{ $order->id }}
                                </p>
                                <button @click="deleteFeedbackModalOpen = true; selectedFeedback = {{ $feedback }}; $wire.set('customer_id', '{{ $feedback->customer_id }}'); $wire.set('provider_id', '{{ $feedback->provider_id }}'); $wire.set('feedback_id', '{{ $feedback->id }}');"
                                    class="absolute right-1 top-1 text-red-600 hover:text-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $customer->profile_pic_url }}" alt="{{ $customer->name }}">
                                </div>
                                <div class="ml-1.5">
                                    <div class="text-sm font-medium text-gray-900">{{ $customer->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $customer->email }}</div>
                                </div>
                            </div>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst($customer->role) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $provider->profile_pic_url }}"
                                        alt="{{ $provider->name }}">
                                </div>
                                <div class="ml-1.5">
                                    <div class="text-sm font-medium text-gray-900">{{ $provider->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $provider->email }}</div>
                                </div>
                            </div>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ ucfirst($provider->role) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div>
                                <div class="text-xs font-medium text-gray-500">Order</div>
                                <div class="text-sm text-gray-900">{{ $order->order }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">Date Delivered</div>
                                <div class="text-sm text-gray-900">{{ $order->date_delivered->Timezone('Singapore')->format('M d, Y \a\t H:i') }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">Star Rating</div>
                                <div class="flex text-sm text-gray-900">
                                    @for ($i = 1; $i <= 5; $i++) <svg
                                        class="w-4 h-4 {{ $i <= round($feedback->star_rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                        </svg>
                                        @endfor
                                        <span
                                            class="ml-1 text-sm">({{ number_format($feedback->star_rating, 1) }})</span>
                                </div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">Remarks</div>
                                <div
                                    class="text-sm">
                                    {{ $feedback->remarks }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-4 text-center text-gray-500">
                        No feedbacks found
                    </div>
                    @endforelse
                </div>

                <!-- DELETE USER MODAL -->
                @teleport('body')
                    <div x-show="deleteFeedbackModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @keydown.escape.window="deleteFeedbackModalOpen = false"
                        >
                        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6 font-poppins"
                            @click.outside="deleteFeedbackModalOpen = false"
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
                                <h3 class="text-lg font-medium text-gray-900">Delete feedback</h3>
                                <p class="text-sm text-gray-500 mt-1">This action cannot be undone.</p>
                            </div>

                            <!-- User Information -->
                            <div class="flex flex-col gap-2 p-4 bg-gray-50 rounded-lg mb-2">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded-full object-cover" src="{{ $provider->profile_pic_url ?? 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif' }}"
                                            alt="{{ $provider->name ?? 'provider' }}">
                                    </div>
                                    <div class="ml-4 flex-grow">
                                        <div class="text-base font-medium text-gray-900">{{ $provider->name ?? 'provider name' }}</div>
                                        <div class="text-sm text-gray-500">{{ $provider->email ?? 'provider email' }}</div>
                                    </div>
                                </div>
                                @if($selected_feedback)
                                <div wire:loading.class="hidden">
                                    <div class="flex items-center mb-4">
                                        <div class="flex mr-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $selected_feedback->star_rating)
                                                    <!-- Filled Star -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-400">
                                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                    </svg>
                                                @else
                                                    <!-- Empty Star -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-300">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-lg font-medium text-gray-700">{{ $selected_feedback->star_rating }}/5</span>
                                    </div>
                                    <div class="">
                                        <h4 class="text-sm font-medium text-gray-600 mb-1"><i>Customer Remarks:</i></h4>
                                        @if(empty($selected_feedback->remarks))
                                            <p class="text-gray-500 italic">No remarks provided</p>
                                        @else
                                            <div class="p-3 bg-gray-100 rounded-md text-gray-700">
                                                <p>{{ $selected_feedback->remarks }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <div wire:loading class="mt-2">
                                    <div role="status" class="max-w-sm animate-pulse">
                                        <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
                                        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
                                        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
                                        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Warning -->
                            <div class="mb-6">
                                <p class="text-sm text-gray-600">
                                    Are you sure you want to delete this feedback? All data associated with this feedback
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
                                <button @click="deleteFeedbackModalOpen = false"
                                    class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Cancel
                                </button>
                                <button @click="deleteFeedbackModalOpen = false; $wire.deleteFeedback(selectedFeedback);" :disabled="deleteConfirmation !== 'DELETE'"
                                    :class="{'bg-red-600 hover:bg-red-700 cursor-pointer': deleteConfirmation === 'DELETE', 'bg-red-300 cursor-not-allowed': deleteConfirmation !== 'DELETE'}"
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete Feedback
                                </button>
                            </div>
                        </div>
                    </div>
                @endteleport
            </div>
        </div>
    </div>

</div>