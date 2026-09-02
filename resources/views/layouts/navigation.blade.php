<nav x-data="{ open: false }" class="studio-nav dark:bg-slate-900 dark:border-slate-800">
    <div class="studio-container">
        <div class="flex h-[4.25rem] items-center justify-between gap-5">
            <div class="flex min-w-0 items-center gap-7">
                <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="flex shrink-0 items-center gap-2 text-[#104841] dark:text-emerald-300">
                    <span class="h-2.5 w-2.5 rounded-sm bg-[#b77928]"></span>
                    <span class="font-serif-display text-xl">Ruang Belajar</span>
                </a>

                <div class="hidden items-center gap-6 sm:flex">
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('teacher.dashboard') || request()->routeIs('student.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home') || request()->routeIs('courses.show')">
                        {{ __('Browse Courses') }}
                    </x-nav-link>
                    @if(Auth::user()?->isAdmin())
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                            {{ __('Manage Users') }}
                        </x-nav-link>
                    @endif
                    @if(Auth::user()?->isTeacher())
                        <x-nav-link :href="route('teacher.courses.create')" :active="request()->routeIs('teacher.courses.create')">
                            {{ __('Create Course') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden items-center sm:flex">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 rounded-md border border-transparent px-2 py-2 text-sm font-semibold text-[#42504c] transition hover:border-[#d8d4c9] hover:bg-[#f1ede4] hover:text-[#104841] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#18645b] dark:text-slate-300 dark:hover:bg-slate-800">
                                <span class="grid h-7 w-7 place-items-center rounded-full bg-[#dcebe5] text-xs font-bold text-[#104841]">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.09 1.04l-4.25 4.5a.75.75 0 0 1-1.09 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" /></svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="studio-text-button">Login</a>
                        <a href="{{ route('register') }}" class="studio-button">Create account</a>
                    </div>
                @endauth
            </div>

            <button @click="open = !open" class="grid h-10 w-10 place-items-center rounded-md text-[#42504c] hover:bg-[#f1ede4] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#18645b] sm:hidden dark:text-slate-300" :aria-expanded="open" aria-label="Toggle navigation">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-transition class="border-t border-[#d8d4c9] bg-[#fffdf8] px-4 py-3 sm:hidden dark:border-slate-800 dark:bg-slate-900" style="display: none;">
        <div class="space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('teacher.dashboard') || request()->routeIs('student.dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home') || request()->routeIs('courses.show')">{{ __('Browse Courses') }}</x-responsive-nav-link>
            @if(Auth::user()?->isAdmin())
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">{{ __('Manage Users') }}</x-responsive-nav-link>
            @endif
            @if(Auth::user()?->isTeacher())
                <x-responsive-nav-link :href="route('teacher.courses.create')" :active="request()->routeIs('teacher.courses.create')">{{ __('Create Course') }}</x-responsive-nav-link>
            @endif
        </div>
        <div class="mt-3 border-t border-[#d8d4c9] pt-3 dark:border-slate-800">
            @auth
                <div class="px-3 pb-2"><p class="text-sm font-bold text-[#203331] dark:text-white">{{ Auth::user()->name }}</p><p class="text-xs text-[#68716b]">{{ Auth::user()->email }}</p></div>
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">@csrf <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-responsive-nav-link></form>
            @else
                <div class="grid grid-cols-2 gap-2"><a href="{{ route('login') }}" class="studio-outline-button">Login</a><a href="{{ route('register') }}" class="studio-button">Register</a></div>
            @endauth
        </div>
    </div>
</nav>
