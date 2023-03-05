@extends('general_user.layouts.main')
@section('main-section')


<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Digital Services​">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Home</title>
    <link rel="stylesheet" href="css/nicepage.css" media="screen">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/Home.css" media="screen">-->
    <script class="u-script" type="text/javascript" src="js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta name="generator" content="Padma Portal">
    <!--<link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">-->

    <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    <script type="text/javascript" src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
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
</head>


<div class="container">
    <div class="row" style="height: 500px;">
        <div class="col-3" style="padding-top: 50px;">
            <div>
                <div><img src="{{url('images/Rashed.jpg')}}" class="rounded-circle" alt="Cinque Terre" width="200" height="200"> </div>
                <a href="Home.html">Md. Rashed Chowdhury</a>
                <p class="">20181220001</p>
                <p class="">FAVP</p>
                <p class="">ICTD</p>
                <a href="#" target="_blank"  class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-2" style="color:#9900ff;font-weight: bold; text-style: none;" >Code of conduct</a>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col"><a href="{{asset('allbrance')}}" class="w-100 btn-sm u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-50 u-btn-3" style="font-weight: bold">Branches</a></div>
                <div class="col"><a href="{{asset('allbrance')}}" class="w-100  btn-sm u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-2-dark-1 u-radius-50 u-btn-4" style="font-weight: bold">Subbranches</a></div>
                <div class="col"><a href="{{asset('aboutus')}}" class="w-100 btn-sm u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-2-base u-radius-50 u-btn-5" style="font-weight: bold">CHO</a></div>
                <div class="col"><a href="{{asset('alldivision')}}" class="w-100 btn-sm u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-4-light-1 u-radius-50 u-btn-6" style="font-weight: bold">Division</a></div>
            </div>
            <!--------- Slider------------------ -->

            <div id="slider1_container" style="position: relative; width: 600px;height: 300px;">
                <!-- Loading Screen -->
                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/loading/static-svg/spin.svg" />
                </div>

                <!-- Slides Container -->
                <div data-u="slides" style="position: absolute; left: 0px; top: 0px; width: 600px; height: 300px;
                     overflow: hidden;">
                    <div>
                        <img data-u="image" src="images/notice11.JPG" />
                        <div data-u="thumb">Do you notice it scales while window resize?</div>
                    </div>
                    <div>
                        <img data-u="image" src="images/notice2.JPG" />
                        <div data-u="thumb">Do you know this is text format thumbnail?</div>
                    </div>
                    <div>
                        <img data-u="image" src="images/notice3.JPG" />
                        <div data-u="thumb">Do you notice the navigator is in multiline?</div>
                    </div>
                    <div>
                        <img data-u="image" src="images/980x380/004.jpg" />
                        <div data-u="thumb">Do you like navigator to act by mouse hover?</div>
                    </div>
                    <div>
                        <img data-u="image" src="images/980x380/001.jpg" />
                        <div data-u="thumb">Do you notice arrows appear when mouse over?</div>
                    </div>
                    <div>
                        <img data-u="image" src="images/980x380/002.jpg" />
                        <div data-u="thumb">Do you notice the slideshow plays outside?</div>
                    </div>
                    <div>
                        <img data-u="image" src="images/980x380/003.jpg" />
                        <div data-u="thumb">Do you know there are <a href="../transitions/slideshow-transitions(360).html">360+ slideshow transitions</a>?</div>
                    </div>
                    <div>
                        <img data-u="image" src="images/980x380/004.jpg" />
                        <div data-u="thumb">Do you know <a href="https://www.jssor.com/help">Jssor Slider Maker</a> is ready to create layer animation?</div>
                    </div>
                </div>

                <!--#region Thumbnail Navigator Skin Begin -->
                <!-- Help: https://www.jssor.com/development/thumbnail-navigator.html -->
                <!-- thumbnail navigator container -->
                <div data-u="thumbnavigator" class="jssort09" style="position: absolute; bottom: 0px; left: 0px; height:60px; width:600px; background-color: rgba(0,0,0,.4);">
                    <!-- Thumbnail Item Skin Begin -->
                    <div data-u="slides">
                        <div data-u="prototype" style="POSITION: absolute; WIDTH: 600px; HEIGHT: 60px; TOP: 0; LEFT: 0;">
                            <div data-u="thumbnailtemplate" style="font-family: verdana; font-weight: normal; POSITION: absolute; WIDTH: 100%; HEIGHT: 100%; TOP: 0; LEFT: 0; color:#fff; line-height: 60px; font-size:20px; padding-left:10px;"></div>
                        </div>
                    </div>
                    <!-- Thumbnail Item Skin End -->
                </div>
                <!--#endregion ThumbnailNavigator Skin End -->

                <!--#region Bullet Navigator Skin Begin -->
                <!-- Help: https://www.jssor.com/development/slider-with-bullet-navigator.html -->
                <style>
                    .jssorb051 .i {position:absolute;cursor:pointer;}
                    .jssorb051 .i .b {fill:#fff;fill-opacity:0.5;stroke:#000;stroke-width:400;stroke-miterlimit:10;stroke-opacity:0.5;}
                    .jssorb051 .i:hover .b {fill-opacity:.7;}
                    .jssorb051 .iav .b {fill-opacity: 1;}
                    .jssorb051 .i.idn {opacity:.3;}
                </style>
                <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:16px;right:10px;" data-scale="0.5" data-scale-bottom="0.75">
                    <div data-u="prototype" class="i" style="width:16px;height:16px;">
                        <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                        </svg>
                    </div>
                </div>
                <!--#endregion Bullet Navigator Skin End -->

                <!--#region Arrow Navigator Skin Begin -->
                <!-- Help: https://www.jssor.com/development/slider-with-arrow-navigator.html -->
                <style>
                    .jssora051 {display:block;position:absolute;cursor:pointer;}
                    .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
                    .jssora051:hover {opacity:.8;}
                    .jssora051.jssora051dn {opacity:.5;}
                    .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
                </style>
                <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                    </svg>
                </div>
                <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
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
        <div class="col-3" >
            <h2 class="u-align-center u-text u-text-default u-text-27"></h2>

            <div style="padding: 20px 0px 0px 10px;">
                <div class="form-group" style="margin-bottom: 0px;">
                    <label >
                        <img src="images/policy.png" width="30" height="30" alt=""/>
                        &nbsp;<a style="color:#9900ff;font-weight: bold;" href="policy.php" >Policy & Guideline</a>
                    </label>
                </div>
                <div class="form-group" style="margin-bottom: 0px;">
                    <label >
                        <img src="images/file_manager2.png" width="30" height="30"  alt=""/>
                        &nbsp;<a style="color:#9900ff;font-weight: bold;" href="http://172.20.10.88/file/" target="_blank"> File Manager</a>
                    </label>
                </div>
                <div class="form-group" style="margin-bottom: 0px;">
                    <label >
                        <img src="images/employee.png" width="30" height="30"  alt="" />
                        &nbsp;<a style="color:#9900ff;font-weight: bold;" href="employee_search.php?page=Employee" > All Employee</a>
                    </label>
                </div>
                <div class="form-group" style="margin-bottom: 0px;">
                    <label>
                        <img src="images/hris.png" width="30" height="20"  alt=""/>
                        &nbsp;<a style="color:#9900ff;font-weight: bold;" href="http://192.168.200.132/padma_hrm/public/empId/" target="_blank">HRIS</a>

                    </label>
                </div>
                <div class="form-group" style="margin-bottom: 0px;">
                    <label >
                        <img src="{{url('images/email_id.png')}}" width="30" height="30"  alt=""/>
                        &nbsp;<a style="color:#9900ff;font-weight: bold;" href="email_address.php"> All Group Email Address</a>
                    </label>
                </div>

                <div class="form-group" style="margin-bottom: 0px;">
                    <label >
                        <img src="images/operation_manual.png" width="40" height="30"  alt=""/>
                        &nbsp;<a target="_blank" style="color:#9900ff;font-weight: bold;" href="http://192.168.200.88/Branch_Operations_Manual/index.php" onclick="return popitup(this)"> Branch Operation Manual</a>
                    </label>
                </div>

                <div class="form-group" style="margin-bottom: 0px;">
                    <label>
                        <img src="images/emp_of_the_month_lebel.png" width="200" height="50"  alt=""/>
                        &nbsp;<a target="_blank" style="color:#9900ff;font-weight: bold;" href="employee_of_month.php" "> </a>
                    </label>
                </div>


                <div class="form-group" style="margin-bottom: 0px;">
                    <label >
                        <img src="images/link.jpg" width="30" height="30"  alt=""/>
                        &nbsp;<a target="_blank" style="color:#9900ff;font-weight: bold; text-style: none;" href="http://192.168.200.88/shortcut_links/">
                            All Application Links
                        </a>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="padding: 10px 50px 0px 50px; height: 350px;">
    <div class="col-3">
        <div class="u-align-left u-border-3 u-border-grey-75 u-container-style u-group u-group-1" style="height: 100%; overflow-y: scroll;">
            <div class="u-container-layout u-container-layout-2">
                <h3 class="u-align-center u-text  u-text-default-lg u-text-default-xl u-text-4 font-weight: bold" style="color:#9900ff;font-weight: bold; text-style: none;" >Top 10 Depositor</h3>
                @foreach ($users as $user)
                    <p> {{ $user }}</p>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="u-border-4 u-border-grey-75 u-container-style u-group u-shape-rectangle u-group-4" style="height: 100%; overflow-y: scroll;">
            <div class="u-container-layout u-container-layout-9">
                <h3 class="u-align-center u-text  u-text-16" style="color:#9900ff;font-weight: bold; text-style: none;">Top   10 <br>Branch</h3>
                <p>BRANCH 1</p>
                <p>BRANCH 2</p>
                <p>BRANCH 3</p>
                <p>BRANCH 4</p>
                <p>BRANCH 5</p>
                <p>BRANCH 6</p>
                <p>BRANCH 7</p>
                <p>BRANCH 8</p>
                <p>BRANCH 9</p>
                <p>BRANCH 10</p>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="u-border-3 u-border-grey-75 u-container-style u-group u-shape-rectangle u-group-3" style="height: 100%;overflow-y: scroll;">
            <div class="u-container-layout u-container-layout-8" >
                <h3 class="u-align-center u-text  u-text-15" style="color:#9900ff;font-weight: bold; text-style: none;">Exchange Rates </h3>
                <div class="u-table u-table-responsive u-table-1">
                    <table border="1" rules="all">
                        <tbody>
                            <tr style="height: 40px;">
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">Currency</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">TT(Buy)</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">TT(Sell)</td>
                            </tr>
                            <tr style="height: 40px;">
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">USD</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">85.05</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">86.05</td>
                            </tr>
                            <tr style="height: 40px;">
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">GBP</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">112.93</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">116.81</td>
                            </tr>
                            <tr style="height: 40px;">
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">EURO</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">93.02</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">97.72</td>
                            </tr>
                            <tr style="height: 40px;">
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">JPY</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">0.70</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">0.76</td>
                            </tr>
                            <tr style="height: 40px;">
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">AUD</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell"> 62.39</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell"> 65.99</td>
                            </tr>
                            <tr style="height: 40px;">
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">CAD</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell"> 66.61</td>
                                <td class="u-border-1 u-border-grey-dark-1 u-table-cell">70.21</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="u-border-3 u-border-grey-75 u-container-style u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-shape-rectangle u-group-6" style="height: 100%;overflow-y: scroll;">
            <div class="u-container-layout u-container-layout-12">
                <h3 class="u-align-center u-text  u-text-28" style="color:#9900ff;font-weight: bold; text-style: none;">All Aplication Link</h3>
                <a href="https://mail.padmabankbd.com/" style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-7" target="_blank"> Padma Email&nbsp; &nbsp;</a>
                <a href="http://192.168.200.72/padma_mis/"  style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-8" target="_blank"> MIS&nbsp; &nbsp;</a>
                <a href="https://padmaclick.padmabankbd.com/padmaclick/" style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-9"> Padma Click&nbsp; &nbsp;</a>
                <a href="https://padmaclick.padmabankbd.com/padmaclick/" style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-10">Task Management System&nbsp; &nbsp;</a>
                <a href="https://padmaclick.padmabankbd.com/padmaclick/" style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-11">Loan Tracking System&nbsp;&nbsp;</a>
                <a href="https://padmaclick.padmabankbd.com/padmaclick/" style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-12">iBanking</a>
                <a href="http://192.168.200.97/edoc_padma_v2/index.php/home" style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-13" target="_blank"> eDoc&nbsp; &nbsp;</a>
                <a href="https://192.168.249.10/partner-portal/login" style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-14" target="_blank">NID Partner Portal</a>
                <a href="http://192.168.200.104:9191/BrowserWeb/servlet/BrowserServlet" style="padding: 0px 10px !important;margin: 0px  !important" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-none u-text-palette-1-base u-btn-15" target="_blank"> CBS T24&nbsp; &nbsp;</a>
            </div>
        </div>
    </div>
</div>

    <div class="row" style="padding: 10px 50px 0px 50px; height: 50px;margin-top: 10px;">
        <div class="col-1" style="color: #9900ff; font-weight: bold; font-size: 18px;">News:</div>
        <div class="col-11" style="background-color: #ffccff">
            <div id="ticker">
                <div id="ticker-box">
                    <ul>
                        <li>"Imagination is the beginning of creation. " - <strong><i>George
                                    Bernard Shaw;</i></strong>
                        </li>
                        <li>
                            "If you haven’t found it yet, keep looking. " - <strong><i>Steve Jobs;</i></strong>
                        </li>
                        <li>
                            "Not all of us can do great things. But we can do
                            small things with great love." - <strong><i>Mother
                                    Teresa</i></strong>
                        </li>

                    </ul>
                </div>
                <script>startTicker('ticker-box', {speed: 5, delay: 500});</script>

            </div>
            <!-- ticker -->
        </div>
    </div>



@endsection
