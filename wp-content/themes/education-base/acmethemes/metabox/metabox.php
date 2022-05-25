<?php
/**
 * Custom Metabox
 * Only added icon not special data
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'education_base_meta_add_featured_icon' )):
    function education_base_meta_add_featured_icon() {
        add_meta_box(
            'education_base_meta_fields', // $id
            __( 'Featured Icon', 'education-base' ), // $title
            'education_base_meta_featured_icon_callback', // $callback
            'page', // $page
            'side', // $context
            'core'// $priority
        );
    }
endif;
add_action('add_meta_boxes', 'education_base_meta_add_featured_icon');

/**
 * Callback function for metabox
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('education_base_meta_featured_icon_callback') ) :
    function education_base_meta_featured_icon_callback(){
        global $post;
        $education_base_featured_icon = get_post_meta( $post->ID, 'education-base-featured-icon', true );
        wp_nonce_field( basename( __FILE__ ), 'education_base_meta_fields_nonce' );
       ?>
        <table class="form-table page-meta-box">
            <tr>
                <td>
                    <label class="description" for="education-base-featured-icon"><?php _e( 'Enter Featured Icon', 'education-base' ); ?></label>
                    <input class="widefat" id="education-base-featured-icon" type="text" name="education-base-featured-icon" value="<?php echo esc_attr( $education_base_featured_icon ); ?>" placeholder="fa-desktop"/>
                    <br />
                    <small>
                        <?php 
                        _e( 'Featured Icon Used in Widgets', 'education-base' );
                        printf( __( '%1$sRefer here%2$s for icon class. For example: %3$sfa-desktop%4$s', 'education-base' ), '<br /><a href="'.esc_url( 'http://fontawesome.io/cheatsheet/' ).'" target="_blank">','</a>',"<code>","</code>" );
                        ?>
                    </small>

                </td>
            </tr>
        </table>

    <?php }
endif;

/**
 * Save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('education_base_meta_save_featured_icon') ) :
    function education_base_meta_save_featured_icon( $post_id ) {

        /*
         * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
         *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
         * */
        if (
            !isset( $_POST[ 'education_base_meta_fields_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'education_base_meta_fields_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }
        //Execute this saving function
        if(isset($_POST['education-base-featured-icon'])){
            $new = sanitize_text_field( $_POST['education-base-featured-icon'] );
            update_post_meta( $post_id, 'education-base-featured-icon', $new );
        }
    }

endif;
add_action('save_post', 'education_base_meta_save_featured_icon');
