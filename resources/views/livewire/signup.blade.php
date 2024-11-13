@extends('layouts.app')
@section('content')
<div x-data="{ signupPartOne: true, signupPartTwo: false, signupPartThree: false, isCustomer: true, isModalOpen: false }" class="flex flex-col font-montserrat h-screen">
    <!-- Top div (Header) -->
    <div class="flex flex-row w-full bg-[#014421] gap-2 md:gap-5 items-center">
        <img src={{ asset('assets/Pasabuy-logo-no-name.png') }} class="ml-5 w-16 md:ml-10 my-2 md:w-16"> 
        <p class="text-xl md:text-2xl font-montserrat text-white font-bold">PASABUY</p>
    </div>
    
    <!-- Centered Div (Signup Form) -->
    <div class="bg-white flex flex-row gap-2 md:w-full md:flex-col md:gap-0 md:items-center justify-center flex-1 mt-16 md:mt-0">   
        <div class="flex flex-col w-5/6 md:w-4/6">
            <div class="flex flex-col justify-start md:justify-center md:items-center mb-10 md:mb-16 gap-5 md:gap-7">
                <p class="text-[#7b1113] font-bold text-4xl md:text-5xl self-start md:self-center">Sign up</p>
                <div class="flex flex-row text-[#014421] w-full justify-center items-center space-x-4">
                    <p :class="{'font-bold': signupPartOne}" class="cursor-pointer">Basic Information</p>
                    <hr class="w-2/12 h-px bg-[#014421] border-0 rounded hidden md:block">
                    <p :class="{'font-bold': signupPartTwo}" class="cursor-pointer">University Information</p>
                    <hr class="w-2/12 h-px bg-[#014421] border-0 rounded hidden md:block">
                    <p :class="{'font-bold': signupPartThree}" class="cursor-pointer">Verification Questions</p>
                </div>
            </div>
            <!-- Toggle between form and message with Alpine.js -->
            <div x-show="signupPartOne" class="flex flex-col w-full justify-center items-center gap-8 md:gap-10">
                <form class="flex flex-col md:grid md:grid-cols-2 w-5/6 gap-4 md:gap-8">
                    <div class="flex flex-col w-full gap-1">
                        <label for="fname" class="font-medium">First Name</label>
                        <input type="text" id="fname" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="lname" class="font-medium">Last Name</label>
                        <input type="text" id="lname" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="contactnumber" class="font-medium">Contact Number</label>
                        <input type="tel" id="contactnumber" pattern="^09\d{9}$" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="role" class="font-medium">Role</label>
                        <select id="role" x-model="isCustomer"  class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value="true">Customer</option>
                            <option value="false">Provider</option>
                        </select>
                    </div>

                </form>
                <div class="flex flex-col-reverse md:flex-row w-5/6 items-center justify-end gap-2 mt-3 md:mt-5">
                    <a class="w-full h-12 bg-white rounded-md md:w-1/6 border border-[#014421] hover:bg-slate-100 flex items-center justify-center" href=" {{ route('login') }} ">
                        <p class=" text-[#014421] ">Return</p>
                    </a>
                    <button @click="signupPartOne = false; signupPartTwo = true; signupPartThree = false;" class="w-full md:w-1/6 h-12 bg-[#014421] rounded-md text-white hover:bg-green-800 flex items-center justify-center">
                        Next
                    </button>
                </div>

            </div>

            <!-- 2nd part -->
            <div x-show="signupPartTwo" class="flex flex-col w-full justify-center items-center gap-8 md:gap-10">
                <form class="flex flex-col md:grid md:grid-cols-2 w-5/6 gap-4 md:gap-8">
                    <div class="flex flex-col w-full gap-1">
                        <label for="email" class="font-medium">UP Email</label>
                        <input type="email" id="email" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="batch" class="font-medium">Batch Year</label>
                        <input type="number" id="batch" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="college" class="font-medium">College</label>
                        <input type="text" id="college" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="degprog" class="font-medium">Degree Program</label>
                        <input type="text" id="degprog" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                </form>
                <div class="flex flex-col-reverse md:flex-row w-5/6 items-center justify-end gap-2 mt-3 md:mt-5">
                    <button @click="signupPartOne = true; signupPartTwo = false; signupPartThree = false;" 
                            class="w-full h-12 bg-white text-[#014421] rounded-md md:w-1/6 border border-[#014421] hover:bg-slate-100 flex items-center justify-center">
                        Return
                    </button>
                    <button @click="signupPartOne = false; signupPartTwo = false; signupPartThree = true;" class="w-full md:w-1/6 h-12 bg-[#014421] rounded-md text-white hover:bg-green-800 flex items-center justify-center">
                        Next
                    </button>
                </div>
            </div>
            
            <!-- 3rd part -->
            <div x-show="signupPartThree" class="flex flex-col w-full justify-center items-center gap-8 md:gap-10">
                <form class="flex flex-col md:grid md:grid-cols-2 w-5/6 gap-4 md:gap-8">
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_one" class="font-medium">If you saw Mariang Banga holding the jar on her head, what would happen to you?</label>
                        <input type="text" id="question_one" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_two" class="font-medium">Assuming you take a jeep to Copeland Gymnasium, where do you get off? </label>
                        <input type="text" id="question_two" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_three" class="font-medium">How many digits are there after the batch year in student number? </label>
                        <input type="number" id="question_three" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_four" class="font-medium">Which bus company offers trips from UPLB to UPD and vice versa? </label>
                        <input type="text" id="question_four" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </div>
                </form>
                <div class="flex flex-col-reverse md:flex-row w-5/6 items-center justify-end gap-2 mt-3 md:mt-5">
                    <button @click="signupPartOne = false; signupPartTwo = true; signupPartThree = false;" 
                            class="w-full h-12 bg-white text-[#014421] rounded-md md:w-1/6 border border-[#014421] hover:bg-slate-100 flex items-center justify-center">
                        Return
                    </button>
                    <button @click="isModalOpen = true" class="w-full md:w-1/6 h-12 bg-[#014421] rounded-md text-white hover:bg-green-800 flex items-center justify-center">
                        Register
                    </button>
                </div>
                <!-- Modal -->
                <div x-show="isModalOpen" x-transition:enter.duration.100ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/3">
                        <p class="text-xl font-semibold text-[#014421]">Confirmation</p>
                        <p class="text-sm md:text-base mt-2 md:mt-5 text-justify">By using PASABUY, a platform that facilitates transactions between Providers and Customers, you agree to comply with all terms and conditions outlined in this Agreement. PASABUY serves as an intermediary, providing tools to manage, create, and track orders between users. While PASABUY offers the platform for these transactions, it is not responsible for the fulfillment, delivery, or quality of the items involved. You, as a user, agree to use the platform responsibly and are fully accountable for any transactions conducted through PASABUY.

                        Users understand and acknowledge that PASABUY is not liable for any issues, disputes, or damages that may arise from transactions between Providers and Customers. Both Providers and Customers are encouraged to communicate directly and resolve any issues regarding the transaction. PASABUY reserves the right to modify these terms at any time, and continued use of the platform constitutes your acceptance of the revised terms.</p>
                        <div class="mt-4 flex justify-end gap-2">
                            <button @click="isModalOpen = false" class="px-4 py-2 bg-white border border-[#014421] text-[#014421] rounded-md hover:bg-slate-100">Cancel</button>
                            <button @click="isModalOpen = false" class="px-4 py-2 bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
