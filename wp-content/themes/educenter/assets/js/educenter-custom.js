/**
 * Educenter Theme Custom Js
*/
jQuery(document).ready( function($){


    var brtl;
    if ($("body").hasClass('rtl')) {
        brtl = true;
    }else{
        brtl = false;
    }


    /**
     * Header Sticky sidebar
    */
    var headersticky = educenter_ajax_script.headersticky;

    
    if( headersticky == 1 ){
        try{
            $(".bottom-header").sticky({ topSpacing: 0 });
        }
        catch(e){
            //console.log( e );
        }
    }

    /**
     * Widget Sticky sidebar
    */
    var sidebarstick = educenter_ajax_script.sidebarstick;

    if( sidebarstick == 1 ){
        try{
            $('.content-area').theiaStickySidebar({
                additionalMarginTop: 30
            });

            $('.widget-area').theiaStickySidebar({
                additionalMarginTop: 30
            });
        }
        catch(e){
            //console.log( e );
        }
    }
    
    /**
     * Search Popup
    */
    $('.search').click(function() {
        $('.ed-pop-up').toggleClass('active');
    });

    $('.search-overlay').click(function() {
        $('.ed-pop-up').removeClass('active');
    });


    /**
     * Main Banner Slider
    */
    $(".slider-layout-2 .ed-slide").lightSlider({
        item: 1,
        slideMove: 1,
        slideMargin: 0,
        loop: true,
        auto: true,
        pager: false,
        mode: 'fade',
        useCSS: true,
        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
        easing: 'linear', //'for jquery animation',////
        controls: true,
        slideEndAnimation:true,
        speed:2000,
        pause:5000,
        enableDrag:false,
        rtl: brtl,
    });


    /**
     * Features Services Area
    */
    $(".ed-service-slide").lightSlider({
        item: $('.ed-service-slide').data('items') || 3,
        autoWidth: false,
        slideMove: 1,
        slideMargin: 20,
        loop: true,
        controls: false,
        adaptiveHeight: true,
        pager: true,
        rtl: brtl,
        onSliderLoad: function() {
            $('.ed-service-slide').removeClass('cS-hidden');
        },
        responsive: [{
                breakpoint: 1100,
                settings: {
                    item: 2,
                    slideMove: 1,
                    slideMargin: 20,
                }
            },
            {
                breakpoint: 640,
                settings: {
                    item: 1,
                    slideMove: 1,
                    slideMargin: 0,
                }
            }
        ]
    });


    /**
     * Success Product Counter
    */
    $('.educenter_counter_wrap').waypoint(function() {
        setTimeout(function() {
          $('.odometer1').html($('.odometer1').data('count'));
        }, 500);
        setTimeout(function() {
          $('.odometer2').html($('.odometer2').data('count'));
        }, 1000);
        setTimeout(function() {
          $('.odometer3').html($('.odometer3').data('count'));
        }, 1500);
        setTimeout(function() {
          $('.odometer4').html($('.odometer4').data('count'));
        }, 2000);
        setTimeout(function() {
          $('.odometer5').html($('.odometer5').data('count'));
        }, 2500);
        setTimeout(function() {
          $('.odometer6').html($('.odometer6').data('count'));
        }, 3000);
        setTimeout(function() {
          $('.odometer7').html($('.odometer7').data('count'));
        }, 3500);
        setTimeout(function() {
          $('.odometer8').html($('.odometer8').data('count'));
        }, 4000);
    }, {
      offset: 800,
      triggerOnce: true
    });


    /**
     * Latest News Blog Area
    */
    $(".ed-blog-slider").lightSlider({
        item: $('.ed-blog-slider').data('items') || 3,
        autoWidth: false,
        slideMove: 1,
        slideMargin: 10,
        loop: true,
        controls: false,
        adaptiveHeight: true,
        pager: true,
        rtl: brtl,
        onSliderLoad: function() {
            $('.ed-blog-slider').removeClass('cS-hidden');
        },
        responsive: [{
                breakpoint: 870,
                settings: {
                    item: 2,
                    slideMove: 1,
                    slideMargin: 10,
                }
            },
            {
                breakpoint: 570,
                settings: {
                    item: 1,
                    slideMove: 1,
                    slideMargin: 2,
                }
            }
        ]
    });


    /**
     * Our Team Member
    */
    $(".ed-team-wrapper").lightSlider({
        item: $(".ed-team-wrapper").data('items') || 3,
        autoWidth: false,
        slideMove: 1,
        slideMargin: 10,
        loop: true,
        controls: false,
        adaptiveHeight: false,
        pager: true,
        rtl: brtl,
        onSliderLoad: function() {
            $('.ed-team-wrapper').removeClass('cS-hidden');
        },
        responsive: [{
                breakpoint: 870,
                settings: {
                    item: 2,
                    slideMove: 1,
                    slideMargin: 10,
                }
            },
            {
                breakpoint: 570,
                settings: {
                    item: 1,
                    slideMove: 1,
                    slideMargin: 2,
                }
            }
        ]
    });


    /**
     * Our Testimonials
    */
    $(".ed-testimonial-wrap").lightSlider({
        item: $(".ed-testimonial-wrap").data('items') || 3,
        autoWidth: false,
        slideMove: 1,
        slideMargin: 30,
        loop: true,
        controls: false,
        adaptiveHeight: false,
        pager: true,
        rtl: brtl,
        onSliderLoad: function() {
            $('.ed-testimonial-wrap').removeClass('cS-hidden');
        },
        responsive: [{
                breakpoint: 870,
                settings: {
                    item: 2,
                    slideMove: 1,
                    slideMargin: 20,
                }
            },
            {
                breakpoint: 570,
                settings: {
                    item: 1,
                    slideMove: 1,
                    slideMargin: 2,
                }
            }
        ]
    });


    /**
     * Gallery Light Box
    */
    $("a[rel^='edugallery']").prettyPhoto({
        theme: 'light_rounded',
        slideshow: 5000,
        autoplay_slideshow: false,
        keyboard_shortcuts: true,
        deeplinking : false,
        default_width: 500,
        default_height: 344,
    });


    /**
     * Add Icon Sub Menu
    */
    $('.box-header-nav .menu-item-has-children').append('<span class="sub-toggle"><i class="fa fa-plus"></i></span>');
    //$('.box-header-nav .page_item_has_children').append('<span class="sub-toggle-children"> <i class="fas fa-plus"></i> </span>');

    $('.box-header-nav .sub-toggle').click(function () {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().toggle();
        $(this).children('.fa-plus').first().toggleClass('fa-minus');
    });


    /**
     * Toggle nav
    */
    $('.header-nav-search .toggle-button').on('click', function() {
        $('body').addClass('menu-active');
    });
    $('.close-icon').on('click', function() {
        $('body').removeClass('menu-active');
    });

    /**
     * Scroll To Top
    */
    $("#footer").on('click', '.goToTop', function(e){
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0,
        },'slow');
    });
    
    // Show/Hide Button on Window Scroll event.
    $(window).on('scroll', function(){
        var fromTop = $(this).scrollTop();
        var display = 'none';
        if(fromTop > 650){
            display = 'block';
        }
        $('#scrollTop').css({'display': display});
    });

    /** sidebar mobile menu */
    $('body').click(function(evt){
        
        //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
        if($(evt.target).closest('.cover-modal.active').length)
           return;             
 
       //Do processing of click event here for every element except with id menu_content
       if( $('body').hasClass('showing-menu-modal')){
            var body = document.body;
            
            $('.cover-modal.active').removeClass('active');
            body.classList.remove( 'showing-modal' );
            body.classList.add( 'hiding-modal' );
            body.classList.remove('showing-menu-modal');
            body.classList.remove('show-modal');

            document.documentElement.removeAttribute('style')
            document.body.style.removeProperty( 'padding-top' );


            // Remove the hiding class after a delay, when animations have been run.
            setTimeout( function() {
                body.classList.remove( 'hiding-modal' );
            }, 500 );
       }
       return;
    });

    /** wp event tab */
    $('.list-tab-event li a').click(function(e){
        e.preventDefault();
        $('.list-tab-event li').removeClass('active');
        $(this).parent().addClass('active');
        var hash = $(this).attr('href');
        
        $('.educenter-list-event').find('.tab-pane').removeClass('active');
        $('.educenter-list-event').find(hash).addClass('active');
    })
    
});