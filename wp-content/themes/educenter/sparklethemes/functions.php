<?php
/**
 * Main Custom admin functions area
 *
 * @since SparklewpThemes
 *
 * @param Educenter
 */


if( ! function_exists( 'educenter_frontpage_template_set' ) ) :
    /**
     * Enable Front Page Action
     *
     * @since 1.0.0
     */
    function educenter_frontpage_template_set() {

        $educenter_set_frontpage = get_theme_mod( 'educenter_set_frontpage' ,false);

        if( 1 != $educenter_set_frontpage ){

           if ( 'posts' == get_option( 'show_on_front' ) ) {

                   include( get_home_template() );

           }
              else {

                   include( get_page_template() );
           }
        } 
    
    }

endif;

add_action( 'educenter_frontpage', 'educenter_frontpage_template_set', 10 );



if ( ! function_exists( 'educenter_breadcrumb' ) ) :

  /**
   * Breadcrumb.
   *
   * @since 1.0.0
   */
  function educenter_breadcrumb() {

    if ( ! function_exists( 'breadcrumb_trail' ) ) {
      require_once trailingslashit( get_template_directory() ) . '/sparklethemes/breadcrumbs/breadcrumbs.php';
    }

    $breadcrumb_args = array(
      'container'   => 'div',
      'show_browse' => false,
    );

    breadcrumb_trail( $breadcrumb_args );

  }

endif;


if ( ! function_exists( 'educenter_add_breadcrumb' ) ) :

  /**
   * Add breadcrumb.
   *
   * @since 1.0.0
   */
  function educenter_add_breadcrumb() {

    // Bail if home page.
    if ( is_front_page() || is_home() ) {
      return;
    }  ?>

    <div class="ed-breadcrumb">
       <div class="ed-overlay"></div>
       <div class="container">
          <div class="breadcrumb-list">
            <h2 class="ed-header-title">
              <?php 
                 if( is_category() || is_archive() ){
                 
                     the_archive_title( '<span>', '</span>' );
                 
                 }elseif( is_search() ){
                 
                     /* translators: %s: search query. */
                     printf( esc_html__( 'Search Results for: %s', 'educenter' ), '<span>' . get_search_query() . '</span>' );
                 
                 }elseif( is_404() ){
                 
                     esc_html_e('Error Page', 'educenter');
                 
                 }else{
                 
                      the_title(); 
                 }
              ?>
            </h2>
            <div id="breadcrumb" class="bread-list">
              <?php educenter_breadcrumb(); ?>
            </div>

          </div>
       </div>
    </div>

  <?php

  }

endif;

add_action( 'educenter_add_breadcrumb', 'educenter_add_breadcrumb', 10 );



if ( ! function_exists( 'educenter_woocommerce_breadcrumb' ) ) :

  /**
   * Add breadcrumb.
   *
   * @since 1.0.0
   */
  function educenter_woocommerce_breadcrumb() {

    // Bail if home page.
    if ( is_front_page() || is_home() ) {
      return;
    }  ?>

    <div class="ed-breadcrumb">
       <div class="ed-overlay"></div>

       <div class="container">
          <div class="breadcrumb-list">

            <h2 class="ed-header-title">
              <?php 

                if( is_product() ) {

                    the_title(); 

                }elseif( is_search() ){ 
                    /* translators: %1$s: search query. */
                    printf( esc_html__( 'Search Results for : %1$s', 'educenter' ), '<span>' . get_search_query() . '</span>' ); 
                }else{  

                  woocommerce_page_title();  

                } 

              ?> 
            </h2>

            <div id="breadcrumb" class="bread-list">
              <?php woocommerce_breadcrumb(); ?>
            </div>

          </div>
       </div>
    </div>

  <?php

  }

endif;

add_action( 'educenter_woocommerce', 'educenter_woocommerce_breadcrumb', 10 );


/**
 * Social Media Links
*/
if ( ! function_exists( 'educenter_social_links' ) ) {
    function educenter_social_links() { ?>
        <ul class="edu-social">
            <?php if (esc_url( get_theme_mod('educenter_social_facebook') ) ) : ?>
                <li>
                    <a href="<?php echo esc_url( get_theme_mod('educenter_social_facebook') );?>">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (esc_url(get_theme_mod('educenter_social_twitter'))) :?>
                <li> 
                  <a href="<?php echo esc_url( get_theme_mod('educenter_social_twitter') ); ?>">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('educenter_social_googleplus'))) :?>
                <li>
                  <a href="<?php echo esc_url(get_theme_mod('educenter_social_googleplus')); ?>">
                    <i class="fab fa-google-plus-g"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('educenter_social_instagram'))) : ?>
                <li> 
                  <a href="<?php echo esc_url(get_theme_mod('educenter_social_instagram')) ;?>">
                    <i class="fab fa-instagram"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('educenter_social_pinterest'))) : ?>
                <li>
                  <a href="<?php echo esc_url(get_theme_mod('educenter_social_pinterest')); ?>">
                    <i class="fab fa-pinterest"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('educenter_social_linkedin'))) : ?>
                <li>
                  <a href="<?php echo esc_url(get_theme_mod('educenter_social_linkedin')); ?>">
                    <i class="fab fa-linkedin"></i>
                  </a>
                </li>
            <?php endif;?>

            <?php if (esc_url(get_theme_mod('educenter_social_youtube'))) : ?>
                <li> 
                  <a href="<?php echo esc_url(get_theme_mod('educenter_social_youtube')); ?>">
                    <i class="fab fa-youtube"></i>
                  </a>
               </li>
            <?php endif;?>
        </ul>
      <?php 
    }
}
add_action('educenter_social_links','educenter_social_links', 5);

/**
 * Top Header Quick Informaint 
*/
if ( ! function_exists( 'educenter_top_quick_information' ) ) {
  
    function educenter_top_quick_information() { ?>
        
            <ul class="quickcontact">
              <?php
                $email_address    = get_theme_mod('educenter_email_address');
                $phone_number     = get_theme_mod('educenter_phone_number');
                $phonenumber      = preg_replace("/[^0-9]/","",$phone_number);
                $map_address      = get_theme_mod('educenter_map_address');
                $open_time        = get_theme_mod('educenter_opeening_time');
              
              if(!empty( $email_address )) { ?>                     
                  <li>
                    <a href="mailto:<?php echo esc_attr( antispambot( $email_address ) ); ?>">
                      <i class="fas fa-envelope"></i>
                      <?php echo esc_attr( antispambot( $email_address ) ); ?>
                    </a>
                  </li>
                <?php }  ?>
                
                <?php if(!empty( $phone_number )) { ?>                      
                  <li>                                    
                    <a href="tel:<?php echo esc_attr( $phonenumber ); ?>">
                      <i class="fas fa-phone"></i>
                      <?php echo esc_attr( $phone_number ); ?>
                    </a>
                  </li>
                <?php }  ?>
                
                <?php if(!empty( $map_address )) { ?>                     
                  <li>                                
                  <i class="fas fa-map"></i>
                  <?php echo esc_attr( $map_address ); ?>
                  </li>
                <?php }  ?>
                
                <?php if(!empty( $open_time )) { ?>                     
                  <li>
                    <i class="fas fa-clock"></i>
                    <?php echo esc_attr( $open_time ); ?>
                  </li>
                <?php }  ?>                             
            </ul><!--/ End Contact -->
      <?php 
    }
}
add_action('educenter_top_quick','educenter_top_quick_information', 5);

/**
  * Footer Copyright Information
 */
if ( ! function_exists( 'educenter_footer_copyright' ) ){

    /**
     * Footer Copyright Information
     *
     * @since 1.0.0
    */

    function educenter_footer_copyright() {

        $copyright = ''; 

        if( !empty( $copyright ) ) { 

            echo esc_html( apply_filters( 'educenter_copyright_text', $copyright . ' ' ) ); 

        } else { 
            echo esc_html( apply_filters( 'educenter_copyright_text', $content = esc_html__('Copyright  &copy; ','educenter') . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) .' - ' ) );
        }

        printf( 'WordPress Theme : By %1$s', '<a href=" ' . esc_url('https://sparklewpthemes.com/') . ' " rel="designer" target="_blank">'.esc_html__( 'Sparkle Themes','educenter' ).'</a>' );   
    }
    
}

add_action( 'educenter_copyright', 'educenter_footer_copyright', 5 );


if ( ! function_exists( 'educenter_section_title' ) ) :
  /**
   * All Section Main Title & Sub Title
   *
   * @since 1.0.0
  */
  function educenter_section_title( $title, $subtitle ) { 
  
   if( !empty($title) || !empty($subtitle) ){ ?>

      <div class="ed-header layout-2">

        <?php if(get_theme_mod('educenter_show_bubble', true)): ?>
          <span class="ed-badge"><?php esc_html_e('Explore', 'educenter'); ?></span>
        <?php endif; ?>

        <?php if( function_exists( 'pll_register_string' ) ){ ?>

          <h2 class="section-header"><?php echo esc_html( pll__( $title ) ); ?></h2>

        <?php }else{ ?>

          <h2 class="section-header"><?php echo esc_html( $title ); ?></h2>

        <?php } ?>

        <?php if( !empty( $subtitle ) ){ ?>

            <?php if( function_exists( 'pll_register_string' ) ){ ?>

              <p><?php echo esc_html( pll__( $subtitle ) ); ?></p>

            <?php }else{ ?>

              <p><?php echo esc_html( $subtitle ); ?></p>

            <?php } ?>

        <?php } ?>

      </div>
    
    <?php }

  }

endif;


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function educenter_custom_excerpt_length( $length ) {

  if(is_admin() ){

    return $length;

  }elseif( is_front_page() ){

    return 18;
    
  }else{

    return 42;

  }

}
add_filter( 'excerpt_length', 'educenter_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function educenter_excerpt_more( $more ) {

  if(is_admin() ){

    return $more;

  }

    return '...';
}
add_filter( 'excerpt_more', 'educenter_excerpt_more' );


/**
 * Customizer Custom Control Class Layout 
*/

if(class_exists( 'WP_Customize_control')) {
    /**
     * Switch Custom Control Function
    */
    class Educenter_Switch_Control extends WP_Customize_Control {
        public $type = 'switch';    
        public function render_content() { ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <div class="switch_options">
                    <span class="switch_enable"><?php esc_html_e('Enable', 'educenter'); ?></span>
                    <span class="switch_disable"><?php esc_html_e('Disable', 'educenter'); ?></span>  
                    <input type="hidden" id="enable_prev_next" <?php esc_url( $this->link() ); ?> value="<?php echo esc_attr( $this->value() ); ?>" />                           
                </div>
            </label>
        <?php   
        }
    }

    /**
     * Repeater Custom Control Function
    */
    class Educenter_Repeater_Controler extends WP_Customize_Control {
      /**
       * The control type.
       *
       * @access public
       * @var string
      */
      public $type = 'repeater';

      public $educenter_box_label = '';

      public $educenter_box_add_control = '';

      private $cats = '';

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
        $this->fields = $fields;
        $this->educenter_box_label = $args['educenter_box_label'] ;
        $this->educenter_box_add_control = $args['educenter_box_add_control'];
        $this->cats = get_categories(array( 'hide_empty' => false ));
        parent::__construct( $manager, $id, $args );
      }

      public function render_content() {
        $values = json_decode($this->value());
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php if($this->description){ ?>
          <span class="description customize-control-description">
          <?php echo wp_kses_post($this->description); ?>
          </span>
        <?php } ?>

        <ul class="educenter-repeater-field-control-wrap">
          <?php $this->educenter_get_fields(); ?>
        </ul>
        <input type="hidden" <?php esc_attr( $this->link() ); ?> class="educenter-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
        <button type="button" class="button educenter-add-control-field"><?php echo esc_html( $this->educenter_box_add_control ); ?></button>
        <?php
      }

      private function educenter_get_fields(){
        $fields = $this->fields;
        $values = json_decode($this->value());
        if(is_array($values)){
        foreach($values as $value){    ?>
          <li class="educenter-repeater-field-control">
            <h3 class="educenter-repeater-field-title accordion-section-title"><?php echo esc_html( $this->educenter_box_label ); ?></h3>
            <div class="educenter-repeater-fields">
              <?php
                foreach ($fields as $key => $field) {
                $class = isset( $field['class'] ) ? $field['class'] : '';
              ?>
                <div class="educenter-fields educenter-type-<?php echo esc_attr( $field['type'] ).' '.esc_attr( $class ); ?>">
                  <?php
                    $label = isset($field['label']) ? $field['label'] : '';
                    $description = isset($field['description']) ? $field['description'] : '';
                    if($field['type'] != 'checkbox'){ ?>
                      <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                      <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                  <?php }

                    $new_value = isset($value->$key) ? $value->$key : '';
                    $default = isset($field['default']) ? $field['default'] : '';

                    switch ( $field['type'] ) {
                      case 'url':
                      case 'text':
                        echo '<input data-default="'.esc_attr($default).'" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
                        break;

                      case 'textarea':
                        echo '<textarea data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">'.esc_textarea($new_value).'</textarea>';
                        break;

                      case 'select':
                        $options = $field['options'];
                        echo '<select  data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
                              foreach ( $options as $option => $val )
                              {
                                  printf('<option value="%s" %s>%s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                              }
                        echo '</select>';
                        break;
                      case 'colorpicker':
                        echo '<input data-default="'.esc_attr($default).'" class="educenter-color-picker" data-alpha="true" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
                        break;

                      case 'upload':
                        $image = $image_class= "";
                        if($new_value){
                          $image = '<img src="'.esc_url($new_value).'" style="max-width:100%;"/>';
                          $image_class = ' hidden';
                        }
                        echo '<div class="educenter-fields-wrap">';
                        echo '<div class="attachment-media-view">';
                        echo '<div class="placeholder'.esc_attr( $image_class ).'">';
                        esc_html_e('No image selected', 'educenter');
                        echo '</div>';
                        echo '<div class="thumbnail thumbnail-image">';
                        echo esc_attr( $image );
                        echo '</div>';
                        echo '<div class="actions sp-clearfix">';
                        echo '<button type="button" class="button educenter-delete-button align-left">'.esc_html__('Remove', 'educenter').'</button>';
                        echo '<button type="button" class="button educenter-upload-button alignright">'.esc_html__('Select Image', 'educenter').'</button>';
                        echo '<input data-default="'.esc_attr($default).'" class="upload-id" data-name="'.esc_attr( $key ).'" type="hidden" value="'.esc_attr($new_value).'"/>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        break;

                      case 'icon':
                        echo '<div class="educenter-selected-icon">';
                        echo '<i class="'.esc_attr($new_value).'"></i>';
                        echo '<span><i class="fa fa-angle-down"></i></span>';
                        echo '</div>';
                        echo '<ul class="educenter-icon-list sp-clearfix">';
                        $educenter_font_awesome_icon_array = educenter_font_awesome_icon_array();
                        foreach ($educenter_font_awesome_icon_array as $educenter_font_awesome_icon) {
                          $icon_class = $new_value == $educenter_font_awesome_icon ? 'icon-active' : '';
                          echo '<li class='.esc_attr( $icon_class ).'><i class="'.esc_attr( $educenter_font_awesome_icon ).'"></i></li>';
                        }
                        echo '</ul>';
                        echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
                        break;

                      default:
                        break;
                    }
                  ?>
                </div>
              <?php } ?>
              <div class="sp-clearfix educenter-repeater-footer">
                <div class="alignright">
                  <a class="educenter-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'educenter') ?></a> |
                  <a class="educenter-repeater-field-close" href="#close"><?php esc_html_e('Close', 'educenter') ?></a>
                </div>
              </div>
            </div>
          </li>
        <?php }
        }
      }
    }

    /**
     * Multiple Category Select Custom Control Function
    */
    class Educenter_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

       /**
        * The type of customize control being rendered.
        *
        * @since  1.0.0
        * @access public
        * @var    string
        */
       public $type = 'checkbox-multiple';

       /**
        * Displays the control content.
        *
        * @since  1.0.0
        * @access public
        * @return void
        */
       public function render_content() {

           if ( empty( $this->choices ) )
               return; ?>
             
           <?php if ( !empty( $this->label ) ) : ?>
               <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
           <?php endif; ?>

           <?php if ( !empty( $this->description ) ) : ?>
               <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
           <?php endif; ?>

           <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>
           <ul>
               <?php foreach ( $this->choices as $value => $label ) : ?>
                   <li>
                       <label>
                           <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                           <?php echo esc_html( $label ); ?>
                       </label>
                   </li>
               <?php endforeach; ?>
           </ul>
           <input type="hidden" <?php esc_url( $this->link() ); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
       <?php }
    }

    /**
     * Info Test Custom Control Function
    */
    class Educenter_Customize_Control_Info_Text extends WP_Customize_Control{
        public function render_content(){ ?>
          <span class="customize-control-title">
          <?php echo esc_html( $this->label ); ?>
        </span>
        <?php if( $this->description ){ ?>
          <span class="description customize-control-description">
            <?php echo wp_kses_post( $this->description ); ?>
          </span>
        <?php }
        }
    }

    /**
     * Multiple Gallery Image Upload Custom Control Function
    */
    class Educenter_Display_Gallery_Control extends WP_Customize_Control{
        public $type = 'gallery';         
        public function render_content() { ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                <?php echo wp_kses_post( $this->description ); ?>
                </span>
            <?php } ?>

            <div class="gallery-screenshot sp-clearfix">
              <?php
                  {
                  $ids = explode( ',', $this->value() );
                      foreach ( $ids as $attachment_id ) {
                          $img = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
                          if(!$img) continue;
                          echo '<div class="screen-thumb"><img src="' . esc_url( $img[0] ) . '" /></div>';
                      }
                  }
              ?>
            </div>

            <input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Add/Edit Gallery','educenter') ?>" />
            <input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Clear','educenter') ?>" />
            <input type="hidden" class="gallery_values" <?php echo esc_url( $this->link() ); ?> value="<?php echo esc_attr( $this->value() ); ?>">
        </label>
        <?php }
    }

    /**
     * Section Re-order
    */
    class Educenter_Section_Re_Order extends WP_Customize_Control {
      
      public $type = 'dragndrop';
        /**
         * Render the content of the category dropdown
         *
         * @return HTML
         */
        public function render_content() {

        if ( empty( $this->choices ) ){
          return;
        }
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

              <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <ul class="controls" id ="tm-sections-reorder">
          <?php
              $default_short_array = array();
              foreach ( $this->choices as $value => $label ) {

                  $default_short_array[$value] = $label;

              }

              $order_save_value = get_theme_mod( $this->id );
              
          if( !empty( $order_save_value ) ) {

            $order_save_array = explode( ',' , $order_save_value);
            
            
            $order_save_array_pop = array_pop( $order_save_array );

            foreach ($order_save_array as $key => $value) {
              ?>
                <li class="tm-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $default_short_array[$value] ); ?></li>
              <?php 

            }
            $section_order_list = $order_save_value;

          } else {
          $order_array = array();
          foreach ( $this->choices as $value => $label ) {
            $order_array[] = $value;            
          ?>
            <li class="tm-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></li>
          <?php }
              $section_order_list = implode ( "," , $order_array );
            }
          ?>
          <input id="shortui-order" type="hidden" <?php $this->link(); ?> value="<?php echo wp_kses_post( $section_order_list ); ?>" />  
        </ul>        
        <?php
      }
    } 

}


/**
 * WooCommerce Section Start Here
*/
if ( ! function_exists( 'educenter_is_woocommerce_activated' ) ) {

    function educenter_is_woocommerce_activated() {

        if ( class_exists( 'WooCommerce' ) ) { return true; } else { return false; }

    }

}


/**
  * Convert hexdec color string to rgb(a) string 
*/
if ( ! function_exists( 'educenter_hex2rgba' ) ) {
    function educenter_hex2rgba($color, $opacity = false) { 
        $default = 'rgb(0,0,0)'; 
        if(empty($color))
            return $default;  
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }
        $rgb =  array_map('hexdec', $hex);
        if($opacity){
            if(abs($opacity) > 1)
            $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }
        return $output;
    }
}


if ( ! function_exists( 'educenter_fonts_url' ) ) :

  /**
   * Return fonts URL.
   *
   * @since 1.0.0
   * @return string Font URL.
   */
  function educenter_fonts_url() {

    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';

    /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== _x( 'on', 'Roboto+Condensed font: on or off', 'educenter' ) ) {
      $fonts[] = 'Roboto Condensed:300,300i,400,400i,700';
    }

    if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'educenter' ) ) {
      $fonts[] = 'Roboto:300,400,500,700';
    }

    if ( 'off' !== _x( 'on', 'Lato font: on or off', 'educenter' ) ) {
      $fonts[] = 'Lato:300,400,500,700';
    }


    if ( $fonts ) {
      $fonts_url = add_query_arg( array(
        'family' => urlencode( implode( '|', $fonts ) ),
        'subset' => urlencode( $subsets ),
      ), 'https://fonts.googleapis.com/css' );
    }

    return $fonts_url;
  }

endif;



/**
 * Schema type
*/
function educenter_html_tag_schema() {

    $schema     = 'http://schema.org/';
    
    $type       = 'WebPage';
    // Is single post
    if ( is_singular( 'post' ) ) {
        $type   = 'Article';
    }
    // Is author page
    elseif ( is_author() ) {
        $type   = 'ProfilePage';
    }
    // Is search results page
    elseif ( is_search() ) {
        $type   = 'SearchResultsPage';
    }
    echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}


/**
 * Page and Post Page Display Layout Metabox function
*/
add_action('add_meta_boxes', 'educenter_metabox_section');
if ( ! function_exists( 'educenter_metabox_section' ) ) {
    function educenter_metabox_section(){   
        add_meta_box('educenter_display_layout', 
            esc_html__( 'Display Layout Options', 'educenter' ), 
            'educenter_display_layout_callback', 
            array('page','post'), 
            'normal', 
            'high'
        );
    }
}

$educenter_page_layouts =array(
    'leftsidebar' => array(
        'value'     => 'leftsidebar',
        'label'     => esc_html__( 'Left Sidebar', 'educenter' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
    ),
    'rightsidebar' => array(
        'value'     => 'rightsidebar',
        'label'     => esc_html__( 'Right (Default)', 'educenter' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
    ),
     'nosidebar' => array(
        'value'     => 'nosidebar',
        'label'     => esc_html__( 'Full width', 'educenter' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
    )
);

/**
 * Function for Page layout meta box
*/
if ( ! function_exists( 'educenter_display_layout_callback' ) ) {
    function educenter_display_layout_callback(){
        global $post, $educenter_page_layouts;
        wp_nonce_field( basename( __FILE__ ), 'educenter_settings_nonce' ); ?>
        <table>
            <tr>
              <td>            
                <?php
                  $i = 0;  
                  foreach ($educenter_page_layouts as $field) {  
                  $educenter_page_metalayouts = esc_attr( get_post_meta( $post->ID, 'educenter_page_layouts', true ) ); 
                ?>            
                  <div class="radio-image-wrapper slidercat" id="slider-<?php echo intval( $i ); ?>">
                    <label class="description">
                        <span>
                          <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </span></br>
                        <input type="radio" name="educenter_page_layouts" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( esc_html( $field['value'] ), 
                            $educenter_page_metalayouts ); if(empty($educenter_page_metalayouts) && esc_html( $field['value'] ) =='rightsidebar'){ echo "checked='checked'";  } ?>/>
                         <?php echo esc_html( $field['label'] ); ?>
                    </label>
                  </div>
                <?php  $i++; }  ?>
              </td>
            </tr>            
        </table>
    <?php
    }
}

/**
 * Save the custom metabox data
*/
if ( ! function_exists( 'educenter_save_page_settings' ) ) {
    function educenter_save_page_settings( $post_id ) { 
        global $educenter_page_layouts, $post;
         if ( !isset( $_POST[ 'educenter_settings_nonce' ] ) || !wp_verify_nonce( sanitize_key( $_POST[ 'educenter_settings_nonce' ] ) , basename( __FILE__ ) ) ) 
            return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
            return;        
        if (isset( $_POST['post_type'] ) && 'page' == $_POST['post_type']) {  
            if (!current_user_can( 'edit_page', $post_id ) )  
                return $post_id;  
        } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
                return $post_id;  
        }  

        foreach ($educenter_page_layouts as $field) {  
            $old = esc_attr( get_post_meta( $post_id, 'educenter_page_layouts', true) );
            if ( isset( $_POST['educenter_page_layouts']) ) { 
                $new = sanitize_text_field( wp_unslash( $_POST['educenter_page_layouts'] ) );
            }
            if ($new && $new != $old) {  
                update_post_meta($post_id, 'educenter_page_layouts', $new);  
            } elseif ('' == $new && $old) {  
                delete_post_meta($post_id,'educenter_page_layouts', $old);  
            } 
         } 
    }
}
add_action('save_post', 'educenter_save_page_settings');

add_filter( 'body_class', function( $classes ) {
  $new_class = array();
  if( get_theme_mod( 'educenter_set_frontpage', false) ){
      $new_class[] = 'educenter-home-enable';
  }
  
  if( get_theme_mod( 'educenter_slider_options', 1 ) ){
    $slider_type = get_theme_mod('educenter_homepage_slider_type', 'default');
    $is_slider_active = false;
    if( $slider_type == 'default' ){
      $slider_items = get_theme_mod('educenter_banner_all_sliders');
      $banner_slider = json_decode( $slider_items );
      if(is_array($banner_slider) && $banner_slider[0]->slider_page ) $is_slider_active = true;
    }else{
      $slider_items = get_theme_mod('educenter_banner_normal_all_sliders');
      $banner_slider = json_decode( $slider_items );
      if( is_array($banner_slider) && $banner_slider[0]->slider_img ) $is_slider_active = true;
    }

    
    
    if( $is_slider_active ){
      $new_class[] = 'educenter-slider-enable';
    }else{
      $new_class[] = 'educenter-slider-disable';
    } 
  }else{
    $new_class[] = 'educenter-slider-disable';
  }
  return array_merge( $classes, $new_class );
} );