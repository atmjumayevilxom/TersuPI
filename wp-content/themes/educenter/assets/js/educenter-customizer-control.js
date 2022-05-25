(function(api) {

    wp.customize('educenter_homepage_slider_type', function(setting) {
        var defaultSlider = function(control) {
			var visibility = function() {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var advancetSlider = function(control) {
            var visibility = function() {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('educenter_banner_all_sliders', defaultSlider);
        wp.customize.control('educenter_banner_normal_all_sliders', advancetSlider);
    });
    
    wp.customize('educenter_homepage_service_type', function(setting) {
        var defaultSlider = function(control) {
            var visibility = function() {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var advancetSlider = function(control) {
            var visibility = function() {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('educenter_fservices_area_settings', defaultSlider);
        wp.customize.control('educenter_fservices_area_settings_advance', advancetSlider);
    });

    /** education xpert theme compatible */
    wp.customize('education_xpert_feature_services_type', function(setting) {
        var defaultOption = function(control) {
            var visibility = function() {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var advanceOption = function(control) {
            var visibility = function() {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('education_xpert_feature_services_area_settings', defaultOption);
        wp.customize.control('education_xpert_feature_services_area_settings_advance', advanceOption);
    });

    /** course view */    
    wp.customize('educenter_courses_section_view', function(setting) {
        var gridSlide = function(control) {
            var visibility = function() {
                if ('grid' === setting.get() || 'slide' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('educenter_courses_section_column', gridSlide);
    });

    
    

})(wp.customize);