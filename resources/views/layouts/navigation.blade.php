<nav x-data="{ open: false }" style="background: linear-gradient(135deg, #3d2314 0%, #2b180d 100%); border-bottom: 2px solid #5c3a21;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(Auth::user()->role != 3)
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 1 || Auth::user()->role == 4)
                    <x-nav-link :href="route('proyekorders.index')" :active="request()->routeIs('proyekorders.*')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        {{ __('Input PO & SPK') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 2 || Auth::user()->role == 4)
                    <x-nav-link :href="route('listspk.index')" :active="request()->routeIs('listspk.*')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        {{ __('List SPK') }}
                    </x-nav-link>
                    @endif
                    
                    @if(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4)
                    @php
                        $navMesins = \App\Models\Mesin::where('status', 'aktif')->orderBy('id', 'asc')->get();
                        $antrianActive = request()->routeIs('antrianmesin.*') || request()->routeIs('antrian.mesin.*');
                        $dropdownClasses = $antrianActive
                            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#d4a373] text-sm font-medium leading-5 text-[#d4a373] focus:outline-none focus:border-[#d4a373] transition duration-150 ease-in-out cursor-pointer h-20'
                            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-[#d4a373] hover:border-[#d4a373] focus:outline-none focus:text-[#d4a373] focus:border-[#d4a373] transition duration-150 ease-in-out cursor-pointer h-20';
                    @endphp
                    <div class="hidden sm:flex sm:ml-4">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="{{ $dropdownClasses }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    <span>{{ __('Antrian') }}</span>
                                    <svg class="ml-1.5 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('antrianmesin.index')" :active="request()->routeIs('antrianmesin.index')">
                                    {{ __('Semua Antrian') }}
                                </x-dropdown-link>
                                <hr class="border-[#5c3a21]/20 my-1">
                                @foreach($navMesins as $navM)
                                    <x-dropdown-link :href="route('antrian.mesin.show', $navM->id)" :active="request()->routeIs('antrian.mesin.show') && (is_object(request()->route('mesin')) ? request()->route('mesin')->id : request()->route('mesin')) == $navM->id">
                                        {{ $navM->nama_mesin }}
                                    </x-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endif
                    
                    @if(Auth::user()->role == 4 || Auth::user()->role == 5)
                    <x-nav-link :href="route('mesin.index')" :active="request()->routeIs('mesin.*')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" stroke-width="2"></path></svg>
                        {{ __('Mesin') }}
                    </x-nav-link>
                    @endif
                    
                    @if(Auth::user()->role == 2 || Auth::user()->role == 4)
                    <x-nav-link :href="route('report.index')" :active="request()->routeIs('report.*')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        {{ __('Laporan') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Live Date & Time Display -->
            <div class="hidden lg:flex flex-col text-right mr-4 px-3 py-1.5 rounded-lg bg-[#5c3a21]/20 border border-[#5c3a21]/40 font-mono">
                <div id="current-date" class="text-[10px] text-amber-200/90 font-medium leading-none mb-1"></div>
                <div id="current-time" class="text-xs text-amber-400 font-bold tracking-wider leading-none"></div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white bg-[#5c3a21]/40 hover:bg-[#5c3a21]/70 hover:text-white focus:outline-none transition ease-in-out duration-150 border border-[#5c3a21]/50 hover:border-[#5c3a21]">
                            <div class="flex items-center">
                                <!-- User icon (circle) above the name, rendered as inline SVG -->
                                <div class="flex flex-row items-center gap-3">
                                    <div class="flex flex-col text-right">
                                        <div class="text-sm font-semibold text-white">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-slate-400">
                                            @if(Auth::user()->role == 1)
                                                Engineering & Estimator
                                            @elseif(Auth::user()->role == 2)
                                                Admin Produksi
                                            @elseif(Auth::user()->role == 3)
                                                Operator
                                            @elseif(Auth::user()->role == 4)
                                                Administrator
                                            @elseif(Auth::user()->role == 5)
                                                IT
                                            @endif
                                        </div>
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
            @if(Auth::user()->role != 3)
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    {{ __('Dashboard') }}
                </div>
            </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 1 || Auth::user()->role == 4)
            <x-responsive-nav-link :href="route('proyekorders.index')" :active="request()->routeIs('proyekorders.*')">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    {{ __('Input PO & SPK') }}
                </div>
            </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 2 || Auth::user()->role == 4)
            <x-responsive-nav-link :href="route('listspk.index')" :active="request()->routeIs('listspk.*')">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    {{ __('List SPK') }}
                </div>
            </x-responsive-nav-link>
            @endif
            
            @if(Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4)
            <div class="border-l-2 border-amber-500 pl-4 py-2 space-y-1 bg-[#5c3a21]/10">
                <div class="text-[10px] font-bold text-amber-300 uppercase tracking-wider mb-1 px-3">Antrian</div>
                <x-responsive-nav-link :href="route('antrianmesin.index')" :active="request()->routeIs('antrianmesin.index')">
                    {{ __('Semua Antrian') }}
                </x-responsive-nav-link>
                @foreach($navMesins as $navM)
                    <x-responsive-nav-link :href="route('antrian.mesin.show', $navM->id)" :active="request()->routeIs('antrian.mesin.show') && (is_object(request()->route('mesin')) ? request()->route('mesin')->id : request()->route('mesin')) == $navM->id">
                        {{ $navM->nama_mesin }}
                    </x-responsive-nav-link>
                @endforeach
            </div>
            @endif

            @if(Auth::user()->role == 4 || Auth::user()->role == 5)
            <x-responsive-nav-link :href="route('mesin.index')" :active="request()->routeIs('mesin.*')">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    {{ __('Mesin') }}
                </div>
            </x-responsive-nav-link>
            @endif
            
            @if(Auth::user()->role == 2 || Auth::user()->role == 4)
            <x-responsive-nav-link :href="route('report.index')" :active="request()->routeIs('report.*')">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    {{ __('Laporan') }}
                </div>
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[#5c3a21]/50">
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

    <!-- Clock & Date Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateClock() {
                const now = new Date();
                
                const dateOptions = { 
                    weekday: 'long', 
                    day: 'numeric', 
                    month: 'short', 
                    year: 'numeric' 
                };
                const timeOptions = { 
                    hour: '2-digit', 
                    minute: '2-digit', 
                    second: '2-digit', 
                    hour12: false 
                };
                
                const dateStr = now.toLocaleDateString('id-ID', dateOptions);
                const timeStr = now.toLocaleTimeString('id-ID', timeOptions);
                
                const dateEl = document.getElementById('current-date');
                const timeEl = document.getElementById('current-time');
                
                if (dateEl) dateEl.textContent = dateStr;
                if (timeEl) timeEl.textContent = timeStr + ' WIB';
            }
            
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>
</nav>
