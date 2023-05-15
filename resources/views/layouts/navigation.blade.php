<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                @if (auth()->user())
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard.index') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                    </div>
                @else
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('utilizador.dashboard.index') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                    </div>
                @endif
                <!-- Navigation Links -->
                @if (auth()->user())
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                    </div>
                @else
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('utilizador.dashboard.index')" :active="request()->routeIs('utilizador.dashboard.index')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            {{-- <div class="hidden sm:flex sm:items-center sm:ml-6"> --}}
            {{-- <x-dropdown align="right" width="48"> --}}
            {{-- <x-slot name="trigger"> --}}
            <button
                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                @if (auth()->user())
                    {{-- <div>{{ Auth::user()->name }}</div> --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>
                @else
                    {{-- <a href="{{ route('login') }}">Log in</a> --}}
                @endif

            </button>
            {{-- </x-slot> --}}
            @if (auth()->user())
                <x-slot name="content">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            @else
            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 rounded-pill focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                    href="{{ route('login') }}">Login</a>
                </button>
                {{-- <x-dropdown-link :href="route('login')">
                            {{ __('Log in') }}
                        </x-dropdown-link> --}}
                {{-- <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a> --}}
            @endif

            {{-- </x-dropdown> --}}
            {{-- </div> --}}

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (auth()->user())
                <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('utilizador.dashboard.index')" :active="request()->routeIs('utilizador.dashboard.index')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @if (auth()->user())
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
