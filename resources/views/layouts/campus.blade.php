@yield('head', View::make('layouts.components.head'))

@yield('header', View::make('campus.components.header'))

<div class="page-wrapper">
    <div>
        @yield('content')
    </div>
</div>

@yield('scripts', View::make('layouts.components.scripts'))
