<?php

$_upcomming_events = $GLOBALS['educenter_upcoming_events'];
extract($args);
?>

<div role="tabpanel" class="tab-pane fade<?php if ( $default_active_tab == 'upcoming' ) {
	echo ' in active';
} ?>" id="tab-upcoming">

	<?php if ( $_upcomming_events->have_posts() ) { ?>

		<?php
		while ( $_upcomming_events->have_posts() ) :
			$_upcomming_events->the_post();
			?>

			<?php
			$time_format = get_option( 'time_format' );
			if ( class_exists( 'WPEMS' ) ) {
				$sorting[ get_the_ID() ] = strtotime( wpems_get_time() );
			} else {
				$sorting[ get_the_ID() ] = strtotime( tp_event_get_time() );
			}
			ob_start();
			?>

			<?php get_template_part( 'wp-events-manager/content', 'event' ); ?>

			<?php
			$html[ get_the_ID() ] = ob_get_contents();
			ob_end_clean();
			?>

		<?php endwhile; ?>

		<?php
		asort( $sorting );

		if ( ! empty( $sorting ) ) {
			$index = 1;
			foreach ( $sorting as $key => $value ) {
				if ( $html[ $key ] ) {
					echo ent2ncr( $html[ $key ] );
				}
				$index ++;
			}
		}
		?>

	<?php } ?>

	<?php wp_reset_postdata(); ?>

</div>