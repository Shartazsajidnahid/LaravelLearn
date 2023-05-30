@extends('general_user.layouts.main')
@section('main-section')

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <meta name="keywords" content="Digital Services​">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="">
        <meta name="page_type" content="np-template-header-footer-from-plugin">
        <title>Home</title>
        <link rel="stylesheet" href="css/nicepage.css" media="screen">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--<link rel="stylesheet" href="css/Home.css" media="screen">-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" rel="stylesheet" />

        <script class="u-script" type="text/javascript" src="js/jquery.js" defer=""></script>
        <script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <meta name="generator" content="Padma Portal">
        <!--<link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">-->

        <!--bootstrap-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
        <script type="text/javascript" src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <!--b
                                                                    <script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "Site2",
    "logo": "images/logo.png"
    }</script>-->
        <meta name="theme-color" content="#478ac9">
        <meta property="og:title" content="Home">
        <meta property="og:description" content="">
        <meta property="og:type" content="website">
        <style>
            .div-scroll,
            table {
                padding: 12px;
                height: 340px;
                width: 250px;
                border-radius: 4px;
                box-shadow: 1px 2px 1px 2px rgb(230, 229, 229);
                margin: 15px;
                border: 1px solid #757070;
                overflow-y: scroll;
                overflow-x: scroll;
            }

            .profilepic {
                position: relative;
                width: 150px;
                height: 150px;
                overflow: hidden;

                /* background-color: #111; */
            }

            .profilepic:hover .profilepic__content {
                opacity: 1;
                cursor: pointer;
            }

            .profilepic:hover .profilepic__image {
                opacity: .4;
                cursor: pointer;
            }

            .profilepic__image {
                object-fit: cover;
                opacity: 1;
                transition: opacity .2s ease-in-out;
            }

            .profilepic__content {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                color: rgb(0, 0, 0);
                opacity: 0;
                transition: opacity .2s ease-in-out;
            }

            .profilepic__icon {
                color: rgb(19, 18, 18);
                padding-bottom: 8px;
            }

            .fas {
                font-size: 15px;
            }

            .profilepic__text {
                text-transform: uppercase;
                font-size: 12px;
                width: 50%;
                text-align: center;
            }
        </style>

    </head>
    <div class="container">
        <div class="row">
            <div class="col-3 float-left" style="padding-top: 50px; padding-left:0px; margin-left:0px;">
                {{-- <div> --}}
                    <form method="post" action="{{ route('employee.update_image', $user['id']) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <a style="padding: 0; border: none;background: none;"
                            onclick="document.getElementById('getFile').click()">

                            <div class="profilepic">
                                @if ($user['profile_image'] == null || $user['profile_image'] == '')
                                    @if ($user['gender'] == 'Male')
                                        <img class="  u-image u-image-circle u-image-1 profilepic__image"
                                            src="{{ asset('images/maledefault.jpg') }}" width="150" height="150" />
                                    @else
                                        <img class="  u-image u-image-circle u-image-1 profilepic__image"
                                            src="{{ asset('images/femaledefault.jpg') }}" width="150" height="150" />
                                    @endif
                                @else
                                    <img class="  u-image u-image-circle u-image-1 profilepic__image"
                                        src="{{ asset('uploads/employees/' . $user['user_name'] . '/' . $user['profile_image']) }}"
                                        width="150" height="150" />
                                @endif


                                <div class="profilepic__content">
                                    <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                                    <span class="profilepic__text">

                                        <button type="button" class="btn btn-sm"
                                            onclick="document.getElementById('getFile').click()">Update image
                                        </button>
                                        <input type='file' name="profile_image" id="getFile" style="display:none">
                                        <input type="submit" style="display:none">
                                    </span>
                                </div>
                            </div>
                        </a>
                    </form>

                    <script type="text/javascript">
                        document.getElementById("upload_form").onchange = function() {
                            // submitting the form
                            document.getElementById("upload_form").submit();
                        };
                    </script>

                    <a href="{{ route('general.home') }}" style="color:#500485 ">{{ $user['name'] }} </a>
                    <p class=""style="font-size: 14px;margin:0">{{ $user['user_name'] }}</p>
                    <p class=""style="font-size: 14px;margin:0">{{ $user['email'] }}</p>
                    <p class="u-align-left u-text u-text-2" style="font-size: 14px;margin:0">
                        {{ $user->designation->designation ?? '' }} | {{ $user->funcDesignation->designation ?? '' }}</p>

                    <p class="u-align-left u-text u-text-3"style="font-size: 14px;margin:0">
                        <i>Div:</i> &nbsp;
                        <a
                            href="{{ route('general.team', ['home' => 'sys_branches', 'id' => $user->branch->id]) }}"
                            target="_blank" style="color:#500485 ">
                            {{ $user->branch->name ?? '' }}
                        </a>
                    </p>
                    @if ($user->department)
                    <p class="u-align-left u-text u-text-3"style="font-size: 14px;margin:0">
                        <i>Dept:</i> &nbsp;
                        <a
                            href="{{ route('general.team', ['home' => 'sys_departments', 'id' => $user->department->id]) }}"
                            target="_blank" style="color:#500485 ">
                            {{ $user->department->name ?? '' }}
                        </a>
                    </p>
                    @endif
                    @if ($user->unit)
                    <p class="u-align-left u-text u-text-3"style="font-size: 14px;margin:0">
                        <i>Unit:</i> &nbsp;
                        <a
                            href="{{ route('general.team', ['home' => 'sys_units', 'id' => $user->unit->id]) }}"
                            target="_blank" style="color:#500485 ">
                            {{ $user->unit->name ?? '' }}
                        </a>
                    </p>
                    @endif

                    <p class="" style="font-size: 14px;margin:0">
                        {{ $user['mobile'] }}
                    </p>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#ModalLoginForm">
                        Edit profile
                    </button>
                    <!-- Modal HTML Markup -->
                    <div id="ModalLoginForm" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit details</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('employee.updateinfo', $user['id']) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_token" value="">
                                        <div class="form-group">
                                            <div>
                                                <input type="email" class="form-control input-lg" name="email"
                                                    value="{{ $user['name'] }} - {{ $user['user_name'] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <input type="email" class="form-control input-lg" name="email"
                                                    value="{{ $user->designation->designation ?? '' }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <input type="email" class="form-control input-lg" name="email"
                                                    value="{{ $user->branch->name ?? '' }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">E-Mail</label>
                                            <div>
                                                <input type="email" class="form-control input-lg" name="email"
                                                    value="{{ $user['email'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <div>
                                                <input type="text" class="form-control input-lg" name="mobile"
                                                    value="{{ $user['mobile'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">IP phone</label>
                                            <div>
                                                <input type="text" class="form-control input-lg" name="ip_phone"
                                                    value="{{ $user['ip_phone'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">PABX</label>
                                            <div>
                                                <input type="text" class="form-control input-lg" name="pabx_phone"
                                                    value="{{ $user['pabx_phone'] }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    Save changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                {{-- </div> --}}

            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col"><a href="{{ route('general.branch') }}"
                            class="w-100 btn-sm u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-50 u-btn-3"
                            style="font-weight: bold">Branches</a></div>
                    <div class="col"><a href="{{ route('general.sub_branch') }}"
                            class="w-100  btn-sm u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-2-dark-1 u-radius-50 u-btn-4"
                            style="font-weight: bold">Subbranches</a></div>
                    <div class="col"><a href="{{ route('general.aboutus') }}"
                            class="w-100 btn-sm u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-2-base u-radius-50 u-btn-5"
                            style="font-weight: bold">CHO</a></div>
                    <div class="col"><a href="{{ route('general.division') }}"
                            class="w-100 btn-sm u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-4-light-1 u-radius-50 u-btn-6"
                            style="font-weight: bold">Division</a></div>
                </div>
                {{-- < !--------- Slider------------------ --> --}}
                <div id="slider1_container" style="position: relative; width: 600px;height: 300px;">
                    < !-- Loading Screen -->
                        <div data-u="loading" class="jssorl-009-spin"
                            style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;"
                                src="../svg/loading/static-svg/spin.svg" />
                        </div>
                        < !-- Slides Container -->
                            <div data-u="slides"
                                style="position: absolute; left: 0px; top: 0px; width: 600px; height: 300px;
                     overflow: hidden;">
                                @foreach ($banners as $item)
                                    <div><img data-u="image" src="{{ asset($item->image) }}" />
                                        <div data-u="thumb">{{ $item->description }}</div>
                                    </div>
                                @endforeach

                            </div>
                            < !--#region Thumbnail Navigator Skin Begin -->
                                < !-- Help: https: //www.jssor.com/development/thumbnail-navigator.html -->
                                    < !-- thumbnail navigator container -->
                                        <div data-u="thumbnavigator" class="jssort09"
                                            style="position: absolute; bottom: 0px; left: 0px; height:60px; width:600px; background-color: rgba(0,0,0,.4);">
                                            < !-- Thumbnail Item Skin Begin -->
                                                <div data-u="slides">
                                                    <div data-u="prototype"
                                                        style="POSITION: absolute; WIDTH: 600px; HEIGHT: 60px; TOP: 0; LEFT: 0;">
                                                        <div data-u="thumbnailtemplate"
                                                            style="font-family: verdana; font-weight: normal; POSITION: absolute; WIDTH: 100%; HEIGHT: 100%; TOP: 0; LEFT: 0; color:#fff; line-height: 60px; font-size:20px; padding-left:10px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                < !-- Thumbnail Item Skin End -->
                                        </div>
                                        < !--#endregion ThumbnailNavigator Skin End -->
                                            < !--#region Bullet Navigator Skin Begin -->
                                                < !-- Help: https:
                                                    //www.jssor.com/development/slider-with-bullet-navigator.html -->

                                                    <style>
                                                        .jssorb051 .i {
                                                            position: absolute;
                                                            cursor: pointer;
                                                        }

                                                        .jssorb051 .i .b {
                                                            fill: #fff;
                                                            fill-opacity: 0.5;
                                                            stroke: #000;
                                                            stroke-width: 400;
                                                            stroke-miterlimit: 10;
                                                            stroke-opacity: 0.5;
                                                        }

                                                        .jssorb051 .i:hover .b {
                                                            fill-opacity: .7;
                                                        }

                                                        .jssorb051 .iav .b {
                                                            fill-opacity: 1;
                                                        }

                                                        .jssorb051 .i.idn {
                                                            opacity: .3;
                                                        }
                                                    </style>
                                                    <div data-u="navigator" class="jssorb051"
                                                        style="position:absolute;bottom:16px;right:10px;" data-scale="0.5"
                                                        data-scale-bottom="0.75">
                                                        <div data-u="prototype" class="i"
                                                            style="width:16px;height:16px;">
                                                            <svg viewBox="0 0 16000 16000"
                                                                style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                                <circle class="b" cx="8000" cy="8000"
                                                                    r="5800"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <!--#endregion Bullet Navigator Skin End -->

                                                    <!--#region Arrow Navigator Skin Begin -->
                                                    <!-- Help: https://www.jssor.com/development/slider-with-arrow-navigator.html -->
                                                    <style>
                                                        .jssora051 {
                                                            display: block;
                                                            position: absolute;
                                                            cursor: pointer;
                                                        }

                                                        .jssora051 .a {
                                                            fill: none;
                                                            stroke: #fff;
                                                            stroke-width: 360;
                                                            stroke-miterlimit: 10;
                                                        }

                                                        .jssora051:hover {
                                                            opacity: .8;
                                                        }

                                                        .jssora051.jssora051dn {
                                                            opacity: .5;
                                                        }

                                                        .jssora051.jssora051ds {
                                                            opacity: .3;
                                                            pointer-events: none;
                                                        }
                                                    </style>
                                                    <div data-u="arrowleft" class="jssora051"
                                                        style="width:55px;height:55px;top:0px;left:25px;"
                                                        data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                                        <svg viewBox="0 0 16000 16000"
                                                            style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                            <polyline class="a"
                                                                points="11040,1920 4960,8000 11040,14080 "></polyline>
                                                        </svg>
                                                    </div>
                                                    <div data-u="arrowright" class="jssora051"
                                                        style="width:55px;height:55px;top:0px;right:25px;"
                                                        data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                                        <svg viewBox="0 0 16000 16000"
                                                            style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                            <polyline class="a"
                                                                points="4960,1920 11040,8000 4960,14080 "></polyline>
                                                        </svg>
                                                    </div>
                                                    <!--#endregion Arrow Navigator Skin End -->

                                                    <!-- Trigger -->
                                                    <script>
                                                        jssor_slider1_init();
                                                    </script>
                </div>


                <!--  -------------Slider End ------------ -->
            </div>
            <div class="col-2 ">
                <h2 class="u-align-center u-text u-text-default u-text-27"></h2>

                <div style="padding: 60px 0px 0px 10px;">
                    @foreach ($applinks_up as $item)
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label>

                                <img src="{{ asset('uploads/applinks/' . $item->image) }}" width="30" height="30"
                                    alt="" />
                                &nbsp;<a style="color:#9900ff;font-weight: bold; font-size: 15px"
                                    href={{ $item->link }}>{{ $item->name }}</a>
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row" style="padding: 10px 50px 0px 50px; height: 350px;">

        <div class="col-3">

            <table border="1px" align="center">
                <tr style="text-align: center">
                    <th style="color:#500485"><b>Top Ten Depositors</b></th>
                </tr>
                @for ($i = 0; $i < 10; $i++)
                    @if (isset($top_employees[$i]['name']))
                        <tr style="text-align: center">
                            <td>{{ $top_employees[$i]['name'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    @endif
                @endfor
            </table>
        </div>

        <div class="col-3">
            <table border="1px" align="center">
                <tr style="text-align: center">
                    <th style="color:#500485 "><b>Top Ten Branches</b></th>
                </tr>
                @for ($i = 0; $i < 10; $i++)
                    @if (isset($top_branches[$i]['name']))
                        <tr style="text-align: center">
                            <td>
                                <a href="{{ route('general.team', ['home' => 'sys_branches', 'id' => $top_branches[$i]['id']]) }} "
                                    style="color:#500485;">
                                    {{ $top_branches[$i]['name'] }}
                                </a>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    @endif
                @endfor
            </table>
        </div>

        <div class="col-3">
            <table border="1px" align="center">
                <tr style="text-align: center">
                    <th colspan="3" style="color:#500485"><b>Exchange Rates</b></th>
                </tr>
                <tr class="text-center">
                    <th> currency </th>
                    <th>TT(buy)</th>
                    <th>TT(sell)</th>
                </tr>
                @for ($i = 0; $i < 10; $i++)
                    @if (isset($exchange_rate[$i]))
                        <tr>
                            <td>{{ $exchange_rate[$i]->currency }}</td>
                            <td>{{ $exchange_rate[$i]->tt_buy }}</td>
                            <td>{{ $exchange_rate[$i]->tt_sell }}</td>
                        </tr>
                    @else
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    @endif
                @endfor
            </table>
        </div>

        <div class="col-3">

            <table border="1px" align="center">
                <tr style="text-align: center">
                    <th style="color:#500485"> <b>All application Links</b></th>
                </tr>
                @for ($i = 0; $i < 10; $i++)
                    @if (isset($applinks_down[$i]->name) && isset($applinks_down[$i]->link))
                        <tr style="text-align: center">
                            <td><a style="color:#500485;font-weight: bold;"
                                    href="{{ $applinks_down[$i]->link }}">{{ $applinks_down[$i]->name }}</a></td>
                        </tr>
                    @else
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    @endif
                @endfor
            </table>
        </div>



    </div>

    <div class="row" style="padding: 10px 50px 0px 50px; height: 50px;margin-top: 10px;">
        <div class="col-1" style="color: #9900ff; font-weight: bold; font-size: 18px;">News:</div>
        <div class="col-11" style="background-color: #ffccff">
            <div id="ticker">
                <div id="ticker-box">
                    <ul>
                        @foreach ($articles as $article)
                            <li><strong><a
                                        style="color:#500485;"href="{{ route('web.blog.show', ['slug' => $article->slug]) }}"
                                        target="_blank">{{ $article->title }}</a></strong>
                                - {{ $article->summary }}
                            </li>
                        @endforeach

                    </ul>
                </div>
                <script>
                    startTicker('ticker-box', {
                        speed: 5,
                        delay: 500
                    });
                </script>

            </div>
            <!-- ticker -->
        </div>
    </div>
@endsection
