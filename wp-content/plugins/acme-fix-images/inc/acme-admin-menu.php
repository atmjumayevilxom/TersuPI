<?php
if ( ! class_exists( 'Acme_Fix_Images' ) ){
    /**
     * Class for Acme Fix Images Menu and Setting
     *
     * @package AcmeThemes
     * @subpackage Acme Fix Images
     * @since 1.0
     */
    class Acme_Fix_Images{
        /*Basic variables for class*/

        /**
         * Acme_Fix_Images instance.
         *
         * @see acme_get_instance()
         * @var object
         * @access protected
         * @since 1.0
         *
         */
        protected static $acme_instance = NULL;


        /**
         * Access Acme Fix Images working acme_instance
         *
         * @access public
         * @since 1.0.0
         * @return object of this class
         */
        public static function acme_get_instance() {
            NULL === self::$acme_instance and self::$acme_instance = new self;
            return self::$acme_instance;
        }

        /**
         * Used for regular plugin work.
         *
         * @access public
         * @since 1.0
         *
         * @return void
         *
         */
        public function acme_admin_menu_init() {

            /*Hook before any function of class start */
            do_action( 'acme_admin_menu_before');


            /*Adding menu page*/
            add_action( 'admin_menu', array($this,'acme_admin_submenu') ,12 );
            
            /*see more here https://codex.wordpress.org/Plugin_API/Filter_Reference/attachment_fields_to_edit*/
            add_filter( 'attachment_fields_to_edit', array(&$this, 'fix_image_single'), 10, 2 );
            
            /*Hook before any function of class end */
            do_action( 'acme_admin_menu_after');
        }

        /**
         * Constructor. Intentionally left empty and public.
         *
         * @access public
         * @since 1.0.0
         *
         */
        public function __construct(){ }

        /**
         * Add submenu in general options
         *
         * @access public
         * @since 1.0.0
         *
         * @return void
         *
         */
        
        public function acme_admin_submenu() {
            add_submenu_page(
                "themes.php",
                __('Acme Fix Images','acme-fix-images'),
                __('Acme Fix Images','acme-fix-images'),
                'manage_options',
                'acme-fix-images-setting',
                array($this, 'acme_submenu_page' )
            );
            /*add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );*/
        }

        /**
         * Add  button to the media page
         *
         * @param array $fields
         * @param object $post
         * @return array
         */
        function fix_image_single($fields, $post) {
            $thumbnails = array();
            foreach ( acme_fix_images_get_image_sizes() as $s )
                $thumbnails[] = 'thumbnails[]='.$s['name'];
            $thumbnails = '&'.implode('&', $thumbnails);
            ob_start();
            ?>
            <script>
                function setMessage(msg) {
                    jQuery("#update-msg").html(msg);
                    jQuery("#update-msg").show();
                }

                function regenerate() {
                    jQuery("#acme_fix_images").prop("disabled", true);
                    setMessage("<?php _e('Reading attachments...', 'acme-fix-images') ?>");
                    thumbnails = '<?php echo $thumbnails ?>';
                    jQuery.ajax({
                        url: "<?php echo admin_url('admin-ajax.php'); ?>",
                        type: "POST",
                        data: "action=acme_fix_images&do=regen&id=<?php echo $post->ID ?>" + thumbnails,
                        success: function(result) {
                            if (result != '-1') {
                                setMessage("<?php _e('Done.', 'acme-fix-images') ?>");
                            }
                        },
                        error: function(request, status, error) {
                            setMessage("<?php _e('Error', 'acme-fix-images') ?>" + request.status);
                        },
                        complete: function() {
                            jQuery("#acme_fix_images").prop("disabled", false);
                        }
                    });
                }
            </script>
            <input type='button' onclick='javascript:regenerate();' class='button' name='acme_fix_images' id='acme_fix_images' value='Fix Images'>
            <span id="update-msg" class="updated fade" style="clear:both;display:none;line-height:28px;padding-left:10px;"></span>
            <?php
            $html = ob_get_clean();
            $fields["acme-fix-images"] = array(
                "label"	=> __('Fix Images', 'acme-fix-images'),
                "input"	=> "html",
                "html"	=> $html
            );
            return $fields;
        }
        /**
         * Add form fields in Acme Fix Images Menu
         *
         * @access public
         * @since 1.0
         *
         * @return void
         *
         */
        public function acme_submenu_page() {
            ?>
            <!--form value-->
            <div id="message" class="updated fade" style="display:none"></div>
            <script type="text/javascript">
                // <![CDATA[

                function setMessage(msg) {
                    jQuery("#message").html(msg);
                    jQuery("#message").show();
                }

                function regenerate() {
                    jQuery("#acme_fix_images").prop("disabled", true);
                    setMessage("<p><?php _e('Reading attachments...', 'acme-fix-images') ?></p>");

                    inputs = jQuery( 'input:checked' );
                    var thumbnails= '';
                    if( inputs.length != jQuery( 'input[type=checkbox]' ).length ){
                        inputs.each( function(){
                            thumbnails += '&thumbnails[]='+jQuery(this).val();
                        } );
                    }

                    var featuredimgonly = jQuery("#featuredimgonly").prop('checked') ? 1 : 0;

                    jQuery.ajax({
                        url: "<?php echo admin_url('admin-ajax.php'); ?>",
                        type: "POST",
                        data: "action=acme_fix_images&do=getimglists&featuredimgonly="+featuredimgonly,
                        success: function(result) {
                            var list = eval(result);
                            var curr = 0;

                            if (!list) {
                                setMessage("<?php _e('No attachments found.', 'acme-fix-images')?>");
                                jQuery("#acme_fix_images").prop("disabled", false);
                                return;
                            }

                            function regenItem() {
                                if (curr >= list.length) {
                                    jQuery("#acme_fix_images").prop("disabled", false);
                                    setMessage("<?php _e('Done.', 'acme-fix-images') ?>");
                                    jQuery("#last-image").html("<?php _e('Completed', 'acme-fix-images')?>");
                                    return;
                                }
                                setMessage(<?php printf( __('"Fixing " + %s + " of " + %s + " (" + %s + ")..."', 'acme-fix-images'), "(curr+1)", "list.length", "list[curr].title"); ?>);

                                jQuery.ajax({
                                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                                    type: "POST",
                                    data: "action=acme_fix_images&do=regen&id=" + list[curr].id + thumbnails,
                                    success: function(result) {
                                        curr = curr + 1;
                                        if (result != '-1') {
                                            jQuery(".thumb").show();
                                            jQuery("#thumb-img").attr("src",result);
                                        }
                                        regenItem();
                                    }
                                });
                            }

                            regenItem();
                        },
                        error: function(request, status, error) {
                            setMessage("<?php _e('Error', 'acme-fix-images') ?>" + request.status);
                        }
                    });
                }

                jQuery(document).ready(function() {
                    jQuery('#size-toggle').click(function() {
                        jQuery("#sizeselect").find("input[type=checkbox]").each(function() {
                            jQuery(this).prop("checked", !jQuery(this).prop("checked"));
                        });
                    });
                });

                // ]]>
            </script>

            <form method="post" action="" style="width: 100%">
                <h2><?php _e('Select which thumbnails you want to fix', 'acme-fix-images'); ?>:</h2>
                <a href="javascript:void(0);" id="size-toggle"><?php _e('Toggle all', 'acme-fix-images'); ?></a>
                <div id="sizeselect">
                    <?php
                    foreach ( acme_fix_images_get_image_sizes() as $s ):
                        ?>

                        <label>
                            <input type="checkbox" name="thumbnails[]" id="sizeselect" checked="checked" value="<?php echo $s['name'] ?>" />
                            <em><?php echo $s['name'] ?></em>
                            &nbsp;(<?php echo $s['width'] ?>x<?php echo $s['height'] ?>
                            <?php if ($s['crop']) _e('cropped', 'acme-fix-images'); ?>)
                        </label>
                        <br/>
                    <?php endforeach;?>
                </div>
                <p>
                    <label>
                        <input type="checkbox" id="featuredimgonly" name="featuredimgonly" />
                        <?php _e('Only fix featured images', 'acme-fix-images'); ?>
                    </label>
                </p>

                <p>
                    <?php
                    _e("Note: If you've changed the dimensions of your thumbnails, existing thumbnail images will not be deleted.",
                        'acme-fix-images'); ?>
                </p>
                <input type="button" onClick="javascript:regenerate();" class="button" name="acme_fix_images" id="acme_fix_images" value="<?php _e( 'Fix All Images', 'acme-fix-images' ) ?>" />
                <br />
            </form>

            <div class="thumb" style="display:none;"><h4 id="last-image"><?php _e('Processing', 'acme-fix-images'); ?>...</h4><img id="thumb-img" /></div>
            

            <?php
        }
        
    } /*END class Acme_Fix_Images*/

    /*Initialize class after init*/
    add_action( 'init', array ( Acme_Fix_Images::acme_get_instance(), 'acme_admin_menu_init' ));

}/*END if(!class_exists('Acme_Fix_Images'))*/