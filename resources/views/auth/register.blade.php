@yield('head', View::make('layouts.components.head'))
<link rel="stylesheet" href="{{asset('dist/custom.css')}}">

<body class="d-flex flex-column">
<div class="page page-center">
    <div id="card-form-register" class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card border-0 card-md" autocomplete="off" method="POST" id="form-register">
            {{csrf_field()}}
            <div class="card-body">
                <h2 class="card-title text-center mb-4" style="font-size: 30px;">Registre-se na Lunaroom</h2>
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" placeholder="Seu nome completo">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome de Usuário (Você será reconhecido por esse nome na
                        comunidade)</label>
                    <input type="text" name="username" class="form-control" placeholder="Nome de Usuário">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Seu e-mail">
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control" name="password" placeholder="Senha"
                               autocomplete="off">
                </span>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" id="btn-register" class="btn btn-primary w-100">Criar minha conta</button>
                    <button id="btn-loading"  style="display: none" class="btn btn-primary w-100" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Criando sua conta
                    </button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3 text-white">
            Já tem uma conta ? <a href="{{route('login')}}" tabindex="-1">Login</a>
        </div>
    </div>
    <div class="container-tight py-4" id="card-greetings" style="display: none;">
        <div class="text-center mb-4">
            <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <div class="card card-md" method="POST" id="form-register">
            {{csrf_field()}}
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Obrigado por se registrar</h2>
                <p>Agora você faz parte da Lunaroom,  uma comunidade linda e maravilhosa de Programação</p>
                <p>Enviamos um email para você, de uma olhada lá depois</p>
                <a href="{{route('login')}}" type="submit" class="btn btn-primary w-100">Fazer Login</a>

            </div>
        </div>
    </div>
</div>
<script>
    $('#form-register').on('submit', function (e) {
        e.preventDefault();
        $('#btn-register').hide();
        $('#btn-loading').show();
        const payload = $(this).serialize();
        $.ajax({
            url: "{{route('post.register')}}",
            type: 'POST',
            data: payload,
            success: function (callback) {
                $('#username-info').text(payload.name);
                $('#card-form-register').hide();
                $('#card-greetings').show();
                toastr.success("Conta criada com sucesso");
            },
            error: function (callback) {
                $('#btn-register').show();
                $('#btn-loading').hide();
                $.each(callback.responseJSON.errors, function (key, value) {
                    toastr.error(value);
                });
            }
        });
    });
</script>

</body>
