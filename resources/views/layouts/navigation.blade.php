<nav x-data="{ open: false }"
    class="flex flex-col justify-between items-center h-screen max-h-full bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 p-10 gap-32">

    <!-- Primary Navigation Menu -->
    <div class="">
        <!-- Logo -->
        <div class="mb-10">
            <a href="{{ route('dashboard') }}">
                <div class="text-lg font-bold">
                    <h1 class="text-white text-2xl">DigiSchool</h1>
                </div>
                {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> --}}
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex flex-col gap-8">
            <div>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Acceuil') }}
                </x-nav-link>
            </div>
            <div>
                <x-nav-link :href="route('notes')" :active="request()->routeIs('notes')">
                    {{ __('Notes') }}
                </x-nav-link>
            </div>
            <div>
                <x-nav-link :href="route('statistiques')" :active="request()->routeIs('statistiques')">
                    {{ __('Statistiques') }}
                </x-nav-link>
            </div>
        </div>
    </div>

    <!-- Settings Dropdown -->
    <div class="flex justify-center mb-12 w-max">
        <x-dropdown align="left" width="48" class="origin-top">
            <x-slot name="trigger">
                <button class="flex flex-row text-gray-500 dark:text-gray-400">
                    <div>{{ Auth::user()->name }}</div>
                    <div>
                        <svg class="fill-current h-4 w-4 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

    {{-- <!-- Hamburger -->
    <div>
        <button @click="open = ! open" class="text-gray-400 dark:text-gray-500">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }">
        <div>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div>
            <div>
                <div>{{ Auth::user()->name }}</div>
                <div>{{ Auth::user()->email }}</div>
            </div>

            <div>
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div> --}}
</nav>
