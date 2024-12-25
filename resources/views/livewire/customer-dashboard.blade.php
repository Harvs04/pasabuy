<div class="antialiased bg-[#f2f2f2] font-montserrat">
    <nav class="bg-[#014421] border-b border-gray-200 px-4 py-2.5 fixed left-0 right-0 top-0 z-50">
      <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
          <a href="{{ route('dashboard') }}" class="flex items-center justify-between mr-4">
            <img
              src={{ asset('assets/Pasabuy-logo-no-name.png') }}
              class="mr-3 h-12"
              alt="Flowbite Logo"
            />
            <span class="self-center text-xl font-bold whitespace-nowrap dark:text-white">PASABUY</span>
          </a>
          <form action="#" method="GET" class="hidden md:block md:pl-2">
            <label for="topbar-search" class="sr-only">Search</label>
            <div class="relative md:w-64 lg:w-96">
              <div
                class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
              >
                <svg
                  class="w-5 h-5 text-gray-500 dark:text-gray-400"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  ></path>
                </svg>
              </div>
              <input
                type="text"
                name="email"
                id="topbar-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 "
                placeholder="Search items, store name."
              />
            </div>
          </form>
        </div>
        <div class="flex items-center lg:order-2">
          <button
            type="button"
            data-drawer-toggle="drawer-navigation"
            aria-controls="drawer-navigation"
            class="p-2 mr-1 text-gray-500 rounded-lg md:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
          >
            <span class="sr-only">Toggle search</span>
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path clip-rule="evenodd" fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"></path>
            </svg>
          </button>
          <button
            type="button"
            class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            id="user-menu-button"
            aria-expanded="false"
            data-dropdown-toggle="dropdown"
          >
            <span class="sr-only">Open user menu</span>
            <img
              class="w-8 h-8 rounded-full"
              src={{ $user->profile_pic }}
              alt="user photo"
            />
          </button>
        </div>
      </div>
    </nav>

    <!-- Sidebar -->

    <aside
      class="fixed top-0 left-0 z-40 w-72 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-[#bcbcbc] md:translate-x-0"
      aria-label="Sidenav"
      id="drawer-navigation"
    >
      <div class="overflow-y-auto py-5 px-3 h-full bg-[#f2f2f2] text-[#7b1113]">
        <form action="#" method="GET" class="md:hidden mb-2">
          <label for="sidebar-search" class="sr-only">Search</label>
          <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
              <svg
                class="w-5 h-5 text-gray-500 dark:text-gray-400"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                ></path>
              </svg>
            </div>
            <input
              type="text"
              name="search"
              id="sidebar-search"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Search"
            />
          </div>
        </form>
        <ul class="space-y-2">
          <li>
            <a href="#" class="flex items-center p-2 text-base font-medium rounded-lg border border-transparent my-1 mb-3 group">
              <img
                src={{ $user->profile_pic }}
                class="mr-3 h-10 rounded-full"
                alt="User photo"
              />
              <span class="self-center text-base text-[#014421] font-medium whitespace-nowrap ">{{ $user->name }}</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 text-base font-medium rounded-lg border border-transparent hover:border-[#7b1113] group {{ request()->is('dashboard') ? 'border-2 border-[#7b1113]' : '' }}">
              <svg width="25" height="25" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 7.27832L35.5117 19.3417C35.5981 19.4088 35.6705 19.4924 35.7246 19.5876C35.7788 19.6827 35.8137 19.7876 35.8273 19.8963C35.8409 20.0049 35.833 20.1152 35.804 20.2208C35.775 20.3264 35.7255 20.4252 35.6583 20.5117C35.5911 20.5981 35.5076 20.6705 35.4124 20.7246C35.3172 20.7788 35.2123 20.8137 35.1037 20.8273C34.9951 20.8409 34.8848 20.833 34.7792 20.804C34.6736 20.775 34.5748 20.7255 34.4883 20.6583L32.5 19.1117V33.3333C32.5 33.5543 32.4122 33.7663 32.2559 33.9226C32.0996 34.0789 31.8877 34.1667 31.6667 34.1667C31.4456 34.1667 31.2337 34.0789 31.0774 33.9226C30.9211 33.7663 30.8333 33.5543 30.8333 33.3333V17.815L20 9.38832L9.16666 17.8167V33.3333C9.16666 33.5543 9.07886 33.7663 8.92258 33.9226C8.7663 34.0789 8.55434 34.1667 8.33332 34.1667C8.11231 34.1667 7.90035 34.0789 7.74407 33.9226C7.58779 33.7663 7.49999 33.5543 7.49999 33.3333V19.1117L5.51166 20.6583C5.33706 20.794 5.1157 20.8548 4.89628 20.8273C4.67687 20.7998 4.47736 20.6863 4.34166 20.5117C4.20596 20.3371 4.14517 20.1157 4.17268 19.8963C4.20018 19.6769 4.31372 19.4774 4.48833 19.3417L7.49999 17V12.5C7.49999 12.058 7.67559 11.634 7.98815 11.3215C8.30071 11.0089 8.72463 10.8333 9.16666 10.8333H10.8333C11.2754 10.8333 11.6993 11.0089 12.0118 11.3215C12.3244 11.634 12.5 12.058 12.5 12.5V13.1117L20 7.27832ZM10.8333 14.25V12.5H9.16666V15.5L10.8333 14.25Z" fill="#7B1113"/>
                <path d="M17.5 24.1667C17.279 24.1667 17.067 24.2545 16.9107 24.4107C16.7545 24.567 16.6667 24.779 16.6667 25V33.3333C16.6667 33.5543 16.5789 33.7663 16.4226 33.9226C16.2663 34.0789 16.0543 34.1667 15.8333 34.1667C15.6123 34.1667 15.4004 34.0789 15.2441 33.9226C15.0878 33.7663 15 33.5543 15 33.3333V25C15 24.337 15.2634 23.7011 15.7322 23.2322C16.2011 22.7634 16.837 22.5 17.5 22.5H22.5C23.163 22.5 23.7989 22.7634 24.2678 23.2322C24.7366 23.7011 25 24.337 25 25V33.3333C25 33.5543 24.9122 33.7663 24.7559 33.9226C24.5996 34.0789 24.3877 34.1667 24.1667 34.1667C23.9457 34.1667 23.7337 34.0789 23.5774 33.9226C23.4211 33.7663 23.3333 33.5543 23.3333 33.3333V25C23.3333 24.779 23.2455 24.567 23.0893 24.4107C22.933 24.2545 22.721 24.1667 22.5 24.1667H17.5Z" fill="#7B1113"/>
              </svg>


              <span class="ml-3">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 text-base font-medium rounded-lg border border-transparent hover:border-[#7b1113] group {{ request()->is('messages') ? 'border-2 border-[#7b1113]' : '' }}">
              <svg width="25" height="25" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.00002 17.1428C5.00034 14.7955 5.7715 12.5132 7.19496 10.6468C8.61843 8.78038 10.6154 7.43306 12.8791 6.81191C15.1427 6.19076 17.5477 6.33016 19.7244 7.20869C21.9011 8.08722 23.729 9.65625 24.9273 11.6746C26.1256 13.693 26.6279 16.0491 26.357 18.3807C26.0861 20.7123 25.057 22.8905 23.4279 24.5804C21.7988 26.2703 19.6598 27.3785 17.3397 27.7345C15.0195 28.0906 12.6467 27.6749 10.5857 26.5514C10.3435 26.419 10.0594 26.3852 9.79288 26.4571L5.15002 27.6999L6.39574 23.0542C6.46687 22.7885 6.43311 22.5057 6.30145 22.2642C5.44458 20.6934 4.99701 18.9321 5.00002 17.1428ZM15.7143 4.28564C13.5216 4.28523 11.3651 4.84563 9.45003 5.91357C7.53492 6.98151 5.92476 8.5215 4.77261 10.3872C3.62046 12.2528 2.9646 14.3822 2.86738 16.5727C2.77016 18.7633 3.23481 20.9424 4.21716 22.9028L2.92002 27.7442C2.83929 28.0468 2.83954 28.3652 2.92075 28.6677C3.00196 28.9701 3.16126 29.2458 3.38268 29.4673C3.60411 29.6887 3.87986 29.848 4.18229 29.9292C4.48472 30.0104 4.80318 30.0107 5.10574 29.9299L9.94431 28.6356C11.6784 29.5053 13.5869 29.9713 15.5267 29.9986C17.4664 30.026 19.3873 29.6141 21.1452 28.7936C22.9032 27.9732 24.4527 26.7657 25.6777 25.2613C26.9027 23.757 27.7714 21.995 28.2187 20.1073C28.666 18.2196 28.6804 16.2552 28.2606 14.3611C27.8409 12.4671 26.998 10.6926 25.7951 9.17059C24.5922 7.64857 23.0605 6.41849 21.3147 5.57252C19.5689 4.72654 17.6543 4.28659 15.7143 4.28564ZM24.2857 35.7142C22.4679 35.7162 20.6705 35.3318 19.0125 34.5865C17.3545 33.8413 15.8738 32.7521 14.6686 31.3914C15.6735 31.4653 16.6834 31.4328 17.6814 31.2942C19.565 32.7727 21.8912 33.5748 24.2857 33.5714C26.0779 33.5743 27.8418 33.1252 29.4143 32.2656C29.6566 32.1332 29.9406 32.0995 30.2072 32.1714L34.85 33.4142L33.6043 28.7685C33.5332 28.5028 33.5669 28.22 33.6986 27.9785C34.5532 26.4068 35.0006 24.6461 35 22.8571C35.0005 20.9549 34.4947 19.0869 33.5343 17.4449C32.574 15.803 31.1939 14.4463 29.5357 13.5142C29.2791 12.539 28.92 11.5938 28.4643 10.6942C30.1981 11.2904 31.7844 12.2502 33.1169 13.5096C34.4495 14.7689 35.4974 16.2985 36.1904 17.9959C36.8835 19.6932 37.2056 21.5192 37.1353 23.3513C37.0651 25.1833 36.6039 26.9792 35.7829 28.6185L37.08 33.4585C37.1609 33.7612 37.1606 34.0798 37.0794 34.3824C36.9981 34.685 36.8387 34.9609 36.6171 35.1824C36.3954 35.4038 36.1194 35.5631 35.8168 35.6442C35.5142 35.7252 35.1955 35.7253 34.8929 35.6442L30.0557 34.3499C28.265 35.248 26.2891 35.7152 24.2857 35.7142Z" fill="#7B1113"/>
              </svg>


              <span class="flex-1 ml-3 whitespace-nowrap">Messages</span>
              <span
                class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-[#f2f2f2] bg-[#7b1113]"
              >
                4
              </span>
            </a>
          </li>
          <li>
            <a
              href="#"
              class="flex items-center p-2 text-base font-medium rounded-lg border border-transparent hover:border-[#7b1113] group {{ request()->is('saved') ? 'border-2 border-[#7b1113]' : '' }}"
              aria-controls="dropdown-pages"
              data-collapse-toggle="dropdown-pages"
            >
              <svg width="25" height="25" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 32.5001V9.36008C10 8.5923 10.2572 7.95175 10.7717 7.43841C11.2861 6.92508 11.9267 6.66786 12.6933 6.66675H27.3083C28.075 6.66675 28.7156 6.92397 29.23 7.43841C29.7444 7.95286 30.0011 8.59342 30 9.36008V32.5001L20 28.2051L10 32.5001ZM11.6667 29.9167L20 26.3334L28.3333 29.9167V9.36008C28.3333 9.10342 28.2267 8.86786 28.0133 8.65341C27.8 8.43897 27.5644 8.3323 27.3067 8.33341H12.6933C12.4367 8.33341 12.2011 8.44008 11.9867 8.65341C11.7722 8.86675 11.6656 9.1023 11.6667 9.36008V29.9167Z" fill="#7B1113"/>
              </svg>

              <span class="flex-1 ml-3 text-left whitespace-nowrap"
                >Saved</span
              >
          </a>
          </li>
          <li>
            <a
              href="#"
              class="flex items-center p-2 w-full text-base font-medium text-[#7b1113] rounded-lg border border-transparent hover:border-[#7b1113] transition duration-75 group {{ request()->is('orders') ? 'border-2 border-[#7b1113]' : '' }}"
              aria-controls="dropdown-sales"
              data-collapse-toggle="dropdown-sales"
            >
              <svg width="25" height="25" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M26.6667 30C27.5507 30 28.3986 30.3512 29.0237 30.9763C29.6488 31.6014 30 32.4493 30 33.3333C30 34.2174 29.6488 35.0652 29.0237 35.6904C28.3986 36.3155 27.5507 36.6667 26.6667 36.6667C25.7826 36.6667 24.9348 36.3155 24.3097 35.6904C23.6845 35.0652 23.3334 34.2174 23.3334 33.3333C23.3334 32.4493 23.6845 31.6014 24.3097 30.9763C24.9348 30.3512 25.7826 30 26.6667 30ZM26.6667 31.6667C26.2247 31.6667 25.8007 31.8423 25.4882 32.1548C25.1756 32.4674 25 32.8913 25 33.3333C25 33.7754 25.1756 34.1993 25.4882 34.5118C25.8007 34.8244 26.2247 35 26.6667 35C27.1087 35 27.5326 34.8244 27.8452 34.5118C28.1578 34.1993 28.3334 33.7754 28.3334 33.3333C28.3334 32.8913 28.1578 32.4674 27.8452 32.1548C27.5326 31.8423 27.1087 31.6667 26.6667 31.6667ZM11.6667 30C12.5507 30 13.3986 30.3512 14.0237 30.9763C14.6488 31.6014 15 32.4493 15 33.3333C15 34.2174 14.6488 35.0652 14.0237 35.6904C13.3986 36.3155 12.5507 36.6667 11.6667 36.6667C10.7826 36.6667 9.93478 36.3155 9.30966 35.6904C8.68454 35.0652 8.33335 34.2174 8.33335 33.3333C8.33335 32.4493 8.68454 31.6014 9.30966 30.9763C9.93478 30.3512 10.7826 30 11.6667 30ZM11.6667 31.6667C11.2247 31.6667 10.8007 31.8423 10.4882 32.1548C10.1756 32.4674 10 32.8913 10 33.3333C10 33.7754 10.1756 34.1993 10.4882 34.5118C10.8007 34.8244 11.2247 35 11.6667 35C12.1087 35 12.5326 34.8244 12.8452 34.5118C13.1578 34.1993 13.3334 33.7754 13.3334 33.3333C13.3334 32.8913 13.1578 32.4674 12.8452 32.1548C12.5326 31.8423 12.1087 31.6667 11.6667 31.6667ZM30 10H7.11669L11.3667 20H25C25.55 20 26.0334 19.7333 26.3334 19.3333L31.3334 12.6667C31.55 12.3833 31.6667 12.0333 31.6667 11.6667C31.6667 11.2246 31.4911 10.8007 31.1785 10.4882C30.866 10.1756 30.442 10 30 10ZM25 21.6667H11.45L10.1667 24.2667L10 25C10 25.442 10.1756 25.8659 10.4882 26.1785C10.8007 26.4911 11.2247 26.6667 11.6667 26.6667H30V28.3333H11.6667C10.7826 28.3333 9.93478 27.9821 9.30966 27.357C8.68454 26.7319 8.33335 25.8841 8.33335 25C8.33286 24.4345 8.47624 23.8782 8.75002 23.3833L9.95002 20.9333L3.90002 6.66667H1.66669V5H5.00002L6.41669 8.33333H30C30.8841 8.33333 31.7319 8.68452 32.357 9.30964C32.9822 9.93476 33.3334 10.7826 33.3334 11.6667C33.3334 12.5 33.05 13.2 32.5834 13.7667L27.7334 20.25C27.1334 21.1 26.1334 21.6667 25 21.6667Z" fill="#7B1113"/>
              </svg>

              <span class="flex-1 ml-3 text-left whitespace-nowrap"
                >My Orders</span
              >
            </a>
          </li>
          <li>
            <a
              href="#"
              class="flex items-center p-2 w-full text-base font-medium text-[#7b1113] rounded-lg border border-transparent hover:border-[#7b1113] transition duration-75 group {{ request()->is(patterns: 'history') ? 'border-2 border-[#7b1113]' : '' }}"
              aria-controls="dropdown-authentication"
              data-collapse-toggle="dropdown-authentication"
            >
              <svg width="25" height="25" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 8.00006C22.4128 7.99999 24.7696 8.72725 26.7628 10.0869C28.756 11.4466 30.293 13.3756 31.1733 15.6221C32.0535 17.8686 32.2361 20.3282 31.6973 22.6801C31.1584 25.0319 29.9231 27.1667 28.1526 28.8058C26.382 30.445 24.1585 31.5123 21.7721 31.8685C19.3858 32.2248 16.9475 31.8534 14.7754 30.8028C12.6033 29.7523 10.7984 28.0713 9.59616 25.9794C8.39392 23.8875 7.85022 21.4817 8.036 19.0761C8.04598 18.945 8.03005 18.8133 7.98912 18.6884C7.94818 18.5635 7.88305 18.4478 7.79743 18.3481C7.71182 18.2484 7.6074 18.1665 7.49013 18.1071C7.37287 18.0477 7.24506 18.012 7.114 18.0021C6.98294 17.9921 6.8512 18.008 6.7263 18.0489C6.60139 18.0899 6.48578 18.155 6.38605 18.2406C6.28632 18.3262 6.20443 18.4307 6.14505 18.5479C6.08568 18.6652 6.04998 18.793 6.04 18.9241C6.01333 19.2814 6 19.6401 6 20.0001C6.00001 23.2452 7.12734 26.3895 9.18921 28.8954C11.2511 31.4012 14.1194 33.113 17.3038 33.7379C20.4882 34.3629 23.7907 33.8622 26.6468 32.3216C29.5028 30.7809 31.735 28.2959 32.9615 25.2915C34.188 22.2871 34.3328 18.95 33.371 15.8507C32.4092 12.7514 30.4006 10.0824 27.6887 8.30026C24.9767 6.51808 21.7299 5.73335 18.5034 6.08025C15.2769 6.42715 12.2711 7.88413 10 10.2021V7.00006C10 6.73485 9.89464 6.48049 9.70711 6.29296C9.51957 6.10542 9.26522 6.00006 9 6.00006C8.73478 6.00006 8.48043 6.10542 8.29289 6.29296C8.10536 6.48049 8 6.73485 8 7.00006V13.0001C8 13.2653 8.10536 13.5196 8.29289 13.7072C8.48043 13.8947 8.73478 14.0001 9 14.0001H15C15.2652 14.0001 15.5196 13.8947 15.7071 13.7072C15.8946 13.5196 16 13.2653 16 13.0001C16 12.7348 15.8946 12.4805 15.7071 12.293C15.5196 12.1054 15.2652 12.0001 15 12.0001H11.056C12.1799 10.7397 13.558 9.73161 15.0996 9.04217C16.6412 8.35274 18.3113 7.99758 20 8.00006ZM20 13.0001C20 12.7348 19.8946 12.4805 19.7071 12.293C19.5196 12.1054 19.2652 12.0001 19 12.0001C18.7348 12.0001 18.4804 12.1054 18.2929 12.293C18.1054 12.4805 18 12.7348 18 13.0001V21.0001C18 21.2653 18.1054 21.5196 18.2929 21.7072C18.4804 21.8947 18.7348 22.0001 19 22.0001H25C25.2652 22.0001 25.5196 21.8947 25.7071 21.7072C25.8946 21.5196 26 21.2653 26 21.0001C26 20.7348 25.8946 20.4805 25.7071 20.293C25.5196 20.1054 25.2652 20.0001 25 20.0001H20V13.0001Z" fill="#7B1113"/>
              </svg>

              <span class="flex-1 ml-3 text-left whitespace-nowrap"
                >Pasabuy History</span
              >
            </a>
          </li>
        </ul>
        <ul
          class="pt-5 mt-5 space-y-2 border-t border-[#bcbcbc]"
        >
          <li>
            <a
              href="#"
              class="flex items-center p-2 text-base font-medium text-[#7b1113] rounded-lg border border-transparent hover:border-[#7b1113] transition duration-75 group"
            >
              <svg width="23" height="23" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M29.0625 18.8831C29.0625 14.0419 26.3887 9.78376 22.2506 7.47001L24.1988 3.96376C24.3798 3.63754 24.4238 3.25278 24.3211 2.89412C24.2184 2.53546 23.9775 2.23227 23.6513 2.05126C23.325 1.87025 22.9403 1.82624 22.5816 1.92892C22.2229 2.0316 21.9198 2.27254 21.7387 2.59876L19.6575 6.34314C18.1518 5.86289 16.5804 5.6206 15 5.62501C13.419 5.6204 11.8469 5.8627 10.3406 6.34314L8.25938 2.59876C8.17427 2.42933 8.05577 2.27885 7.91101 2.15639C7.76625 2.03392 7.59823 1.942 7.41703 1.88614C7.23584 1.83028 7.04522 1.81164 6.85663 1.83134C6.66805 1.85104 6.4854 1.90868 6.31966 2.00079C6.15392 2.09289 6.00852 2.21756 5.8922 2.3673C5.77588 2.51704 5.69105 2.68876 5.6428 2.87213C5.59455 3.05549 5.58388 3.24673 5.61143 3.43432C5.63898 3.62192 5.70419 3.80201 5.80313 3.96376L7.74937 7.47001C3.61125 9.78376 0.9375 14.0419 0.9375 18.8813C0.9375 20.4056 1.25437 21.8869 2.08875 23.1825C2.92875 24.4894 4.1325 25.3538 5.45437 25.92C7.92562 26.9813 11.2875 27.1875 15 27.1875C18.7125 27.1875 22.0744 26.9813 24.5438 25.9219C25.8694 25.3556 27.0712 24.4913 27.9112 23.1844C28.7475 21.8888 29.0625 20.4075 29.0625 18.8831ZM3.75 18.8831C3.75 23.4375 7.5 24.375 15 24.375C22.5 24.375 26.25 23.4375 26.25 18.8831C26.25 13.2581 21.5625 8.43751 15 8.43751C8.4375 8.43751 3.75 13.2563 3.75 18.8813M19.6875 21.0919C19.3145 21.0919 18.9569 20.9437 18.6931 20.68C18.4294 20.4163 18.2812 20.0586 18.2812 19.6856V16.875C18.2812 16.5021 18.4294 16.1444 18.6931 15.8806C18.9569 15.6169 19.3145 15.4688 19.6875 15.4688C20.0605 15.4688 20.4181 15.6169 20.6819 15.8806C20.9456 16.1444 21.0938 16.5021 21.0938 16.875V19.6875C21.0938 20.0605 20.9456 20.4182 20.6819 20.6819C20.4181 20.9456 20.0605 21.0938 19.6875 21.0938M8.90625 19.6875C8.90625 20.0605 9.05441 20.4182 9.31813 20.6819C9.58185 20.9456 9.93954 21.0938 10.3125 21.0938C10.6855 21.0938 11.0431 20.9456 11.3069 20.6819C11.5706 20.4182 11.7187 20.0605 11.7188 19.6875V16.875C11.7187 16.5021 11.5706 16.1444 11.3069 15.8806C11.0431 15.6169 10.6855 15.4688 10.3125 15.4688C9.93954 15.4688 9.58185 15.6169 9.31813 15.8806C9.05441 16.1444 8.90625 16.5021 8.90625 16.875V19.6875Z" fill="#7B1113"/>
              </svg>


              <span class="ml-3">Navigation Chatbot</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- setting icon -->
      <!-- <svg
        aria-hidden="true"
        class="w-6 h-6"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
          clip-rule="evenodd"
        ></path>
      </svg> -->
    </aside>

    <main class="p-4 md:ml-72 h-auto pt-20">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div
          class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 h-32 md:h-64"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"
        ></div>
      </div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
      ></div>
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
      </div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
      ></div>
      <div class="grid grid-cols-2 gap-4">
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
      </div>
    </main>
  </div>