<?php
/**
 * Ajax function for fixing images
 *
 * @since Acme Fix Images 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('acme_fix_images_ajax_callback') ) :

    function acme_fix_images_ajax_callback() {
        global $wpdb;

        $action = $_POST["do"];
        $thumbnails = isset( $_POST['thumbnails'] )? $_POST['thumbnails'] : NULL;
        $featuredimgonly = isset( $_POST['featuredimgonly'] ) ? $_POST['featuredimgonly'] : 0;

        if ( $action == "getimglists" ) {

            if ($featuredimgonly) {
                /* Get all featured images */
                $featured_images = $wpdb->get_results( "SELECT meta_value,{$wpdb->posts}.post_title AS title FROM {$wpdb->postmeta}, {$wpdb->posts}
		                                        WHERE meta_key = '_thumbnail_id' AND {$wpdb->postmeta}.post_id={$wpdb->posts}.ID");

                foreach($featured_images as $image) {
                    $res[] = array('id' => $image->meta_value, 'title' => $image->title);
                }
            } else {
                $attachments = get_children( array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'numberposts' => -1,
                    'post_status' => null,
                    'post_parent' => null,
                    'output' => 'object',
                ) );
                foreach ( $attachments as $attachment ) {
                    $res[] = array('id' => $attachment->ID, 'title' => $attachment->post_title);
                }
            }

            die( json_encode($res) );
        } else if ($action == "regen") {
            $id = $_POST["id"];

            $fullsizepath = get_attached_file( $id );

            if ( FALSE !== $fullsizepath && @file_exists($fullsizepath) ) {
                set_time_limit( 150 );
                wp_update_attachment_metadata( $id, acme_fix_images_wp_generate_attachment_metadata( $id, $fullsizepath, $thumbnails ) );
                die( wp_get_attachment_thumb_url( $id ));
            }

            die('-1');
        }
    }

endif;

add_action('wp_ajax_acme_fix_images', 'acme_fix_images_ajax_callback');