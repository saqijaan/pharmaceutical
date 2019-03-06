<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title-distributer') </title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="{{ asset('vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">

    @yield('stylesheet-distributer')


</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        @include('partials-distributer._sidenav')

        @include('partials-distributer._topnav')

        @yield('content-distributer')

        @include('partials-distributer._footer')


    </div>
</div>


<script src="{{ asset('plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('vendors/editors.js')}}"></script>

@include('partials-distributer.bottomScript')

<script type="text/javascript">
    function toggleFullscreen(event) {
        var element = document.body;

        if (event instanceof HTMLElement) {
            element = event;
        }

        var isFullscreen = document.webkitIsFullScreen || document.mozFullScreen || false;

        element.requestFullScreen = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || function () { return false; };
        document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || function () { return false; };

        isFullscreen ? document.cancelFullScreen() : element.requestFullScreen();
    }
</script>

</body>
</html>
