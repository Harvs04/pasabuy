<div x-data="{ activeTab: 'Profile' }" class="mx-4 min-h-screen max-w-screen-xl sm:mx-8 xl:mx-auto font-montserrat">
  <div class="flex flex-row items-center gap-5 mt-5">
    <a href={{ route('dashboard') }}>
      <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.75 18.75H33.75C34.0815 18.75 34.3995 18.8817 34.6339 19.1161C34.8683 19.3505 35 19.6685 35 20C35 20.3315 34.8683 20.6495 34.6339 20.8839C34.3995 21.1183 34.0815 21.25 33.75 21.25H8.75C8.41848 21.25 8.10054 21.1183 7.86612 20.8839C7.6317 20.6495 7.5 20.3315 7.5 20C7.5 19.6685 7.6317 19.3505 7.86612 19.1161C8.10054 18.8817 8.41848 18.75 8.75 18.75Z" fill="black"/>
        <path d="M9.26751 20.0001L19.635 30.3651C19.8697 30.5998 20.0016 30.9182 20.0016 31.2501C20.0016 31.5821 19.8697 31.9004 19.635 32.1351C19.4003 32.3698 19.0819 32.5017 18.75 32.5017C18.4181 32.5017 18.0997 32.3698 17.865 32.1351L6.61501 20.8851C6.4986 20.769 6.40624 20.6311 6.34323 20.4792C6.28021 20.3273 6.24777 20.1645 6.24777 20.0001C6.24777 19.8357 6.28021 19.6729 6.34323 19.521C6.40624 19.3692 6.4986 19.2312 6.61501 19.1151L17.865 7.86511C18.0997 7.6304 18.4181 7.49854 18.75 7.49854C19.0819 7.49854 19.4003 7.6304 19.635 7.86511C19.8697 8.09983 20.0016 8.41817 20.0016 8.75011C20.0016 9.08205 19.8697 9.4004 19.635 9.63511L9.26751 20.0001Z" fill="black"/>
      </svg>
    </a>
    <div class="w-full flex flex-row items-center justify-between">
      <p x-text="activeTab" class="border-b sm:ml-3 py-6 text-3xl md:text-4xl font-semibold"></p>
      <div class="relative my-4 sm:hidden">
        <select x-model="activeTab" class="w-full">
          <option value="Profile">Account</option>
          <option value="Settings">Settings</option>
        </select>
      </div>
    </div>
  </div>
  <div class="grid grid-cols-8 sm:grid-cols-10"> 
    <div class="col-span-2 hidden sm:block">
      <ul>
        <li
          @click="activeTab = 'Profile'"
          :class="{'border-l-2 border-l-blue-700 text-blue-700': activeTab === 'Profile'}"
          class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700"
        >
          Profile
        </li>
        <li
          @click="activeTab = 'Settings'"
          :class="{'border-l-2 border-l-blue-700 text-blue-700': activeTab === 'Settings'}"
          class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700"
        >
          Settings
        </li>
      </ul>
    </div>
    <div x-show="activeTab === 'Profile'" class="w-5/6 sm:w-full col-span-8 overflow-hidden rounded-xl sm:bg-gray-50 sm:px-8 sm:shadow">
      <div class="mt-5">
        <p class="py-2 text-xl font-semibold">Email Address</p>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
          <p class="text-gray-600">Your email address is <strong>john.doe@company.com</strong></p>
          <button class="inline-flex text-sm font-semibold text-blue-600 underline decoration-2">Change</button>
        </div>
      </div>
      <hr class="my-5" />
      <p class="text-xl font-semibold">Password</p>
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
        <p class="text-xl font-semibold">Delete Account</p>
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
    <div x-show="activeTab === 'Settings'" class="col-span-8 overflow-hidden rounded-xl sm:bg-gray-50 sm:px-8 sm:shadow">
      <div class="mt-5">
        <p class="py-2 text-xl font-semibold">Email Address</p>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
          <p class="text-gray-600">Your email address is <strong>john.doe@company.com</strong></p>
          <button class="inline-flex text-sm font-semibold text-blue-600 underline decoration-2">Change</button>
        </div>
      </div>
      <hr class="my-5" />
      <p class="text-xl font-semibold">Password</p>
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
        <p class="text-xl font-semibold">Delete Account</p>
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