@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
    <nav class="main-header navbar
                            {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
                            {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

        {{-- Navbar left links --}}
        <ul class="navbar-nav">
            {{-- Left sidebar toggler link --}}
            @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

            {{-- Configured left links --}}
            @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

            {{-- Custom left links --}}
            @yield('content_top_nav_left')
        </ul>

        {{-- Navbar right links --}}
        <ul class="navbar-nav ml-auto">
            {{-- Custom right links --}}
            @yield('content_top_nav_right')

            {{-- Configured right links --}}
            @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

            {{-- User menu link --}}
            @if (Auth::guard('user')->user() || Auth::guard('client')->user())
                {{-- @if (config('adminlte.usermenu_enabled'))
                    @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
                @else

                @endif --}}
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @else
                <a href={{ route('users.login') }} class="px-3">Staff Login</a>
                <a href={{ $login_url }}>Client Login</a>
            @endif

            {{-- Right sidebar toggler link --}}
            @if (config('adminlte.right_sidebar'))
                @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
            @endif
        </ul>

    </nav>
