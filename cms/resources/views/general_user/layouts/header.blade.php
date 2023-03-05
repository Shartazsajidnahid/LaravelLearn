<header class="u-clearfix u-custom-color-4 u-header u-header" id="sec-513f"><div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-clearfix u-sheet u-sheet-1" style="color:#9900ff;">
        <a href="index.php" class="u-image u-logo u-image-1" data-image-width="150" data-image-height="103" title="Home" style="margin-top: 10px;">
            <img src="images/logo.png" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
            <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
                <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
                    <svg class="u-svg-link" viewBox="0 0 24 24">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
                    </svg>
                    <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <rect y="1" width="16" height="2"></rect>
                            <rect y="7" width="16" height="2"></rect>
                            <rect y="13" width="16" height="2"></rect>
                        </g>
                    </svg>
                </a>
            </div>
            <div class="u-custom-menu u-nav-container">
                <ul class="u-nav u-unstyled u-nav-1">
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base" href="{{asset('general')}}" style="padding: 10px 20px;font-weight: bold" >Home</a>
                    </li>
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base" href="{{asset('aboutus')}}" target="_blank" style="padding: 10px 20px;font-weight: bold">About US</a>
                    </li>
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base" href="{{asset('team')}}" target="_blank" style="padding: 10px 20px;font-weight: bold">Team</a>
                    </li>
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base" href="{{asset('allbrance')}}" style="padding: 10px 20px;font-weight: bold">All Branches</a>
                    </li>
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base" href="{{asset('alldivision')}}" style="padding: 10px 20px;font-weight: bold">All Divisions</a>
                    </li>
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base danger" href="{{ URL::route('general.logout')}}" style="padding: 10px 20px;font-weight: bold">Logout</a>
                    </li>
                </ul>
            </div>
    </div>
    </header>

