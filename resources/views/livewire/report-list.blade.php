<div class="font-poppins bg-gray-100 relative min-h-screen flex flex-col"
    x-data="{ openBurger: false, openFilter: false, createPostModalOpen:false, isChangeRoleModalOpen: false, clicked: false, change: false, search: $wire.entangle('search'), post_type: $wire.entangle('post_type'), item_type: $wire.entangle('item_type'), mode_of_payment: $wire.entangle('mode_of_payment'), delivery_date: $wire.entangle('delivery_date') }"
    x-cloak>

    <!-- NAVBAR -->
    <livewire:navbar />

    <div class="sm:transition-all sm:duration-300 sm:transform relative flex-grow flex items-center justify-center" style="margin-top: 4.3rem;"
    wire:loading.class="hidden"
    wire:target="switchRole, applyFilter, clearFilter"
    >   
        <div class="flex flex-col items-center justify-center w-full max-w-4xl px-4">
            <div class="text-center w-full md:w-9/12 p-6 rounded-md bg-white shadow-sm border">
                <p class="text-black text-2xl font-medium">Report list</p>
            </div>
            {{ $reports }}
        </div>
    </div>

</div>