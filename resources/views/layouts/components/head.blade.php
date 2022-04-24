<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Lunaroom</title>
    <!-- CSS files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{asset('dist/custom.css')}}">
    <link href="{{asset('dist/css/tabler.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/demo.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('src/toastr/toastr.css')}}" rel="stylesheet"/>
    <script src="{{asset('src/toastr/toastr.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('plugins/datatables/jquery.dataTables.min.css')}}">
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
    <script>
        function debounce(func, timeout = 300){
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => { func.apply(this, args); }, timeout);
            };
        }
    </script>
</head>
<style>
    table.dataTable.no-footer{
        border-bottom: 1px solid #ccc;
    }
    tbody, td, tfoot, th, thead{
        border: none;
    }
</style>
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


    $.extend( true, $.fn.dataTable.defaults, {
        "searching": true,
        "ordering": true,
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
