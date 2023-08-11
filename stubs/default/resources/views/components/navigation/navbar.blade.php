<nav x-data="{
    navigationMenuOpen: false,
    navigationMenu: '',
    navibationMenuCloseDelay: 200,
    navigationMenuCloseTimeout: null,
    navigationMenuLeave() {
        let that = this;
        this.navigationMenuCloseTimeout = setTimeout(() => {
            that.navigationMenuClose();
        }, this.navibationMenuCloseDelay);
    },
    navigationMenuReposition(navElement) {
        this.navigationMenuClearCloseTimeout();
        this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
        this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2) + 'px';
    },
    navigationMenuClearCloseTimeout() {
        clearTimeout(this.navigationMenuCloseTimeout);
    },
    navigationMenuClose() {
        this.navigationMenuOpen = false;
        this.navigationMenu = '';
    }
}"
     class="relative z-10 ml-10">
    <div class="relative">
        <ul class="flex items-center justify-center flex-1 space-x-1 text-gray-300 list-none group">

            <li>
                <x-navigation.elements.normal-link to="dashboard"
                                                   is_to="dashboard"
                                                   title="Dashboard"
                                                   icon="fas-house" />
            </li>

            {{-- @if (auth()->user()->hasAllAccess() ||
    ($logged_in_user->can('admin.access.user.list') || $logged_in_user->can('admin.access.user.deactivate') || $logged_in_user->can('admin.access.user.reactivate') || $logged_in_user->can('admin.access.user.clear-session') || $logged_in_user->can('admin.access.user.impersonate') || $logged_in_user->can('admin.access.user.change-password'))) --}}
            <li>
                <button :class="{
                    'bg-gray-700 text-white': navigationMenu == 'administrator',
                    'hover:bg-gray-700': navigationMenu !=
                        'administrator'
                }"
                        @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='administrator'"
                        @mouseleave="navigationMenuLeave()"
                        @class([
                            'group inline-flex h-10 w-max items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:text-white focus:outline-none disabled:pointer-events-none disabled:opacity-50',
                            'bg-gray-900 !text-white' =>
                                Request::is('admin/auth/*') || Request::is('system/*'),
                        ])>
                    <span class="mb-[2px] mr-[6px] text-secondary-400">@svg('fas-user-astronaut', 'w-4 h-4')</span>
                    <span class="hidden lg:block">Administrator</span>
                    <svg :class="{ '-rotate-180': navigationMenuOpen == true && navigationMenu == 'administrator' }"
                         class="relative top-[1px] ml-1 h-3 w-3 duration-300 ease-out"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </li>
            {{-- @endif --}}
        </ul>
    </div>

    <div x-ref="navigationDropdown"
         x-show="navigationMenuOpen"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         @mouseover="navigationMenuClearCloseTimeout()"
         @mouseleave="navigationMenuLeave()"
         class="absolute top-0 pt-3 duration-200 ease-out -translate-x-1/2 translate-y-11 bg-none"
         x-cloak>

        <x-navigation.elements.open-nav menu="administrator"
                                        icon="fas-user-astronaut"
                                        title="Administrator"
                                        subline="Einstellungen für Privilegierte" />

    </div>
</nav>
