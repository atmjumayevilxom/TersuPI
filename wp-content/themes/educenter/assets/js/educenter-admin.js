/**
 * Educenter Theme Admin Js
*/
jQuery(document).ready(function($){

	/**
     * Customizer Option Auto focus
     */
	 jQuery('h3.accordion-section-title').on('click', function(){
        var id = $(this).parent().attr('id');
        try{
            var is_panel = id.includes("panel");
            var is_section = id.includes("section");
            
            if( is_panel ){
                focus_item = id.replace('accordion-panel-', '');
                console.log(focus_item);
                history.pushState({}, null, '?autofocus[panel]=' + focus_item);
            }
            if( is_section ){
                focus_item = id.replace('accordion-section-', '');
                history.pushState({}, null, '?autofocus[section]=' + focus_item);
            }
        }catch(e){
            console.log(e);
        }
    });
	
    /**
     * Repeater Fields
    */
	function educenter_refresh_repeater_values(){
		$(".educenter-repeater-field-control-wrap").each(function(){			
			var values = []; 
			var $this = $(this);			
			$this.find(".educenter-repeater-field-control").each(function(){
			var valueToPush = {};
			$(this).find('[data-name]').each(function(){
				var dataName = $(this).attr('data-name');
				var dataValue = $(this).val();
				valueToPush[dataName] = dataValue;
			});
			values.push(valueToPush);
			});
			$this.next('.educenter-repeater-collector').val(JSON.stringify(values)).trigger('change');
		});
	}

    $('#customize-theme-controls').on('click','.educenter-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.educenter-repeater-field-control').toggleClass('expanded');
    });
    $('#customize-theme-controls').on('click', '.educenter-repeater-field-close', function(){
    	$(this).closest('.educenter-repeater-fields').slideUp();;
    	$(this).closest('.educenter-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.educenter-add-control-field', function(){
		var $this = $(this).parent();
		if(typeof $this != 'undefined') {
            var field = $this.find(".educenter-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){                
                field.find("input[type='text'][data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });
                field.find("textarea[data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });
                field.find("select[data-name]").each(function(){
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });

                field.find(".educenter-icon-list").each(function(){
					var defaultValue = $(this).next('input[data-name]').attr('data-default');
					$(this).next('input[data-name]').val(defaultValue);
					$(this).prev('.educenter-selected-icon').children('i').attr('class','').addClass(defaultValue);
					
					$(this).find('li').each(function(){
						var icon_class = $(this).find('i').attr('class');
						if(defaultValue == icon_class ){
							$(this).addClass('icon-active');
						}else{
							$(this).removeClass('icon-active');
						}
					});
				});

                field.find(".attachment-media-view").each(function(){
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if(defaultValue){
                        $(this).find(".thumbnail-image").html('<img src="'+defaultValue+'"/>').prev('.placeholder').addClass('hidden');
                    }else{
                        $(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');   
                    }
                });

				field.find('.educenter-fields').show();

				$this.find('.educenter-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.educenter-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                educenter_refresh_repeater_values();
            }

		}
		return false;
	 });
	
	$("#customize-theme-controls").on("click", ".educenter-repeater-field-remove",function(){
		if( typeof	$(this).parent() != 'undefined'){
			$(this).closest('.educenter-repeater-field-control').slideUp('normal', function(){
				$(this).remove();
				educenter_refresh_repeater_values();
			});			
		}
		return false;
	});

    $('.educenter-color-picker').wpColorPicker({
		change: function(event, ui){
			setTimeout(function(){
                educenter_refresh_repeater_values()
		}, 100);
		}
	});

	$("#customize-theme-controls").on('keyup change', '[data-name]',function(){
		 educenter_refresh_repeater_values();
		 return false;
	});


	// Set all variables to be used in scope
	var frame;
	// ADD IMAGE LINK
	$('.customize-control-repeater').on( 'click', '.educenter-upload-button', function( event ){
		event.preventDefault();
		var imgContainer = $(this).closest('.educenter-fields-wrap').find( '.thumbnail-image'),
		placeholder = $(this).closest('.educenter-fields-wrap').find( '.placeholder'),
		imgIdInput = $(this).siblings('.upload-id');

		// Create a new media frame
		frame = wp.media({
		    title: 'Select or Upload Image',
		    button: {
		    text: 'Use Image'
		    },
		    multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected in the media frame...
		frame.on( 'select', function() {
			// Get media attachment details from the frame state
			var attachment = frame.state().get('selection').first().toJSON();
			// Send the attachment URL to our custom image input field.
			imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
			placeholder.addClass('hidden');
			// Send the attachment id to our hidden input
			imgIdInput.val( attachment.url ).trigger('change');
		});

		// Finally, open the modal on click
		frame.open();
	});


	// DELETE IMAGE LINK
	$('.customize-control-repeater').on( 'click', '.educenter-delete-button', function( event ){

		event.preventDefault();
		var imgContainer = $(this).closest('.educenter-fields-wrap').find( '.thumbnail-image'),
		placeholder = $(this).closest('.educenter-fields-wrap').find( '.placeholder'),
		imgIdInput = $(this).siblings('.upload-id');

		// Clear out the preview image
		imgContainer.find('img').remove();
		placeholder.removeClass('hidden');

		// Delete the image id from the hidden input
		imgIdInput.val( '' ).trigger('change');

	});


	$('body').on('click', '.educenter-icon-list li', function(){
		var icon_class = $(this).find('i').attr('class');
		$(this).addClass('icon-active').siblings().removeClass('icon-active');
		$(this).parent('.educenter-icon-list').prev('.educenter-selected-icon').children('i').attr('class','').addClass(icon_class);
		$(this).parent('.educenter-icon-list').next('input').val(icon_class).trigger('change');
		educenter_refresh_repeater_values();
	});

	$('body').on('click', '.educenter-selected-icon', function(){
		$(this).next().slideToggle();
	});

	/*Drag and drop to change order*/
	$(".educenter-repeater-field-control-wrap").sortable({
		orientation: "vertical",
		update: function( event, ui ) {
			educenter_refresh_repeater_values();
		}
	});


	/**
	 * Enable/Disable Swithc Options
	*/
	$('.switch_options').each(function() {    
	    var obj = $(this); //This object
	    var enb = obj.children('.switch_enable'); //cache first element, this is equal to ON
	    var dsb = obj.children('.switch_disable'); //cache first element, this is equal to OFF
	    var input = obj.children('input'); //cache the element where we must set the value
	    var input_val = obj.children('input').val(); //cache the element where we must set the value

	    /* Check selected */
	    if (0 == input_val) {
	        dsb.addClass('selected');
	    }
	    else if (1 == input_val) {
	        enb.addClass('selected');
	    }

	    //Action on user's click(ON)
	    enb.on('click', function() {
	        $(dsb).removeClass('selected'); //remove "selected" from other elements in this object class(OFF)
	        $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(ON) 
	        $(input).val(1).change(); //Finally change the value to 1
	    });

	    //Action on user's click(OFF)
	    dsb.on('click', function() {
	        $(enb).removeClass('selected'); //remove "selected" from other elements in this object class(ON)
	        $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(OFF) 
	        $(input).val(0).change(); // //Finally change the value to 0
	    });
	});

	/**
	 * Select Multiple Category
	*/
    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {

            var checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return $( this ).val();
                }
            ).get().join( ',' );

            $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        
        }
    );

    /**
     * Multiple Gallery Image Control
    */
    $('.upload_gallery_button').click(function(event){
        var current_gallery = $( this ).closest( 'label' );

        if ( event.currentTarget.id === 'clear-gallery' ) {
            //remove value from input
            current_gallery.find( '.gallery_values' ).val( '' ).trigger( 'change' );

            //remove preview images
            current_gallery.find( '.gallery-screenshot' ).html( '' );
            return;
        }

        // Make sure the media gallery API exists
        if ( typeof wp === 'undefined' || !wp.media || !wp.media.gallery ) {
            return;
        }
        event.preventDefault();

        // Activate the media editor
        var val = current_gallery.find( '.gallery_values' ).val();
        var final;

        if ( !val ) {
            final = '[gallery ids="0"]';
        } else {
            final = '[gallery ids="' + val + '"]';
        }
        var frame = wp.media.gallery.edit( final );

        frame.state( 'gallery-edit' ).on(
            'update', function( selection ) {

                //clear screenshot div so we can append new selected images
                current_gallery.find( '.gallery-screenshot' ).html( '' );

                var element, preview_html = '', preview_img;
                var ids = selection.models.map(
                    function( e ) {
                        element = e.toJSON();
                        preview_img = typeof element.sizes.thumbnail !== 'undefined' ? element.sizes.thumbnail.url : element.url;
                        preview_html = "<div class='screen-thumb'><img src='" + preview_img + "'/></div>";
                        current_gallery.find( '.gallery-screenshot' ).append( preview_html );
                        return e.id;
                    }
                );

                current_gallery.find( '.gallery_values' ).val( ids.join( ',' ) ).trigger( 'change' );
            }
        );
        return false;
    });

    
    //Homepage Section Sortable
    function educenter_sections_order(container) {
        var sections = $(container).sortable('toArray');
        var sec_ordered = [];
        $.each(sections, function(index, sec_id) {
            sec_id = sec_id.replace("accordion-section-", "");
            sec_ordered.push(sec_id);
        });

        $.ajax({
            url: ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                'action': 'educenter_sections_reorder',
                'sections': sec_ordered,
            }
        }).done(function(data) {
            $.each(sec_ordered, function(key, value) {
                wp.customize.section(value).priority(key);
            });
            $(container).find('.educenter-drag-spinner').hide();
            wp.customize.previewer.refresh();
        });
    }
    $('#sub-accordion-panel-educenter_homepage_settings').sortable({
        axis: 'y',
        helper: 'clone',
        cursor: 'move',
        items: '> li.control-section:not(#accordion-section-educenter-upgrade-section-homepage-settings)',
        delay: 150,
        update: function(event, ui) {
            $('#sub-accordion-panel-educenter_homepage_settings').find('.educenter-drag-spinner').show();
            educenter_sections_order('#sub-accordion-panel-educenter_homepage_settings');
            $('.wp-full-overlay-sidebar-content').scrollTop(0);
        }
    });

    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-educenter_homepage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });

});



function scrollToSection( section_id ){
	
    var preview_section_id = "edu-features-section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {

        case 'accordion-section-educenter_fservices_settings':
        preview_section_id = "edu-features-section";
        break;

        case 'accordion-section-educenter_aboutus_settings':
        preview_section_id = "edu-aboutus-section";
        break;

        case 'accordion-section-educenter_cta_settings':
        preview_section_id = "edu-cta-section";
        break;

        case 'accordion-section-educenter_services_settings':
        preview_section_id = "edu-services-section";
        break;

        case 'accordion-section-educenter_courses_settings':
        preview_section_id = "edu-courses-section";
        break;

        case 'accordion-section-educenter_gallery_settings':
        preview_section_id = "edu-gallery-section";
        break;

        case 'accordion-section-educenter_counter_settings':
        preview_section_id = "edu-counter-section";
        break;

        case 'accordion-section-educenter_team_settings':
        preview_section_id = "edu-team-section";
        break;

        case 'accordion-section-educenter_testimonial_settings':
        preview_section_id = "edu-testimonials-section";
        break;

        case 'accordion-section-educenter_blog_settings':
        preview_section_id = "edu-blog-section";
        break;
        
        case 'accordion-section-educenter_events_settings':
        preview_section_id = "edu-wp-events-section";
        break;

    }

    if( $contents.find('#'+preview_section_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}
