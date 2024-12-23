<div class="flex flex-col md:flex-row font-montserrat">
    <div class="bg-[#014421] flex flex-row gap-2 md:h-screen md:w-1/2 md:flex-col md:gap-0 md:justify-center items-center">
        <img src="{{ asset('assets/Pasabuy-logo-no-name.png') }}" class="ml-5 w-16 py-2 md:ml-0 md:w-1/2 md:py-0">
        <p class="text-white text-xl font-bold md:text-6xl">PASABUY</p>
    </div>
    <div class="bg-white flex flex-row gap-2 h-screen md:w-1/2 md:flex-col md:gap-0 md:items-center items-start mt-16 md:mt-0 justify-center">   
        <div class="flex flex-col w-5/6 md:w-3/6 justify-center items-center gap-10">
            <p class="text-[#7b1113] font-bold text-4xl md:text-5xl self-start">Sign in</p>
            <div class="flex flex-col w-full gap-4 md:gap-2">
                <div class="flex flex-col w-full gap-1">
                    <label for="email" class="font-medium">Email</label>
                    <input type="email" id="email" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="password" class="font-medium">Password</label>
                    <input type="password" id="password" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                </div>
            </div>
            <div class="flex flex-col w-full items-center justify-center gap-2">
                <button class="w-full h-12 bg-[#014421] rounded-md text-white hover:bg-green-800">
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

                <div class="flex text-sm md:text-base flex-row gap-2 mt-2">
                    <p>Don't have an account?</p>
                    <a href={{ route('signup') }}  class="text-[#7b1113] font-bold">Register here</a>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#7b1113] text-white px-3 py-2 w-4/6 md:w-full max-w-md flex justify-between items-center rounded-lg shadow-md">
            <div class="flex-1 text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <!-- Close Button -->
            <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-4">
                &times;
            </button>
        </div>
    @endif
</div>
