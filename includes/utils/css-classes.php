<?php
/**
 * Outputs a `class` HTML attribute based on array of CSS classes supplied.
 * Does the same as `echo get_class_attr()`.
 *
 * @param $classes string[] Array of CSS classes
 *
 * @return void
 */
function the_class_attr( array $classes ) {
	echo get_class_attr( $classes );
}

/**
 * Returns a `class` HTML attribute based on array of CSS classes supplied.
 *
 * @param array $classes
 *
 * @return string
 */
function get_class_attr( array $classes ): string {
	return sprintf( 'class="%s"', esc_attr( get_class_attr_value( $classes ) ) );
}

/**
 * Returns a `class` HTML attribute based on array of CSS classes supplied.
 *
 * @param array $classes
 *
 * @return string
 */
function get_class_attr_value( array $classes ): string {
	if ( empty( $classes ) ) {
		return '';
	}

	// Remove empty values
	$classes = array_filter( $classes );

	return implode( ' ', $classes );
}
