jQuery(document).ready(function($){
    var at_window = $(window),
        at_body = $('body');

    /*custom ticker by @acmethemes*/
    var ticker = $('.news-notice-content'),
        ticker_first = ticker.children(':first');

    if( ticker_first.length ){
        setInterval(function() {
            if ( !ticker_first.is(":hover") ){
                ticker_first.fadeOut(function() {
                    ticker_first.appendTo(ticker);
                    ticker_first = ticker.children(':first');
                    ticker_first.fadeIn();
                });
            }
        },3000);   
    }
    
    function homeFullScreen() {

        var homeSection = $('#at-banner-slider');
        var windowHeight = at_window.outerHeight();

        if (homeSection.hasClass('home-fullscreen')) {

            $('.home-fullscreen').css('height', windowHeight);
        }
    }
    //make slider full width
    homeFullScreen();

    //window resize
    at_window.resize(function () {
        homeFullScreen();
        appendMenuIcon();
    });

    at_window.on("load", function() {
        // function goes here
    });

    $('.acme-owl-carausel').show().owlCarousel({
        autoPlay : true,
        navigation : true, // Show next and prev buttons
        pagination : false, // Show next and prev buttons
        slideSpeed : 800,
        paginationSpeed : 600,
        singleItem:true,
        navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        addClassActive: true
    });

    /*parallax scolling*/
    $('a[href*="\\#"]').click(function(event){
        var at_offset= $.attr(this, 'href');
        var at_navbar= $('.at-navbar');
        var id = at_offset.substring(1, at_offset.length);
        if ( ! document.getElementById( id ) ) {
            return;
        }
        if( $( at_offset ).offset() ){
            var offset_height = at_navbar.height()*2 + 30;
            if( at_navbar.hasClass('navbar-fixed-top')){
                offset_height = (offset_height - 30)/2;
            }
            $('html, body').animate({
                scrollTop: $( at_offset ).offset().top-offset_height
            }, 1000);
        }
    });

    /*bootstrap sroolpy*/
    $("body").scrollspy({target: ".navbar-fixed-top", offset: $('.at-navbar').height()+50 } );

    /*featured slider*/
    $('.acme-gallery').each(function(){
        var $masonry_boxes = $(this);
        var $container = $masonry_boxes.find('.fullwidth-row');
        $container.imagesLoaded( function(){
            $masonry_boxes.fadeIn( 'slow' );
            $container.masonry({
                itemSelector : '.at-gallery-item'
            });
        });
        /*widget*/
        $masonry_boxes.find('.image-gallery-widget').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }

        });
        $masonry_boxes.find('.single-image-widget').magnificPopup({
            type: 'image'
        });
    });

    function stickyMenu() {
        var sticky_header = $('.at-sticky-header .education-base-main-header-wrapper');
        if ( sticky_header.length ) {
            at_body.css('padding-top',sticky_header.height())
        }
        var scrollTop = at_window.scrollTop();
        var offset = 0;

        if ( scrollTop > offset ) {
            $('.education-base-sticky').addClass('navbar-fixed-top');
            $('.sm-up-container').show();
        }
        else {
            $('.education-base-sticky').removeClass('navbar-fixed-top');
            $('.sm-up-container').hide();
        }
    }
    //What happen on window scroll
    stickyMenu();
    at_window.on("scroll", function (e) {
        setTimeout(function () {
            stickyMenu();
        }, 300)
    });

    /*Append icon*/
    function appendMenuIcon(){
        if( $(window).width() <=1023){
            if( !$('.main-navigation .menu-item-has-children .at-submenu-icon').length ){
                $('.main-navigation .menu-item-has-children').append('<i class="at-submenu-icon fa fa-angle-down"></i>');
            }
        }
        else{
            $('.main-navigation .menu-item-has-children .at-submenu-icon').remove();
        }
    }
    appendMenuIcon()
    /*Navbar custom functions*/
    $(document).on("click", ".at-submenu-icon", function(e) {
        e.preventDefault();
        let submenu = $(this).siblings('.sub-menu');
        if ($(submenu).is(':hidden')) {
            $(this).removeClass('fa-angle-down');
            $(this).addClass('fa-angle-up');
            $(this).parent().addClass('at-submenu-active');
            $(submenu).slideDown(200);
        } else {
            $(this).addClass('fa-angle-down');
            $(this).removeClass('fa-angle-up');
            $(submenu).slideUp(200);
            $(this).parent().removeClass('at-submenu-active')

        }
    });

});

/*animation with wow*/

if(typeof WOW !== 'undefined'){
    eb_wow = new WOW({
            boxClass: 'init-animate',
            animateClass: 'animated' // default
        }
    );
    eb_wow.init();
}

/**
 * Skip link focus fixed
 */
( function() {
    var isIe = /(trident|msie)/i.test( navigator.userAgent );
    if ( isIe && document.getElementById && window.addEventListener ) {
        window.addEventListener(
            'hashchange',
            function() {
                var id = location.hash.substring( 1 ),
                    element;

                if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
                    return;
                }

                element = document.getElementById( id );

                if ( element ) {
                    if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
                        element.tabIndex = -1;
                    }

                    element.focus();
                }
            },
            false
        );
    }
}() );
