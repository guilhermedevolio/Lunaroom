@yield('head', View::make('layouts.components.head'))
<body class="antialiased">
<div class="wrapper">
    <header class="navbar navbar-expand-md navbar-dark d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="{{route('dash.admin')}}">
                    Lunaroom Admin
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{auth()->user()->name}}</div>
                            <div class="mt-1 small text-muted">Administrador</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Perfil</a>
                        <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar navbar-light">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('dash.admin')}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline
                              points="5 12 3 12 12 3 21 12 19 12"/><path
                              d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/><path
                              d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/></svg>
                    </span>
                                <span class="nav-link-title">
                      Home
                    </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                               role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                   viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                   stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"
                                                                                        fill="none"/><polyline
                                      points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"/><line x1="12" y1="12"
                                                                                                  x2="20" y2="7.5"/><line
                                      x1="12" y1="12" x2="12" y2="21"/><line x1="12" y1="12" x2="4" y2="7.5"/><line
                                      x1="16" y1="5.25" x2="8" y2="9.75"/></svg>
                            </span>
                            <span class="nav-link-title">
                                Usuários
                            </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="{{route('users')}}">
                                            Gerenciar Usuários
                                        </a>
                                        <a class="dropdown-item" href="./empty.html">
                                            Cadastrar Usuários
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./form-elements.html">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline
                              points="9 11 12 14 20 6"/><path
                              d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"/></svg>
                    </span>
                                <span class="nav-link-title">
                      Form elements
                    </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                               role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                              d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"/></svg>
                    </span>
                                <span class="nav-link-title">
                      Extra
                    </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./activity.html">
                                    Activity
                                </a>
                                <a class="dropdown-item" href="./gallery.html">
                                    Gallery
                                </a>
                                <a class="dropdown-item" href="./invoice.html">
                                    Invoice
                                </a>
                                <a class="dropdown-item" href="./search-results.html">
                                    Search results
                                </a>
                                <a class="dropdown-item" href="./pricing.html">
                                    Pricing cards
                                </a>
                                <a class="dropdown-item" href="./users.html">
                                    Users
                                </a>
                                <a class="dropdown-item" href="./license.html">
                                    License
                                </a>
                                <a class="dropdown-item" href="./music.html">
                                    Music
                                </a>
                                <a class="dropdown-item" href="./widgets.html">
                                    Widgets
                                </a>
                                <a class="dropdown-item" href="./wizard.html">
                                    Wizard
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                               role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                   viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                   stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"
                                                                                        fill="none"/><rect x="4" y="4"
                                                                                                           width="6"
                                                                                                           height="5"
                                                                                                           rx="2"/><rect
                                      x="4" y="13" width="6" height="7" rx="2"/><rect x="14" y="4" width="6" height="7"
                                                                                      rx="2"/><rect x="14" y="15"
                                                                                                    width="6" height="5"
                                                                                                    rx="2"/></svg>
                            </span>
                                <span class="nav-link-title">
                      Layout
                    </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="./layout-horizontal.html">
                                            Horizontal
                                        </a>
                                        <a class="dropdown-item" href="./layout-vertical.html">
                                            Vertical
                                        </a>
                                        <a class="dropdown-item" href="./layout-vertical-transparent.html">
                                            Vertical transparent
                                        </a>
                                        <a class="dropdown-item" href="./layout-vertical-right.html">
                                            Right vertical
                                        </a>
                                        <a class="dropdown-item" href="./layout-condensed.html">
                                            Condensed
                                        </a>
                                        <a class="dropdown-item" href="./layout-condensed-dark.html">
                                            Condensed dark
                                        </a>
                                        <a class="dropdown-item" href="./layout-combo.html">
                                            Combined
                                        </a>
                                    </div>
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="./layout-navbar-dark.html">
                                            Navbar dark
                                        </a>
                                        <a class="dropdown-item" href="./layout-navbar-sticky.html">
                                            Navbar sticky
                                        </a>
                                        <a class="dropdown-item" href="./layout-navbar-overlap.html">
                                            Navbar overlap
                                        </a>
                                        <a class="dropdown-item" href="./layout-dark.html">
                                            Dark mode
                                        </a>
                                        <a class="dropdown-item" href="./layout-rtl.html">
                                            RTL mode
                                        </a>
                                        <a class="dropdown-item" href="./layout-fluid.html">
                                            Fluid
                                        </a>
                                        <a class="dropdown-item" href="./layout-fluid-vertical.html">
                                            Fluid vertical
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

