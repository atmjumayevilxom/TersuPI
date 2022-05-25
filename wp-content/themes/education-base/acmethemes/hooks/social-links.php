<?php
/**
 * Display Social Links
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('education_base_social_links') ) :

    function education_base_social_links( ) {

        global $education_base_customizer_all_values;
        ?>
        <ul class="socials init-animate">
            <?php
            if ( !empty( $education_base_customizer_all_values['education-base-facebook-url'] ) ) { ?>
                <li class="facebook">
                    <a href="<?php echo esc_url( $education_base_customizer_all_values['education-base-facebook-url'] ); ?>" title="<?php esc_attr_e( 'Facebook','education-base');?>"  target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
            <?php }
            if ( !empty( $education_base_customizer_all_values['education-base-twitter-url'] ) ) { ?>
                <li class="twitter">
                    <a href="<?php echo esc_url( $education_base_customizer_all_values['education-base-twitter-url'] ); ?>" title="<?php esc_attr_e( 'Twitter','education-base');?>" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
            <?php }
            if ( !empty( $education_base_customizer_all_values['education-base-youtube-url'] ) ) { ?>
                <li class="youtube">
                    <a href="<?php echo esc_url( $education_base_customizer_all_values['education-base-youtube-url'] ); ?>" title="<?php esc_attr_e( 'Youtube','education-base');?>" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>
            <?php }
            if ( !empty( $education_base_customizer_all_values['education-base-google-plus-url'] ) ) {
                ?>
                <li class="google-plus">
                    <a href="<?php echo esc_url( $education_base_customizer_all_values['education-base-google-plus-url'] ); ?>" title="<?php esc_attr_e( 'Google Plus','education-base');?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
endif;
add_filter( 'education_base_action_social_links', 'education_base_social_links', 10 );