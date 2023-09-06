/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2017, Codrops
 * http://www.codrops.com
 */

class Details {

    constructor() {
        this.DOM = {};

        const detailsTmpl = `
        <div class="theme-modelbox-bg theme-modelbox-bg-up"></div>
        <div class="theme-modelbox-bg theme-modelbox-bg-down"></div>
        <div class="quick_details_content">
        <h2 class="details__title"></h2>
        <p class="details__excerpt"></p>
        <p class="details__description"></p>
        <a class="read_more_popup"><span class="btn-arrow"></span><span class="btn-arrow-text">`+minimal_photography_animation.read_more+`</span></a>
        </div>
        <img class="details__img" src="" alt="img 01"/>
        <div id="twp-popup-content" class="details_media"></div>
        <button class="details__close"><svg viewBox="0 0 320 512" class="icon icon--cross"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" ></path></svg></button>
        `;

        this.DOM.details = document.createElement('div');
        this.DOM.details.className = 'details';
        this.DOM.details.innerHTML = detailsTmpl;
        DOM.content.appendChild(this.DOM.details);
        this.init();

    }

    init() {

        this.DOM.bgUp = this.DOM.details.querySelector('.theme-modelbox-bg-up');
        this.DOM.bgDown = this.DOM.details.querySelector('.theme-modelbox-bg-down');

        this.DOM.img = this.DOM.details.querySelector('.details__img');
        this.DOM.details_media = this.DOM.details.querySelector('.details_media');
        this.DOM.quick_details_content = this.DOM.details.querySelector('.quick_details_content');

        this.DOM.title = this.DOM.details.querySelector('.details__title');
        this.DOM.excerpt = this.DOM.details.querySelector('.details__excerpt');
        this.DOM.description = this.DOM.details.querySelector('.details__description');
        this.DOM.readmore = this.DOM.details.querySelector('.read_more_popup');
        this.DOM.close = this.DOM.details.querySelector('.details__close');

        this.initEvents();

    }
    initEvents() {

        this.DOM.close.addEventListener('click', () => this.isZoomed ? this.zoomOut() : this.close());

    }

    fill(info) {

        if( info.img ){

            this.DOM.details_media.style.display = "none";
            this.DOM.img.style.display = "block";
            this.DOM.img.src = info.img;

        }else{

            this.DOM.img.style.display = "none";

            if( info.media ){

                this.DOM.details_media.style.display = "block";

                this.DOM.details_media.innerHTML = info.media;

                // Youtube Video Custom Controls Start
                var action = [];
                var iframe = document.getElementsByClassName("details_media");
                var src;

                Array.prototype.forEach.call(iframe, function(el) {
                    // Do stuff here
                    
                    jQuery(document).ready(function ($) {
                        "use strict";
                        
                        var id = $(el).find('.video-main-wraper').attr('data-id')+'-popup';
                        ;
                        if( id == 'undefined-popup' ){
                            id = $(el).find('.video-main-wraper-ajax').attr('data-id')+'-popup';
                        }
                        src = $(el).find('iframe').attr('src');

                        if( src ){

                            if( src.indexOf('youtube.com') != -1 ){

                                $(el).find('iframe').attr('id',id);
                                $(el).find('iframe').addClass('twp-iframe-video-youtube-popup');
                                $(el).find('iframe').attr('src',src+'&enablejsapi=1&autoplay=1&mute=1&rel=0&modestbranding=0&autohide=0&showinfo=0&controls=0&loop=1');

                            }

                            if( src.indexOf('vimeo.com') != -1 ){

                                Minimal_Photography_Vimeo();

                                $(el).find('iframe').attr('id',id);
                                $(el).find('iframe').addClass('twp-iframe-video-vimeo');
                                $(el).find('iframe').attr('src',src+'&title=0&byline=0&portrait=0&transparent=0&autoplay=1&controls=0&loop=1');
                                $(el).find('iframe').attr('allow','autoplay;');

                                var player = document.getElementById(id);

                                $(player).vimeo("setVolume", 0);

                                $('#'+id).closest('.entry-video').find('.twp-mute-unmute').on('click',function(){

                                    
                                    if( $(this).hasClass('unmute') ){

                                        $(player).vimeo("setVolume", 1);
                                        $(this).removeClass('unmute');
                                        $(this).addClass('mute');
                                        $(this).find('.twp-video-control-action').html(minimal_photography_custom.unmute);
                                        $(this).find('.screen-reader-text').html(minimal_photography_custom.unmute_text);

                                    }else if( $(this).hasClass('mute') ){

                                        $(player).vimeo("setVolume", 0);
                                        $(this).removeClass('mute');
                                        $(this).addClass('unmute');
                                        $(this).find('.twp-video-control-action').html(minimal_photography_custom.mute);
                                        $(this).find('.screen-reader-text').html(minimal_photography_custom.mute_text);

                                    }

                                });

                                $('#'+id).closest('.entry-video').find('.twp-pause-play').on('click',function(){

                                    if( $(this).hasClass('play') ){

                                        $(player).vimeo('play');
                                        
                                        $(this).removeClass('play');
                                        $(this).addClass('pause');
                                        $(this).find('.twp-video-control-action').html(minimal_photography_custom.pause);
                                        $(this).find('.screen-reader-text').html(minimal_photography_custom.pause_text);

                                    }else if( $(this).hasClass('pause') ){
                                        
                                        $(player).vimeo('pause');
                                        $(this).removeClass('pause');
                                        $(this).addClass('play');
                                        $(this).find('.twp-video-control-action').html(minimal_photography_custom.play);
                                        $(this).find('.screen-reader-text').html(minimal_photography_custom.play_text);

                                    }

                                });

                            }

                        }else{

                            var currentVideo;
                            $(el).find('video').attr('loop','loop');
                            $(el).find('video').attr('autoplay','autoplay');
                            $(el).find('video').removeAttr('controls');
                            $(el).find('video').attr('id',id);

                            $('#'+id).closest('.entry-video').find('.twp-mute-unmute').on('click',function(){

                                if( $(this).hasClass('unmute') ){

                                    currentVideo = document.getElementById(id);
                                    $(currentVideo).prop('muted', false);

                                    $(this).removeClass('unmute');
                                    $(this).addClass('mute');
                                    $(this).find('.twp-video-control-action').html(minimal_photography_custom.unmute);
                                    $(this).find('.screen-reader-text').html(minimal_photography_custom.unmute_text);

                                }else if( $(this).hasClass('mute') ){

                                    currentVideo = document.getElementById(id);
                                    $(currentVideo).prop('muted', true);
                                    $(this).removeClass('mute');
                                    $(this).addClass('unmute');
                                    $(this).find('.twp-video-control-action').html(minimal_photography_custom.mute);
                                    $(this).find('.screen-reader-text').html(minimal_photography_custom.mute_text);

                                }

                            });

                            if( id != 'undefined-popup' ){
                            
                                setTimeout(function(){

                                    currentVideo = document.getElementById(id);
                                    currentVideo.play();

                                },2000);

                            }

                            $('#'+id).closest('.entry-video').find('.twp-pause-play').on('click',function(){

                                if( $(this).hasClass('play') ){

                                    currentVideo = document.getElementById(id);
                                    currentVideo.play();
                                    
                                    $(this).removeClass('play');
                                    $(this).addClass('pause');
                                    $(this).find('.twp-video-control-action').html(minimal_photography_custom.pause);
                                    $(this).find('.screen-reader-text').html(minimal_photography_custom.pause_text);

                                }else if( $(this).hasClass('pause') ){

                                    currentVideo = document.getElementById(id);
                                    currentVideo.pause();

                                    $(this).removeClass('pause');
                                    $(this).addClass('play');
                                    $(this).find('.twp-video-control-action').html(minimal_photography_custom.play);
                                    $(this).find('.screen-reader-text').html(minimal_photography_custom.play_text);

                                }

                            });
            
                        }

                    });

                });

                onYouTubePlayerAPIReady();
                // this function gets called when API is ready to use
                function onYouTubePlayerAPIReady() {

                    jQuery(document).ready(function ($) {
                        "use strict";

                        $('.twp-iframe-video-youtube-popup').each(function(){


                            var id = $(this).attr('id');

                            // create the global action from the specific iframe (#video)
                            action[id] = new YT.Player(id, {
                                events: {
                                    // call this function when action is ready to use
                                    'onReady': function onReady() {

                                        $('#'+id).closest('.entry-video').find('.twp-pause-play').on('click',function(){

                                            var id = $(this).attr('attr-id')+'-popup';
                                            
                                            if( $(this).hasClass('play') ){

                                                action[id].playVideo();
                                                
                                                $(this).removeClass('play');
                                                $(this).addClass('pause');
                                                $(this).find('.twp-video-control-action').html(minimal_photography_custom.pause);
                                                $(this).find('.screen-reader-text').html(minimal_photography_custom.pause_text);

                                            }else if( $(this).hasClass('pause') ){

                                                action[id].pauseVideo();
                                                $(this).removeClass('pause');
                                                $(this).addClass('play');
                                                $(this).find('.twp-video-control-action').html(minimal_photography_custom.play);
                                                $(this).find('.screen-reader-text').html(minimal_photography_custom.play_text);

                                            }
                                            

                                        });

                                        $('#'+id).closest('.entry-video').find('.twp-mute-unmute').on('click',function(){

                                            var id = $(this).attr('attr-id')+'-popup';
                                            if( $(this).hasClass('unmute') ){

                                                action[id].unMute();
                                                
                                                $(this).removeClass('unmute');
                                                $(this).addClass('mute');
                                                $(this).find('.twp-video-control-action').html(minimal_photography_custom.unmute);
                                                $(this).find('.screen-reader-text').html(minimal_photography_custom.unmute_text);

                                            }else if( $(this).hasClass('mute') ){

                                                action[id].mute();
                                                $(this).removeClass('mute');
                                                $(this).addClass('unmute');
                                                $(this).find('.twp-video-control-action').html(minimal_photography_custom.mute);
                                                $(this).find('.screen-reader-text').html(minimal_photography_custom.mute_text);

                                            }
                                            

                                        });

                                    },
                                }
                            });

                        });

                    });
                }

                jQuery(document).ready(function ($) {

                    var rtled = false;

                    if( $('body').hasClass('rtl') ){
                        rtled = true;
                    }

                    setTimeout(function(){

                        // Content Gallery Slide Start
                        $(".details_media ul.wp-block-gallery.columns-1, .details_media .wp-block-gallery.columns-1 .blocks-gallery-grid, .details_media .gallery-columns-1,  .details_media .twp-content-gallery .wp-block-gallery.columns-1 .blocks-gallery-grid").each(function () {


                            var slidehtml = '';
                            slidehtml += '<figure class="wp-block-gallery columns-1 is-cropped"><ul class="blocks-gallery-grid custom-slick">';

                            $(this).find('figure').each(function(){
                                
                                var src = $(this).find('img').attr('src');

                                if( src ){

                                    slidehtml += '<li class="blocks-gallery-item"><figure>';
                                    slidehtml += '<img src="'+src+'" >';
                                    slidehtml += '</figure></li>';

                                }

                            });
                            

                            slidehtml += '</ul></figure>';
                            
                            $('.details_media').html(slidehtml);


                            $('.blocks-gallery-grid.custom-slick').slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                fade: true,
                                autoplay: false,
                                autoplaySpeed: 8000,
                                infinite: true,
                                nextArrow: '<button type="button" class="slide-btn slide-next-icon"></button>',
                                prevArrow: '<button type="button" class="slide-btn slide-prev-icon"></button>',
                                dots: false,
                                rtl: rtled,
                            });

                            setTimeout(function(){

                                $('div#twp-popup-content li img').css("opacity", "1");
                                
                            },500);
                            

                        });

                    }, 50);

                });

            }else{

                this.DOM.details_media.style.display = "none";

            }
            
        }
        
        if( info.href ){

            this.DOM.readmore.style.display = "block";
            this.DOM.readmore.href = info.href;

        }else{

            this.DOM.readmore.style.display = "none";

        }

        this.DOM.title.innerHTML = info.title;

        if( info.title ){

            this.DOM.title.style.display = "block";
            this.DOM.title.innerHTML = info.title;

        }else{

            this.DOM.title.style.display = "none";

        }

        if( info.description ){

            this.DOM.description.style.display = "block";
            this.DOM.description.innerHTML = info.description;

        }else{

            this.DOM.description.style.display = "none";

        }

        if( info.excerpt ){

            this.DOM.excerpt.style.display = "block";
            this.DOM.excerpt.innerHTML = info.excerpt;

        }else{

            this.DOM.excerpt.style.display = "none";

        }
        
    }
    getProductDetailsRect() {

        var returnval = {

            productBgRect: this.DOM.productBg.getBoundingClientRect(),
            detailsBgRect: this.DOM.bgDown.getBoundingClientRect(),
            detailsImgRect: this.DOM.img.getBoundingClientRect(),
            detailsMediaRect: this.DOM.details_media.getBoundingClientRect(),

        }

        if( this.DOM.productImg ){

            returnval['productImgRect'] = this.DOM.productImg.getBoundingClientRect();
        }

        if( this.DOM.medias ){
            
            returnval['productMediaRect'] = this.DOM.medias.getBoundingClientRect();

        }

        return returnval;

    }
    open(data) {

        if ( this.isAnimating ) return false;
        this.isAnimating = true;

        this.DOM.details.classList.add('details--open');
        
        this.DOM.productBg = data.productBg;

        if( data.productImg ){
            this.DOM.productImg = data.productImg;
        }

        if( data.medias ){
            this.DOM.medias = data.medias;
        }

        this.DOM.productBg.style.opacity = 0;

        if( data.productImg ){
            this.DOM.productImg.style.opacity = 0;
        }

        if( data.medias ){
            this.DOM.medias.style.opacity = 0;
        }

        const rect = this.getProductDetailsRect();


        this.DOM.bgDown.style.transform = `translateX(${rect.productBgRect.left-rect.detailsBgRect.left}px) translateY(${rect.productBgRect.top-rect.detailsBgRect.top}px) scaleX(${rect.productBgRect.width/rect.detailsBgRect.width}) scaleY(${rect.productBgRect.height/rect.detailsBgRect.height})`;
        this.DOM.bgDown.style.opacity = 1;
        
        if( rect.productImgRect ){

            this.DOM.img.style.transform = `translateX(${rect.productImgRect.left-rect.detailsImgRect.left}px) translateY(${rect.productImgRect.top-rect.detailsImgRect.top}px) scaleX(${rect.productImgRect.width/rect.detailsImgRect.width}) scaleY(${rect.productImgRect.height/rect.detailsImgRect.height})`;
            this.DOM.img.style.opacity = 1;

        }

        if( rect.productMediaRect ){

            this.DOM.details_media.style.transform = `translateX(${rect.productMediaRect.left-rect.detailsMediaRect.left}px) translateY(${rect.productMediaRect.top-rect.detailsMediaRect.top}px) scaleX(${rect.productMediaRect.width/rect.detailsMediaRect.width}) scaleY(${rect.productMediaRect.height/rect.detailsMediaRect.height})`;
            this.DOM.details_media.style.opacity = 1;

        }

        anime({
            targets: [this.DOM.bgDown,this.DOM.img,this.DOM.details_media],
            duration: (target, index) => index ? 1000 : 250,
            easing: (target, index) => index ? 'easeOutElastic' : 'easeOutSine',
            elasticity: 250,
            translateX: 0,
            translateY: 0,
            scaleX: 1,
            scaleY: 1,
            complete: () => this.isAnimating = false
        });

        anime({
            targets: [this.DOM.title, this.DOM.description, this.DOM.excerpt, this.DOM.readmore, this.DOM.quick_details_content],
            duration: 600,
            easing: 'easeOutExpo',
            delay: (target, index) => {
                return index*60;
            },
            translateY: (target, index, total) => {
                return index !== total - 1 ? [50,0] : 0;
            },
            scale:  (target, index, total) => {
                return index === total - 1 ? [0,1] : 1;
            },
            opacity: 1
        });

        anime({
            targets: this.DOM.bgUp,
            duration: 100,
            easing: 'linear',
            opacity: 1
        });

        anime({
            targets: this.DOM.close,
            duration: 250,
            easing: 'easeOutSine',
            translateY: ['100%',0],
            opacity: 1
        });

    }
    close() {
        if ( this.isAnimating ) return false;
        this.isAnimating = true;

        this.DOM.details.classList.remove('details--open');

        anime({
            targets: this.DOM.close,
            duration: 250,
            easing: 'easeOutSine',
            translateY: '100%',
            opacity: 0
        });

        anime({
            targets: this.DOM.bgUp,
            duration: 100,
            easing: 'linear',
            opacity: 0
        });

        anime({
            targets: [this.DOM.title, this.DOM.description, this.DOM.excerpt, this.DOM.readmore, this.DOM.quick_details_content],
            duration: 20,
            easing: 'linear',
            opacity: 0
        });

        const rect = this.getProductDetailsRect();
        anime({
            targets: [this.DOM.bgDown,this.DOM.img,this.DOM.details_media],
            duration: 250,
            easing: 'easeOutSine',
            translateX: (target, index) => {

                if( rect.productImgRect ){
                    return index ? rect.productImgRect.left-rect.detailsImgRect.left : rect.productBgRect.left-rect.detailsBgRect.left;
                }else{

                    if( rect.productMediaRect ){
                        return index ? rect.productMediaRect.left-rect.detailsMediaRect.left : rect.productBgRect.left-rect.detailsBgRect.left;
                    }else{
                        return index ? 0 : 0;
                    }
                }

            },
            translateY: (target, index) => {

                if( rect.productImgRect ){
                    return index ? rect.productImgRect.top-rect.detailsImgRect.top : rect.productBgRect.top-rect.detailsBgRect.top;
                }else{

                    if( rect.productMediaRect ){
                        return index ? rect.productMediaRect.top-rect.detailsMediaRect.top : rect.productBgRect.top-rect.detailsBgRect.top;
                    }else{
                        return index ? 0 : 0;
                    }
                }

            },
            scaleX: (target, index) => {

                if( rect.productImgRect ){
                    return index ? rect.productImgRect.width/rect.detailsImgRect.width : rect.productBgRect.width/rect.detailsBgRect.width;
                }else{

                    if( rect.productMediaRect ){
                        return index ? rect.productMediaRect.width/rect.detailsMediaRect.width : rect.productBgRect.width/rect.detailsBgRect.width;
                    }else{
                        return index ? 0 : 0;
                    }
                }

            },
            scaleY: (target, index) => {

                if( rect.productImgRect ){
                    return index ? rect.productImgRect.height/rect.detailsImgRect.height : rect.productBgRect.height/rect.detailsBgRect.height;
                }else{

                    if( rect.productMediaRect ){
                        return index ? rect.productMediaRect.width/rect.detailsMediaRect.width : rect.productBgRect.width/rect.detailsBgRect.width;
                    }else{
                        return index ? 0 : 0;
                    }
                }

            },
            complete: () => {
                this.DOM.bgDown.style.opacity = 0;
                this.DOM.img.style.opacity = 0;
                this.DOM.details_media.style.opacity = 0;
                this.DOM.bgDown.style.transform = 'none';
                this.DOM.img.style.transform = 'none';
                this.DOM.details_media.style.transform = 'none';
                this.DOM.productBg.style.opacity = 1;
                if( this.DOM.productImg ){
                    this.DOM.productImg.style.opacity = 1;
                }
                if( this.DOM.medias ){
                    this.DOM.medias.style.opacity = 1;
                }
                this.isAnimating = false;
                this.DOM.medias = '';
                this.DOM.productImg = '';
                this.DOM.details_media.innerHTML = '';

                jQuery(document).ready(function ($) {

                    $('.details_media').html('');

                });
            }
        });
    }

    zoomIn() {
        this.isZoomed = true;

        anime({
            targets: [this.DOM.title, this.DOM.description, this.DOM.excerpt, this.DOM.readmore, this.DOM.quick_details_content],
            duration: 100,
            easing: 'easeOutSine',
            translateY: (target, index, total) => {
                return index !== total - 1 ? [0, index === 0 || index === 1 ? -50 : 50] : 0;
            },
            scale:  (target, index, total) => {
                return index === total - 1 ? [1,0] : 1;
            },
            opacity: 0
        });

        if( this.DOM.img ){
            const imgrect = this.DOM.img.getBoundingClientRect();
        }else{
            const imgrect = this.DOM.details_media.getBoundingClientRect();
        }
        const win = {w: window.innerWidth, h: window.innerHeight};
        
        const imgAnimeOpts = '';
        if( this.DOM.img ){

            imgAnimeOpts = {
                targets: this.DOM.img,
                duration: 250,
                easing: 'easeOutCubic',
                translateX: win.w/2 - (imgrect.left+imgrect.width/2),
                translateY: win.h/2 - (imgrect.top+imgrect.height/2)
            };

        }else{

            imgAnimeOpts = {
                targets: this.DOM.details_media,
                duration: 250,
                easing: 'easeOutCubic',
                translateX: win.w/2 - (imgrect.left+imgrect.width/2),
                translateY: win.h/2 - (imgrect.top+imgrect.height/2)
            };

        }

        if( this.DOM.img ){

            if ( win.w > 0.8*win.h && this.DOM.img ) {
                this.DOM.img.style.transformOrigin = '50% 50%';
                Object.assign(imgAnimeOpts, {
                    scaleX: 0.95*win.w/parseInt(0.8*win.h),
                    scaleY: 0.95*win.w/parseInt(0.8*win.h),
                    rotate: 90
                });
            }

        }else{

            if ( win.w > 0.8*win.h && this.DOM.details_media ) {
                this.DOM.details_media.style.transformOrigin = '50% 50%';
                Object.assign(imgAnimeOpts, {
                    scaleX: 0.95*win.w/parseInt(0.8*win.h),
                    scaleY: 0.95*win.w/parseInt(0.8*win.h),
                    rotate: 90
                });
            }

        }

        anime(imgAnimeOpts);

        anime({
            targets: this.DOM.close,
            duration: 250,
            easing: 'easeInOutCubic',
            scale: 1.8,
            rotate: 180
        });
    }

    zoomOut() {

        if ( this.isAnimating ) return false;
        this.isAnimating = true;
        this.isZoomed = false;

        anime({
            targets: [this.DOM.title, this.DOM.description, this.DOM.excerpt, this.DOM.readmore, this.DOM.quick_details_content],
            duration: 250,
            easing: 'easeOutCubic',
            translateY: 0,
            scale: 1,
            opacity: 1
        });

        anime({
            targets: this.DOM.img,
            duration: 250,
            easing: 'easeOutCubic',
            translateX: 0,
            translateY: 0,
            scaleX: 1,
            scaleY: 1,
            rotate: 0,
            complete: () => {
                this.DOM.img.style.transformOrigin = '0 0';
                this.isAnimating = false;
            }
        });

        anime({
            targets: this.DOM.details_media,
            duration: 250,
            easing: 'easeOutCubic',
            translateX: 0,
            translateY: 0,
            scaleX: 1,
            scaleY: 1,
            rotate: 0,
            complete: () => {
                this.DOM.details_media.style.transformOrigin = '0 0';
                this.isAnimating = false;
            }
        });

        anime({
            targets: this.DOM.close,
            duration: 250,
            easing: 'easeInOutCubic',
            scale: 1,
            rotate: 0
        });

    }

};

class Item {

	constructor(el) {

		this.DOM = {};
        this.DOM.el = el;
        this.DOM.product = this.DOM.el.querySelector('.twp-archive-items');
        this.DOM.productBg = this.DOM.product.querySelector('.anime-bg');
        this.DOM.animationtrigger = this.DOM.product.querySelector('.anime-image-trigger');
        this.DOM.productImg = this.DOM.product.querySelector('.anime-bg-image');
        this.DOM.EntryTitle = this.DOM.product.querySelector('.entry-title a');
        this.DOM.EntryDesc = this.DOM.product.querySelector('.entry-content-detail');
        this.DOM.Permalink = this.DOM.product.querySelector('.mp-read-more-src');
        this.DOM.medias = this.DOM.product.querySelector('.entry-content-media');
        this.DOM.excerptContent = this.DOM.product.querySelector('.entry-content');
        this.info = {};

        if ( this.DOM.productImg ){

            const imgresult = this.DOM.productImg.hasAttribute('src');

            if( imgresult ){

                this.info['img'] = this.DOM.productImg.src;

            }

        }else{

            if( this.DOM.medias ){
                this.info['media'] = this.DOM.product.querySelector('.entry-content-media').innerHTML;
            }

        }

        if ( this.DOM.Permalink ){

            const permalinksrc = this.DOM.Permalink.hasAttribute('href');

            if( permalinksrc ){

                this.info['href'] = this.DOM.Permalink.href;

            }

        }

        if ( this.DOM.EntryTitle ){

            this.info['title'] = this.DOM.product.querySelector('.entry-title a').innerHTML;

        }

        if ( this.DOM.EntryDesc ){

            this.info['description'] = this.DOM.product.querySelector('.entry-content-detail').innerHTML;

        }

        if ( this.DOM.excerptContent ){

            this.info['excerpt'] = this.DOM.product.querySelector('.entry-content').innerHTML;

        }

		this.initEvents();

	}

    initEvents() {

        if ( this.DOM.animationtrigger ){
            this.DOM.animationtrigger.addEventListener('click', () => this.open());
        }

        if ( this.DOM.EntryTitle ){

            this.DOM.EntryTitle.addEventListener('click', () => this.open());

        }

    }

    open() {

        DOM.details.fill(this.info);

        var detaildata = {
            productBg: this.DOM.productBg,
        }

        if( this.DOM.medias ){
            detaildata['medias'] = this.DOM.medias
        }

        if( this.DOM.productImg ){
            detaildata['productImg'] = this.DOM.productImg
        }

        DOM.details.open(detaildata);



    }

};

const DOM = {};
DOM.grid = document.querySelector('.theme-panelarea-anime');

if( DOM.grid ){

    DOM.content = DOM.grid.parentNode;
    DOM.gridItems = Array.from(DOM.grid.querySelectorAll('.twp-archive-items-main'));
    let items = [];
    DOM.gridItems.forEach(item => items.push(new Item(item)));

    DOM.details = new Details();

    imagesLoaded(document.body, () => document.body.classList.remove('loading'));

}