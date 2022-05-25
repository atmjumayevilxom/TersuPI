( function( $ ) {
    /*Drag and drop to change order*/
    $(document).ready(function () {
        var customize_theme_controls = $(document);
        function refresh_repeater_values(){
            $(".at-repeater-field-control-wrap").each(function(){
                var values = [];
                var $this = $(this);
                $this.find(".repeater-field-control").each(function(){
                    var valueToPush = {};
                    $(this).find('[data-name]').each(function(){
                        var dataName = $(this).attr('data-name');
                        var dataValue = $(this).val();
                        valueToPush[dataName] = dataValue;
                    });
                    values.push(valueToPush);
                });
                $this.next('.at-repeater-collection').val(JSON.stringify(values)).trigger('change');
            });
        }

        customize_theme_controls.on('click','.repeater-field-title',function(){
            $(this).next().slideToggle();
            $(this).closest('.repeater-field-control').toggleClass('expanded');
        });
        customize_theme_controls.on('click', '.repeater-field-close', function(){
            $(this).closest('.repeater-fields').slideUp();
            $(this).closest('.repeater-field-control').toggleClass('expanded');
        });
        $("body").on("click",'.at-repeater-add-control-field', function(){
            var $this = $(this).parent();
            if(typeof $this !== 'undefined') {
                var field = $this.find(".at-repeater-field-control-generator").html();
                var field = $($.parseHTML(field));
                if(typeof field !== 'undefined'){
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

                    field.find('.single-field').show();

                    $this.find('.at-repeater-field-control-wrap').append(field);

                    field.addClass('expanded').find('.repeater-fields').show();
                    $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                    refresh_repeater_values();
                }

            }
            return false;
        });

        customize_theme_controls.on("click", ".repeater-field-remove",function(){
            if( typeof	$(this).parent() != 'undefined'){
                $(this).closest('.repeater-field-control').slideUp('normal', function(){
                    $(this).remove();
                    refresh_repeater_values();
                });
            }
            return false;
        });

        customize_theme_controls.on('keyup change', '[data-name]',function(){
            refresh_repeater_values();
            return false;
        });
        $(".at-repeater-field-control-wrap").sortable({
            orientation: "vertical",
            update: function( event, ui ) {
                refresh_repeater_values();
            }
        });
    })

} )( jQuery );