<article id="tp_event-<?php the_ID(); ?>" <?php post_class( 'tp_single_event' ); ?>>

	<?php
	/**
	 * tp_event_before_loop_room_summary hook
	 *
	 * @hooked tp_event_show_room_sale_flash - 10
	 * @hooked tp_event_show_room_images - 20
	 */
	do_action( 'tp_event_before_single_event' );
	?>

	<div class="summary entry-summary">

		<?php
		/**
		 * tp_event_single_event_title hook
		 */
		do_action( 'tp_event_single_event_title' );

		/**
		 * tp_event_single_event_thumbnail hook
		 */
		echo '<div class="tp-event-top">';
		do_action( 'tp_event_single_event_thumbnail' );

		/**
		 * tp_event_loop_event_countdown
		 */
		do_action( 'tp_event_loop_event_countdown' );
		echo '</div>';
		?>
		<div class="tp-event-content">
			<?php
			/**
			 * tp_event_single_event_content hook
			 */
			do_action( 'tp_event_single_event_content' );

			$time_format = get_option( 'time_format' );
			$date_format = get_option( 'date_format' );
			$time_from   = get_post_meta( get_the_ID(), 'tp_event_date_start', true ) ? strtotime( get_post_meta( get_the_ID(), 'tp_event_date_start', true ) ) : time();
			$time_finish = get_post_meta( get_the_ID(), 'tp_event_date_end', true ) ? strtotime( get_post_meta( get_the_ID(), 'tp_event_date_end', true ) ) : time();
			$time_start  = wpems_event_start( $time_format );
			$time_end    = wpems_event_end( $time_format );

			$location = get_post_meta( get_the_ID(), 'tp_event_location', true ) ? get_post_meta( get_the_ID(), 'tp_event_location', true ) : '';
			?>
			<div class="tp-event-info">
				<div class="tp-info-box">
					<p class="heading">
						<i class="thim-color fa fa-clock-o"></i><?php esc_html_e( 'Start Time', 'educenter' ); ?>
					</p>

					<p><?php echo esc_html( $time_start ); ?></p>

					<p><?php echo date_i18n( $date_format, $time_from ); ?></p>
				</div>
				<div class="tp-info-box">
					<p class="heading">
						<i class="thim-color fa fa-flag"></i><?php esc_html_e( 'Finish Time', 'educenter' ); ?>
					</p>

					<p><?php echo esc_html( $time_end ); ?></p>

					<p><?php echo date_i18n( $date_format, $time_finish ); ?></p>
				</div>
				<?php if ( $location ) { ?>
					<div class="tp-info-box">
						<p class="heading">
							<i class="thim-color fas fa-map-marker"></i><?php esc_html_e( 'Address', 'educenter' ); ?>
						</p>

						<p><?php echo esc_html( $location ); ?></p>
						<?php
						/**
						 * tp_event_loop_event_location hook
						 */
						do_action( 'tp_event_loop_event_location' );
						?>
					</div>
				<?php } ?>
			</div>
		</div>

	</div><!-- .summary -->

	<?php
	/**
	 * hotel_booking_after_loop_room hook
	 *
	 * @hooked hotel_booking_output_room_data_tabs - 10
	 * @hooked hotel_booking_upsell_display - 15
	 * @hooked hotel_booking_output_related_products - 20
	 */
	do_action( 'tp_event_after_single_event' );
	?>

</article>
