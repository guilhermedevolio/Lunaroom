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
                        <a href="{{route('campus')}}" class="dropdown-item">Área do Aluno</a>
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

                                </span>
                                <span class="nav-link-title">
                                    Home
                                </span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"  role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->

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

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->

                            </span>
                            <span class="nav-link-title">
                                Cursos
                            </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="{{route('courses')}}">
                                            Gerenciar Cursos
                                        </a>
                                        <a class="dropdown-item" href="{{route('add-course')}}">
                                            Cadastrar Curso
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

