<nav x-data="{ open: false }" class="bg-slate-900 border-b border-slate-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                        <span class="font-bold text-white text-xl tracking-tight hidden sm:block">CCM Prod</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:items-center sm:-my-px sm:ml-10 sm:flex">
                    <!-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Produksi') }}
                    </x-nav-link> -->
                    @if(Auth::user()->role == 1)
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <x-nav-link>
                                {{ __('Office L2') }}
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                            </x-nav-link>
                        </x-slot>
                            
                        <x-slot name="content">
                            <x-dropdown-link :href="route('proyekorders.index')">
                                {{ __('Input PO & SPK') }}
                            </x-dropdown-link>
                            
                        </x-slot>
                    </x-dropdown>
                    @endif
                    @if(Auth::user()->role == 2)
                    <!-- nav menu 2 -->
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <x-nav-link>
                                {{ __('Produksi WS1') }}
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                            </x-nav-link>
                        </x-slot>
                            
                        <x-slot name="content">
                            
                            <x-dropdown-link :href="route('listspk.index')">
                                {{ __('List SPK') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('antrianmesin.index')">
                                {{ __('Antrian Mechine') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    @endif
                    <!-- nav menu 3 -->
                    {{--
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <x-nav-link>
                                {{ __('Produksi WS2') }}
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                            </x-nav-link>
                        </x-slot>
                            
                        <x-slot name="content">
                            
                        </x-slot>
                    </x-dropdown>
                    --}}
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-slate-300 bg-slate-800 hover:text-white focus:outline-none transition ease-in-out duration-150 border border-slate-700 hover:border-slate-600">
                            <div class="flex items-center">
                                <!-- User icon (circle) above the name, rendered as inline SVG -->
                                <div class="flex flex-row items-center gap-3">
                                    <div class="flex flex-col text-right">
                                        <div class="text-sm font-semibold text-white">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-slate-400">{{ Auth::user()->role == 1 ? 'Engineering & Estimator' : 'Admin Produksi' }}</div>
                                    </div>
                                    <div class="h-10 w-10 rounded-full bg-slate-700 flex items-center justify-center text-slate-300 border border-slate-600">
                                        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                </div>
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

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-800">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
