<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Education_Base_Customize_Category_Dropdown_Control' )):

    /**
     * Custom Control for category dropdown
     * @package Acme Themes
     * @subpackage Education Base
     * @since 1.0.0
     *
     */
    class Education_Base_Customize_Category_Dropdown_Control extends WP_Customize_Control {

        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'category_dropdown';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
        public function render_content() {
            $education_base_customizer_name = 'education_base_customizer_dropdown_categories_' . $this->id;;
            $education_base_dropdown_categories = wp_dropdown_categories(
                array(
                    'name'              => $education_base_customizer_name,
                    'echo'              => 0,
                    'show_option_none'  =>__('Select','education-base'),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
            $education_base_dropdown_final = str_replace( '<select', '<select ' . $this->get_link(), $education_base_dropdown_categories );
            printf(
                '<label><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $education_base_dropdown_final
            );
        }
    }
endif;