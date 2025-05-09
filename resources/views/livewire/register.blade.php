<div x-data="{ signupPartOne: true, signupPartTwo: false, signupPartThree: false, isModalOpen: false }" class="flex flex-col font-poppins" x-cloak>
    <!-- Top div (Header) -->
    <div class="flex flex-row w-full bg-[#014421] gap-2 md:gap-5 items-center">
        <img src="https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png" class="ml-5 w-16 md:ml-10 my-2 md:w-16"> 
        <p class="text-xl md:text-2xl font-montserrat text-white font-bold">PASABUY</p>
    </div>
    <!-- Centered Div (Signup Form) -->
    <div class="bg-white flex flex-row gap-2 md:w-full md:flex-col md:gap-0 md:items-center justify-center flex-1 mt-10 pb-10">   
        <div class="flex flex-col w-5/6 md:w-4/6">
            <div class="flex flex-col justify-start md:justify-center md:items-center mb-10 md:mb-16 gap-5 md:gap-7">
                <p class="text-[#7b1113] font-semibold text-4xl md:text-5xl self-start md:self-center">Sign up</p>
                <div class="flex flex-row text-[#014421] w-full justify-center items-center space-x-4">
                    <p :class="{'font-semibold': signupPartOne}" class="cursor-pointer">Basic Information</p>
                    <hr class="w-2/12 h-px bg-[#014421] border-0 rounded hidden md:block">
                    <p :class="{'font-semibold': signupPartTwo}" class="cursor-pointer">Account Information</p>
                    <hr class="w-2/12 h-px bg-[#014421] border-0 rounded hidden md:block">
                    <p :class="{'font-semibold': signupPartThree}" class="cursor-pointer">Verification Questions</p>
                </div>
            </div>
            <!-- Toggle between form and message with Alpine.js -->
            <div x-show="signupPartOne" class="flex flex-col w-full justify-center items-center gap-8 md:gap-10" x-data="{ fname: $wire.entangle('first_name'), lname: $wire.entangle('last_name'), contact: $wire.entangle('contact_number'), constituent: $wire.entangle('constituent'), college: $wire.entangle('college'), degprog: $wire.entangle('degree_program'), degprogs: $wire.entangle('degprogs'), errors: {} }">
                <form class="flex flex-col md:grid md:grid-cols-3 w-5/6 md:w-full gap-4 md:gap-8">
                <div class="flex flex-col w-full gap-1">
                    <label for="fname" class="font-medium">First Name</label>
                    <input type="text" id="fname" x-model="fname" 
                        @input="if (fname.trim().length >= 3 && fname.trim().length <= 30 && /^[a-zA-Z\s]+$/.test(fname)) { delete errors.fname; }"
                        x-bind:class="{'border-red-500': errors.fname || ((fname.trim().length < 3 || fname.trim().length > 30 || !/^[a-zA-Z\s]+$/.test(fname)) && fname.trim().length > 0)}"
                        class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    <p x-show="errors.fname" class="text-red-500 text-sm mt-1">Firstname is required.</p>
                    <p x-show="(fname.trim().length < 3 || fname.trim().length > 30) && fname.trim().length > 0" class="text-red-500 text-sm mt-1"> Firstname must be between 3 and 30 characters long. </p>
                    <p x-show="!/^[a-zA-Z\s]+$/.test(fname) && fname.trim().length > 0" class="text-red-500 text-sm mt-1"> Firstname must contain only alphabetic characters and spaces. </p>
                </div>

                <div class="flex flex-col w-full gap-1">
                    <label for="lname" class="font-medium">Last Name</label>
                    <input type="text" id="lname" x-model="lname" 
                        @input="if (lname.trim().length >= 2 && lname.trim().length <= 30 && /^[a-zA-Z\s]+$/.test(lname)) { delete errors.lname; }"
                        x-bind:class="{'border-red-500': errors.lname || ((lname.trim().length < 2 || lname.trim().length > 30 || !/^[a-zA-Z\s]+$/.test(lname)) && lname.trim().length > 0)}"
                        class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    <p x-show="errors.lname" class="text-red-500 text-sm mt-1">Lastname is required.</p>
                    <p x-show="(lname.trim().length < 2 || lname.trim().length > 30) && lname.trim().length > 0" class="text-red-500 text-sm mt-1"> Lastname must be between 2 and 30 characters long. </p>
                    <p x-show="!/^[a-zA-Z\s]+$/.test(lname) && lname.trim().length > 0" class="text-red-500 text-sm mt-1"> Lastname must contain only alphabetic characters and spaces. </p>
                </div>


                    <div class="flex flex-col w-full gap-1">
                        <label for="contactnumber" class="font-medium">Contact Number</label>
                        <input type="tel" id="contactnumber" x-model="contact" wire:model="contact_number" @input=" if (contact.length === 11 && /^09\d{9}$/.test(contact)) { delete errors.contact }" x-bind:class="{'border-red-500': errors.contact || ((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 )}"
                            class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.contact" class="text-red-500 text-sm mt-1">Contact number is required.</p>
                        <p x-show="((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 ) " class="text-red-500 text-sm mt-1">Invalid contact number format (09***).</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="constituent" class="font-medium">Type of constituent</label>
                        <select x-model="constituent" wire:model="constituent" id="constituent" @change="if(constituent === 'staff') { degprog = ''; delete errors.constituent; } if(constituent !== '' && constituent !== 'staff' && college !== '') { delete errors.constituent; errors.degprog = true; } if(constituent === '') { errors.constituent = true; } if (constituent !== '') { delete errors.constituent; }" x-bind:class="{'border-red-500': errors.constituent }"
                                class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value="" disabled></option>
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                            <option value="staff">Administrative Staff</option>
                            <option value="alumnus">Alumnus</option>
                        </select>
                        <p x-show="errors.constituent" class="text-red-500 text-sm mt-1">Type of constituent is required.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="college" class="font-medium">College</label>
                        <select x-model="college" wire:model="college" id="college" @change="if(college !== '') { delete errors.college; } if(college === '' && constituent !== 'staff') { errors.college = true; errors.degprog = true; } if (college === '') { errors.college = true; } degprog = ''; errors.degprog = true; " x-bind:class="{'border-red-500': errors.college }"
                            class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value="" disabled></option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college }}">{{ $college }}</option>
                            @endforeach
                        </select>
                        <p x-show="errors.college" class="text-red-500 text-sm mt-1">College is required.</p>
                    </div>

                    <div class="flex flex-col w-full gap-1">
                        <label for="degprog" class="font-medium">Degree Program</label>
                        <select x-model="degprog" wire:model="degree_program" id="degprog" @change="if(degprog !== '') { delete errors.degprog; } if(degprog === ''  && constituent !== 'staff') { errors.degprog = true; }" x-bind:class="{'border-red-500': errors.degprog && constituent !== 'staff'}"
                            class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            x-bind:disabled="constituent === 'staff' || !college">
                            <option value="" disabled></option>
                            <template x-for="program in degprogs[college]" :key="program">
                                <option :value="program" x-text="program"></option>
                            </template>
                        </select>
                        <p x-show="errors.degprog && constituent !== 'staff'" class="text-red-500 text-sm mt-1">Degree program is required.</p>
                    </div>

                </form>
                <div class="flex flex-col-reverse md:flex-row w-full items-center justify-end gap-2 mt-3 md:mt-5">
                    <a class="w-full h-12 bg-white rounded-md md:w-1/6 border border-[#014421] hover:bg-slate-100 flex items-center justify-center"
                    href="{{ route('login') }}">
                        <p class="text-[#014421]">Return</p>
                    </a>
                    <button @click="
                                errors = {};
                                if (!fname.trim()) errors.fname = true;
                                if ((fname.length < 3 || fname.length > 30) && fname.length > 0) errors.length = true;
                                if (!lname.trim()) errors.lname = true;
                                if ((lname.length < 3 || lname.length > 30) && lname.length > 0) errors.length = true;
                                if (!contact.trim()) errors.contact = true;
                                if (((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 )) errors.format = true;
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
            <div x-show="signupPartTwo" x-data = "{ email: $wire.entangle('up_email'), role: $wire.entangle('role'), password: $wire.entangle('password'), repeat_password: $wire.entangle('repeat_password'), showPassword: false, showRepeatPassword: false, errors:{} }" class="flex flex-col w-full justify-center items-center gap-8 md:gap-10">
                <form class="flex flex-col md:grid md:grid-cols-2 w-5/6 gap-4 md:gap-8">
                    <div class="flex flex-col w-full gap-1">
                        <label for="email" class="font-medium">UP Email</label>
                        <input type="email" id="email" x-model="email" wire:model="up_email" @change="if (email.length === 0) { errors.email = true; } " @input="if (email.length > 0) { delete errors.email; } " x-bind:class="{'border-red-500': errors.email || (email.length > 0 && email.length < 10) || (email && !email.endsWith('@up.edu.ph')) || (email && /[.]/.test(email.split('@')[0])) || email.length > 40}" class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.email" class="text-red-500 text-sm mt-1">Email is required.</p>
                        <p x-show="email.length > 40" class="text-red-500 text-sm mt-1">Maximum email length of 40 is reached.</p>
                        <p x-show="email && !email.endsWith('@up.edu.ph')" class="text-red-500 text-sm mt-1">Only UP emails are allowed.</p>
                        <p x-show="email && /[.]/.test(email.split('@')[0])" class="text-red-500 text-sm mt-1">Invalid email format.</p>
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
                        <div class="relative w-full" >
                            <input :type="showPassword ? 'text' : 'password'" id="password" x-model="password" wire:model="password" @input="if (password.trim().length > 0) { delete errors.password; delete errors.password_format; }" @change="if (password.length === 0) { errors.password = true; } "  class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                x-bind:class="{'border-red-500': errors.password || errors.password_format || (password.length > 0 && password.length < 8) || password.length > 40}" > 
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
                        <p x-show="errors.password" class="text-red-500 text-sm mt-1">Password is required.</p>
                        <p x-show="errors.password_format" class="text-red-500 text-sm mt-1">Your selected password is invalid.</p>
                        <p x-show="password.trim().length > 0 && password.trim().length < 8" class="text-red-500 text-sm mt-1">Password must be at least 8 characters long.</p>
                        <p x-show="password.trim().length > 40" class="text-red-500 text-sm mt-1">Password must be between 8 and 40 characters long.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="repeat_password" class="font-medium">Confirm Password</label>
                        <div class="relative w-full">
                            <input :type="showRepeatPassword ? 'text' : 'password'" id="repeat_password" x-model="repeat_password" wire:model="repeat_password" @input="if (repeat_password.length > 0) { delete errors.repeat_password; }" @change="if (repeat_password.length === 0) { errors.repeat_password = true; } "  class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                x-bind:class="{'border-red-500': errors.repeat_password || (repeat_password !== password && repeat_password.length > 0)}">
                            <button type="button" @click="showRepeatPassword = !showRepeatPassword" class="absolute top-1/2 right-3 transform -translate-y-1/2 text-slate-400 focus:outline-none">
                                <svg x-show="!showRepeatPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="showRepeatPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
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
                                if (email.length > 50 || email.length < 10) errors.length = true;
                                if ((/[.]/.test(email.split('@')[0]) || !email.endsWith('@up.edu.ph')) && email) errors.format = true;
                                if (!role.trim()) errors.role = true;
                                if (password.length > 0 && password.trim().length === 0) errors.password_format = true;
                                if (password.length === 0) errors.password = true;
                                if (password.length > 40 || password.length < 8) errors.length = true;
                                if (!repeat_password.trim()) errors.repeat_password = true;
                                if (repeat_password !== password) errors.match = true;
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
                        <select x-model="qone" wire:model="question_one" id="question_one" @change="if (qone === '') { errors.qone = true; } if (qone !== '') { delete errors.qone; } " x-bind:class="{'border-red-500': errors.qone }"
                                class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value=""></option>
                            <option value="delay">You will be delayed in your graduation</option>
                            <option value="low_units">You will be underloaded next semester</option>
                            <option value="late_in_class">You will be late for your classes</option>
                            <option value="incur_singko">You will incur a grade of 5.0</option>
                        </select>
                        <p x-show="errors.qone" class="text-red-500 text-sm mt-1">This question is required.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_two" class="font-medium">Assuming you take a jeep to Copeland Gymnasium, where do you get off? </label>
                        <select x-model="qtwo" wire:model="question_two" id="question_two" @change="if (qtwo === '') { errors.qtwo = true; } if (qtwo !== '') { delete errors.qtwo; } " x-bind:class="{'border-red-500': errors.qtwo }"
                                class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value=""></option>
                            <option value="mens_dorm">Men's Dormitory</option>
                            <option value="dl_umali">D.L. Umali Hall</option>
                            <option value="ansci">Animal Science / Husbandry Arch</option>
                            <option value="pahinungod">Ugnayan ng Pahinungod</option>
                        </select>
                        <p x-show="errors.qtwo" class="text-red-500 text-sm mt-1">This question is required.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_three" class="font-medium">How many digits are there after the batch year in student number? </label>
                        <input type="number" id="question_three" x-model:="qthree" wire:model="question_three" min="1" max="10" @change="if (qthree === '') { errors.qthree = true; } if (qthree !== '') { delete errors.qthree; } " x-bind:class="{'border-red-500': errors.qthree || ((qthree > 10 || qthree < 1) && qthree !== '') }"  class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                        <p x-show="errors.qthree" class="text-red-500 text-sm mt-1">This question is required.</p>
                        <p x-show="(qthree > 10 || qthree < 1) && qthree !== ''" class="text-red-500 text-sm mt-1">Invalid answer.</p>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="question_four" class="font-medium">Which bus company offers trips from UPLB to UPD and vice versa? </label>
                        <select x-model="qfour" wire:model="question_four" id="question_four" @change="if (qfour === '') { errors.qfour = true; } if (qfour !== '') { delete errors.qfour; } " x-bind:class="{'border-red-500': errors.qfour }"
                                class="w-full h-12 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-[#898989] rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value=""></option>
                            <option value="jac_liner">Jac Liner</option>
                            <option value="hm_transport">HM Transport</option>
                            <option value="lli">LLI</option>
                            <option value="dltb">DLTB Co.</option>
                        </select>
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
                                if ((qthree > 10 || qthree < 1) && qthree !== '') errors.value = true;
                                if (!qfour.trim()) errors.qfour = true;

                                if (Object.keys(errors).length === 0) {
                                    isModalOpen = true;
                                    document.body.style.overflow = 'hidden'
                                }
                            " 
                            class="w-full md:w-1/6 h-12 bg-[#014421] rounded-md text-white hover:bg-green-800 flex items-center justify-center">
                        Register
                    </button>
                </div>
                <!-- Modal -->
                <div @keydown.escape.window="isModalOpen = false; document.body.style.overflow = 'auto';" x-show="isModalOpen" x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/3 relative">
                        <div class="flex flex-row gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#014421" class="size-6 md:size-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-xl md:text-2xl font-semibold text-[#014421]">Confirmation</p>
                            <button @click="isModalOpen = false; document.body.style.overflow = 'auto';" class="absolute top-4 right-4 p-2 hover:bg-gray-100 hover:rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#000000" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm mt-2 md:mt-5 text-justify">By using PASABUY, a platform that facilitates bulk purchasing of items, you agree to comply with all terms and conditions outlined in this agreement. </p>
                        <p class="text-sm mt-2 md:mt-5 text-justify">PASABUY serves as an intermediary, providing tools to manage, create, and track orders between users. While PASABUY offers the platform for these transactions, it is not responsible for the quality of the items involved.
                        You, as a user, agree to use the platform responsibly and are fully accountable for any transactions conducted through PASABUY.</p>
                        <p class="text-sm mt-2 md:mt-5 text-justify">Users understand and acknowledge that PASABUY is not liable for any issues, disputes, or damages that may arise from transactions between providers and customers. Both providers and customers are encouraged to communicate directly and resolve any issues regarding the transaction. </p>
                        <p class="text-sm mt-2 md:mt-5 text-justify">PASABUY reserves the right to modify these terms at any time, and continued use of the platform constitutes your acceptance of the revised terms.</p>
                        <div class="mt-4 flex justify-end gap-2">
                            <button @click="isModalOpen = false; document.body.style.overflow = 'auto'" class="px-2 sm:px-3 py-1.5 text-sm border rounded-md hover:bg-slate-200 ml-auto">Cancel</button>
                            <button x-data="{ disabled: false }" :disabled="disabled" @click="$wire.verifyQuestions(); disabled = true;" class="px-2 sm:px-3 py-1 sm:py-1.5 text-sm bg-[#014421] text-white rounded-md hover:bg-green-800">I understand</button>
                        </div>
                    </div>
                </div>
                <div wire:loading.delay wire:target="verifyQuestions" class="fixed inset-0 bg-white bg-opacity-50 z-[51] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" class="absolute top-1/2 left-1/2 w-12 h-12 text-gray-200 animate-spin fill-[#014421]">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
