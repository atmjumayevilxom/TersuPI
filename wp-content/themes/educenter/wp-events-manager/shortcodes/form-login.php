<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="thim-login">
    <h2 class="title"><?php esc_html_e( 'Login with your site account', 'educenter' ); ?></h2>
	<?php
	wp_login_form(
		array(
			'redirect'       => ! empty( $_REQUEST['redirect_to'] ) ? esc_url( $_REQUEST['redirect_to'] ) : apply_filters( 'educenter_default_login_redirect', home_url() ),
			'id_username'    => 'educenter_login',
			'id_password'    => 'educenter_pass',
			'label_username' => esc_html__( 'Username or email', 'educenter' ),
			'label_password' => esc_html__( 'Password', 'educenter' ),
			'label_remember' => esc_html__( 'Remember me', 'educenter' ),
			'label_log_in'   => esc_html__( 'Login', 'educenter' ),
		)
	);
	?>
	<?php echo '<p class="link-bottom">' . esc_html__( 'Not a member yet? ', 'educenter' ) . ' <a href="' . esc_url( educenter_get_register_url() ) . '">' . esc_html__( 'Register now', 'educenter' ) . '</a></p>'; ?>
</div>
