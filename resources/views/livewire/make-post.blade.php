<div class="p-4 bg-white border border-gray-50 shadow-sm rounded-md" x-data="{ createPostModalOpen: false }" x-cloak>
    <div class="p-2 flex flex-row gap-4">
        <img class="size-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
        <button class="text-gray-600 text-start text-xs sm:text-sm px-3 sm:px-4 py-1 sm:py-1.5 border bg-gray-100 rounded-full w-full">
            @if ($user->role === 'customer')
                Looking for items, {{ $user->name }}?
            @else
                Planning to buy items in bulk, {{ $user->name }}?
            @endif
        </button>
    </div>
</div>