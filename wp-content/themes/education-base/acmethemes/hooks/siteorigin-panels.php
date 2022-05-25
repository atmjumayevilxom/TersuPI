<?php
/**
 * Adds Education Base Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
function education_base_widgets($widgets) {
    $theme_widgets = array(
        'Education_base_about',
        'Education_base_posts_col',
        'Education_base_contact',
        'Education_base_course',
        'Education_Base_fdcolumn',
        'Education_base_gallery',
        'Education_base_team',
        'Education_base_testimonial'
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('education-base');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'education_base_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Education base 1.0.0
 *
 * @param null
 * @return null
 *
 */
function education_base_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => __('AT Education Base Widgets', 'education-base'),
        'filter' => array(
            'groups' => array('education-base')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'education_base_widgets_tab', 20);