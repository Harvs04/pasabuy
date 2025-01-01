<div class="flex flex-col mx-4 sm:mx-0 w-full min-h-screen font-montserrat bg-gray-100">
  <!-- ALERT MESSAGES --> 
  @if(session('change_role_success'))
    <div class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-3 py-2 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
      <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>

          <div class="text-center">
              {{ session('change_role_success') }}
          </div>
      </div>
      <!-- Close Button -->
      <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-4">
          &times;
      </button>
    </div>

  @endif
  @if(session('change_info_success'))
    <div class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-3 py-2 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
      <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>

          <div class="text-center">
              {{ session('change_info_success') }}
          </div>
      </div>
      <!-- Close Button -->
      <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-4">
          &times;
      </button>
    </div>
  @endif
  @if(session('change_pass_success'))
    <div class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-[#014421] border-t border-white text-white px-3 py-2 w-4/6 md:w-fit max-w-md flex justify-center items-center rounded-lg shadow-sm sm:shadow-md">
      <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>

          <div class="text-center">
              {{ session('change_pass_success') }}
          </div>
      </div>
      <!-- Close Button -->
      <button onclick="this.parentElement.style.display='none'" class="text-white font-bold p-2 ml-4">
          &times;
      </button>
    </div>
  @endif
  <div class="flex flex-row items-center gap-5 mt-20 mb-3 sm:ml-32 ">
    <a href={{ route('dashboard') }}>
      <svg class="w-5 sm:w-7" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.75 18.75H33.75C34.0815 18.75 34.3995 18.8817 34.6339 19.1161C34.8683 19.3505 35 19.6685 35 20C35 20.3315 34.8683 20.6495 34.6339 20.8839C34.3995 21.1183 34.0815 21.25 33.75 21.25H8.75C8.41848 21.25 8.10054 21.1183 7.86612 20.8839C7.6317 20.6495 7.5 20.3315 7.5 20C7.5 19.6685 7.6317 19.3505 7.86612 19.1161C8.10054 18.8817 8.41848 18.75 8.75 18.75Z" fill="black"/>
        <path d="M9.26751 20.0001L19.635 30.3651C19.8697 30.5998 20.0016 30.9182 20.0016 31.2501C20.0016 31.5821 19.8697 31.9004 19.635 32.1351C19.4003 32.3698 19.0819 32.5017 18.75 32.5017C18.4181 32.5017 18.0997 32.3698 17.865 32.1351L6.61501 20.8851C6.4986 20.769 6.40624 20.6311 6.34323 20.4792C6.28021 20.3273 6.24777 20.1645 6.24777 20.0001C6.24777 19.8357 6.28021 19.6729 6.34323 19.521C6.40624 19.3692 6.4986 19.2312 6.61501 19.1151L17.865 7.86511C18.0997 7.6304 18.4181 7.49854 18.75 7.49854C19.0819 7.49854 19.4003 7.6304 19.635 7.86511C19.8697 8.09983 20.0016 8.41817 20.0016 8.75011C20.0016 9.08205 19.8697 9.4004 19.635 9.63511L9.26751 20.0001Z" fill="black"/>
      </svg>
    </a>
    <p class="text-xl sm:text-3xl font-semibold sm:font-bold">User Profile and Settings</p>
  </div>
  <div class="flex justify-center">
    <div class="w-full sm:w-5/6 flex flex-col sm:flex-row gap-4">
      <div class="flex flex-col gap-4">
        <!-- IMAGE -->
        <div class="rounded-lg bg-white shadow-sm sm:shadow-md w-full sm:w-96 gap-4">
          <div class="w-full flex flex-col sm:flex-row justify-center items-center gap-4 py-8">
            <img src="https://zerebro.org/logo512.png"  class="h-14 sm:h-20 aspect-auto rounded-full border-2 border-black"  alt="FlowBite Logo" />
            <div class="flex flex-col justify-center items-center sm:items-start">
              <p class="text-lg sm:text-xl font-semibold"> {{ $user->name }} </p>
              <p> {{ $user->constituent }} </p>
              <button class="font-medium py-1 px-2 mt-3 bg-[#014421] hover:bg-green-800 text-white text-sm rounded-md"> Change picture </button>
            </div>
          </div>
        </div>  
        <!-- PASABUY INFO -->
        <div class="flex justify-start rounded-lg bg-white shadow-sm sm:shadow-md w-full sm:w-96 gap-4">
          <div class="w-full sm:w-5/6 flex flex-col p-8">
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
                  class="absolute left-0 mt-2 z-50 border border-gray-50 rounded-lg bg-white shadow-sm sm:shadow-md p-2 w-64"
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
                <button class="font-medium w-2/3 sm:w-full py-1 px-2 mt-3 bg-[#014421] hover:bg-green-800 text-white text-sm rounded-md"> View provider wordcloud </button>
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-start rounded-lg bg-white shadow-sm sm:shadow-md w-full sm:w-96 gap-4">
          <div class="flex flex-col p-8 gap-2">
            <p class="text-lg sm:text-xl font-semibold">Account Management</p>
            <button>
              <div wire:click="logOut" class="flex items-center justify-center gap-2 w-1/2 font-medium px-2 py-1 text-sm bg-white text-[#014421] border border-[#014421] rounded-md hover:bg-gray-100">
                <svg class="w-4 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <p class="mr-1">Log Out</p>
              </div>
            </button>
            <hr class="my-3">
            <p class="text-sm inline-flex w-2/3 items-center rounded-full bg-rose-200 px-3 py-1 text-[#7b1113]">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              Proceed with caution
            </p>
            <p class="text-sm">This action will completely delete your data in our database.</p>
            <button wire:click="deleteAccount" class="w-1/2 font-medium px-2 sm:px-3 py-1 text-sm bg-white text-[#7b1113] border border-[#7b1113] rounded-md hover:bg-rose-300">Delete Account</button>
          </div>
        </div>
      </div>
      <div class="flex flex-col gap-4">
        <!-- GENERAL INFO -->
        <div class="bg-white rounded-lg shadow-sm sm:shadow-md w-full">
          <div class="flex flex-col p-8 justify-center" x-data="{ contact: $wire.entangle('contact'), originalContact:  '{{ $user->contact_number }}', constituent: '{{ $user->constituent }}', selectedConstituent: '{{ $user->constituent }}' , college: '{{ $user->college }}', selectedCollege: '{{ $user->college }}', degprog: '{{ $user->degree_program }}', selectedDegprog: '{{ $user->degree_program }}', degProgs: {{ json_encode($degprogs) }}, isModalOpen: false, infoModalOpen: false, errors: {} }" x-cloak>
            <div class="flex flex-row items-center">
              <p class="text-lg sm:text-xl font-semibold">General Information</p>
              <button @click="isModalOpen = true" class="font-medium ml-auto py-1 px-2 bg-[#014421] hover:bg-green-800 text-white text-sm rounded-md"> Change role </button>
            </div>
            <p class="text-sm font-semibold">You are logged in as {{ $user->role === 'customer' ? 'Customer' : 'Provider' }}</p>
            <!-- MODAL -->
            <div x-show="isModalOpen" x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/3">
                    <div class="flex flex-row items-center gap-2 sm:gap-3">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#014421" class="size-5 sm:size-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                      </svg>
                      <p class="text-xl font-semibold text-[#014421]">Reminder</p>
                    </div>
                    @if($user->role === 'customer')
                      <p class="text-xs md:text-sm mt-2 md:mt-5 sm:ml-2 text-justify">By changing role to Provider, you will be able to:</p>
                      <ul class="text-xs md:text-sm mt-2 md:mt-4 list-disc list-inside ml-5">
                        <li>Create and initiate transactions</li>
                        <li>Gather item orders from customers</li>
                        <li>Manage orders</li>
                        <li>Update order statuses</li>
                      </ul>
                    @else
                      <p class="text-xs md:text-sm mt-2 md:mt-5 sm:ml-2 text-justify">
                        By changing your role to Customer, you will be able to:
                      </p>
                      <ul class="text-xs md:text-sm mt-2 md:mt-4 list-disc list-inside ml-5">
                        <li>Create item requests</li>
                        <li>Place item orders to providers</li>
                        <li>Track item orders</li>
                        <li>Rate the transaction and provider</li>
                      </ul>
                    @endif
                    <div class="mt-5 flex justify-end gap-2">
                        <button @click="isModalOpen = false" class="font-medium px-2 sm:px-3 py-1 sm:py-1.5 text-sm sm:text-base bg-white border border-[#014421] text-[#014421] rounded-md hover:bg-slate-100">Cancel</button>
                        <button wire:click="changeRole" class=" font-medium px-2 sm:px-3 py-1 sm:py-1.5 text-sm sm:text-base bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
              <div class="flex flex-col mt-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                <input type="text" id="name" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="{{ $user->name }}" disabled />
              </div>
              <div class="flex flex-col mt-4">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                <input type="text" id="email" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"  placeholder="{{ $user->email }}" disabled/>
              </div>
              <div class="flex flex-col mt-4">
                <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 ">Contact Number</label>
                <input x-model="contact" type="tel" id="contact" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5" x-bind:class="{'border-red-500': ((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 ) || contact === originalContact }" placeholder="{{ $user->contact_number }}"/>
                <p x-show="((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0) && contact !== originalContact" class="text-red-500 text-sm mt-1">Invalid contact number format (09***).</p>
                <p x-show="contact === originalContact" class="text-red-500 text-sm mt-1">Contact number is already in use.</p>
              </div>
              <div class="flex flex-col mt-4">
                <label for="constituent" class="block mb-2 text-sm font-medium text-gray-900 ">Type of Constituent</label>
                <select x-model="constituent" wire:model="constituent" type="text" id="constituent" @change="if (constituent === 'staff') { degprog = 'Not Applicable'; } if (constituent !== 'staff' && college === selectedCollege) { degprog = selectedDegprog; } " class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5" >
                  <option value="{{ $user->constituent }}" selected>
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
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="flex flex-col mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="college">College</label>
                <select x-model="college" wire:model="selectedCollege" id="college" @change="if(college !== selectedCollege) { degprog = ''; } if (college === selectedCollege) { degprog = selectedDegprog; }" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5">
                  <option value="{{ $user->college }}" selected>{{ $user->college }}</option>
                  @foreach ($colleges as $college)
                    @if($college !== $user->college)
                      <option value="{{ $college }}">{{ $college }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="flex flex-col mt-4">
                <!-- <p x-text="constituent"></p> -->
                <!-- <p x-text="college"></p>  -->
                <!-- <p x-text="degprog"></p>  -->
                <label for="degprog" class="block mb-2 text-sm font-medium text-gray-900">Degree Program</label>
                <select 
                    x-model="degprog" 
                    wire:model="degprog" 
                    id="degprog" 
                    x-bind:class="{'border-red-500': degprog === '' && constituent !== 'staff'}" 
                    class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                    :disabled="constituent === 'staff'">
                    
                    <!-- Placeholder option when no degree program is selected -->
                    <option value="" disabled x-show="!degProgs[college] || degprog === '' || college !== selectedCollege ">
                        Select a degree program
                    </option>
                    
                    <!-- Default option when college matches the original registered value -->
                    <option x-text="selectedDegprog" :value="selectedDegprog" x-show="college === selectedCollege && degprog === selectedDegprog">
                    </option>
                    
                    <!-- Render degree programs dynamically based on selected college -->
                    <template x-for="program in degProgs[college]" :key="program">
                      <option x-text="program" :value="program"></option>
                    </template>
                </select>
                <p x-show="degprog === '' && constituent !== 'staff'" class="text-red-500 text-sm mt-1">A new degree program is required.</p>
              </div>
            </div>
            <div class="mt-6 flex justify-start">
              <button class="font-medium py-2 px-3 bg-[#014421] enabled:hover:bg-green-800 disabled:bg-gray-500 text-white text-sm rounded-md" :disabled="(!contact && constituent === selectedConstituent && college === selectedCollege && degprog === selectedDegprog) || ((degprog === 'Not Applicable' || degprog === '') && constituent !== 'staff')" @click="
                                errors = {};
                                if ((degprog === undefined || degprog === '') && constituent !== 'staff') errors.deg_undefined = true;
                                if (((!/^09\d{9}$/.test(contact) || contact.length !== 11) && contact.length > 0 )) errors.contact_length = true;
                                if (contact === originalContact) errors.same = true;
                                if (Object.keys(errors).length === 0) {
                                  infoModalOpen = true;
                                }
                            " 
                            class="w-full md:w-1/6 h-12 bg-[#014421] rounded-md text-white hover:bg-green-800 flex items-center justify-center">Save changes</button>
            </div>
            <div x-show="infoModalOpen" x-transition:enter.duration.25ms class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg w-5/6 md:w-1/3">
                    <div class="flex flex-col">
                      <div class="flex flex-row items-center gap-2 sm:gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#014421" class="size-5 sm:size-7">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <p class="text-xl font-semibold text-[#014421]">Reminder</p>
                      </div>
                      <p class="text-xs md:text-sm mt-2 sm:ml-2 text-justify">Do you wish to save your changes?</p>
                    </div>
                    <div class="text-xs md:text-sm mt-2 md:mt-5 border border-gray-500 shawod:md rounded-md p-2">
                      <p class="font-medium text-lg ml-1">Summary of changes</p>
                      <div class="flex flex-col gap-1 text-sm ml-5 px-3 py-1">
                        <ul class="list-inside list-disc mt-2">
                          <li x-show="contact" x-text="'Contact Number: ' + contact"></li>
                          <li x-show="constituent !== selectedConstituent" x-text="'Type of constituent: ' + constituent" style="text-transform: capitalize;"></li>
                          <li x-show="college !== selectedCollege" x-text="'College: ' + college"></li>
                          <li x-show="degprog !== selectedDegprog && constituent !== 'staff'" x-text="degprog !== 'Not Applicable'? 'Degree Program: ' + degprog : ''"></li>
                        </ul>
                      </div>

                    </div>
                    <div class="mt-5 flex justify-end gap-2">
                        <button @click="infoModalOpen = false" class="font-medium px-2 sm:px-3 py-1 sm:py-1.5 text-sm sm:text-base bg-white border border-[#014421] text-[#014421] rounded-md hover:bg-slate-100">Cancel</button>
                        <button wire:click="saveInfoChanges" class=" font-medium px-2 sm:px-3 py-1 sm:py-1.5 text-sm sm:text-base bg-[#014421] text-white rounded-md hover:bg-green-800">Confirm</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <!-- PASSWORD INFO --> 
        <div x-data="{ current_password: $wire.entangle('current_password'), originalPassword: '{{ $user->password }}', new_password: $wire.entangle('new_password'), confirm_new_pass: '', showCurrentPassword: false, showNewPassword: false, showConfirmPassword: false }" class="mb-4">
          <div class="bg-white rounded-lg shadow-sm sm:shadow-md p-8">
            <p x-text="originalPassword"></p>
            <p class="text-lg sm:text-xl font-semibold">Password Information</p>
            <div class="flex flex-col sm:flex-row">
              <div class="flex flex-col w-full mt-4">
                <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 ">Current Password</label>
                  <div class="relative w-full">
                    <input :type="showCurrentPassword ? 'text' : 'password'" id="current_password" x-model="current_password" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                    x-bind:class="{'border-red-500': errors.repeat_password || (repeat_password !== password && repeat_password.length > 0)}">
                    <button type="button" @click="showCurrentPassword = !showCurrentPassword" class="absolute top-1/2 right-11 transform -translate-y-1/2 text-slate-400 focus:outline-none">
                        <svg x-show="!showCurrentPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg x-show="showCurrentPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                  </div>
              </div>
              <div class="flex flex-col w-full mt-4">
                <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 ">New Password</label>
                <div class="relative w-full">
                    <input :type="showNewPassword ? 'text' : 'password'" id="new_password" x-model="new_password" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                    x-bind:class="{'border-red-500': errors.repeat_password || (repeat_password !== password && repeat_password.length > 0)}">
                    <button type="button" @click="showNewPassword = !showNewPassword" class="absolute top-1/2 right-11 transform -translate-y-1/2 text-slate-400 focus:outline-none">
                        <svg x-show="!showNewPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg x-show="showNewPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                  </div>
              </div>
            </div>
            <div class="flex flex-col sm:flex-row mt-4">
              <div class="flex flex-col w-full">
                <label for="confirm_new_pass" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm New Password</label>
                <div class="relative w-full">
                    <input :type="showConfirmPassword ? 'text' : 'password'" id="confirm_new_pass" x-model="confirm_new_pass " class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] block p-2.5"
                                    x-bind:class="{'border-red-500': errors.repeat_password || (repeat_password !== password && repeat_password.length > 0)}">
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute top-1/2 right-11 transform -translate-y-1/2 text-slate-400 focus:outline-none">
                        <svg x-show="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg x-show="showConfirmPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                  </div>
              </div>
              <!-- HIDDEN -->
              <div class="flex flex-col w-full">
                <label for="new_password" class="mb-2 text-sm font-medium text-gray-900 hidden">New Password</label>
                <input type="password" id="new_password" class="hidden w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#014421] p-2.5"  placeholder="{{ $user->new_password }}"/>
              </div>
            </div>
            <div class="mt-4 flex flex-col sm:w-1/2 text-sm">
              <p class="font-medium text-base"> Password requirements: </p>
              <div class="sm:ml-5">
                <p class="mt-2">Ensure that these requirements are met:</p>
                <ul class="list-disc list-inside">
                    <li class="">At least 8 characters (and up to 40 characters)</li>
                    <li>At least one uppercase character</li>
                </ul>
              </div>

            </div>
            <div class="mt-6 flex justify-start">
              <button class="font-medium py-2 px-3 bg-[#014421] hover:bg-green-800 text-white text-sm rounded-md" :disabled="">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>