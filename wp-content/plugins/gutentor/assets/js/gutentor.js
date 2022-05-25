(function($) {
    const gDocument = $(document),
        gProgressBarB = $('.gutentor-porgress-bar-item'),
        gProgressBarE = $('.gutentor-element-progressbar'),
        counter_block = $('.gutentor-counter'),
        counter_element = $('.gutentor-element-counter'),
        gWindow = $(window),
        gBody = $('body'),
        gWindowWidth = gWindow.width();

    /*Gutentor Slick*/
    function gBooleanVal(val) {
        if (typeof val === 'boolean') {
            return val;
        }
        return (val === 'true');
    }

    function gSlick(gThis) {
        let gss = {}; /*Slick Setting*/
        if (gThis[0].hasAttribute('data-dots')) {
            gss.dots = gBooleanVal(gThis.data('dots'));
        }
        if (gThis[0].hasAttribute('data-arrows')) {
            gss.arrows = gBooleanVal(gThis.data('arrows'));
        }
        if (gThis[0].hasAttribute('data-infinite')) {
            gss.infinite = gBooleanVal(gThis.data('infinite'));
        }
        if (gThis[0].hasAttribute('data-speed')) {
            gss.speed = parseInt(gThis.data('speed'));
        }
        if (gThis[0].hasAttribute('data-slideitemdesktop')) {
            gss.slidesToShow = parseInt(gThis.data('slideitemdesktop'));
        }
        if (gThis[0].hasAttribute('data-slidescroll-desktop')) {
            gss.slidesToScroll = parseInt(gThis.data('slidescroll-desktop'));
        }
        if (gThis[0].hasAttribute('data-nextarrow')) {
            gss.nextArrow = '<span class="slick-next"><i class="' + gThis.data('nextarrow') + '"></i></span>';
        } else {
            gss.nextArrow = '<span class="slick-next"><i class="fas fa-angle-right"></i></span>';
        }
        if (gThis[0].hasAttribute('data-prevarrow')) {
            gss.prevArrow = '<span class="slick-prev"><i class="' + gThis.data('prevarrow') + '"></i></span>';
        } else {
            gss.prevArrow = '<span class="slick-prev"><i class="fas fa-angle-left"></i></span>';
        }
        if (gThis[0].hasAttribute('data-autoplay')) {
            gss.autoplay = gBooleanVal(gThis.data('autoplay'));
            if (gThis[0].hasAttribute('data-autoplayspeed')) {
                gss.autoplaySpeed = parseInt(gThis.data('autoplayspeed'));
            }
            if (gThis[0].hasAttribute('data-pauseonfocus')) {
                gss.pauseOnFocus = gBooleanVal(gThis.data('pauseonfocus'));
            }
            if (gThis[0].hasAttribute('data-pauseonhover')) {
                gss.pauseOnHover = gBooleanVal(gThis.data('pauseonhover'));
            }
        }
        if (gThis[0].hasAttribute('data-draggable')) {
            gss.draggable = gBooleanVal(gThis.data('draggable'));
        }
        if (gThis[0].hasAttribute('data-fade')) {
            gss.fade = gBooleanVal(gThis.data('fade'));
        }
        if (gThis[0].hasAttribute('data-blockimagesliderfade')) {
            gss.fade = gBooleanVal(gThis.data('blockimagesliderfade'));
        }
        if (gThis[0].hasAttribute('data-cmondesktop')) {
            gss.centerMode = gBooleanVal(gThis.data('cmondesktop'));
            if(gBooleanVal(gThis.data('cmondesktop'))){
                if (gThis[0].hasAttribute('data-cmpaddingdesktop')) {
                    gss.centerPadding = gThis.data('cmpaddingdesktop');
                }
            }
        }

        /*Responsive Setting*/
        let rTgss = {},
            rMgss = {};
        if (gThis[0].hasAttribute('data-slideitemtablet')) {
            rTgss.slidesToShow = parseInt(gThis.data('slideitemtablet'));
        }
        if (gThis[0].hasAttribute('data-slidescroll-tablet')) {
            rTgss.slidesToScroll = parseInt(gThis.data('slidescroll-tablet'));
        }
        if (gThis[0].hasAttribute('data-dotstablet')) {
            rTgss.dots = gBooleanVal(gThis.data('dotstablet'));
        }
        if (gThis[0].hasAttribute('data-arrowstablet')) {
            rTgss.arrows = gBooleanVal(gThis.data('arrowstablet'));
        }
        if (gThis[0].hasAttribute('data-cmontablet')) {
            rTgss.centerMode = gBooleanVal(gThis.data('cmontablet'));
            if(gBooleanVal(gThis.data('cmontablet'))){
                if (gThis[0].hasAttribute('data-cmpaddingtablet')) {
                    rTgss.centerPadding = gThis.data('cmpaddingtablet');
                }
            }
        }

       /*Responsive mobile*/
        if (gThis[0].hasAttribute('data-slideitemmobile')) {
            rMgss.slidesToShow = parseInt(gThis.data('slideitemmobile'));
        }
        if (gThis[0].hasAttribute('data-slidescroll-mobile')) {
            rMgss.slidesToScroll = parseInt(gThis.data('slidescroll-mobile'));
        }
        if (gThis[0].hasAttribute('data-dotsmobile')) {
            rMgss.dots = gBooleanVal(gThis.data('dotsmobile'));
        }
        if (gThis[0].hasAttribute('data-arrowsmobile')) {
            rMgss.arrows = gBooleanVal(gThis.data('arrowsmobile'));
        }
        if (gThis[0].hasAttribute('data-cmonmobile')) {
            rMgss.centerMode = gBooleanVal(gThis.data('cmonmobile'));
            if(gBooleanVal(gThis.data('cmonmobile'))){
                if (gThis[0].hasAttribute('data-cmpaddingmobile')) {
                    rMgss.centerPadding = gThis.data('cmpaddingmobile');
                }
            }
        }
        let rTSettings = {
                breakpoint: 1024,
                settings: rTgss
            },
            rMSettings = {
                breakpoint: 480,
                settings: rMgss
            };

        gss.responsive = [];
        gss.responsive.push(rTSettings);
        gss.responsive.push(rMSettings);

        /*Arrow Position*/
        if (gThis[0].hasAttribute('data-arrowspositiondesktop') && 'gutentor-slick-a-default-desktop' !== gThis.data('arrowspositiondesktop')) {
            gss.appendArrows = gThis.siblings('.gutentor-slick-arrows');
        }
        /*RTL*/
        if (gBody.hasClass('rtl')) {
            gss.rtl = true;
        }
        /*Finally call Slick*/
        gThis.slick(gss);
    }

    /*Magnific Popup
    * gThis
    * isI => is image
    * isG => is gallery
    * */
    function gMagnificPopup(gThis, isI = false, isG = false) {
        let gma = {};
        if (isI) {
            gma = {
                type: 'image',
                closeBtnInside: false,
                fixedContentPos: false
            };
        } else {
            gma = {
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false,
            };
        }
        if (isG) {
            gma.gallery = {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            };
            gma.callbacks = {
                elementParse: function(item) {

                    if (item.el[0].getAttribute("data-media-type") === 'g-popup-video') {
                        item.type = 'iframe';
                    } else {
                        item.type = 'image';
                    }

                }
            }
        }
        gThis.magnificPopup(gma);

    }

    /*easyPieChart*/
    function gEasyPieChart(gThis) {
        let gea = {
            barColor: gThis.data('barcolor'),
            trackColor: gThis.data('trackcolor'),
            scaleColor: gThis.data('scalecolor'),
            size: gThis.data('size'),
            lineCap: gThis.data('linecap'),
            animate: gThis.data('animate'),
            lineWidth: gThis.data('linewidth'),
        };
        gThis.easyPieChart(gea);
    }

    /*CountUP*/
    function gCountUp(gThis) {
        let startValue = parseInt(gThis.data('start')),
            endValue = parseInt(gThis.data('end')),
            duration = parseInt(gThis.data('duration')),
            nCountUp = new CountUp(gThis[0], startValue, endValue, 0, duration);

        nCountUp.start();
    }
    function gIsEleInView(elem) {
        let docViewTop = $(window).scrollTop(),
            docViewBottom = docViewTop + $(window).height(),
            elemTop = $(elem).offset().top,
            elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    function gCountAndBar(){
        /*CountUP Trigger*/
        if (counter_block.length || counter_element.length){
            $('.gutentor-single-item-number,.gutentor-counter-number-main').each(function() {
                let gThis = $(this);
                if( gIsEleInView(gThis) ){
                    if( !gThis.hasClass('g-c-loaded')){
                        gThis.addClass('g-c-loaded')
                        gCountUp(gThis)
                    }
                }
            });
        }

        /*easyPieChart Trigger*/
        if (gProgressBarB.length || gProgressBarE.length){
            $('.gutentor-progressbar-circular,.gutentor-element-progressbar-circular').each(function() {
                let gThis = $(this);
                if( gIsEleInView(gThis) ){
                    if( !gThis.hasClass('g-c-loaded')){
                        gThis.addClass('g-c-loaded')
                        gEasyPieChart(gThis)
                    }
                }
            });
        }

        /*easyPieChart Trigger*/
        if (gProgressBarB.length || gProgressBarE.length){
            $('.gutentor-porgress-bar-item .progressbar,.gutentor-element-progressbar-box .gutentor-element-progressbar-horizontal').each(function() {
                let gThis = $(this);
                if( gIsEleInView(gThis) ){
                    if( !gThis.hasClass('g-c-loaded')){
                        gThis.addClass('g-c-loaded')
                        gThis.css('width', gThis.attr("data-width") + "%");
                    }
                }
            });
        }
    }
    gCountAndBar()
    $(window).scroll( function(){
        gCountAndBar()
    });
    /*Count Down*/
    function gCountDown(gThis) {

        // Set the date we're counting down to
        let gutentor_event_date = gThis.data('eventdate');
        if (gutentor_event_date === undefined || gutentor_event_date === null) {
            gThis.html("<span>Please set validate Date and time for countdown </span>");
            return false;
        }
        let expired_text = gThis.data('expiredtext'),
            gutentor_day = gThis.find('.day'),
            gutentor_hour = gThis.find('.hour'),
            gutentor_min = gThis.find('.min'),
            gutentor_sec = gThis.find('.sec'),
            gutentor_date_time = gutentor_event_date.split('T');
        if (gutentor_date_time.length !== 2) {
            return false;
        }
        let date_collection = gutentor_date_time[0],
            time_collection = gutentor_date_time[1],
            date_explode = date_collection.split('-');

        if (date_explode.length !== 3) {
            return false;
        }

        let time_explode = time_collection.split(':');
        if (time_explode.length !== 3) {
            return false;
        }

        let gutentor_year_value = parseInt(date_explode[0]),
            gutentor_month_value = parseInt(date_explode[1]) - 1,
            gutentor_day_value = parseInt(date_explode[2]),
            gutentor_hour_value = parseInt(time_explode[0]),
            gutentor_minutes_value = parseInt(time_explode[1]),
            gutentor_second_value = parseInt(time_explode[2]),
            countDownDate = new Date(gutentor_year_value, gutentor_month_value, gutentor_day_value, gutentor_hour_value, gutentor_minutes_value, gutentor_second_value, 0).getTime();

        // Update the count down every 1 second
        let x = setInterval(function() {

            // Get todays date and time
            let now = new Date().getTime();

            // Find the distance between now an the count down date
            let distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element
            gutentor_day.html(days);
            gutentor_hour.html(hours);
            gutentor_min.html(minutes);
            gutentor_sec.html(seconds);
            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                gThis.html("<span>" + expired_text + "</span>");
            }
        }, 1000);
    }

    // initialize date picker in count down block
    $.fn.trigger2 = function(eventName) {
        return this.each(function() {
            let el = $(this).get(0);
            triggerNativeEvent(el, eventName);
        });
    };

    function triggerNativeEvent(el, eventName) {
        if (el.fireEvent) { // < IE9
            (el.fireEvent('on' + eventName));
        } else {
            let evt = document.createEvent('Events');
            evt.initEvent(eventName, true, false);
            el.dispatchEvent(evt);
        }
    }

    /*Tabs*/
    function gTabs() {
        gDocument.on('click', '.gutentor-tabs-list', function() {
            let thisTabInside = $(this),
                gutentorSingleItemIndex = thisTabInside.data('index'),
                gTabsC = thisTabInside.closest('.gutentor-tabs'),
                gTabsContentWrap = gTabsC.next('.gutentor-tabs-content-wrap'),
                gTabsSingleContent = gTabsContentWrap.find('.' + gutentorSingleItemIndex);

            gTabsSingleContent.siblings().removeClass('gutentor-tab-content-active');
            thisTabInside.siblings().removeClass('gutentor-tab-active');

            gTabsSingleContent.addClass('gutentor-tab-content-active');
            thisTabInside.addClass('gutentor-tab-active');
        });
    }

    /*show more block*/
    function gShowMoreBlock(className) {
        gDocument.on('click', className, function(e) {
            e.preventDefault();
            if (className === '.gutentor-show-more-button') {
                $(this).closest('.gutentor-single-item-content').addClass('show-more-content');
            }
            else if(className === '.gutentor-show-less-action-button') {
                $(this).closest('.gutentor-single-item-content').removeClass('show-more-content');
            }
            else if(className === '.gutentor-adv-s-m-btn'){
                $(this).closest('.g-m-advance-show-more').addClass('g-show-more-content');
            }
            else if(className === '.gutentor-adv-s-l-btn'){
                $(this).closest('.g-m-advance-show-more').removeClass('g-show-more-content');
            }
        });
    }

    /*API*/
    function gP4GetLoader(type) {
        let gP4Loader;
        switch (type) {
            case 'gp4-animation-1':
                gP4Loader = '<div class="gutentor-loading-wrap"></div>';
                break;
            case 'gp4-animation-2':
                gP4Loader = '<div class="gutentor-loading-wrap"><div class="gutentor-loading-2"><div></div><div></div><div></div></div></div>';
                break;
            case 'gp4-animation-3':
                gP4Loader = '<div class="gutentor-loading-wrap"><div class="gutentor-loading-3"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';
                break;
            case 'gp4-animation-4':
                gP4Loader = '<div class="gutentor-loading-wrap"></div>';
                break;
            case 'gp4-animation-5':
                gP4Loader = '<div class="gutentor-loading-wrap"><div class="gutentor-loading-5"></div></div>';
                break;
            default:
                gP4Loader = '';
                break;
        }
        return gP4Loader;
    }

    function gApi(gAB, gParam, gAppend = false) {
        gParam.innerBlockType = gAB.data('i-b');
        gParam.blockId = gAB.find('.gutentor-post-module').data('gbid');
        gParam.postId = gAB.data('gpid');

        /*Globally Add Tax and Term Data*/
        if (gAB.find('.gutentor-filter-navigation').length) {
            gParam.gTax = gAB.find('.gutentor-filter-navigation').data('gtax');
            gParam.gTerm = gAB.find('.gutentor-filter-item-active').children().attr('data-gterm');
            if( 'gAll' === gParam.gTerm ){
                gParam.allOpt = gAB.find('.gutentor-filter-item-active').children().attr('data-all-opt');
            }
        } else {
            gParam.gTax = 'default';
            gParam.gTerm = 'default';
        }
        if (!gParam.paged) {
            gParam.paged = 1;
        }
        /*Search Field*/
        if (gAB.find('.g-fm-search').length){
            gParam.s = gAB.find('.g-fm-search').val();
        }

        $.ajax({
            type: 'GET',
            url: gutentorLS.restUrl + 'gutentor-self-api/v1/gadvancedb',
            data: gParam,
            beforeSend: function(xhr) {
                gAB.addClass(gAB.data('l-ani'));
                xhr.setRequestHeader('X-WP-Nonce', gutentorLS.restNonce);
                gAB.removeClass('gutentor-loaded');
                gAB.find('.gutentor-post-module .grid-container').append(gP4GetLoader(gAB.data('l-ani')));
            },
        }).done(function(data) {
            if (!gAppend) {
                gAB.find('.gutentor-post-module').replaceWith(data.pBlog);
            } else {
                gAB.find('.gutentor-post-module .grid-container .grid-row').append($(data.pBlog).find('.grid-container .grid-row').html());

            }
            gAB.find('.gutentor-pagination')
                .children() //Select all the children of the parent
                .not(':first-child') //Unselect the first child
                .not(':last-child') //Unselect the last child
                .remove();

            let paged = parseInt(gParam.paged),
                max_num_pages = parseInt(data.max_num_pages);

            gAB.find('.gutentor-pagination').children('.gutentor-pagination-prev')
                .after(data.pagination)
                .children().attr('data-gpage', paged > 1 ? paged - 1 : 1);
            gAB.attr('data-maxnumpages', max_num_pages);
            gAB.find('.gutentor-pagination').children('.gutentor-pagination-next')
                .children().attr('data-gpage', max_num_pages > paged ? paged + 1 : max_num_pages);

            /*disabled class*/
            if (paged <= 1) {
                gAB.find('.gutentor-pagination').children('.gutentor-pagination-prev').children().addClass('gutentor-disabled');
                gAB.find('.gutentor-navigation').find('.g-nav-prev').addClass('gutentor-disabled');
            } else {
                gAB.find('.gutentor-pagination').children('.gutentor-pagination-prev').children().removeClass('gutentor-disabled');
                gAB.find('.gutentor-navigation').find('.g-nav-prev').removeClass('gutentor-disabled');
            }
            if (max_num_pages <= paged) {
                gAB.find('.gutentor-pagination').children('.gutentor-pagination-next').children().addClass('gutentor-disabled');
                gAB.find('.gutentor-navigation').find('.g-nav-next').addClass('gutentor-disabled');

                /*for load more disabled class*/
                gAB.find('.gutentor-post-footer.g-ap-load-more-template a.gutentor-button').addClass('gutentor-disabled');

            } else {
                gAB.find('.gutentor-pagination').children('.gutentor-pagination-next').children().removeClass('gutentor-disabled');
                gAB.find('.gutentor-navigation').find('.g-nav-next').removeClass('gutentor-disabled');

                /*for load more disabled class*/
                gAB.find('.gutentor-post-footer.g-ap-load-more-template a.gutentor-button').removeClass('gutentor-disabled');
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }).always(function() {
            $('.g-edd-cart .edd-no-js').hide();
            $('.g-edd-cart .edd-add-to-cart').addClass('edd-has-js');
            gAB.removeClass(gAB.data('l-ani'));
            gAB.addClass('gutentor-loaded');
            gAB.find('.gutentor-post-module .grid-container').find('.gutentor-loading-wrap').remove();

        });
    }
    /*Filter Cats*/
    gDocument.on('click', '.gutentor-filter-navigation .gutentor-filter-item>a', function(e) {
        e.preventDefault();

        let gThis = $(this),
            gList = gThis.closest('.gutentor-filter-list'),
            gAB = gThis.closest('.gutentor-advanced-post-module');

        if (gThis.parent().hasClass('gutentor-filter-item-active')) {
            return false;
        }
        gList.find('.gutentor-filter-item').removeClass('gutentor-filter-item-active');
        gThis.parent().addClass('gutentor-filter-item-active');

        /*for load more reset pagination */
        gAB.find('.gutentor-post-footer.g-ap-load-more-template a.gutentor-button').removeAttr('data-gpage');

        /*Search reset*/
        if (gAB.find('.g-fm-search').length){
            gAB.find('.g-fm-search').val('');
        }

        gApi(
            gAB, {}
        )
    });
    /*Numeric Pagination*/
    gDocument.on('click', '.gutentor-pagination a', function(e) {
        e.preventDefault();

        let gThis = $(this),
            gAB = gThis.closest('.gutentor-advanced-post-module');

        if (gThis.hasClass('gutentor-disabled')) {
            return false;
        }
        if (gThis.parent().hasClass('gutentor-pagination-active')) {
            return false;
        }
        let currentPage = gThis.parent().siblings('.gutentor-pagination-active').children().attr('data-gpage');

        if (currentPage == gThis.attr('data-gpage')) {
            return false;
        }
        let gParam = {
            paged: gThis.attr('data-gpage'),
        };
        if (parseInt(gAB.attr('data-maxnumpages')) < parseInt(gParam.paged)) {
            return false;
        }
        gApi(
            gAB,
            gParam
        )
    });
    /*Navigation*/
    gDocument.on('click', '.gutentor-navigation a', function(e) {
        e.preventDefault();

        let gThis = $(this),
            gNav = gThis.closest('.gutentor-navigation'),
            gAB = gThis.closest('.gutentor-advanced-post-module');

        if (gThis.hasClass('gutentor-disabled')) {
            return false;
        }
        let current_page = parseInt(gNav.attr('data-gpage')),
            nextPage;
        if (gThis.hasClass('g-nav-prev')) {
            nextPage = current_page - 1;
        } else {
            nextPage = current_page + 1;
        }
        let gParam = {
            paged: nextPage
        };

        gNav.attr('data-gpage', nextPage);
        gApi(
            gAB,
            gParam
        )
    });
    /*Load More*/
    gDocument.on('click', '.gutentor-post-footer.g-ap-load-more-template a.gutentor-button', function(e) {
        e.preventDefault();

        let gThis = $(this),
            gAB = gThis.closest('.gutentor-advanced-post-module');

        if (gThis.hasClass('gutentor-disabled')) {
            return false;
        }

        if (!gThis.attr('data-gpage')) {
            gThis.attr('data-gpage', 2);
        }
        let gParam = {
            paged: gThis.attr('data-gpage')
        };
        gThis.attr('data-gpage', parseInt(gThis.attr('data-gpage')) + 1)
        gApi(
            gAB,
            gParam,
            true
        )
    });
    /*Search Icon*/
    gDocument.on('click', '.g-search-icon', function(e) {
        e.preventDefault();

        let gThis = $(this),
            gAB = gThis.closest('.gutentor-advanced-post-module');

        /*commented on request of a user*/
        /*https://wordpress.org/support/topic/post-module-header-search-keywords/#post-15077989*/
        /* if( !gAB.find('.g-fm-search').val()){
            return false;
        }*/
        gApi(
            gAB, {}
        )
    });
    /*Search Enter*/
    $( document ).on(
        'keydown',
        '.gutentor-advanced-post-module .g-fm-search',
        function(e){
            let key   = e.which;
            if (key === 13) {
                e.preventDefault();

                let gThis = $(this),
                    gAB = gThis.closest('.gutentor-advanced-post-module');
                /*commented on request of a user*/
                /*https://wordpress.org/support/topic/post-module-header-search-keywords/#post-15077989*/
                /*  if( !gAB.find('.g-fm-search').val()){
                    return false;
                }*/

                gApi(
                    gAB, {}
                )
            }
        }
    );
    /*Document ready function*/
    gDocument.ready(function() {
        /*WOW*/
        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }
        /*Magnific Popup*/
        /* video popup and button link popup */
        $('.gutentor-video-popup-holder').each(function() {
            gMagnificPopup($(this))
        });
        $('.g-v-btn').each(function() {
            gMagnificPopup($(this))
        });
        $('.g-v-fp-btn').each(function() {
            gMagnificPopup($(this))
        });
        $('.gutentor-element-button-link-popup').each(function() {
            gMagnificPopup($(this))
        });

        $('.gutentor-post-footer.g-ap-load-more-template a.gutentor-button').each(function() {
            let gThis = $(this),
                gAB = gThis.closest('.gutentor-advanced-post-module');
            if (gAB.attr('data-maxnumpages') && parseInt(gAB.attr('data-maxnumpages')) < 2) {
                gThis.addClass('gutentor-disabled');
            } else {
                gThis.removeClass('gutentor-disabled');
            }
        });

        /*Slick*/
        if (typeof $.fn.slick !== 'undefined') {
            $('.gutentor-slider-wrapper').each(function() {
                gSlick($(this))
            });
            $('.gutentor-module-slider-row').each(function() {
                gSlick($(this))
            });
            $('.gutentor-carousel-row').each(function() {
                gSlick($(this))
            });
            $('.gutentor-image-carousel-row').each(function() {
                gSlick($(this))
            });
            $('.gutentor-module-carousel-row').each(function() {
                gSlick($(this))
            });
            $('.gutentor-m7-carousel-row').each(function() {
                gSlick($(this))
            });
        }

        /*Refresh some needed js*/
        function gRefreshJS($wrap){
            if (typeof $.fn.slick !== 'undefined') {
                $wrap.find('.gutentor-slider-wrapper').each(function() {
                    $(this).slick('refresh')
                });
                $wrap.find('.gutentor-module-slider-row').each(function() {
                    $(this).slick('refresh')
                });
                $wrap.find('.gutentor-carousel-row').each(function() {
                    $(this).slick('refresh')
                });
                $wrap.find('.gutentor-image-carousel-row').each(function() {
                    $(this).slick('refresh')
                });
                $wrap.find('.gutentor-module-carousel-row').each(function() {
                    $(this).slick('refresh')
                });
                $wrap.find('.gutentor-m7-carousel-row').each(function() {
                    $(this).slick('refresh')
                });
            }

            /*Isotop Refresh*/
            if (typeof $.fn.isotope !== 'undefined') {
                if ($wrap.find('.g-gm-item-wrap').hasClass('isotope')) {
                    $wrap.find('.g-gm-item-wrap').isotope('reloadItems').isotope();
                }
                if ($wrap.find('.gutentor-filter-item-wrap').hasClass('isotope')) {
                    $wrap.find('.gutentor-filter-item-wrap').isotope('reloadItems').isotope();
                }
            }
            /*masonry Refresh*/
            $wrap.find('.gutentor-gallery-wrapper').each(function() {
                let masonryBoxes = $(this);
                if (masonryBoxes.hasClass('enable-masonry')) {
                    let container = masonryBoxes.find('.full-width-row');
                    container.masonry({
                        itemSelector: '.gutentor-gallery-item',
                    });
                }
            });
            $wrap.find('.gutentor-post-module-p1').each(function() {
                let masonryBoxes = $(this);
                if (masonryBoxes.hasClass('g-masonry')) {
                    let container = masonryBoxes.find('.grid-row');
                    container.masonry({
                        itemSelector: '.gutentor-post',
                    });
                }
            });
            $wrap.find('.g-gm-module').each(function(i, item) {
                let thisFilterWrap = $(this);
                if (thisFilterWrap.hasClass('g-on-masonry')) {
                    let container = thisFilterWrap.find('.g-gm-item-wrap');
                    container.masonry({
                        itemSelector: '.g-gm-col ',
                    });
                }
            })

        }

        /*Accordion*/
        gDocument.on('click', '.gutentor-accordion-heading', function(e) {

            var gThis = $(this),
                accordion_content = gThis.closest('.gutentor-accordion-wrap'),
                accordion_item = gThis.closest('.gutentor-single-item'),
                accordion_details = accordion_item.find('.gutentor-accordion-body'),
                accordion_all_items = accordion_content.siblings('.gutentor-accordion-wrap'),
                accordion_icon = accordion_content.find('.gutentor-accordion-icon');

            accordion_all_items.each(function() {
                $(this).find('.gutentor-accordion-body').slideUp();
                $(this).find('.gutentor-accordion-heading').removeClass('active');
            });

            if (accordion_details.is(":visible")) {
                accordion_details.slideUp().removeClass('gutentor-active-body');
                gThis.removeClass('active');

            } else {
                accordion_details.slideDown().addClass('gutentor-active-body');
                gThis.addClass('active');
            }
            e.preventDefault();
        });

        /* Module Accordion*/
        gDocument.on('click', '.gutentor-module-accordion-item-heading', function(e) {

            let gThis = $(this),
                a_g_p = gThis.closest('.gutentor-module-accordion'),
                a_item = gThis.closest('.gutentor-module-accordion-item'),
                a_details = a_item.find('.gutentor-module-accordion-body'),
                a_o_items = a_item.siblings('.gutentor-module-accordion-item'),
                a_i_wrap = gThis.find('.gutentor-module-accordion-icon');

            a_o_items.removeClass('gutentor-module-accordion-active');

            if (a_g_p.hasClass('gutentor-module-accordion-enable-toggle')){
                a_o_items.each(function() {
                    $(this).find('.gutentor-module-accordion-body').slideUp();
                    $(this).find('.gutentor-module-accordion-icon').removeClass('gutentor-module-accordion-icon-active');
                });
            }
            if (a_details.is(":visible")) {
                a_details.slideUp();
                a_i_wrap.removeClass('gutentor-module-accordion-icon-active');
                a_details.removeClass('gutentor-module-accordion-icon-active');
                a_item.removeClass('gutentor-module-accordion-active');
            } else {
                a_details.slideDown();
                a_details.addClass('gutentor-module-accordion-icon-active');
                a_i_wrap.addClass('gutentor-module-accordion-icon-active');
                a_item.addClass('gutentor-module-accordion-active');

                gRefreshJS(a_details);
            }
            e.preventDefault();
        });

        /* Table of content Accordion*/
        gDocument.on('click', '.g-toc-header', function(e) {
            let gThis = $(this),
                toc_parent = gThis.closest('.gutentor-module-table-of-contents'),
                toc_body = toc_parent.find('.g-toc-body');
            if(toc_parent.hasClass('g-enable-collapsible')){
                if (toc_body.is(":visible")) {
                    toc_body.slideUp();
                    gThis.removeClass('g-collapsible-active');
                } else {
                    gThis.addClass('g-collapsible-active');
                    toc_body.slideDown();
                }
            }
            e.preventDefault();
        });

        /* Module Tab*/
        $('.gutentor-module-tabs-item').each(function() {
            $(this).on('click', function(e) {
                let gThis = $(this),
                    gThisIndex = gThis.index(),
                    gThisWrap = gThis.closest('.gutentor-module-tabs-wrap'),
                    gThisWrapID = gThisWrap.data('id'),
                    gThisContentID = '.gm-tc-' + gThisWrapID;
                if (gThis.hasClass('gutentor-tabs-nav-active')) {
                    return;
                }
                gThis.addClass('gutentor-tabs-nav-active');
                gThis.siblings().removeClass('gutentor-tabs-nav-active');
                gThisWrap.find(gThisContentID).eq(gThisIndex).siblings().removeClass('gutentor-tabs-content-active');
                gThisWrap.find(gThisContentID).eq(gThisIndex).addClass('gutentor-tabs-content-active');

                /*Slick Fixed*/
                gRefreshJS(gThisWrap.find(gThisContentID).eq(gThisIndex));
                e.preventDefault();
            });
        });

        /*Counter*/
        gDocument.on('click', '.gutentor-countup-wrap', function() {
            $(this).addClass('gutentor-countup-open');
        });
        gDocument.on('click', '.gutentor-countup-box-close', function() {
            $('.gutentor-countup-box').addClass('hide-input');
            $(this).hide();
        });
        gDocument.on('click', '.gutentor-countup', function() {
            $('.gutentor-countup-box').removeClass('hide-input');
        });

        // Gutentor Countdown
        $('.gutentor-countdown-wrapper').each(function() {
            gCountDown($(this));
        });

        /*show popover content block*/
        function showPopoverContent(popoverContent) {
            if(popoverContent.hasClass("d-none")){
                popoverContent.removeClass('d-none')
            }
        }

        // gutentor popover blocks
        $('.g-m-popover').each(function() {
            let gThis = $(this),
                normalContent = gThis.find('.g-m-popover-normal'),
                popoverContent = gThis.find('.g-m-popover-content');
            if(gThis.hasClass("g-po-e-hover")){
                normalContent.on({
                    mouseenter: function () {
                        showPopoverContent(popoverContent);
                        gThis.find('.g-m-popover-content').show();
                    },
                    mouseleave: function () {
                        gThis.find('.g-m-popover-content').hide();
                    }
                });
            }
            if(gThis.hasClass("g-po-e-click")){
                normalContent.on('click', function(e) {
                    showPopoverContent(popoverContent);
                    gThis.find('.g-m-popover-content').toggle();
                    e.preventDefault();
                });
            }
            if(gThis.hasClass("g-m-popover-c-on")){
                showPopoverContent(popoverContent);
                gThis.find('.g-m-popover-content').show();
            }
        });

        /*FlexMenu ( Responsive Menu)*/
        if (typeof $.fn.flexMenu !== 'undefined') {
            var g_r_e = $('.g-responsive-menu');
            if (g_r_e.length) {
                g_r_e.flexMenu({
                    threshold: 0,
                    cutoff: 0,
                    linkText: '<span class="screen-reader-text">More</span>',
                    linkTextAll: '<span class="screen-reader-text">More</span>',
                    linkTitle: '',
                    linkTitleAll: '',
                    showOnHover: (gWindowWidth > 991 ? true : false)
                });
                gDocument.click(function(e){
                    let flexMenuPopup = $('ul.flexMenu-popup');
                    if(!(
                        $(e.target).closest('li.flexMenu-viewMore ').length > 0  ||
                        !flexMenuPopup.length ||
                        !flexMenuPopup.is(":visible")
                    )) {
                        $('li.flexMenu-viewMore > a').trigger('click');
                    }
                });

            }
        }

        /*Show more Block*/
        gShowMoreBlock('.gutentor-show-more-button');
        gShowMoreBlock('.gutentor-show-less-action-button');
        gShowMoreBlock('.gutentor-adv-s-m-btn');
        gShowMoreBlock('.gutentor-adv-s-l-btn');


        if (typeof $.fn.AcmeTicker !== 'undefined') {
            $('.gutentor-post-module-p5').each(function() {
                let this_newsTicker = $(this),
                    news_ticker_data = this_newsTicker.find('.gutentor-news-ticker-data'),
                    news_ticker_Pause = this_newsTicker.find('.gutentor-news-ticker-controls').find('.gutentor-news-ticker-pause'),
                    news_ticker_up = this_newsTicker.find('.gutentor-news-ticker-controls').find('.gutentor-news-ticker-prev'),
                    news_ticker_down = this_newsTicker.find('.gutentor-news-ticker-controls').find('.gutentor-news-ticker-next');
                let options = {
                    type: "horizontal",
                    direction: "right",
                    speed: 600,
                    controls: {
                        toggle: news_ticker_Pause /*Can be used for vertical/horizontal/marquee/typewriter*/
                    },
                };
                if (this_newsTicker.attr('data-type')) {
                    options.type = this_newsTicker.attr('data-type');
                    if (this_newsTicker.attr('data-type') !== 'marquee') {
                        options.controls.prev = news_ticker_up;
                        options.controls.next = news_ticker_down;
                    }
                }
                if (this_newsTicker.attr('data-direction')) {
                    options.direction = this_newsTicker.attr('data-direction');
                }
                if (this_newsTicker.attr('data-speed')) {
                    options.speed = Number(this_newsTicker.attr('data-speed'));
                }
                if (this_newsTicker.attr('data-pauseOnHover')) {
                    options.pauseOnHover = ('1' === this_newsTicker.attr('data-pauseOnHover'));
                }
                news_ticker_data.AcmeTicker(options);
            });
            /*Pause fixed*/
            $(document).on('acmeTickerToggle', function(e, thisTicker) {
                $(thisTicker).closest('.gutentor-news-ticker').toggleClass('gutentor-ticker-pause')
            });
        }
        /*Tabs*/
        gTabs();

        /*edd add to cart*/
        // Gutentor Countdown
        $('.g-edd-cart').each(function() {
            let icon = $(this).attr('data-icon'),
                button_class = $(this).find('.gutentor-button');
            if (button_class.hasClass('gutentor-icon-before')) {
                button_class.prepend('<i class="gutentor-button-icon ' + icon + '" ></i>');
            }
            if (button_class.hasClass('gutentor-icon-after')) {
                button_class.append('<i class="gutentor-button-icon ' + icon + '" ></i>');
            }
        });
    });

    /*Filter Module*/
    function gM11() {
        let buttonM11Filters = {},
            buttonM11Filter = {},
            m11Regex = {},
            m11FilWrap = $('.g-fm-module'),
            currentFilter;
        if (m11FilWrap.length) {
            m11FilWrap.find('.g-gm-item-wrap').isotope({
                itemSelector: '.g-gm-col',
                layoutMode: 'fitRows',
                filter: function() {
                    let gThis = $(this),
                        searchResult = currentFilter && m11Regex[currentFilter] ? gThis.text().match(m11Regex[currentFilter]) : true,
                        buttonResult = currentFilter && buttonM11Filter[currentFilter] ? gThis.is(buttonM11Filter[currentFilter]) : true;

                    return searchResult && buttonResult;
                },
            });
        }
        $('.g-fm-fis').on('click', '.g-fm-fi', function() {
            $(this).siblings().removeClass('g-fm-active');
            $(this).addClass('g-fm-active');

            let masonryBoxes = $(this).closest('.g-fm-module');
            currentFilter = masonryBoxes.attr('data-filter-number');
            let gThis = $(this);
            // get group key
            let btnGroup = gThis.parents('.g-fm-fis'),
                filterGroup = btnGroup.attr('data-filter-group');

            // set filter for group
            if (buttonM11Filters[currentFilter] === undefined) {
                buttonM11Filters[currentFilter] = {};
            }
            buttonM11Filters[currentFilter][filterGroup] = gThis.attr('data-filter');
            // combine filters
            if (buttonM11Filter[currentFilter] === undefined) {
                buttonM11Filter[currentFilter] = {};
            }
            buttonM11Filter[currentFilter] = gConcatValues(buttonM11Filters[currentFilter]);
            // Isotope arrange
            let this_grid_wrapper = gThis.closest('.g-fm-module').find('.g-gm-item-wrap');
            this_grid_wrapper.isotope();
        });

        $('.g-gm-module').find('.grid-container').each(function() {
            let str = $( ".g-nothing-found-text" ).text();
            str =  str ? str : 'Nothing Found!!!!';
            let html = '<div class="g-nothing-found">'+str+'</div>';
            $(this).append(html);
            $('.g-nothing-found').hide();
        });

        //filter search
        function filterSearchEvent(thisData) {
            let masonryBoxes = thisData.closest('.g-fm-module');
            currentFilter = masonryBoxes.attr('data-filter-number');
            m11Regex[currentFilter] = new RegExp(thisData.val(), 'gi');
            let this_grid_wrapper = thisData.closest('.g-fm-module').find('.g-gm-item-wrap');

            this_grid_wrapper.isotope();
            // display message box if no filtered items
            if ( !this_grid_wrapper.data('isotope').filteredItems.length ) {
                $('.g-nothing-found').show();
            }
            else{
                $('.g-nothing-found').hide();
            }
        }

        /* use value of search field to filter*/
        $('.g-fm-module .g-fm-search').keyup(gDebounce(function() {
            filterSearchEvent($(this))
        }));
        $('.g-fm-module .g-fm-search').on("search", function() {
            filterSearchEvent($(this))
        });

        // flatten object by concatting values
        function gConcatValues(obj) {
            let value = '';
            for (let prop in obj) {
                value += obj[prop];
            }
            return value;
        }

        // gDebounce so filtering doesn't happen every millisecond
        function gDebounce(fn, threshold) {
            let timeout;
            threshold = threshold || 100;
            return function gDebounced() {
                clearTimeout(timeout);
                let args = arguments;
                let _this = this;

                function delayed() {
                    fn.apply(_this, args);
                }
                timeout = setTimeout(delayed, threshold);
            };
        }

        gDocument.find('.g-fm-module').each(function(i, item) {
            let thisFilterWrap = $(this);
            thisFilterWrap.attr('data-filter-number', i);
        });
        gDocument.find('.g-gm-module').each(function(i, item) {
            let thisFilterWrap = $(this);
            if (thisFilterWrap.hasClass('g-on-masonry')) {
                let container = thisFilterWrap.find('.g-gm-item-wrap');
                container.isotope({ layoutMode: 'masonry' })
            }
            let thisFilterWrapPopup = $(this);
            if (thisFilterWrapPopup.hasClass('g-on-popup')) {
                let container = thisFilterWrapPopup.find('.g-gm-item-wrap');
                if (typeof $.fn.imagesLoaded !== 'undefined') {
                    container.imagesLoaded(function() {
                        thisFilterWrapPopup.fadeIn('slow');
                        container.masonry({
                            itemSelector: '.g-gm-col ',
                        });
                    });
                }
            }
            let popupIcon = thisFilterWrapPopup.find('.g-gm-popup'),
                popupMediaType = popupIcon.attr('data-media-type');
            if(popupMediaType === 'g-popup-img'){
                gMagnificPopup(popupIcon,true, true);
            }
            else{
                gMagnificPopup(popupIcon,false, true);
            }
        });
    }

    /*Gallery Gutenberg Module Popup Link
    * gMagnificPopup initilize above */
    gDocument.on('click', '.g-gm-popup', function(e) {
        e.preventDefault();
        let gThis = $(this),
            hasLink = gThis.attr('href'),
            popupMediaType = gThis.attr('data-media-type');

        gThis.magnificPopup.open()
    });

    /*Window Load*/
    gWindow.on('load', function() {
        //Gutentor Gallery Box
        if (typeof $.fn.imagesLoaded !== 'undefined') {
            let galleryWrapper = $('.gutentor-gallery-wrapper');
            galleryWrapper.each(function() {
                let masonryBoxes = $(this);
                if (masonryBoxes.hasClass('enable-masonry')) {
                    let container = masonryBoxes.find('.full-width-row');

                    container.imagesLoaded(function() {
                        masonryBoxes.fadeIn('slow');
                        container.masonry({
                            itemSelector: '.gutentor-gallery-item',
                        });
                    });

                }
                gMagnificPopup(masonryBoxes.find('.image-gallery'), true, true);
            });
            let postModule = $('.gutentor-post-module-p1');
            postModule.each(function() {
                let masonryBoxes = $(this);
                if (masonryBoxes.hasClass('g-masonry')) {
                    let container = masonryBoxes.find('.grid-row');
                    container.imagesLoaded(function() {
                        masonryBoxes.fadeIn('slow');
                        container.masonry({
                            itemSelector: '.gutentor-post',
                        });
                    });
                }
            });
        }


        //Gutentor filter Box
        let buttonFilters = {},
            buttonFilter = {},
            qsRegex = {},
            filter_wrap = $('.gutentor-filter-item-wrap'),
            currentFilter;
        if (filter_wrap.length) {
            filter_wrap.isotope({
                itemSelector: '.gutentor-gallery-item',
                layoutMode: 'fitRows',
                filter: function() {
                    let gThis = $(this);
                    let searchResult = currentFilter && qsRegex[currentFilter] ? gThis.text().match(qsRegex[currentFilter]) : true;
                    let buttonResult = currentFilter && buttonFilter[currentFilter] ? gThis.is(buttonFilter[currentFilter]) : true;
                    return searchResult && buttonResult;
                },
            });
        }
        $('.gutentor-filter-group').on('click', '.gutentor-filter-btn', function() {
            $(this).siblings().removeClass('gutentor-filter-btn-active');
            $(this).addClass('gutentor-filter-btn-active');

            let masonryBoxes = $(this).closest('.gutentor-filter-wrapper');
            currentFilter = masonryBoxes.attr('data-filter-number');
            let gThis = $(this);
            // get group key
            let $buttonGroup = gThis.parents('.gutentor-filter-group'),
                filterGroup = $buttonGroup.attr('data-filter-group');

            // set filter for group
            if (buttonFilters[currentFilter] === undefined) {
                buttonFilters[currentFilter] = {};
            }
            buttonFilters[currentFilter][filterGroup] = gThis.attr('data-filter');
            // combine filters
            if (buttonFilter[currentFilter] === undefined) {
                buttonFilter[currentFilter] = {};
            }
            buttonFilter[currentFilter] = concatValues(buttonFilters[currentFilter]);
            // Isotope arrange
            let this_grid_wrapper = $(this).closest('.gutentor-filter-container').next('.gutentor-filter-item-wrap');
            this_grid_wrapper.isotope();
        });
        // use value of search field to filter
        $('.gutentor-search-filter').keyup(debounce(function() {
            let masonryBoxes = $(this).closest('.gutentor-filter-wrapper');
            currentFilter = masonryBoxes.attr('data-filter-number');
            qsRegex[currentFilter] = new RegExp($(this).val(), 'gi');
            let this_grid_wrapper = $(this).closest('.gutentor-filter-container').next('.gutentor-filter-item-wrap');

            this_grid_wrapper.isotope();
        }));

        // flatten object by concatting values
        function concatValues(obj) {
            let value = '';
            for (let prop in obj) {
                value += obj[prop];
            }
            return value;
        }

        // debounce so filtering doesn't happen every millisecond
        function debounce(fn, threshold) {
            let timeout;
            threshold = threshold || 100;
            return function debounced() {
                clearTimeout(timeout);
                let args = arguments;
                let _this = this;

                function delayed() {
                    fn.apply(_this, args);
                }
                timeout = setTimeout(delayed, threshold);
            };
        }

        gDocument.find('.gutentor-filter-wrapper').each(function(i, item) {
            let thisFilterWrap = $(this);
            thisFilterWrap.attr('data-filter-number', i);
            gMagnificPopup(thisFilterWrap.find('.image-gallery'), true, true);

            let container = thisFilterWrap.find('.gutentor-filter-item-wrap');

            if (thisFilterWrap.hasClass('enable-masonry')) {
                container.isotope({ layoutMode: 'masonry' })
            }
        });

        /*sticky sidebar*/
        if (typeof $.fn.theiaStickySidebar !== 'undefined') {
            $('.gutentor-enable-sticky-column').each(function() {
                let thisSticky = $(this),
                    stickyChildren = thisSticky.find('.grid-row:first').children('.gutentor-single-column'),
                    mTop = thisSticky.attr('data-top'),
                    mBottom = thisSticky.attr('data-bottom');

                stickyChildren.theiaStickySidebar({
                    // Settings
                    additionalMarginTop: parseInt(mTop),
                    additionalMarginBottom: parseInt(mBottom),
                });
            });
        }

        /*WooCommerce added cart*/

        $(document.body).on('added_to_cart', function(e, button) {
            setTimeout(function() {
                $('.gutentor-woo-add-to-cart .added_to_cart.wc-forward').addClass('gutentor-button button gutentor-post-button');
            }, 1);

        });

        if (typeof $.fn.isotope !== 'undefined') {
            /*m11 filter*/
            gM11();
        }

        /*Video Autoplay*/
        function gVideoAutoplay() {
            let videos = document.getElementsByClassName("gutentor-bg-video"),
                i;
            for (i = 0; i < videos.length; i++) {
                if (videos[i].hasAttribute("autoplay")) {
                    if (!videos[i].playing) {
                        if (!videos[i].hasAttribute("muted")) {
                            videos[i].muted = true;
                        }
                        videos[i].play();
                    }
                }

            }
        }
        gVideoAutoplay();
    });
})(jQuery);