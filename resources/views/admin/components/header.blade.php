@yield('head', View::make('layouts.components.head'))

<style>
    .loader-wrapper {
        z-index: 999;
        width: 100%;
        height: 100%;
        position: fixed;
        background: rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
        -webkit-transition: opacity .2s,visibility .2s;
        -o-transition: opacity .2s,visibility .2s;
        transition: opacity .2s,visibility .2s;
    }
    .loading-logo > h2 {
        font-size: 100px;
        color: #206bc4;
    }
    .loading-logo {
        padding: 10px;
        border-radius: 30px;
        border: 8px solid  #206bc4;
        display: flex;
    }

    .loading-logo, .loading-logo h2 {
        animation: logo-anim 1s ease infinite alternate;

    }

    @keyframes logo-anim {
        0% {
            opacity: 1;
        }
        10% {
            opacity: 1;
        }
        15% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }


    .loading-logo, .anim-1{
        -webkit-animation-delay: .4s;
        animation-delay: .4s !important;
    }

    .loading-logo,.anim-2{
        -webkit-animation-delay: .4s;
        animation-delay: .4s !important;
    }

    .loading-logo,.anim-3{
        -webkit-animation-delay: .1s;
        animation-delay: .1s !important;
    }
    .-hide {
        opacity: 0;
        visibility: hidden;
    }
</style>
<script>
    function loading() {
        $('.loader-wrapper').removeClass('-hide');
    }
    function unloading() {
        setTimeout(() => {
            $('.loader-wrapper').addClass('-hide');
        }, 800);
    }
</script>
<body class="antialiased">
<div class="loader-wrapper -hide" >
        <div class="loading-logo">
            <h2 class="anim-1">Lu</h2>
            <h2 class="anim-2">na</h2>
            <h2 class="anim-3">room</h2>
        </div>
</div>
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
                            <span class="avatar avatar-sm"
                                  style="background-image: url(./static/avatars/000m.jpg)"></span>
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
                                    <i class="fa fa-home"></i>
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
                                    <i class="fa fa-user"></i>

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
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                               role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <i class="fas fa-graduation-cap" aria-hidden="true"></i>
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

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                               role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <i class="fa fa-file" aria-hidden="true"></i>
                            </span>
                                <span class="nav-link-title">
                                Relatórios
                            </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="{{route('report-sales')}}">
                                            Relatório de Faturamento
                                        </a>
                                        <a class="dropdown-item" href="">
                                            Relatório por Cursos
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

