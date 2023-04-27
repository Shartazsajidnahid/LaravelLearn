@extends('general_user.layouts.main')
@section('main-section')

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <meta name="keywords" content="​Managing Director &amp;amp; CEO">
        <meta name="description" content="">
        <meta name="page_type" content="np-template-header-footer-from-plugin">
        <title>About US</title>
        <link rel="stylesheet" href="{{ asset('css/nicepage.css') }}" media="screen">
        <link rel="stylesheet" href="{{ asset('css/about-us.css') }}" media="screen">
        <script class="u-script" type="text/javascript" src="{{ asset('js/jquery.js') }} defer="></script>
        <script class="u-script" type="text/javascript" src="{{ asset('js/nicepage.js') }}" defer=""></script>
        <meta name="generator" content="Nicepage 4.8.2, nicepage.com">
        <link id="u-theme-google-font" rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
        <script type="application/ld+json">{
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "Site2",
            "logo": "images/logo.png"
            }</script>
        <meta name="theme-color" content="#478ac9">
        <meta property="og:title" content="About US">
        <meta property="og:description" content="">
        <meta property="og:type" content="website">
    </head>
    @php

        $index = 1;
        $dmdindex = 1;
    @endphp

    <body class="u-body u-xl-mode">
        <section class="u-clearfix u-custom-color-3 u-section-1" id="sec-4e05">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
                    <div class="u-layout">
                        <div class="u-layout-row">
                            <div
                                class="u-align-center u-container-style u-layout-cell u-left-cell u-size-18 u-layout-cell-1">
                                <div class="u-container-layout u-container-layout-1">
                                    <div> <img src="{{ asset('uploads/cho/' . $md['profile_image']) }}"
                                            class="u-align-left u-image u-image-circle u-image-contain u-preserve-proportions u-image-2"
                                            alt="Cinque Terre" width="320" height="304">
                                    </div>
                                    <h5 class="u-align-left u-text u-text-default u-text-1"> {{ $md['name'] }} </h5>
                                    <h2 class="u-align-left u-text u-text-2"> {{ $md['designation'] }} </h2>
                                </div>
                            </div>
                            <div
                                class="u-align-left u-container-style u-layout-cell u-right-cell u-size-42 u-layout-cell-2">
                                <div class="u-container-layout u-container-layout-2">
                                    <div class="u-clearfix u-layout-wrap u-layout-wrap-2">
                                        <div class="u-layout">
                                            <div class="u-layout-row">
                                                <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-3">
                                                    <div class="u-container-layout u-container-layout-3">
                                                        @foreach ($md['branches'][0] as $item)
                                                            <a href="{{ route('general.team', ['home' => 'sys_branches', 'id' => $item->id]) }}"
                                                                data-page-id="301504267"
                                                                class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-{{ $index }}"
                                                                target="_blank">
                                                                {{ $item->name }}
                                                            </a>
                                                            @php
                                                                $index++;
                                                            @endphp
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-4">
                                                    <div class="u-container-layout u-container-layout-4">
                                                        @foreach ($md['branches'][1] as $item)
                                                            <a href="{{ route('general.team', ['home' => 'sys_branches', 'id' => $item->id]) }}"
                                                                data-page-id="301504267"
                                                                class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-{{ $index }}"
                                                                target="_blank">
                                                                {{ $item->name }}
                                                            </a>
                                                            @php
                                                                $index++;
                                                            @endphp
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="u-clearfix u-custom-color-3 u-section-2" id="sec-e2cc">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
                    <div class="u-layout">
                        <div class="u-layout-row">
                            @foreach ($dmds as $dmd)
                                <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-1">
                                    <div class="u-container-layout u-container-layout-1">
                                        <div class="u-container-style u-custom-color-3 u-group u-group-1">
                                            <div class="u-container-layout u-valign-top u-container-layout-2">
                                                <div> <img src="{{ asset('uploads/cho/' . $dmd['profile_image']) }}"
                                                        class="u-align-left u-image u-image-circle u-image-contain u-preserve-proportions u-image-1"
                                                        alt="Cinque Terre" width="320" height="304"></div>
                                                <h5 class="u-align-left u-text u-text-1"> {{ $dmd['name'] }}</h5>
                                                <h5 class="u-align-left u-text u-text-2"> {{ $dmd['designation'] }} </h5>
                                                <br>
                                                @foreach ($dmd['branches'] as $branch)

                                                        <a href="{{ route('general.team', ['home' => 'sys_branches', 'id' => $branch[0]->id]) }}" data-page-id="301504267"
                                                        class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-{{ $dmdindex }}"
                                                        target="_blank"> {{ $branch[0]->name }}</a>


                                                    @php
                                                        $dmdindex++;
                                                    @endphp
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="u-align-left u-clearfix u-section-3" id="sec-858c">
            <div class="u-clearfix u-sheet u-sheet-1"></div>
        </section>
        <section class="u-align-center u-clearfix u-section-4" id="sec-c1df">
            <div class="u-align-left u-clearfix u-sheet u-sheet-1"></div>
        </section>
    </body>
@endsection
