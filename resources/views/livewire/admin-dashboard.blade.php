<div class="font-poppins bg-gray-100 relative min-h-screen flex flex-col"
    x-data="{ openBurger: false, openFilter: false, createPostModalOpen:false, isChangeRoleModalOpen: false, clicked: false, change: false, search: $wire.entangle('search'), post_type: $wire.entangle('post_type'), item_type: $wire.entangle('item_type'), mode_of_payment: $wire.entangle('mode_of_payment'), delivery_date: $wire.entangle('delivery_date') }"
    x-cloak>

    <!-- NAVBAR -->
    <livewire:navbar />

    <!-- SIDEBAR -->
    <livewire:sidebar />

    <div class="sm:transition-all sm:duration-300 sm:transform relative flex-grow flex items-center justify-center" style="margin-top: 4.3rem;"
    wire:loading.class="hidden"
    wire:target="switchRole, applyFilter, clearFilter"
    >   
        <div class="flex flex-col items-center justify-center w-full max-w-4xl px-4">
            <div class="text-center w-full md:w-2/3 p-5 rounded-md bg-white shadow-sm border">
                <p class="text-gray-800 text-xl font-semibold">Welcome back, Admin {{ $user->name }}</p>
            </div>
            <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                <button class="text-center w-full p-5 rounded-md bg-white shadow-sm border transform hover:scale-105 duration-300">
                    <p class="text-gray-600 text-lg font-medium">Users list</p>
                </button>
                <button class="text-center w-full p-5 rounded-md bg-white shadow-sm border transform hover:scale-105 duration-300">
                    <p class="text-gray-600 text-lg font-medium">Posts list</p>
                </button>
                <button class="text-center w-full p-5 rounded-md bg-white shadow-sm border transform hover:scale-105 duration-300">
                    <p class="text-gray-600 text-lg font-medium">Orders list</p>
                </button>
                <button class="text-center w-full p-5 rounded-md bg-white shadow-sm border transform hover:scale-105 duration-300">
                    <p class="text-gray-600 text-lg font-medium">Reports list</p>
                </button>
            </div>
        </div>
    </div>

</div>