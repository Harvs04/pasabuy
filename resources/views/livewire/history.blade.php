<div class="font-poppins bg-gray-50" x-data="{ openBurger: window.innerWidth > 640 ? true : false }" x-cloak>
    <livewire:navbar />
    <livewire:sidebar />
    <div class="sm:transition-all sm:duration-300 sm:transform relative flex flex-row" style="margin-top: 4.3rem;":class="{'lg:ml-64 xl:ml-96': openBurger, 'md:ml-0': !openBurger}">
        <div class="flex flex-row w-2/3">
            <div class="bg-red-600 border border-white w-full">
                RED
            </div>
            <div class="bg-blue-600 border border-white w-full" >
                BLUE
            </div>
        </div>
        <div class="bg-orange-600 border border-white w-1/3">
            ORANGE
        </div>
    </div>
</div>