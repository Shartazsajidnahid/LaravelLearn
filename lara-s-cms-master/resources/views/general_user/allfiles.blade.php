@extends('general_user.layouts.main')
@section('main-section')

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <meta name="keywords" content="Department / Branch, ​Member">
        <meta name="description" content="">
        <meta name="page_type" content="np-template-header-footer-from-plugin">
        <title>Team</title>
        <link rel="stylesheet" href="{{ asset('css/nicepage.css') }}" media="screen">
        <link rel="stylesheet" href="{{ asset('css/team.css') }}" media="screen">
        <script class="u-script" type="text/javascript" src="{{ asset('js/jquery.js') }}" defer=""></script>
        <script class="u-script" type="text/javascript" src="{{ asset('js/nicepage.js') }}" defer=""></script>
        <meta name="generator" content="Nicepage 4.8.2, nicepage.com">
        <link id="u-theme-google-font" rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">


        <script type="application/ld+json">{
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "Site2",
            "logo": "images/logo.png"
        }
        </script>
        <meta name="theme-color" content="#478ac9">
        <meta property="og:title" content="Team">
        <meta property="og:description" content="">
        <meta property="og:type" content="website">
    </head>

    <body class="u-body u-xl-mode">

    <br>
    <br>
        <section class="u-align-center u-clearfix u-section-3" id="sec-414e">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-expanded-width u-tab-links-align-left u-tabs u-tabs-1">

                    <ul class="u-border-2 u-border-palette-1-base u-spacing-10 u-tab-list u-unstyled" role="tablist">
                        @foreach ($filetypes as $item)
                            <li class="u-tab-item" role="presentation">
                                <a class="{{ $loop->first ? 'active' : '' }} u-active-palette-1-base u-button-style u-grey-10 u-tab-link u-text-active-white u-text-black u-tab-link-{{ $loop->iteration }}"
                                    id="link-tab-{{ $loop->iteration }}" href="#tab-{{ $loop->iteration }}"
                                    role="tab" aria-controls="tab-{{ $loop->iteration }}"
                                    aria-selected="true">{{ $item->filetype }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="u-tab-content">
                        @foreach ($data as $array)
                            <div class="u-container-style u-tab-{{ $loop->first ? 'active' : 'pane' }} u-tab-pane u-white u-tab-pane-{{ $loop->iteration }}"
                                id="tab-{{ $loop->iteration }}" role="tabpanel"
                                aria-labelledby="link-tab-{{ $loop->iteration }}">
                                <div class="u-container-layout u-container-layout-{{ $loop->iteration }}">
                                    <div
                                        class="u-expanded-width u-table u-table-responsive u-table-{{ $loop->iteration }}">
                                        <table class="u-table-entity">
                                            <colgroup>
                                                <col width="50%">
                                                <col width="50%">
                                            </colgroup>
                                            <tbody class="u-table-alt-grey-5 u-table-body">
                                                @foreach ($array as $item)
                                                    {{-- <p>{{$item->name}}</p> --}}
                                                    <tr style="height: 70px;">
                                                        <td class="u-table-cell">{{ $item->name }}</td>
                                                        <td class="u-table-cell"><a href="{{ $item->filepath }}"
                                                                target="_blank">Download</a></td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            {{-- <div>
                @foreach ($data as $array)
                <p> filetype - {{$loop->iteration}}</p>
                    @foreach ($array as $item)
                        <p>{{$item->name}}</p>
                    @endforeach

                @endforeach
            </div> --}}
        </section>



    </body>
@endsection
