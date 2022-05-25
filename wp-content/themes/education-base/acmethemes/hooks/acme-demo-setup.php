<?php
if( !function_exists( 'education_base_demo_nav_data') ){
    function education_base_demo_nav_data(){
        $demo_navs = array(
            'one-page' => 'Front Page',
            'primary'  => 'Inner Page'
        );
        return $demo_navs;
    }
}
add_filter('acme_demo_setup_nav_data','education_base_demo_nav_data');

if( !function_exists( 'education_base_demo_wp_options_data') ){
    function education_base_demo_wp_options_data(){
        $wp_options = array(
            'blogname'       => 'Education Base',
            'page_on_front'  => 'Home Page',
            'page_for_posts' => 'Blog',
        );
        return $wp_options;
    }
}
add_filter('acme_demo_setup_wp_options_data','education_base_demo_wp_options_data');