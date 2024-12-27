<div class="flex flex-col mx-4 sm:w-full min-h-screen sm:mx-8 xl:mx-auto font-montserrat bg-gray-100">
  <div class="self-start flex flex-row items-center gap-5 pt-5 ">
    <a href={{ route('dashboard') }}>
      <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.75 18.75H33.75C34.0815 18.75 34.3995 18.8817 34.6339 19.1161C34.8683 19.3505 35 19.6685 35 20C35 20.3315 34.8683 20.6495 34.6339 20.8839C34.3995 21.1183 34.0815 21.25 33.75 21.25H8.75C8.41848 21.25 8.10054 21.1183 7.86612 20.8839C7.6317 20.6495 7.5 20.3315 7.5 20C7.5 19.6685 7.6317 19.3505 7.86612 19.1161C8.10054 18.8817 8.41848 18.75 8.75 18.75Z" fill="black"/>
        <path d="M9.26751 20.0001L19.635 30.3651C19.8697 30.5998 20.0016 30.9182 20.0016 31.2501C20.0016 31.5821 19.8697 31.9004 19.635 32.1351C19.4003 32.3698 19.0819 32.5017 18.75 32.5017C18.4181 32.5017 18.0997 32.3698 17.865 32.1351L6.61501 20.8851C6.4986 20.769 6.40624 20.6311 6.34323 20.4792C6.28021 20.3273 6.24777 20.1645 6.24777 20.0001C6.24777 19.8357 6.28021 19.6729 6.34323 19.521C6.40624 19.3692 6.4986 19.2312 6.61501 19.1151L17.865 7.86511C18.0997 7.6304 18.4181 7.49854 18.75 7.49854C19.0819 7.49854 19.4003 7.6304 19.635 7.86511C19.8697 8.09983 20.0016 8.41817 20.0016 8.75011C20.0016 9.08205 19.8697 9.4004 19.635 9.63511L9.26751 20.0001Z" fill="black"/>
      </svg>
    </a>
    <p class="text-xl sm:text-4xl font-semibold sm:font-bold">User Profile</p>
  </div>
  <div class="border border-red-400">
    <div class="w-5/6 flex flex-col sm:flex-row gap-4">
      <div class="flex flex-col gap-4">
        <!-- IMAGE -->
        <div class="rounded-lg bg-white sm:shadow w-96 gap-4">
          <div class="w-full flex flex-col sm:flex-row justify-center items-center gap-4 py-8">
            <img src="https://zerebro.org/logo512.png"  class="h-14 sm:h-20 aspect-auto rounded-full border-2 border-black"  alt="FlowBite Logo" />
            <div class="flex flex-col justify-center items-center sm:items-start">
              <p class="text-lg sm:text-xl font-semibold"> {{ $user->name }} </p>
              <p> {{ $user->constituent }} </p>
              <button class="py-1 px-2 mt-3 bg-[#014421] hover:bg-green-800 text-white text-sm rounded-md"> Change picture </button>
            </div>
          </div>
        </div>  
        <!-- PASABUY INFO -->
        <div class="flex justify-center rounded-lg bg-white sm:shadow w-96 gap-4">
          <div class="w-full sm:w-5/6 flex flex-col py-8">
            <p class="text-lg sm:text-xl font-semibold">PASABUY Information</p>
            <div class="flex flex-row gap-2 items-center text-sm" x-data="{ open: false }">
              <p>PASABUY points</p>
              <div 
                @mouseenter="open = true" 
                @mouseleave="open = false" 
                class="flex self-center relative"
              >
                <button>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                  </svg>
                </button>
                <!-- Tooltip -->
                <div 
                  x-show="open" 
                  class="absolute left-0 mt-2 z-50 border border-gray-50 rounded-lg bg-white shadow-md p-2 w-64"
                  x-cloak
                >
                  <p class="text-sm text-black">
                    If your PASABUY point is below 80, you will not be able to avail or do transactions.
                  </p>
                </div>
              </div>
              <p>: 1</p>
            </div>
            <hr class="my-5" />
            <div class="flex flex-col gap-2">
              <div class="flex flex-row gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <p class="font-semibold text-lg sm:text-xl">Customer</p>
              </div>
              <div class="flex flex-col text-sm gap-1">
                <p>Successful Item Purchase : 1</p>
                <p>Cancelled Items : 1</p>
              </div>
            </div>
            <hr class="my-5" />
            <div class="flex flex-col gap-2">
              <div class="flex flex-row gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
                <p class="font-semibold text-lg sm:text-xl">Provider</p>
              </div>  
              <div class="flex flex-col text-sm gap-1">
                <div class="flex flex-row items-center">
                  <p class="mr-1">Rating:</p>
                  @for($i = 0; $i < 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                  @endfor()
                  <!-- SOLID STAR -->
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" class="w-5" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                  </svg> -->
                  <p>(12)</p>
                </div>
                <p>Successful Deliveries : 1</p>
                <p>Cancelled Transactions : 1</p>
                <button class="py-1 px-2 mt-3 bg-[#014421] hover:bg-green-800 text-white text-sm rounded-md"> View provider wordcloud </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-lg w-full">
        <div class="flex flex-col p-8" x-data="{ constituent: {{$user->constituent}}, college: {{$user->college}}, degprog: {{$user->degprog}} }">
          <p class="text-lg sm:text-xl font-semibold">General Information</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-5 text-sm">
            <div class="flex flex-col">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
              <input type="text" id="name" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="{{ $user->name }}" disabled />
            </div>
            <div class="flex flex-col">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
              <input type="text" id="email" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="{{ $user->email }}" disabled/>
            </div>
            <div class="flex flex-col mt-4">
              <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 ">Contact Number</label>
              <input type="text" id="contact" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="{{ $user->contact_number }}"/>
            </div>
            <div class="flex flex-col mt-4">
              <label for="constituent" class="block mb-2 text-sm font-medium text-gray-900 ">Type of Constituent</label>
              <select x-model="constituent" type="text" id="constituent" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5" >
                <option value="" selected>
                  @if ($user->constituent === 'student')
                      Student
                  @elseif ($user->constituent === 'faculty')
                      Faculty Member
                  @elseif ($user->constituent === 'staff')
                      Administrative Staff
                  @elseif ($user->constituent === 'alumni')
                      Alumni
                  @endif
                </option>
                @foreach ($types as $label => $value)
                  @if($user->constituent !== $value)
                    <option value="{{ $value }}">{{ $label }}</option>
                  @endif()
                @endforeach
              </select>
            </div>
            <div class="flex flex-col mt-4">
              <label class="block mb-2 text-sm font-medium text-gray-900" for="college">College</label>
              <select x-model="college" wire:model="college" id="college" @change="if(college !== '') { delete errors.college; } if(college === '' && constituent !== 'staff') { errors.college = true; errors.degprog = true; } if (college === '') { errors.college = true; } degprog = ''; errors.degprog = true;" x-bind:class="{'border-red-500': errors.college }" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5">
                <option value="{{ $user->college }}" selected>{{ $user->college }}</option>
                @foreach ($colleges as $college)
                  @if($college !== $user->college)
                    <option value="{{ $college }}">{{ $college }}</option>
                  @endif()
                @endforeach
              </select>
            </div>
            <div class="flex flex-col mt-4">
              <label for="degprog" class="block mb-2 text-sm font-medium text-gray-900">Degree Program</label>
              <select x-model="degprog" wire:model="degree_program" id="degprog" @change="if(degprog !== '') { delete errors.degprog; } if(degprog === ''  && constituent !== 'staff') { errors.degprog = true; }" x-bind:class="{'border-red-500': errors.degprog && constituent !== 'staff'}" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5">
                  x-bind:disabled="constituent === 'staff' || !college">
                  <option value="">{{ $user->degree_program }}</option>
                  @if (!empty($degprogs[$user->college]))
                    @foreach ($degprogs[$user->college] as $program)
                      @if($user->degree_program !== $program)
                        <option value="{{ $program }}">{{ $program }}</option>
                      @endif()
                    @endforeach
                  @endif
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- DELETE -->
    <div x-show="activeTab === 'Settings'" class="w-5/6 col-span-8 overflow-hidden rounded-xl sm:bg-gray-50 sm:px-8 sm:shadow">
      <div class="mt-5">
        <p class="py-2 text-lg sm:text-xl font-semibold">Email Address</p>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
          <p class="text-gray-600">Your email address is <strong>john.doe@company.com</strong></p>
          <button class="inline-flex text-sm font-semibold text-blue-600 underline decoration-2">Change</button>
        </div>
      </div>
      <hr class="my-5" />
      <p class="text-lg sm:text-xl font-semibold">Password</p>
      <div class="flex items-center">
        <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-3 sm:mt-2">
          <label for="login-password">
            <span class="text-sm text-gray-500">Current Password</span>
            <div class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-600">
              <input type="password" id="login-password" class="w-full flex-shrink appearance-none border-gray-300 bg-white py-2 px-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none" />
            </div>
          </label>
          <label for="login-password">
            <span class="text-sm text-gray-500">New Password</span>
            <div class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-600">
              <input type="password" id="login-password" class="w-full flex-shrink appearance-none border-gray-300 bg-white py-2 px-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none" />
            </div>
          </label>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="mt-5 ml-2 h-6 w-6 cursor-pointer text-sm font-semibold text-gray-600 underline decoration-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
        </svg>
      </div>
      <p class="mt-2">Can't remember your current password? <a class="text-sm font-semibold text-blue-600 underline decoration-2" href="#">Recover Account</a></p>
      <button class="mt-4 rounded-lg bg-blue-600 px-4 py-2 text-white">Save Password</button>
      <hr class="my-5" />
      <div class="mb-10">
        <p class="text-lg sm:text-xl font-semibold">Delete Account</p>
        <p class="inline-flex items-center rounded-full bg-rose-100 px-4 py-1 text-rose-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
          </svg>
          Proceed with caution
        </p>
        <p class="mt-2">Make sure you have taken backup of your account in case you ever need to get access to your data. We will completely wipe your data. There is no way to access your account after this action.</p>
        <button class="ml-auto text-sm font-semibold text-rose-600 underline decoration-2">Continue with deletion</button>
      </div>
    </div>
  </div>
</div>