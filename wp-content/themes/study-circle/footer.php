<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Study Circle
 */
?>
<div id="footer-wrapper">
    	<div class="container">             
               <?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>             
               <?php endif; // end footer widget area ?>    
                        
               <?php if ( ! dynamic_sidebar( 'footer-2' ) ) : ?>                                  	
               <?php endif; // end footer widget area ?>   
            
               <?php if ( ! dynamic_sidebar( 'footer-3' ) ) : ?>                
               <?php endif; // end footer widget area ?>  
              
               <?php if ( ! dynamic_sidebar( 'footer-4' ) ) : ?>                 
               <?php endif; // end footer widget area ?>    
                
            <div class="clear"></div>
          </div><!--end .container-->
        
        <div class="copyright-wrapper">
        	<div class="container">            	
                <div class="powerby">
				 <?php bloginfo('name'); ?> <?php esc_html_e('Theme by Grace Themes','study-circle'); ?>  
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div><!--#end pageholder-->
<?php wp_footer(); ?>
</body>
</html>