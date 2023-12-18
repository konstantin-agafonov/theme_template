<?php
/**
 * Outputs attributes array as HTML.
 * The same as `echo get_attrs()`.
 *
 * @param array $attrs
 *
 * @return void
 */
function the_attrs( array $attrs ) {
	echo get_attrs( $attrs );
}

/**
 * Returns attributes array as HTML.
 *
 * @param array $attrs
 *
 * @return string
 */
function get_attrs( array $attrs ): string {
	$html = '';

	foreach ( $attrs as $key => $value ) {
		if ( ! $key ) {
			continue;
		}

		$html .= ' ' . esc_attr( $key );

		if ( $value ) {
			$html .= sprintf( '="%s"', esc_attr( $value ) );
		}
	}

	return $html;
}
