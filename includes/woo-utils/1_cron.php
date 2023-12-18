<?php

add_filter( 'cron_schedules', 'bi_custom_cron_intervals' );
function bi_custom_cron_intervals( $schedules ) {
	$schedules['one_minute'] = [
		'interval' => 60,
		'display'  => esc_html__( 'Every minute' ),
	];
	$schedules['five_minutes'] = [
		'interval' => 5 * 60,
		'display'  => esc_html__( 'Every 5 minutes' ),
	];
	return $schedules;
}
