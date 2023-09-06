<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
    <i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="{$basedir}"><img src="{$themepath}img/logo.png" alt=""></a>
            </li>
            {$navbar}
        </ul>
    </nav>
    <div class="nav-logo-right">
        <ul>
            <li>
                <i class="icon_phone"></i>
                <div class="info-text">
                    <span>Telepon:</span>
                    <p>{$rconf.telp}</p>
                </div>
            </li>
            <li>
                <i class="icon_mail"></i>
                <div class="info-text">
                    <span>Email:</span>
                    <p>{$rconf.email}</p>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section">
    <div class="top-nav" style="text-align: center; position: fixed; top: 0;right: 0;left: 0; z-index: 10; background-color: rgba(0,0,0,.6);">
        <!-- <div class="container" -->
            <div class="row">
                <div class="col-lg-12">
                    <nav class="main-menu">
                        <ul>
                            <li>
                                <a href="{$basedir}"><img src="{$themepath}img/logo.png" alt=""></a>
                            </li>
                            {$navbar}
                        </ul>
                    </nav>
                </div>
            </div>
        <!-- </div> -->
    </div>
    <div class="top-nav" style="text-align: center;">
        <!-- <div class="container" -->
            <div class="row">
                <div class="col-lg-12">
                    <nav class="main-menu">
                        <ul>
                            <li>
                                <a href="{$basedir}"><img src="{$themepath}img/logo.png" alt=""></a>
                            </li>
                            {$navbar}
                        </ul>
                    </nav>
                </div>
            </div>
        <!-- </div> -->
    </div>
</header>
<!-- Header End -->