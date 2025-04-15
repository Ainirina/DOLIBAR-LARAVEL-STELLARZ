<header class="sticky top-0 z-50 flex w-full border-b border-gray-200 bg-[--Black] dark:border-gray-800 dark:bg-gray-900">
    <div class="flex w-full items-center justify-between px-4 py-2">
        <!-- Bouton Menu Mobile -->
        <button id="menu-btn" class="lg:hidden p-2 rounded-lg text-gray-500 dark:text-gray-400">
            <i class="pi pi-bars text-xl"></i>
        </button>

        <!-- Logo -->
        <div class="w-10 h-10 flex sm:justify-center items-center fill-current">
            {{-- <x-ApplicationLogo /> --}}
        </div>

        <!-- Boutons -->
        <div class="flex items-center gap-4">

          <!-- Shearch Menu Area -->
          <div class=" bg-[--Black] dark:bg-slate-950 flex items-center content-center justify-center rounded-lg pl-3">
            <div class="w-7 shrink-0">
                <!-- Icône de recherche -->
                <i class="pi pi-search" aria-hidden="true"></i>
            </div>
            <input type="text" class="bg-transparent block border-none min-w-0 grow py-1.5 pl-1 pr-3 text-base placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6 focus-visible:ring-0"
                placeholder="Search" />
        </div>

        <!-- Shearch Menu Area -->

          <!-- Notification Menu Area -->
          <div id="notification-btn" class="relative">
            <button class="hover:text-dark-900 relative flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-[--Black] text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-slate-950 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white" @click.prevent="dropdownOpen = ! dropdownOpen; notifying = false">
              <span :class="!notifying ? 'hidden' : 'flex'" class="absolute right-0 top-0.5 z-1 h-2 w-2 rounded-full bg-orange-400 flex">
                <span class="absolute -z-1 inline-flex h-full w-full animate-ping rounded-full bg-[--Primary] opacity-75"></span>
              </span>
              <i class="pi pi-bell" style="font-size: 1rem"></i>
            </button>
          </div>
          <!-- Notification Menu Area -->

            <!-- Profil -->
            <div class="relative">
                <button id="profile-btn" class="gap-2 p-2 bg-[--Black] rounded-lg text-gray-700 dark:text-gray-400">
                    <span class="hover:text-dark-900 relative flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-[--Black] text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">AD</span>
                </button>

                <!-- Profil Menu Déroulant -->
                <div id="profile-menu" class="hidden absolute right-0 mt-2 flex-col p-3 w-52 bg-[--Black] dark:bg-gray-800 border rounded-lg shadow-lg">
                    <ul class="flex flex-col gap-1 border-b border-gray-200 pb-3 pt-4 dark:border-gray-800">
                        <li>
                            <a href="Dashboard" class="group flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:bg-[--Black]/5 dark:hover:text-gray-300">
                                <i class="pi pi-cog" style="font-size: 1rem"></i>
                            Account settings
                            </a>
                        </li>
                        <li>
                            <button class="group w-full flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300" onclick="toggleDarkMode()">
                                <i class="pi pi-moon" style="font-size: 1rem"></i>
                            Dark mode
                              </button>
                        </li>
                        <li>
                            <a href="#" class="group flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                <i class="pi pi-info-circle" style="font-size: 1rem"></i>
                            Support
                            </a>
                        </li>
                    </ul>
                        <button class="group mt-3 flex items-center gap-3 w-full rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                            <i class="pi pi-sign-out" style="font-size: 1rem"></i>
                            <a href="{{ route('admin-Logout') }}"> Sign out</a>
                        </button>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
// Mode sombre
if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    function toggleDarkMode() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    }

// Menu profil
const profileBtn = document.getElementById("profile-btn");
const profileMenu = document.getElementById("profile-menu");

profileBtn.addEventListener("click", () => {
    profileMenu.classList.toggle("hidden");
});

// Fermer le menu profil si on clique ailleurs
document.addEventListener("click", (event) => {
    if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
        profileMenu.classList.add("hidden");
    }
});
</script>
