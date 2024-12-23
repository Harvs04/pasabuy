<div x-data="{ signupPartOne: false, signupPartTwo: true, signupPartThree: false, isModalOpen: false }" class="flex flex-col font-montserrat h-screen">
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
                    <p :class="{'font-bold': signupPartTwo}" class="cursor-pointer">Account Information</p>
                    <hr class="w-2/12 h-px bg-[#014421] border-0 rounded hidden md:block">
                    <p :class="{'font-bold': signupPartThree}" class="cursor-pointer">Verification Questions</p>
                </div>
            </div>
            <!-- Toggle between form and message with Alpine.js -->
            <div x-show="signupPartOne" class="flex flex-col w-full justify-center items-center gap-8 md:gap-10" x-data="{ fname: $wire.entangle('first_name'), lname: $wire.entangle('last_name'), contact: $wire.entangle('contact_number'), constituent: $wire.entangle('constituent'), college: $wire.entangle('college'), degprog: $wire.entangle('degree_program'), degprogs: $wire.entangle('degprogs'), errors: {} }">
                <form class="flex flex-col md:grid md:grid-cols-3 w-5/6 md:w-full gap-4 md:gap-8">
                    <div class="flex flex-col w-full gap-1">
                        <label for="fname" class="font-medium">First Name</label>
                        <input type="text" id="fname" x-model="fname" wire:model="fname" 
                            x-bind:class="{'border-red-500': errors.fname || ((fname.length < 3 || fname.length > 30 || !/^[a-zA-Z]+$/.test(fname)) && fname.length > 0)}" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.fname" class="text-red-500 text-sm mt-1">Firstname is required.</p>
                        <p x-show="(fname.length < 3 || fname.length > 30) && fname.length > 0" class="text-red-500 text-sm mt-1"> Firstname must be between 3 and 30 characters long. </p>
                        <p x-show="!/^[a-zA-Z]+$/.test(fname) && fname.length > 0" class="text-red-500 text-sm mt-1"> Firstname must contain only alphabetic characters. </p>
                    </div>
                    
                    <div class="flex flex-col w-full gap-1">
                        <label for="lname" class="font-medium">Last Name</label>
                        <input type="text" id="lname" x-model="lname" wire:model="lname" 
                            x-bind:class="{'border-red-500': errors.lname || ((lname.length < 3 || lname.length > 30 ||  !/^[a-zA-Z]+$/.test(lname)) && lname.length > 0)}" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.lname" class="text-red-500 text-sm mt-1">Lastname is required.</p>
                        <p x-show="(lname.length < 3 || lname.length > 30) && lname.length > 0" class="text-red-500 text-sm mt-1"> Lastname must be between 3 and 30 characters long. </p>
                        <p x-show="!/^[a-zA-Z]+$/.test(lname) && lname.length > 0" class="text-red-500 text-sm mt-1"> Lastname must contain only alphabetic characters. </p>
                    </div>

                    <div class="flex flex-col w-full gap-1">
                        <label for="contactnumber" class="font-medium">Contact Number</label>
                        <input type="tel" id="contactnumber" x-model="contact" wire:model="contact_number" x-bind:class="{'border-red-500': errors.contact || ((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 )}"
                            class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.contact" class="text-red-500 text-sm mt-1">Contact number is required.</p>
                        <p x-show="((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 ) " class="text-red-500 text-sm mt-1">Invalid contact number format.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="constituent" class="font-medium">Type of constituent</label>
                        <select x-model="constituent" wire:model="constituent" id="constituent" @change="if(constituent === 'staff') { degprog = ''; }" x-bind:class="{'border-red-500': errors.constituent }"
                                class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value=""></option>
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                            <option value="staff">Administrative Staff</option>
                            <option value="alumni">Alumni</option>
                        </select>
                        <p x-show="errors.constituent" class="text-red-500 text-sm mt-1">Type of constituent is required.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="college" class="font-medium">College</label>
                        <select x-model="college" wire:model="college" id="college" x-bind:class="{'border-red-500': errors.college }"
                            class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value="">Select a college</option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college }}">{{ $college }}</option>
                            @endforeach
                        </select>
                        <p x-show="errors.college" class="text-red-500 text-sm mt-1">College is required.</p>
                    </div>

                    <div class="flex flex-col w-full gap-1">
                        <label for="degprog" class="font-medium">Degree Program</label>
                        <select x-model="degprog" wire:model="degree_program" id="degprog" x-bind:class="{'border-red-500': errors.degprog }"
                            class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            x-bind:disabled="constituent === 'staff' || !college">
                            <option value="">Select a degree program</option>
                            <template x-for="program in degprogs[college]" :key="program">
                                <option :value="program" x-text="program"></option>
                            </template>
                        </select>
                        <p x-show="errors.degprog" class="text-red-500 text-sm mt-1">Degree program is required.</p>
                    </div>

                </form>
                <div class="flex flex-col-reverse md:flex-row w-5/6 items-center justify-end gap-2 mt-3 md:mt-5">
                    <a class="w-full h-12 bg-white rounded-md md:w-1/6 border border-[#014421] hover:bg-slate-100 flex items-center justify-center"
                    href="{{ route('login') }}">
                        <p class="text-[#014421]">Return</p>
                    </a>
                    <button @click="
                                errors = {};
                                if (!fname.trim()) errors.fname = true;
                                if (!lname.trim()) errors.lname = true;
                                if (!contact.trim()) errors.contact = true;
                                if (!constituent.trim()) errors.constituent = true;
                                if (!college.trim()) errors.college = true;
                                if (!degprog.trim() && constituent !== 'staff') errors.degprog = true;

                                if (Object.keys(errors).length === 0) {
                                    signupPartOne = false; 
                                    signupPartTwo = true; 
                                    signupPartThree = false;
                                }
                            " 
                            class="w-full md:w-1/6 h-12 bg-[#014421] rounded-md text-white hover:bg-green-800 flex items-center justify-center">
                        Next
                    </button>
                </div>
            </div>


            <!-- 2nd part -->
            <div x-show="signupPartTwo" x-data = "{ email: $wire.entangle('up_email'), role: $wire.entangle('role'), password: $wire.entangle('password'), repeat_password: $wire.entangle('repeat_password'), errors:{} }" class="flex flex-col w-full justify-center items-center gap-8 md:gap-10">
                <form class="flex flex-col md:grid md:grid-cols-2 w-5/6 gap-4 md:gap-8">
                    <div class="flex flex-col w-full gap-1">
                        <label for="email" class="font-medium">UP Email</label>
                        <input type="email" id="email" x-model="email" wire:model="up_email" x-bind:class="{'border-red-500': errors.email || (email.length > 0 && email.length < 10)}" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.email" class="text-red-500 text-sm mt-1">Email is required.</p>
                        <p x-show="email && !email.endsWith('@up.edu.ph')" class="text-red-500 text-sm mt-1">Only UP emails are allowed.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="role" class="font-medium">Role</label>
                        <select x-model="role" wire:model="role" id="role" 
                                class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value="customer">Customer</option>
                            <option value="provider">Provider</option>
                        </select>
                        <p x-show="errors.role" class="text-red-500 text-sm mt-1">Role is required.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="password" class="font-medium">Password</label>
                        <input type="password" id="password" x-model="password" wire:model="password" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            x-bind:class="{'border-red-500': errors.password || (password.length > 0 && password.length < 8)}">
                        <p x-show="errors.password" class="text-red-500 text-sm mt-1">Password is required.</p>
                        <p x-show="password.length > 0 && password.length < 8" class="text-red-500 text-sm mt-1">Password must be at least 8 characters long.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="repeat_password" class="font-medium">Confirm Password</label>
                        <input type="password" id="repeat_password" x-model="repeat_password" wire:model="repeat_password" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            x-bind:class="{'border-red-500': errors.repeat_password || (repeat_password !== password && repeat_password.length > 0)}">
                        <p x-show="errors.repeat_password" class="text-red-500 text-sm mt-1">Password confirmation is required.</p>
                        <p x-show="repeat_password !== password && repeat_password.length > 0" class="text-red-500 text-sm mt-1">Passwords must match.</p>
                    </div>

            
                </form>
                <div class="flex flex-col-reverse md:flex-row w-5/6 items-center justify-end gap-2 mt-3 md:mt-5">
                    <button @click="signupPartOne = true; signupPartTwo = false; signupPartThree = false;" 
                            class="w-full h-12 bg-white text-[#014421] rounded-md md:w-1/6 border border-[#014421] hover:bg-slate-100 flex items-center justify-center">
                        Return
                    </button>
                    <button @click="
                                errors = {};
                                if (!email.trim()) errors.email = true;
                                if (!role.trim()) errors.role = true;
                                if (!password.trim()) errors.password = true;
                                if (!repeat_password.trim()) errors.repeat_password = true;

                                if (Object.keys(errors).length === 0) {
                                    signupPartOne = false; 
                                    signupPartTwo = false; 
                                    signupPartThree = true;
                                }
                            " 
                            class="w-full md:w-1/6 h-12 bg-[#014421] rounded-md text-white hover:bg-green-800 flex items-center justify-center">
                        Next
                    </button>
                </div>
            </div>
            
            <!-- 3rd part -->
            <div x-show="signupPartThree" x-data="{ qone: $wire.entangle('question_one'), qtwo:$wire.entangle('question_two'), qthree:$wire.entangle('question_three'), qfour:$wire.entangle('question_four'), errors:{} }" class="flex flex-col w-full justify-center items-center gap-8 md:gap-10">
                <form class="flex flex-col md:grid md:grid-cols-2 w-5/6 gap-4 md:gap-8">
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_one" class="font-medium">If you saw Mariang Banga holding the jar on her head, what would happen to you?</label>
                        <input type="text" id="question_one" x-model:="qone" wire:model="question_one" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.qone" class="text-red-500 text-sm mt-1">This question is required.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_two" class="font-medium">Assuming you take a jeep to Copeland Gymnasium, where do you get off? </label>
                        <input type="text" id="question_two" x-model:="qtwo" wire:model="question_two" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.qtwo" class="text-red-500 text-sm mt-1">This question is required.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_three" class="font-medium">How many digits are there after the batch year in student number? </label>
                        <input type="number" id="question_three" x-model:="qthree" wire:model="question_three" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.qthree" class="text-red-500 text-sm mt-1">This question is required.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_four" class="font-medium">Which bus company offers trips from UPLB to UPD and vice versa? </label>
                        <input type="text" id="question_four" x-model:="qfour" wire:model="question_four" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.qfour" class="text-red-500 text-sm mt-1">This question is required.</p>
                    </div>
                </form>
                <div class="flex flex-col-reverse md:flex-row w-5/6 items-center justify-end gap-2 mt-3 md:mt-5">
                    <button @click="signupPartOne = false; signupPartTwo = true; signupPartThree = false;" 
                            class="w-full h-12 bg-white text-[#014421] rounded-md md:w-1/6 border border-[#014421] hover:bg-slate-100 flex items-center justify-center">
                        Return
                    </button>
                    <button @click="
                                errors = {};
                                if (!qone.trim()) errors.qone = true;
                                if (!qtwo.trim()) errors.qtwo = true;
                                if (!qthree.trim()) errors.qthree = true;
                                if (!qfour.trim()) errors.qfour = true;

                                if (Object.keys(errors).length === 0) {
                                    isModalOpen = true;
                                }
                            " 
                            class="w-full md:w-1/6 h-12 bg-[#014421] rounded-md text-white hover:bg-green-800 flex items-center justify-center">
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
                            <button @click="isModalOpen = false" wire:click="verify_questions" class="px-4 py-2 bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
