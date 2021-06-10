@yield('head', View::make('layouts.components.head'))

<body class="antialiased border-top-wide border-primary d-flex flex-column">
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href=".."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" method="POST" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Faça login na Lunaroom</h2>
                <div class="mb-3">
                    <label class="form-label">Endereço de Email</label>
                    <input type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Senha
                        <span class="form-label-description">
                  <a href="./forgot-password.html">Esqueci minha senha</a>
                </span>
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control"  placeholder="Senha"  autocomplete="off">
                        <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </div>
            </div>
            <div class="hr-text">ou</div>
            <div class="card-body">
                <div class="row">
                    <div class="col md-12"><a href="{{route('register')}}" class="btn btn-white w-100">
                            Registre-se
                        </a></div>
                </div>
            </div>
        </form>
    </div>
</div>
@yield('scripts', View::make('layouts.components.scripts'))
</body>

