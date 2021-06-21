@yield('head', View::make('layouts.components.head'))



<body class="d-flex flex-column">
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href=".."><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card border-0 card-md" id="form-login" method="POST" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4 font-weight-bold" style="font-size: 30px">Faça Login na Lunaroom</h2>
                <div class="mb-3">
                    <input type="email" value="devguilhermedevolio@gmail.com" name="email" id="email"
                           class="form-control" placeholder="E-mail">
                </div>
                <div class="mb-2">
                </span>
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" id="password" value="password" name="password" class="form-control"
                               placeholder="Senha" autocomplete="off">
                </span>
                    </div>
                </div>
                <div class="form-footer">
                    <button id="btn-login" class="btn btn-primary w-100"> Entrar</button>
                    <button id="btn-loading" style="display: none" class="btn btn-primary w-100" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Autenticando
                    </button>
                </div>
            </div>
            <div class="text-center">ou</div>
            <div class="card-body" style="border: none">
                <div class="row">
                    <div class="col md-12"><a href="{{route('register')}}" class="btn  w-100"> Registre-se</a></div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#btn-login').on('click', function (event) {
        event.preventDefault();
        const payload = $('#form-login').serialize();
        $('#btn-login').hide();
        $('#btn-loading').show();
        $.ajax({
            url: "{{route('post.login')}}",
            type: 'POST',
            data: payload,
            success: (callback) => {
                toastr.success('Redirecionando..', 'Autenticado com sucesso');
                setTimeout(function () {
                    location.href = "{{route('login')}}"
                }, 2000);
            },
            error: (callback) => {
                $('#btn-login').show();
                $('#btn-loading').hide();
                if (callback.responseJSON.errors) {
                    $.each(callback.responseJSON.errors, function (key, value) {
                        toastr.error(value);
                    });
                } else {
                    toastr.error('Email ou senha inválidos')
                }

            }
        })

    });
</script>
@yield('scripts', View::make('layouts.components.scripts'))
</body>

