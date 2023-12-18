<?php
/**
 * Outputs a number of `data-*` HTML attributes based on array of values supplied.
 *
 * @param $values string[] Array of values
 */
function bi_the_data_attr( array $values ) {
	if ( empty( $values ) ) {
		return;
	}

	$values_transformed = [];

	foreach ( $values as $key => $value ) {
		$values_transformed[ 'data-' . bi_sanitize_attr_name( $key ) ] = $value;
	}

	echo get_attrs( $values_transformed );
}

/**
 * Sanitizes attribute name
 *
 * @param string $attr_name
 *
 * @return string
 */
function bi_sanitize_attr_name( string $attr_name ): string {
	$attr_name = preg_replace(
		[
			// 1. Delete non-word characters at the start and the end of the string
			'/^[^a-zA-Z0-9]+|[^a-zA-Z0-9]+$/',
			// 2. Replace non-word characters in the middle of the string by hyphens (`-`)
			'/[^a-zA-Z0-9]+/',
		],
		[
			// 1.
			'',
			// 2.
			'-',
		],
		$attr_name
	);

	return apply_filters( 'bi/sanitize_attr_name', $attr_name );
}
