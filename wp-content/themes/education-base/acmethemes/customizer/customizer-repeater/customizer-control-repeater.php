<?php
function education_base_sanitize_repeater( $input ){
	$input_decoded = json_decode( $input, true );
	if( !empty( $input_decoded ) ) {
		foreach ( $input_decoded as $boxes => $box ){
			foreach ( $box as $key => $value ){
				$input_decoded[$boxes][$key] = sanitize_text_field( $value );
			}
		}
		return json_encode( $input_decoded );
	}
	return $input;
}

class AT_Repeater_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'repeater';

	public $repeater_main_label = '';

	public $repeater_add_control_field = '';

	/**
	 * The fields that each container row will contain.
	 *
	 * @access public
	 * @var array
	 */
	public $fields = array();

	/**
	 * Repeater drag and drop controler
	 *
	 * @since  1.0.0
	 */
	public function __construct( $manager, $id, $args = array(), $fields = array() ) {
		$this->fields                       = $fields;
		$this->repeater_main_label       = $args['repeater_main_label'];
		$this->repeater_add_control_field = $args['repeater_add_control_field'];
		parent::__construct( $manager, $id, $args );
	}

	public function enqueue(){
		wp_enqueue_script( 'at-customizer-repeater-script', get_template_directory_uri() . '/acmethemes/customizer/customizer-repeater/customizer-repeater.js', array('jquery', 'jquery-ui-draggable' ), '1.0.0', true  );
    }

	public function render_content() {
		?>
        <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
        </span>
		<?php if ( $this->description ) { ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post( $this->description ); ?>
            </span>
        <?php
		}
		?>
        <ul class="at-repeater-field-control-wrap">
			<?php $this->get_fields(); ?>
        </ul>
        <input type="hidden" <?php $this->link(); ?> class="at-repeater-collection" value="<?php echo esc_attr( $this->value() ); ?>"/>
        <button type="button" class="button at-repeater-add-control-field"><?php echo esc_html( $this->repeater_add_control_field ); ?></button>
		<?php
	}

	private function get_fields() {
		$fields = $this->fields;
		$values = json_decode( $this->value() );
		/*repeater generator start*/
		?>
        <script type="text/html" class="at-repeater-field-control-generator">

            <li class="repeater-field-control">
                <h3 class="repeater-field-title accordion-section-title">
			        <?php echo esc_html( $this->repeater_main_label ); ?>
                </h3>
                <div class="repeater-fields hidden">
			        <?php
			        foreach ( $fields as $key => $field ) {
				        $class = isset( $field['class'] ) ? $field['class'] : '';
				        ?>
                        <div class="single-field type-<?php echo esc_attr( $field['type'] ) . ' ' . $class; ?>">
					        <?php
					        $label       = isset( $field['label'] ) ? $field['label'] : '';
					        $description = isset( $field['description'] ) ? $field['description'] : '';
					        if ( $field['type'] != 'checkbox' ) { ?>
                                <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                                <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
						        <?php
					        }
					        $new_value = '';
					        $default   = isset( $field['default'] ) ? $field['default'] : '';

					        switch ( $field['type'] ) {
						        case 'text':
							        echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '"/>';
							        break;

						        case 'textarea':
							        echo '<textarea data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">' . esc_textarea( $new_value ) . '</textarea>';
							        break;

						        case 'select':
							        $options = $field['options'];
                                    $new_value = is_numeric($new_value) || is_string($new_value)?$new_value:'';
							        echo '<select  data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">';
                                    $new_value = is_numeric($new_value) || is_string($new_value)?$new_value:'';
							        foreach ( $options as $option => $val ) {
								        printf( '<option value="%s" %s>%s</option>', esc_attr( $option ), selected( $new_value, $option, false ), esc_html( $val ) );
							        }
							        echo '</select>';
							        break;

						        default:
							        break;
					        }
					        ?>
                        </div>
				        <?php
			        }
			        ?>

                    <div class="clearfix repeater-footer">

                        <a class="repeater-field-remove" href="#remove">
					        <?php _e( 'Delete', 'education-base' ) ?>
                        </a> |
                        <a class="repeater-field-close" href="#close">
					        <?php _e( 'Close', 'education-base' ) ?>
                        </a>

                    </div>
                </div>
            </li>
        </script>

        <?php
		/*repeater generator end*/
		if ( is_array( $values ) ) {
			foreach ( $values as $value ) { ?>
                <li class="repeater-field-control">
                    <h3 class="repeater-field-title accordion-section-title">
                        <?php echo esc_html( $this->repeater_main_label ); ?>
                    </h3>
                    <div class="repeater-fields hidden">
						<?php
						foreach ( $fields as $key => $field ) {
							$class = isset( $field['class'] ) ? $field['class'] : '';
							?>
                            <div class="single-field type-<?php echo esc_attr( $field['type'] ) . ' ' . $class; ?>">
                                <?php
                                $label       = isset( $field['label'] ) ? $field['label'] : '';
                                $description = isset( $field['description'] ) ? $field['description'] : '';
                                if ( $field['type'] != 'checkbox' ) { ?>
                                    <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                                    <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                                    <?php
                                }
								$new_value = isset( $value->$key ) ? $value->$key : '';
								$default   = isset( $field['default'] ) ? $field['default'] : '';

								switch ( $field['type'] ) {
									case 'text':
										echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '"/>';
										break;

									case 'textarea':
										echo '<textarea data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">' . esc_textarea( $new_value ) . '</textarea>';
										break;

									case 'select':
										$options = $field['options'];
                                        $new_value = is_numeric($new_value) || is_string($new_value)?$new_value:'';
										echo '<select  data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">';
                                        $new_value = is_numeric($new_value) || is_string($new_value)?$new_value:'';
										foreach ( $options as $option => $val ) {
											printf( '<option value="%s" %s>%s</option>', esc_attr( $option ), selected( $new_value, $option, false ), esc_html( $val ) );
										}
										echo '</select>';
										break;

									default:
										break;
								}
								?>
                            </div>
						<?php
						}
						?>

                        <div class="clearfix repeater-footer">

                            <a class="repeater-field-remove" href="#remove">
		                        <?php _e( 'Delete', 'education-base' ) ?>
                            </a> |
                            <a class="repeater-field-close" href="#close">
		                        <?php _e( 'Close', 'education-base' ) ?>
                            </a>

                        </div>
                    </div>
                </li>
			<?php }
		}
	}
}