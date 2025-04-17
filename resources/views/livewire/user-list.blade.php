<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, openFilter: false, createPostModalOpen:false, isChangeRoleModalOpen: false, clicked: false, change: false, search: $wire.entangle('search'), post_type: $wire.entangle('post_type'), item_type: $wire.entangle('item_type'), mode_of_payment: $wire.entangle('mode_of_payment'), delivery_date: $wire.entangle('delivery_date') }"
    x-cloak>

    <!-- NAVBAR -->
    <livewire:navbar />

    <div class="sm:transition-all sm:duration-300 sm:transform relative flex-grow flex items-center justify-center py-2" style="margin-top: 4.3rem;"
    wire:loading.class="hidden"
    wire:target="switchRole, applyFilter, clearFilter"
    >   
    <div class="w-full overflow-x-auto rounded-lg">
    <div class="min-w-full inline-block align-middle rounded-lg">
        <div class="hidden sm:block overflow-hidden border border-gray-200 rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                        <caption class="p-5 text-lg mid:text-2xl text-left rtl:text-right text-gray-800 bg-white overflow-hidden">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('dashboard') }}" class="p-1.5 hover:bg-gray-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 md:size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                </a>
                                <p class="font-semibold">User list</p>
                            </div>
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Info</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Academic</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performance</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_pic_url }}" alt="{{ $user->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">Joined: {{ $user->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->contact_number ?? 'No contact number' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ ucfirst($user->constituent ?? 'Not specified') }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->college ?? '' }}{{ $user->college && $user->degree_program ? ' - ' : '' }}{{ $user->degree_program ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : '' }}
                                            {{ $user->role === 'provider' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $user->role === 'customer' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= round($user->star_rating) ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endfor
                                                <span class="ml-1 text-sm text-gray-500">({{ number_format($user->star_rating, 1) }})</span>
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <span class="text-green-600">✓ {{ $user->successful_orders + $user->successful_deliveries }}</span> / 
                                            <span class="text-red-600">✗ {{ $user->cancelled_orders + $user->cancelled_transactions }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="font-medium {{ $user->pasabuy_points >= 100 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $user->pasabuy_points }} pts
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="text-indigo-600 hover:text-indigo-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No users found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View (visible only on mobile) -->
                <div class="sm:hidden">
                    @forelse ($users as $user)
                        <div class="bg-white p-4 border-b border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded-full object-cover" src="{{ $user->profile_pic_url }}" alt="{{ $user->name }}">
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-base font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $user->role === 'provider' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $user->role === 'customer' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-2 mb-3">
                                <div>
                                    <div class="text-xs font-medium text-gray-500">Contact</div>
                                    <div class="text-sm text-gray-900">{{ $user->contact_number ?? 'No contact number' }}</div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500">Status</div>
                                    <div class="text-sm text-gray-900">{{ ucfirst($user->constituent ?? 'Not specified') }}</div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500">Academic</div>
                                    <div class="text-sm text-gray-900 truncate">{{ $user->college ?? 'N/A' }}{{ $user->college && $user->degree_program ? ' - ' : '' }}{{ $user->degree_program ?? '' }}</div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500">Points</div>
                                    <div class="text-sm font-medium {{ $user->pasabuy_points >= 100 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $user->pasabuy_points }} pts
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= round($user->star_rating) ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                        <span class="ml-1 text-sm text-gray-500">({{ number_format($user->star_rating, 1) }})</span>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-3">
                                    <button class="p-1 text-blue-600 hover:text-blue-900 bg-blue-50 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="p-1 text-indigo-600 hover:text-indigo-900 bg-indigo-50 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button class="p-1 text-red-600 hover:text-red-900 bg-red-50 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">
                            No users found
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>