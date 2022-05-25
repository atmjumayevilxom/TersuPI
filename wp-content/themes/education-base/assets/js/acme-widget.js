(function ( $, window, document, undefined ) {
    'use strict';
    var waf_document = $(document);

    waf_document.on('click','.media-image-upload', function(e){

        // Prevents the default action from occuring.
        e.preventDefault();
        var media_image_upload = $(this);
        var media_title = $(this).data('title');
        var media_button = $(this).data('button');
        var media_input_val = $(this).prev();
        var media_image_url_value = $(this).prev().prev().children('img');
        var media_image_url = $(this).siblings('.img-preview-wrap');

        var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: media_title,
            button: { text:  media_button },
            library: { type: 'image' }
        });
        // Opens the media library frame.
        meta_image_frame.open();
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            media_input_val.val(media_attachment.url);
            if( media_image_url_value !== null ){
                media_image_url_value.attr( 'src', media_attachment.url );
                media_image_url.show();
                WAFREFRESHVALUE(media_image_upload.closest("p"));
            }
        });
    });
    // Runs when the image button is clicked.
    jQuery('body').on('click','.media-image-remove', function(e){
        $(this).siblings('.img-preview-wrap').hide();
        $(this).prev().prev().val('');
    });
    /**repeater**/
    /*sortable*/
    var WAFREFRESHVALUE = function (wrapObject) {
        wrapObject.find('[name]').each(function(){
            $(this).trigger('change');
        });
    };
    var WAFSORTABLE = function () {
        var repeaters = $('.at-repeater');
        repeaters.sortable({
            orientation: "vertical",
            items: '> .repeater-table',
            placeholder: 'at-sortable-placeholder',
            update: function( event, ui ) {
                WAFREFRESHVALUE(ui.item);
            }
        });
        repeaters.trigger("sortupdate");
        repeaters.sortable("refresh");
    };
    /*replace*/
    var WAFREPLACE = function( str, replaceWhat, replaceTo ){
        var re = new RegExp(replaceWhat, 'g');
        return str.replace(re,replaceTo);
    };
    var WAFREPEATER =  function (){
        waf_document.on('click','.at-add-repeater',function (e) {
            e.preventDefault();
            var add_repeater = $(this),
                repeater_wrap = add_repeater.closest('.at-repeater'),
                code_for_repeater = repeater_wrap.find('.at-code-for-repeater'),
                total_repeater = repeater_wrap.find('.at-total-repeater'),
                total_repeater_value = parseInt( total_repeater.val() ),
                repeater_html = code_for_repeater.html();

            total_repeater.val( total_repeater_value +1 );
            var final_repeater_html = WAFREPLACE( repeater_html, add_repeater.attr('id'),total_repeater_value );
            add_repeater.before($('<div class="repeater-table"></div>').append( final_repeater_html ));
            var new_html_object = add_repeater.prev('.repeater-table');
            var repeater_inside = new_html_object.find('.at-repeater-inside');
            repeater_inside.slideDown( 'fast',function () {
                new_html_object.addClass( 'open' );
                WAFREFRESHVALUE(new_html_object);
            } );

        });
        waf_document.on('click', '.at-repeater-top, .at-repeater-close', function (e) {
            e.preventDefault();
            var accordion_toggle = $(this),
                repeater_field = accordion_toggle.closest('.repeater-table'),
                repeater_inside = repeater_field.find('.at-repeater-inside');

            if ( repeater_inside.is( ':hidden' ) ) {
                repeater_inside.slideDown( 'fast',function () {
                    repeater_field.addClass( 'open' );
                } );
            }
            else {
                repeater_inside.slideUp( 'fast', function() {
                    repeater_field.removeClass( 'open' );
                });
            }
        });
        waf_document.on('click', '.at-repeater-remove', function (e) {
            e.preventDefault();
            var repeater_remove = $(this),
                repeater_field = repeater_remove.closest('.repeater-table'),
                repeater_wrap = repeater_remove.closest('.at-repeater');

            repeater_field.remove();
            WAFREFRESHVALUE(repeater_wrap);
        });

        waf_document.on('change', '.at-select', function (e) {
            e.preventDefault();
            var select = $(this),
                repeater_inside = select.closest('.at-repeater-inside'),
                postid = repeater_inside.find('.at-postid'),
                postid_href = postid.attr('href'),
                postidhidden_href = postid.data('href'),
                optionSelected = select.find("option:selected"),
                valueSelected = optionSelected.val();
            if( valueSelected == 0 ){
                postid.addClass('hidden');
            }
            else{
                postid.removeClass('hidden');
            }

            postid_href = WAFREPLACE( postidhidden_href , 'POSTID',valueSelected );
            postid.attr('href',postid_href);
        });
    };
    /*call all methods on ready*/
    waf_document.ready( function() {
        waf_document.on('widget-added widget-updated', function( event, widgetContainer ) {
            WAFSORTABLE();
        });

        /*
         * Manually trigger widget-added events for media widgets on the admin
         * screen once they are expanded. The widget-added event is not triggered
         * for each pre-existing widget on the widgets admin screen like it is
         * on the customizer. Likewise, the customizer only triggers widget-added
         * when the widget is expanded to just-in-time construct the widget form
         * when it is actually going to be displayed. So the following implements
         * the same for the widgets admin screen, to invoke the widget-added
         * handler when a pre-existing media widget is expanded.
         */
        $( function initializeExistingWidgetContainers() {
            var widgetContainers;
            if ( 'widgets' !== window.pagenow ) {
                return;
            }
            widgetContainers = $( '.widgets-holder-wrap:not(#available-widgets)' ).find( 'div.widget' );
            widgetContainers.one( 'click.toggle-widget-expanded', function toggleWidgetExpanded() {
                WAFSORTABLE();
            });
        });
        WAFREPEATER();
    });
})( jQuery, window, document );