<?php
/**
 * Study Circle About Theme
 *
 * @package Study Circle
 */

//about theme info
add_action( 'admin_menu', 'study_circle_abouttheme' );
function study_circle_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'study-circle'), __('About Theme Info', 'study-circle'), 'edit_theme_options', 'study_circle_guide', 'study_circle_mostrar_guide');   
} 

//Guidline for about theme
function study_circle_mostrar_guide() { 
?>

<div class="wrap-GT">
	<div class="gt-left">
   		   <div class="heading-gt"><h2><?php esc_html_e('About Theme Info', 'study-circle'); ?></h2></div>
          <p><?php esc_html_e('Study Circle is a free Education WordPress theme. It is perfect for school, college, tution classes, coaching classes, personal, bloging and any small business. It is user friendly customizer options and Compatible in WordPress Latest Version. also Compatible with WooCommerce, Nextgen gallery ,Contact Form 7 and many WordPress popular plugins. ','study-circle'); ?></p>
<div class="heading-gt"> <?php esc_html_e('Theme Features', 'study-circle'); ?></div>
 
<div class="col-2">
  <h4><?php esc_html_e('Theme Customizer', 'study-circle'); ?></h4>
  <div class="description"><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'study-circle'); ?></div>
</div>

<div class="col-2">
  <h4><?php esc_html_e('Responsive Ready', 'study-circle'); ?></h4>
  <div class="description"><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'study-circle'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('Cross Browser Compatible', 'study-circle'); ?></h4>
<div class="description"><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'study-circle'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('E-commerce', 'study-circle'); ?></h4>
<div class="description"><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'study-circle'); ?></div>
</div>

</div><!-- .gt-left -->
	
	<div><br />		
        <hr>
        <p><a href="https://gracethemes.com/documentation/studycircle-doc/#homepage-lite" target="_blank"><?php esc_html_e('Documentation', 'study-circle'); ?></a></p>	
        <hr />  

	</div>		
	</div><!-- .gt-right-->
    <div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>