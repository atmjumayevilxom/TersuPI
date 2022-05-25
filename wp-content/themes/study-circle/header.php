<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Study Circle
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	}
?>
<a class="skip-link screen-reader-text" href="#page_content">
<?php esc_html_e( 'Skip to content', 'study-circle' ); ?>
</a>
<?php
$study_circle_disabled_slides 	  	= esc_attr( get_theme_mod('study_circle_disabled_slides', false) );
?>
<div id="pageholder">
<div class="header <?php if( !is_front_page() && !is_home() ){ ?>headerinner<?php } ?>">
        <div class="container">
            <div class="logo">
            			<?php study_circle_the_custom_logo(); ?>
                        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php $description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<span><?php echo esc_html($description); ?></span>
					<?php endif; ?> 
            </div><!-- logo -->
             <div class="hdrright">
             <div class="toggle">
                <a class="toggleMenu" href="#"><?php esc_html_e('Menu','study-circle'); ?></a>
             </div><!-- toggle --> 
            
            <div class="sitenav">
                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
            </div><!-- site-nav -->
            </div>
            <div class="clear"></div>
            
        </div><!-- container -->
  </div><!--.header -->

<?php 
if ( is_front_page() && !is_home() ) {
if($study_circle_disabled_slides != '') {
	for($i=7; $i<=10; $i++) {
	  if( get_theme_mod('study_circle_page-setting'.$i,false)) {
		$slider_Arr[] = absint( get_theme_mod('study_circle_page-setting'.$i,true));
	  }
	}
?> 
<div class="slider-wrapper">                
<?php if(!empty($slider_Arr)){ ?>
<div id="slider" class="nivoSlider">
<?php 
$i=1;
$slidequery = new WP_Query( array( 'post_type' => 'page', 'post__in' => $slider_Arr, 'orderby' => 'post__in' ) );
while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
?>
<?php if(!empty($image)){ ?>
<img src="<?php echo esc_url( $image ); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php }else{ ?>
<img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider-default.jpg" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php } ?>
<?php $i++; endwhile; ?>
</div> 
 
<?php 
$j=1;
$slidequery->rewind_posts();
while( $slidequery->have_posts() ) : $slidequery->the_post(); ?> 
<div id="slidecaption<?php echo esc_attr( $j ); ?>" class="nivo-html-caption">
    <div class="slide_info">
    	<h2><?php the_title(); ?></h2>
        <?php the_excerpt(); ?>
        <a class="slide_more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'study-circle');?></a>
    </div>
</div>      
<?php $j++; 
endwhile;
wp_reset_postdata(); ?>        
     </div><!--end .slider area-->
<div class="clear"></div>        
<?php } ?>
<?php } } ?> 
       
        
<?php if ( is_front_page() && ! is_home() ) { ?>

<?php
$hide_whychooseus = get_theme_mod('study_circle_disabled_whychooseus', '1');
if( $hide_whychooseus == ''){
if( get_theme_mod('study_circle_why-page1')) {
?> 
<section id="Appwrap">
		<div class="container">
		   <div class="appointmentwrap"> 
				<?php 
				$queryvar = new WP_query('page_id='.absint(get_theme_mod('study_circle_why-page1' ,true)));
                while( $queryvar->have_posts() ) : $queryvar->the_post();
				?> 
                <h3><?php the_title(); ?></h3> 
               <?php the_excerpt(); ?> 
                <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','study-circle'); ?></a> 
                <?php 
				endwhile;
				wp_reset_postdata(); 
				?> 
	  	 </div> 
	  <div class="clear"></div>
	</div><!-- container -->
</section>
<?php } } ?>


<?php
$hide_pageboxes = get_theme_mod('study_circle_disabled_pgboxes', '1');
if( $hide_pageboxes == ''){
?>  
<section id="wrapsecond">
<div class="container">
    <div class="services-wrap">                       
        <?php for($p=1; $p<4; $p++) { ?>       
        <?php if( get_theme_mod('study_circle_page-column'.$p,false)) { ?>          
            <?php $queryvar = new WP_query('page_id='.absint(get_theme_mod('study_circle_page-column'.$p,true))); ?>				
                    <?php while( $queryvar->have_posts() ) : $queryvar->the_post(); ?> 
                    <div class="fourbox <?php if($p % 3 == 0) { echo "last_column"; } ?>">                                    
						<?php if(has_post_thumbnail() ) { ?>
                        <div class="thumbbx"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a></div>
                        <?php } ?>
                        <div class="pagecontent">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>                                    
                           <?php the_excerpt(); ?> 
                            <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','study-circle'); ?></a> 
                        </div>                                   
                    </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                    
        <?php } } ?>  
    <div class="clear"></div>  
</div><!-- services-wrap-->
<div class="clear"></div>
</div><!-- container -->
</section> 
<?php } ?>       
<?php }?>