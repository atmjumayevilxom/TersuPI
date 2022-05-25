<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Educenter_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'educenter_enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once get_theme_file_path('sparklethemes/customizer/customizer-pro/section-pro.php');

		// Register custom section types.
		$manager->register_section_type( 'Educenter_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Educenter_Customize_Section_Pro(
				$manager,
				'educenter',
				array(
					'title'    => '',
					'pro_text' => esc_html__( 'Upgrade To Educenter Pro','educenter' ),
					'pro_url'  => 'https://sparklewpthemes.com/wordpress-themes/educenterpro/',
					'priority'  => 1,
				)
			)
		);


		// Register Documentation Section.
		$manager->add_section(
			new Educenter_Customize_Section_Pro(
				$manager,
				'educenterdoc',
				array(
					'title'    => esc_html__( 'Documentation', 'educenter' ),
					'pro_text' => esc_html__( 'View','educenter' ),
					'pro_url'  => 'http://docs.sparklewpthemes.com/educenter/',
					'priority'  => 1,
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function educenter_enqueue_control_scripts() {

		wp_enqueue_script( 'educenter-customize-controls', trailingslashit( get_template_directory_uri() ) . 'sparklethemes/customizer/customizer-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'educenter-customize-controls', trailingslashit( get_template_directory_uri() ) . 'sparklethemes/customizer/customizer-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
Educenter_Customize::get_instance();

if ( class_exists( 'WP_Customize_Control' ) ) {

	if ( !class_exists( 'EduCenter_Upgrade_Text') ) {
	
		class EduCenter_Upgrade_Text extends WP_Customize_Control {

	        public $type = 'educenter-upgrade-text';

	        public function render_content() {
	            ?>
	            <label>
	                <span class="dashicons dashicons-info"></span>

	                <?php if ($this->label) { ?>
	                    <span>
	                        <?php echo wp_kses_post($this->label); ?>
	                    </span>
	                <?php } ?>

	                <a href="<?php echo esc_url('https://sparklewpthemes.com/wordpress-themes/educenterpro'); ?>" target="_blank"> <strong><?php echo esc_html__('Upgrade to PRO', 'educenter'); ?></strong></a>
	            </label>

	            <?php if ($this->description) { ?>
	                <span class="description customize-control-description">
	                    <?php echo wp_kses_post($this->description); ?>
	                </span>
	                <?php
	            }

	            $choices = $this->choices;
	            if ($choices) {
	                echo '<ul>';
	                foreach ($choices as $choice) {
	                    echo '<li>' . esc_html($choice) . '</li>';
	                }
	                echo '</ul>';
	            }
	        }
	    }
	} 
}   

if ( class_exists( 'WP_Customize_Section' ) ) {
	
	if ( !class_exists( 'EduCenter_Customize_Upgrade_Section' ) ) {

		class EduCenter_Customize_Upgrade_Section extends WP_Customize_Section {

	        /**
	         * The type of customize section being rendered.
	         *
	         * @since  1.0.0
	         * @access public
	         * @var    string
	         */
	        public $type = 'educenter-upgrade-section';

	        /**
	         * Custom button text to output.
	         *
	         * @since  1.0.0
	         * @access public
	         * @var    string
	         */
	        public $text = '';
	        public $options = array();

	        /**
	         * Add custom parameters to pass to the JS via JSON.
	         *
	         * @since  1.0.0
	         * @access public
	         * @return void
	         */
	        public function json() {
	            $json = parent::json();

	            $json['text'] = $this->text;
	            $json['options'] = $this->options;

	            return $json;
	        }

	        /**
	         * Outputs the Underscore.js template.
	         *
	         * @since  1.0.0
	         * @access public
	         * @return void
	         */
	        protected function render_template() {
	            ?>
	            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
	                <label>
	                    <# if ( data.title ) { #>
	                    {{ data.title }}
	                    <# } #>
	                </label>

	                <# if ( data.text ) { #>
	                {{ data.text }}
	                <# } #>

	                <# _.each( data.options, function(key, value) { #>
	                {{ key }}<br/>
	                <# }) #>

	                <a href="<?php echo esc_url('https://sparklewpthemes.com/wordpress-themes/educenterpro'); ?>" class="button button-primary" target="_blank"><?php echo esc_html__('Upgrade to Pro', 'educenter'); ?></a>
	            </li>
	            <?php
	        }
	    }

	}

}
