<div class="flex flex-col lg:flex-row font-poppins" x-cloak>
    <div class="bg-[#014421] flex flex-row gap-2 lg:h-screen lg:w-1/2 lg:flex-col lg:gap-0 lg:justify-center items-center">
        <img src="{{ asset('assets/Pasabuy-logo-no-name.png') }}" class="ml-5 w-16 py-2 lg:ml-0 lg:w-1/2 lg:py-0">
        <p class="text-white text-xl font-bold lg:text-6xl">PASABUY</p>
    </div>
    <div class="bg-white flex flex-row gap-2 h-screen lg:w-1/2 lg:flex-col lg:gap-0 lg:items-center items-start mt-16 lg:mt-0 justify-center">   
        <div class="flex flex-col w-5/6 md:w-3/6 justify-center items-center gap-10" x-data="{ email: $wire.entangle('email'), password: $wire.entangle('password'), errors: {}, showPassword: false }" >
            <p class="text-[#7b1113] font-semibold text-4xl md:text-5xl self-start">Sign in</p>
            <div class="flex flex-col w-full gap-4 md:gap-2">
                <div class="flex flex-col w-full gap-1">
                    <label for="email" class="font-medium">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        x-model="email" 
                        @input="errors.email = email.length === 0" 
                        class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" 
                        :class="{'border-red-500': errors.email}"
                    >
                    <p x-show="errors.email" class="text-red-500 text-sm">Email is required.</p>
                </div>

                <div class="flex flex-col w-full gap-1">
                    <label for="password" class="font-medium">Password</label>
                    <div class="relative w-full" >
                        <input :type="showPassword ? 'text' : 'password'" id="password" x-model="password" @input="if (password.length > 0) { delete errors.password; }" @change="if (password.length === 0) { errors.password = true; } "  class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            :class="{'border-red-500': errors.password}"
                            
                            > 
                            <!-- Show/Hide Password Icon -->
                        <button type="button" @click="showPassword = !showPassword" class="absolute top-1/2 right-3 transform -translate-y-1/2 text-slate-400 focus:outline-none">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    <p x-show="errors.password" class="text-red-500 text-sm">Password is required.</p>
                </div>
            </div>
            <div class="flex flex-col w-full items-center justify-center gap-2">
                <button 
                    x-data="{ disabled: false }"
                    :disabled="disabled"
                    x-on:click="
                        errors = {};
                        errors.email = email.length === 0;
                        errors.password = password.length === 0;
                        if (!errors.email && !errors.password) { 
                            disabled = true;
                            $wire.login(); 
                        }
                    "
                    class="w-full h-12 bg-[#014421] rounded-md text-white hover:bg-green-800"
                >
                    Sign in
                </button>

                <div class="flex flex-row justify-center items-center w-full">
                    <hr class="w-1/2 h-px mx-auto my-4 bg-[#898989] border-0 rounded">
                    <p class="text-black mx-5">or</p>
                    <hr class="w-1/2 h-px mx-auto my-4 bg-[#898989] border-0 rounded">
                </div>
                <a href="{{ route('auth.google') }}" 
                    class="w-full h-12 text-black rounded-md border border-[#898989] hover:bg-slate-100 flex justify-center items-center">
                    <div class="flex flex-row items-center gap-5">
                        <svg width="23" height="23" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_4_48)">
                                <path d="M29.6425 15.2806C29.6425 14.0515 29.5428 13.1546 29.327 12.2245H15.292V17.772H23.5302C23.3642 19.1506 22.4673 21.2268 20.4741 22.6219L20.4462 22.8076L24.8837 26.2454L25.1912 26.2761C28.0147 23.6683 29.6425 19.8315 29.6425 15.2806Z" fill="#4285F4"/>
                                <path d="M15.292 29.8969C19.328 29.8969 22.7163 28.5681 25.1912 26.2761L20.4741 22.6219C19.2118 23.5022 17.5176 24.1167 15.292 24.1167C11.339 24.1167 7.98389 21.5091 6.7879 17.9049L6.61259 17.9198L1.99832 21.4908L1.93797 21.6586C4.39614 26.5417 9.44542 29.8969 15.292 29.8969Z" fill="#34A853"/>
                                <path d="M6.7879 17.905C6.47232 16.9749 6.28969 15.9782 6.28969 14.9485C6.28969 13.9187 6.47232 12.9221 6.77129 11.992L6.76293 11.7939L2.09083 8.16553L1.93797 8.23824C0.924842 10.2646 0.343506 12.5401 0.343506 14.9485C0.343506 17.3569 0.924842 19.6323 1.93797 21.6587L6.7879 17.905Z" fill="#FBBC05"/>
                                <path d="M15.292 5.78004C18.0989 5.78004 19.9924 6.99252 21.072 8.00576L25.2908 3.8866C22.6998 1.47824 19.328 0 15.292 0C9.44541 0 4.39614 3.35508 1.93797 8.23821L6.77129 11.992C7.98389 8.38775 11.339 5.78004 15.292 5.78004Z" fill="#EB4335"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_4_48">
                                    <rect width="30" height="30" rx="15" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>

                        <p>Continue with UP Mail</p>
                    </div>
                </a>

                <div class="flex items-center text-sm md:text-base flex-row lg:flex-col xl:flex-row gap-2 lg:gap-0 xl:gap-2 mt-2">
                    <p>Don't have an account?</p>
                    <a href={{ route('signup') }}  class="text-[#7b1113] font-bold">Register here</a>
                </div>
            </div>
        </div>
    </div>
    @if(session('non-up'))
    <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>


            <div class="text-center text-sm">
                {{ session('non-up') }}
            </div>
        </div>
        <!-- Close Button -->
        <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
            &times;
        </button>
    </div>
    @elseif(session('duplicate'))
    <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>


            <div class="text-center text-sm">
                {{ session('duplicate') }}
            </div>
        </div>
        <!-- Close Button -->
        <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
            &times;
        </button>
    </div>
    @elseif(session('register_error'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <div class="text-center text-sm">
                    {{ session('register_error') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
    @elseif(session('register_error_contact'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <div class="text-center text-sm">
                    {{ session('register_error_contact') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
    @elseif(session('register_success'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                    {{ session('register_success') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
    @elseif(session('delete_account_success'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <div class="text-center text-sm">
                    {{ session('delete_account_success') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
    @elseif(session('login_failed'))
        <div class="flash fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] border-t border-white text-white px-1.5 py-1 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>


                <div class="text-center text-sm">
                    {{ session('login_failed') }}
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-auto">
                &times;
            </button>
        </div>
    @endif
</div>

<script>
    setTimeout(() => {
        document.querySelector('.flash').style.display = 'none';
    }, 3000); // 3 seconds
</script>
