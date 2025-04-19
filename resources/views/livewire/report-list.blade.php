<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, openFilter: false, reportDetailsModalOpen:false, reportEditModalOpen:false, reportDeleteModalOpen:false, isChangeRoleModalOpen: false, search: $wire.entangle('search'), selectedReport: null }"
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
    @elseif(session('report_updated'))
    <div
        class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-center text-sm">
                {{ session('report_updated') }}
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
    <div wire:loading wire:target="updateReport"
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
                                <p class="font-semibold">Report list</p>
                            </div>
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sender</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Reported</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Report Type</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Complaint</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($reports as $report)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ App\Models\User::where('id', $report->sender_id)->first()->profile_pic_url }}"
                                                alt="{{ App\Models\User::where('id', $report->sender_id)->first()->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ App\Models\User::where('id', $report->sender_id)->first()->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">Added report:
                                                {{ $report->created_at->Timezone('Singapore')->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ App\Models\User::where('id', $report->reported_id)->first()->profile_pic_url }}"
                                                alt="{{ App\Models\User::where('id', $report->reported_id)->first()->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ App\Models\User::where('id', $report->reported_id)->first()->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
    {{ $report->type === 'Spam' ? 'bg-yellow-100 text-yellow-800' : '' }} 
    {{ $report->type === 'Selling illegal items' ? 'bg-red-100 text-red-800' : '' }} 
    {{ $report->type === 'Bullying, harassment, or abuse' ? 'bg-pink-100 text-pink-800' : '' }} 
    {{ $report->type === 'Scam or false information' ? 'bg-purple-100 text-purple-800' : '' }} 
    {{ $report->type === 'Fake identity' ? 'bg-indigo-100 text-indigo-800' : '' }} 
    {{ $report->type === 'Others' ? 'bg-gray-100 text-gray-800' : '' }}">
                                        {{ $report->type }}
                                    </span>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $report->complaint }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $report->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $report->status === 'Resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button @click="reportDetailsModalOpen = true; selectedReport = {{ $report }}; $wire.set('sender_id', '{{ $report->sender_id }}'); $wire.set('reported_id', '{{ $report->reported_id }}');" class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    No reports found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @teleport('body')
                    <div x-show="reportDetailsModalOpen"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @keydown.escape.window="reportDetailsModalOpen = false">
                        
                        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full p-6 font-poppins max-h-[calc(100svh-4em)] overflow-y-auto"
                            @click.outside="reportDetailsModalOpen = false">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg md:text-2xl font-semibold text-gray-800">Report Details</h2>
                                <button @click="reportDetailsModalOpen = false" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600">Report ID:</span>
                                    <span class="text-gray-800 font-medium" x-text="selectedReport?.id"></span>
                                </div>
                                
                                <div class="flex justify-between pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600">Type:</span>
                                    <span class="text-gray-800 font-medium" x-text="selectedReport?.type"></span>
                                </div>
                                
                                <div class="flex justify-between pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600">Status:</span>
                                    <span x-text="selectedReport?.status" 
                                        x-bind:class="selectedReport?.status === 'Pending' ? 'text-yellow-800 bg-yellow-100 px-2.5 py-1 rounded-full text-xs font-semibold' : 'text-green-800 bg-green-100 px-2 py-1 rounded-full text-xs'">
                                    </span>
                                </div>
                                
                                <div class="flex justify-between pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600">Sender:</span>
                                    <span class="flex gap-2.5 items-center">
                                        <img wire:loading.class="hidden" class="h-8 w-8 rounded-full object-cover border"
                                                    src="{{ $sender->profile_pic_url ?? ''}}"
                                                    alt="{{ $sender->name ?? ''}}">
                                        <img wire:loading class="h-10 w-10 rounded-full object-cover"
                                                    src="https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif"
                                                    alt="img">
                                        <span wire:loading.class="hidden" class="text-gray-800 font-medium">{{ $sender->name ?? '' }}</span>
                                        <span wire:loading class="text-gray-800">Loading...</span>
                                    </span>
                                </div>
                                
                                <div class="flex justify-between pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600">Reported</span>
                                    <span class="flex gap-2.5 items-center">
                                        <img wire:loading.class="hidden" class="h-8 w-8 rounded-full object-cover border"
                                                    src="{{ $reported->profile_pic_url ?? ''}}"
                                                    alt="{{ $reported->name ?? ''}}">
                                        <img wire:loading class="h-10 w-10 rounded-full object-cover"
                                                    src="https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif"
                                                    alt="img">
                                        <span wire:loading.class="hidden" class="text-gray-800 font-medium">{{ $reported->name ?? '' }}</span>
                                        <span wire:loading class="text-gray-800">Loading...</span>
                                    </span>
                                </div>

                                <div class="flex justify-between pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600">Post ID:</span>
                                    <span class="text-gray-800 font-medium" x-text="selectedReport?.post_id"></span>
                                </div>

                                <div class="flex justify-between pb-2 border-b border-gray-200" x-show="selectedReport?.order_id">
                                    <span class="font-medium text-gray-600">Order ID:</span>
                                    <span class="text-gray-800 font-medium" x-text="selectedReport?.order_id"></span>
                                </div>
                                
                                <div class="pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600 block mb-1">Complaint:</span>
                                    <p class="text-gray-800 font-medium whitespace-pre-line" x-text="selectedReport?.complaint"></p>
                                </div>
                                
                                <div class="flex justify-between pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600">Created:</span>
                                    <span class="text-gray-800 font-medium" x-text="new Date(selectedReport?.created_at).toLocaleString()"></span>
                                </div>
                                
                                <div class="flex justify-between pb-2 border-b border-gray-200">
                                    <span class="font-medium text-gray-600">Updated:</span>
                                    <span class="text-gray-800 font-medium" x-text="new Date(selectedReport?.updated_at).toLocaleString()"></span>
                                </div>
                            </div>
                            
                            <div class="flex justify-end space-x-3">
                                <button @click="reportEditModalOpen = true; reportDetailsModalOpen = false;" 
                                        class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                    Edit
                                </button>
                                <button @click="reportDetailsModalOpen = false" 
                                        class="px-4 py-2 text-sm bg-white border text-gray-800 rounded-md hover:bg-gray-100 transition-colors">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                @endteleport

                @teleport('body')
                    <div x-show="reportEditModalOpen"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @keydown.escape.window="reportEditModalOpen = false; reportDetailsModalOpen = true;">
                        
                        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6 font-poppins"
                            @click.outside="reportEditModalOpen = false; reportDetailsModalOpen = true;"
                            x-data="{ status: '', points_add: 0, points_minus: 0 }">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg md:text-2xl font-semibold text-gray-800">Edit Report</h2>
                                <button @click="reportEditModalOpen = false; reportDetailsModalOpen = true;" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            
                                <div class="space-y-4 mb-6">
                                    <div>
                                        <label for="edit-status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                        <select id="edit-status" x-model="status" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="Pending">Pending</option>
                                            <option value="Resolved">Resolved</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="point-add" class="block text-sm font-medium text-gray-700 mb-1">Point increase for sender</label>
                                        <input min="0" max="20" type="number" id="point-add" x-model="points_add"
                                        x-on:input="points_add = Math.min(Math.max(points_add, 0), 20)"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                                    </div>
                                    <div>
                                        <label for="point-deduction" class="block text-sm font-medium text-gray-700 mb-1">Point decrease for reported</label>
                                        <input min="0" max="100" type="number" id="point-deduction" x-model="points_minus"
                                        x-on:input="points_minus = Math.min(Math.max(points_minus, 0), 100)"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                                    </div>
                                </div>
                                
                                <div class="flex justify-end space-x-3">
                                    <button @click="reportEditModalOpen = false; $wire.updateReport(selectedReport?.id, status, points_add, points_minus);"
                                            class="px-4 py-2 bg-blue-600 text-sm text-white rounded-md hover:bg-blue-700 transition-colors">
                                        Update
                                    </button>
                                    <button @click="reportEditModalOpen = false; reportDetailsModalOpen = true;" 
                                            class="px-4 py-2 bg-white text-sm text-gray-800 rounded-md border hover:bg-gray-100 transition-colors">
                                        Cancel
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