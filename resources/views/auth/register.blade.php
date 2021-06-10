@yield('head', View::make('layouts.components.head'))
<body class="antialiased border-top-wide border-primary d-flex flex-column">
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md"  method="POST">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Crie sua conta na Lunaroom</h2>
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" placeholder="Seu nome completo">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome de Usuário (Você será reconhecido por esse nome na comunidade)</label>
                    <input type="text" class="form-control" placeholder="Nome de Usuário">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Seu e-mail">
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
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
                    <button type="submit" class="btn btn-primary w-100">Criar minha conta</button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            Já tem uma conta ? <a href="{{route('login')}}" tabindex="-1">Login</a>
        </div>
    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="./dist/js/tabler.min.js"></script>
</body>
