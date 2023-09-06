
<!-- START HEADER -->
<header class="header_wrap dark_skin hover_menu_style3 main_menu_capitalize main_menu_weight_400 main_menu_size_16">
	<div class="top-header bg-dark light_skin">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <ul class="contact_detail list_none text-center text-md-left">
                        <li><i class="ti-mobile"></i>{$rconf.telp}</li>
                        <li><i class="ti-location-pin"></i> {$rconf.alamat}</li>
                    </ul>
                </div>
                <div class="col-md-2">
                	<div class="d-flex flex-wrap align-items-center justify-content-md-end justify-content-center">
                        <ul class="list_none social_icons text-center hover_style2 social_white text-md-right">
                            <li><a href="{$facebook}"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="https://twitter.com/{$twitter}"><i class="ion-social-twitter"></i></a></li>
                            <li hidden><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="https://instagram.com/{$instagram}"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                        <ul class="list_none header_list list_menu justify-content-center justify-content-md-start" hidden>
                            <li><a href="{$themepath}demo-education/register.html">Sign Up</a></li>
                            <li><a href="{$themepath}demo-education/login.html">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="container">
        <nav class="navbar navbar-expand-lg"> 
            <a class="navbar-brand" href="{$basedir}">
                <img class="logo_light" src="{$basedir}images/header-2-300x117.png" style="height: 41px;" alt="logo" />
                <img class="logo_dark" src="{$basedir}images/header-2-300x117.png" style="height: 41px;" alt="logo" />
                <img class="logo_default" src="{$basedir}images/header-2-300x117.png" style="height: 41px;" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="ion-android-menu"></span> </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                  {$navbar}
                </ul>
            </div>
            <ul class="navbar-nav attr-nav align-items-center" hidden>
                <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="ion-ios-search-strong"></i></a>
                    <div class="search-overlay">
                        <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                        <div class="search_wrap">
                            <form>
                                <input type="text" placeholder="Search" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
	</div>
</header>