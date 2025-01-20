
<div class="bg-black bg-opacity-50 fixed inset-0 flex items-center justify-center z-50 font-poppins">
    <div @keydown.escape.window="orderItemModalOpen = false" class="bg-white px-8 py-6 rounded-lg w-9/12 md:w-4/12">
        {{ $post }}
        <div class="flex flex-row items-center gap-2 sm:gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#014421" class="size-5 sm:size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            <p class="text-xl font-semibold text-[#014421]">Add order</p>
        </div>
        <p class="mt-2 text-sm">Make sure that you want this item before confirming.</p>
        <div class="flex flex-col gap-1 mt-5 text-sm text-gray-800">
            <p class=""> <span class="font-medium">You are ordering:</span> {{ $post->item_name }}</p>
            <p class=""> <span class="font-medium">Provider name:</span> {{ $post->poster_name }}</p>
        </div>
        <div  class="mt-5 flex justify-end gap-2">
            <button @click="orderItemModalOpen = false" class="font-medium px-2 sm:px-3 py-1.5 text-sm bg-white text-black  rounded-md hover:bg-slate-200 border hover:border-slate-200 hover:text-black">Cancel</button>
            <button @click="" class="font-medium px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
        </div>
    </div>
</div>