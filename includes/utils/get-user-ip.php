<?php

/**
 * Get remote user ip
 *
 * @return string
 */
function bi_get_user_ip(): string {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		//check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		//to check ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$ip = explode( ',', $ip );
	if ( is_array( $ip ) ) {
		return $ip[0];
	}
	return '';
}
