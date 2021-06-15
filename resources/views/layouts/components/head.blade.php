<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Lunaroom</title>
    <!-- CSS files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="{{asset('dist/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/demo.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('src/toastr/toastr.css')}}" rel="stylesheet"/>
    <script src="{{asset('src/toastr/toastr.min.js')}}"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.8.1/tinymce.min.js"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        height: "200",
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });


</script>

</script>
