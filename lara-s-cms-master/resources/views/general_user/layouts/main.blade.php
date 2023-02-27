<html style="font-size: 16px;">
    <head>

        <title>Padma Portal</title>
        <link rel="stylesheet" href="{{asset('css/nicepage.css')}}" media="screen">
        <script class="u-script" type="text/javascript" src="{{asset('js/jquery.js')}}" defer=""></script>
        <script class="u-script" type="text/javascript" src="{{asset('js/jquery.js')}}" defer=""></script>
        <meta name="generator" content="Padma Portal">
        <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
        <script type="text/javascript" src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{asset('js/jssor.slider.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/slider.js')}}"></script>
        <script src="js/news-ticker.js"></script>
        <link rel="stylesheet" href="css/style.css" media="screen">
    </head>

    <body class="u-body u-xl-mode">
        <header class="u-clearfix u-custom-color-4 u-header u-header"  style="background-color: #ce6587c4">
            @include('general_user.layouts.header')
        </header>
        <div class="container">
            @yield('main-section')
        </div>


        @include('general_user.layouts.footer')

    </body>

</html>
