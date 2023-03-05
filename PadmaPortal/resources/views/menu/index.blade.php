
<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <style>
        .dropdown-menu .nav-item a { color: #000 !important; }
        .dropdown-toggle:after { content: none; }
        .dropdown-menu .dropdown-menu { margin-left: 0; margin-right: 0; }
        .dropdown-menu li { position: relative }
        .nav-item .submenu { display: none; position: absolute; left: 100%; top: -7px; }
        .dropdown-menu>li:hover { background-color: #f1f1f1; }
        .dropdown-menu>li:hover>.submenu { display: block; }
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand">Laravel Menu</a>
        <ul class="navbar-nav mr-auto">
            @each('menu.submenu', $menulist, 'menu', 'empty')
        </ul>
    </nav>



    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section ">
            <h3>{{ ucwords(lang('main menu', $translation)) }}</h3>
            <ul class="nav side-menu navbar-nav mr-auto">
                @each('menu.submenu', $menulist, 'menu', 'empty')
            </ul>
        </div>
    </div>

    <div class="container">
        <a href="{{route('admin.addcontroller')  }}">
            <span>Add Controller</span>
        </a>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">

        $(document).on('click', '.dropdown-menu', ($event) => $event.stopPropagation());
        if ($(window).width() < 992) {
            $('.dropdown-menu a').click(($event) => {
                $event.preventDefault();
                if ($(this).next('menu.submenu').length) {
                    $(this).next('menu.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', () => $(this).find('menu.submenu').hide());
            });
        }

    </script>
</body>
