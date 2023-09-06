<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-light navbar-border navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
              <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="ft-menu font-large-1"></i></a></li>
              <li class="nav-item d-md-none d-lg-none d-xl-none">
                <a class="navbar-brand" href="{$basedir}">
                  <img src="{$basedir}images/logo_llaj.png" style="height: 25px;">
                </a>
              </li>
            </ul>
        </div>

        <div class="navbar-container container center-layout">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block">
                        <img src="{$basedir}images/logo_llaj.png" style="height: 40px;">
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item">
                        <i class="fa fa-phone btn btn-sm"> {$rconf.telp}</i>
                    </li>
                    <li class="nav-item">
                        <i class="fa fa-envelope btn btn-sm"> {$rconf.email}</i>
                    </li>
                    <li class="nav-item">
                        <a href="{$facebook}" target="_blank"><i class="fa fa-facebook btn btn-sm" style="background-color: #3b5998; color: white;"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://twitter.com/{$twitter}" target="_blank"><i class="fa fa-twitter btn btn-sm" style="background-color: #08a0e9; color: white;"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://instagram.com/{$instagram}" target="_blank"><i class="fa fa-instagram btn btn-sm" style="background: linear-gradient(225deg, rgba(81,91,212,1) 0%, rgba(129,52,175,1) 10%, rgba(221,42,123,1) 30%, rgba(245,133,41,1)70%, rgba(254,218,119,1) 90%); color: white;"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="{$youtube}" target="_blank"><i class="fa fa-youtube btn btn-sm" style="background-color: #e62117; color: white;"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content container center-layout" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            {$navbar}
        </ul>
    </div>
</div>