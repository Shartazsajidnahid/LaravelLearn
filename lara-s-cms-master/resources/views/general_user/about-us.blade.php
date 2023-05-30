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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
            integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
        </script>
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
        $dmdcount = 0;
    @endphp

    <body class="u-body u-xl-mode">
        @if (!empty($md))
        <div class="container" style="padding-top: 25px; padding-down: 30px">
            <div class="row">
                <div class="col-4">
                    <div>
                        @if ($md['profile_image'] == null || $md['profile_image'] == '')
                            <img class="u-align-left u-image u-image-circle u-image-contain u-preserve-proportions u-image-2"
                                alt="Cinque Terre" width="320" height="304"
                                src="{{ asset('images/maledefault.jpg') }}" />
                        @else
                            <img class="u-align-left u-image u-image-circle u-image-contain u-preserve-proportions u-image-2"
                                alt="Cinque Terre" width="320" height="304"
                                src="{{ asset('uploads/employees/' . $md['user_name'] . '/' . $md['profile_image']) }}">
                        @endif
                    </div>
                    <h5 class="font-weight-bold" style="padding: 15px 0px 0px 25px;"> {{ $md['name'] }} </h5>
                    <h5 class="font-weight-bold" style="padding: 0px 0px 0px 25px;"> {{ $md['position'] }} </h5>
                </div>
                <div class="col-4">
                    <br>
                    <table>
                        <tbody>
                            @foreach ($md['branches'][0] as $item)
                                <tr>
                                    <td style="padding-bottom: 10px">
                                        <a href="{{ route('general.team', ['home' => 'sys_branches', 'id' => $item->id]) }}"
                                            target="_blank">
                                            {{ $item->name }}
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $index++;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    @if (!empty($md['branches'][1]))
                        <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-4">
                            <div class="u-container-layout u-container-layout-4">
                                <br>
                                <table ">
                                            <tbody>
                                                  @foreach ($md['branches'][1] as
                                    $item)
                                    <tr>
                                        <td style="padding-bottom: 10px">
                                            <a href="{{ route('general.team', ['home' => 'sys_branches', 'id' => $item->id]) }}"
                                                target="_blank">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $index++;
                                    @endphp
                    @endforeach

                    </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
        </div>
        </div>
        @else
            <h1>NO CHO AVAILABLE</h1>
        @endif



        <div class="container" style="padding-top: 120px; padding-down: 30px">
            <div class="row">
                @foreach ($dmds as $dmd)
                    @php
                        $dmdcount++;
                    @endphp
                    <div class="col-6">
                        <div class="{{ $dmdcount % 2 ? '' : 'float-right' }}">
                            <div>
                                @if ($dmd['profile_image'] == null || $dmd['profile_image'] == '')
                                    <img class="u-align-left u-image u-image-circle u-preserve-proportions u-image-1"
                                        alt="Cinque Terre" width="300"
                                        height="290"src="{{ asset('images/maledefault.jpg') }}" />
                                @else
                                    <img class="u-align-left u-image u-image-circle u-preserve-proportions u-image-1"
                                        alt="Cinque Terre" width="300" height="290"
                                        src="{{ asset('uploads/employees/' . $dmd['user_name'] . '/' . $dmd['profile_image']) }}">
                                @endif
                            </div>
                            <h5 style="padding: 15px 0px 0px 20px;"> {{ $dmd['name'] }}</h5>
                            <h5 style="padding: 0px 0px 0px 20px;"> {{ $dmd['position'] }} </h5>
                            <br>

                            <table>
                                <tbody>
                                    @foreach ($dmd['branches'] as $branch)
                                        <tr>
                                            <td style="padding: 0px 0px 10px 20px">
                                                <a href="{{ route('general.team', ['home' => 'sys_branches', 'id' => $branch->id]) }}"
                                                    target="_blank"> {{ $branch->name }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </body>
@endsection
