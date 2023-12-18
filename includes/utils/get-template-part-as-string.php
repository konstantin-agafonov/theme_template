<?php
/**
 * Returns a template part output as a string.
 *
 * @param string      $slug The slug name for the generic template.
 * @param string|null $name The name of the specialised template.
 * @param array       $args Optional. Additional arguments passed to the template.
 *                     Default empty array.
 *
 * @return string Template part output
 */
function bi_get_template_part_as_string( string $slug, string $name = null, array $args = array() ): string {
	ob_start();

	get_template_part( $slug, $name, $args );

	return ob_get_clean();
}
