<?php

function bi_sanitize_array( array $arr ): array {
	$temp_arr = $arr;
	if ( empty( $temp_arr ) ) {
		return $temp_arr;
	}

	foreach ( $temp_arr as &$arr_elem ) {
		if ( is_array( $arr_elem ) ) {
			$arr_elem = bi_sanitize_array( $arr_elem );
		} else {
			if ( !is_bool( $arr_elem ) ) {
				$arr_elem = sanitize_text_field( $arr_elem );
			}
		}
	}
	unset( $arr_elem );

	return $temp_arr;
}
