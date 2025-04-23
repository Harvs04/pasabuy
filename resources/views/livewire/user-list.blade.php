<div class="font-poppins bg-gray-100 relative"
    x-data="{ openBurger: false, isChangeRoleModalOpen: false, deleteUserModalOpen: false, search: $wire.entangle('search'), userDetailsOpen: false, selectedUser: null, userRating: null, ratingCount: null }"
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
    @elseif(session('user_deleted'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                {{ session('user_deleted') }}
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
        <div wire:loading wire:target="deleteUser"
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
        style="margin-top: 4.3rem;" wire:loading.class="hidden" wire:target="deleteUser">
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
                                <p class="font-semibold">User list</p>
                            </div>
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact Info</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Academic</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Performance</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Points</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ $user->profile_pic_url }}" alt="{{ $user->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">Joined:
                                                {{ $user->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ $user->contact_number ?? 'No contact number' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ ucfirst($user->constituent ?? 'Not specified') }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ $user->college ?? '' }}{{ $user->college && $user->degree_program ? ' - ' : '' }}{{ $user->degree_program ?? '' }}
                                    </div>
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
                                            @php
                                            $averageRating = round($user->ratings->avg('star_rating'), 1); 
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++) @if ($i <=floor($averageRating)) <!-- Solid
                                                Star for full rating -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 xl:w-6 text-yellow-500" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                @elseif ($i - $averageRating < 1) <!-- Half Star for fractional rating
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
                                                        class="ml-1 text-sm text-gray-500">{{ $averageRating . "/5" }}</span>
                                                    <span
                                                        class="ml-1 text-sm text-gray-500">({{ count($user->ratings) }})</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center text-xs text-gray-500 mt-1">
                                            <span class="flex items-center gap-0.5 text-green-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                                {{ $user->successful_orders }}
                                            </span>
                                            <p x-text="' / '"></p>
                                            <span class="flex items-center gap-0.5 text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                                {{ $user->cancelled_orders }}
                                            </span>
                                        </div>

                                        <div class="flex items-center text-xs text-gray-500 mt-1">
                                            <span class="flex items-center gap-0.5 text-green-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                                </svg>
                                                {{ $user->successful_deliveries }}
                                            </span>
                                            <p x-text="' / '"></p>
                                            <span class="flex items-center gap-0.5 text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                                </svg>
                                                {{ $user->cancelled_transactions }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="font-medium {{ $user->pasabuy_points >= 80 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $user->pasabuy_points }} pts
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @php
                                    $averageRating = round($user->ratings->avg('star_rating'), 1);
                                    @endphp
                                    <div class="flex space-x-2">
                                        <button
                                            @click="userDetailsOpen = true; selectedUser = {{ $user }}; userRating = {{ $averageRating }}; ratingCount = {{ count($user->ratings) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="text-indigo-600 hover:text-indigo-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteUserModalOpen = true; selectedUser = {{ $user }};"
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
                    @php
                    $averageRating = round($user->ratings->avg('star_rating'), 1); // Rounded to 1 decimal place
                    @endphp
                    <div @click="userDetailsOpen = true; selectedUser = {{ $user }}; userRating = {{ $averageRating }}; ratingCount = {{ count($user->ratings) }}"
                        class="bg-white p-4 border-b border-gray-200">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-12 w-12 rounded-full object-cover" src="{{ $user->profile_pic_url }}"
                                        alt="{{ $user->name }}">
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
                                <div class="text-sm text-gray-900">{{ $user->contact_number ?? 'No contact number' }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">Constituent</div>
                                <div class="text-sm text-gray-900">{{ ucfirst($user->constituent ?? 'Not specified') }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">College</div>
                                <div class="text-sm text-gray-900">
                                    {{ $user->college ?? 'N/A' }}{{ $user->college && $user->degree_program ? ' - ' : '' }}{{ $user->degree_program ?? '' }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">Points</div>
                                <div
                                    class="text-sm font-medium {{ $user->pasabuy_points >= 100 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $user->pasabuy_points }} pts
                                </div>
                            </div>
                            <div class="flex flex-col text-xs text-gray-500">
                                <div class="text-xs font-medium text-gray-500">As Customer</div>
                                <div class="flex items-center">
                                    <span class="flex items-center gap-1 text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <div class="text-sm">
                                            {{ $user->successful_orders }}
                                        </div>
                                    </span>
                                    <p>
                                    <p>&nbsp/&nbsp</p>
                                    </p>
                                    <span class="flex items-center gap-1 text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <div class="text-sm">
                                            {{ $user->cancelled_orders }}
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col text-xs text-gray-500">
                                <div class="text-xs font-medium text-gray-500">As Provider</div>
                                <div class="flex items-center">
                                    <span class="flex items-center gap-1 text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                        </svg>
                                        <div class="text-sm">
                                            {{ $user->successful_deliveries }}
                                        </div>
                                    </span>
                                    <p>&nbsp/&nbsp</p>
                                    <span class="flex items-center gap-1 text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                        </svg>
                                        <div class="text-sm">
                                            {{ $user->cancelled_transactions }}
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++) <svg
                                        class="w-4 h-4 {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                        </svg>
                                        @endfor
                                        <span
                                            class="ml-1 text-sm text-gray-500">({{ number_format($averageRating, 1) }})</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button
                                    @click="userDetailsOpen = true; selectedUser = {{ $user }}; userRating = {{ $averageRating }}; ratingCount = {{ count($user->ratings) }}"
                                    class="text-blue-600 hover:text-blue-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="text-indigo-600 hover:text-indigo-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button @click="deleteUserModalOpen = true; selectedUser = {{ $user }};"
                                    class="text-red-600 hover:text-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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


                <!-- USER DETAILS MODAL -->
                @teleport('body')
                    <div x-show="userDetailsOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @keydown.escape.window="userDetailsOpen = false">

                        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full p-6 font-poppins"
                            @click.outside="userDetailsOpen = false">
                            <!-- Header with user info -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded-full object-cover"
                                            x-bind:src="selectedUser?.profile_pic_url || 'https://res.cloudinary.com/dflz6bik9/image/upload/v1735137073/ypf6wlmswbndekosiest.avif'"
                                            x-bind:alt="selectedUser?.name || 'user'">
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-base font-medium text-gray-900"
                                            x-text="selectedUser?.name || 'user'"></div>
                                        <div class="text-sm text-gray-500"
                                            x-text="selectedUser?.email || 'No email provided'"></div>
                                    </div>
                                </div>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full" :class="{
                                            'bg-purple-100 text-purple-800': selectedUser?.role === 'admin',
                                            'bg-blue-100 text-blue-800': selectedUser?.role === 'provider',
                                            'bg-green-100 text-green-800': selectedUser?.role === 'customer'
                                        }"
                                    x-text="selectedUser?.role.charAt(0).toUpperCase() + selectedUser?.role.slice(1)">
                                </span>
                            </div>

                            <!-- User details grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 bg-gray-50 p-3 rounded-lg">
                                <div>
                                    <div class="text-xs font-medium text-gray-500">Contact</div>
                                    <div class="text-sm text-gray-900"
                                        x-text="selectedUser?.contact_number || 'No contact number'"></div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500">Constituent</div>
                                    <div class="text-sm text-gray-900"
                                        x-text="selectedUser?.constituent.charAt(0).toUpperCase() + selectedUser?.constituent.slice(1)">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500">College</div>
                                    <div class="text-sm text-gray-900"
                                        x-text="selectedUser?.college + ' - ' + selectedUser?.degree_program"></div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500">Points</div>
                                    <div class="text-sm font-medium"
                                        :class="selectedUser?.pasabuy_points > 79 ? 'text-green-600' : 'text-red-600'">
                                        <span x-text="selectedUser?.pasabuy_points"></span> pts
                                    </div>
                                </div>
                                <div class="flex flex-col text-xs text-gray-500">
                                    <div class="text-xs font-medium text-gray-500">As Customer</div>
                                    <div class="flex items-center">
                                        <span class="flex items-center gap-1 text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                            <div class="text-sm">
                                                <p x-text="selectedUser?.successful_orders || 0"></p>
                                            </div>
                                        </span>
                                        <p>
                                        <p>&nbsp/&nbsp</p>
                                        </p>
                                        <span class="flex items-center gap-1 text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                            <div class="text-sm">
                                                <p x-text="selectedUser?.cancelled_orders || 0"></p>
                                            </div>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex flex-col text-xs text-gray-500">
                                    <div class="text-xs font-medium text-gray-500">As Provider</div>
                                    <div class="flex items-center">
                                        <span class="flex items-center gap-1 text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                            </svg>
                                            <div class="text-sm">
                                                <p x-text="selectedUser?.successful_deliveries || 0"></p>
                                            </div>
                                        </span>
                                        <p>&nbsp/&nbsp</p>
                                        <span class="flex items-center gap-1 text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                            </svg>
                                            <div class="text-sm">
                                                <p x-text="selectedUser?.cancelled_transactions || 0"></p>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center justify-between border-t pt-3">
                                <div class="flex items-center">
                                    <template x-for="i in 5" :key="i">
                                        <svg class="w-4 h-4"
                                            :class="i <= Math.round(userRating) ? 'text-yellow-400' : 'text-gray-300'"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </template>
                                    <span class="ml-1 text-sm text-gray-500" x-text="userRating + '/5'"></span>
                                    <span class="ml-1 text-sm text-gray-500" x-text="'(' + ratingCount + ')'"></span>
                                </div>

                                <!-- Optional: Close button -->
                                <button @click="userDetailsOpen = false" class="text-sm text-gray-500 hover:text-gray-700">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                @endteleport

                <!-- DELETE USER MODAL -->
                @teleport('body')
                    <div x-show="deleteUserModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @keydown.escape.window="deleteUserModalOpen = false"
                        >
                        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full p-6 font-poppins"
                            @click.outside="deleteUserModalOpen = false"
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
                                <h3 class="text-lg font-medium text-gray-900">Delete User Account</h3>
                                <p class="text-sm text-gray-500 mt-1">This action cannot be undone.</p>
                            </div>

                            <!-- User Information -->
                            <div class="flex items-center p-4 mb-6 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-12 w-12 rounded-full object-cover" :src="selectedUser?.profile_pic_url"
                                        :alt="selectedUser?.name">
                                </div>
                                <div class="ml-4 flex-grow">
                                    <div class="text-base font-medium text-gray-900" x-text="selectedUser?.name"></div>
                                    <div class="text-sm text-gray-500" x-text="selectedUser?.email"></div>
                                </div>
                            </div>

                            <!-- Warning -->
                            <div class="mb-6">
                                <p class="text-sm text-gray-600">
                                    Are you sure you want to delete this user account? All data associated with this user
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
                                <button @click="deleteUserModalOpen = false"
                                    class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Cancel
                                </button>
                                <button @click="deleteUserModalOpen = false; $wire.deleteUser(selectedUser);" :disabled="deleteConfirmation !== 'DELETE'"
                                    :class="{'bg-red-600 hover:bg-red-700 cursor-pointer': deleteConfirmation === 'DELETE', 'bg-red-300 cursor-not-allowed': deleteConfirmation !== 'DELETE'}"
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete User
                                </button>
                            </div>
                        </div>
                    </div>
                @endteleport
            </div>
        </div>
    </div>

</div>