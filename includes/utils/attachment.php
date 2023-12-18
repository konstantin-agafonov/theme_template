<?php
/**
 * Various helper functions for working with ACF image fields' return values.
 */

/**
 * Get the URL of the image from ACF image field
 *
 * @param array|string|int $acf_field
 *
 * @return string
 */
function bi_get_acf_field_image_url( array|string|int $acf_field ): string {
	if ( is_array( $acf_field ) ) {
		// The field returns an array. Grab the field with ID out of it.
		return $acf_field['url'];
	} elseif ( is_string( $acf_field ) ) {
		// The field returns a URL to the image, simply return that.
		return $acf_field;
	} elseif ( is_int( $acf_field ) ) {
		// The field returns an ID of the image, get the image URL.
		return wp_get_attachment_image_url( $acf_field );
	}

	return '';
}

/**
 * Get the alt of the image from ACF image field.
 * Getting attachment ID by it's URL is uncommon and tricky, so this is not implemented.
 *
 * @param array|string|int $acf_field
 *
 * @return string
 */
function bi_get_acf_field_image_alt( array|string|int $acf_field ): string {
	if ( is_array( $acf_field ) ) {
		return $acf_field['alt'];
	} elseif ( is_int( $acf_field ) ) {
		return bi_get_attachment_image_alt( $acf_field );
	}

	return '';
}

/**
 * Get the title of the image from ACF image field.
 * Getting attachment ID by it's URL is uncommon and tricky, so this is not implemented.
 *
 * @param array|string|int $acf_field
 *
 * @return string
 */
function bi_get_acf_field_image_title( array|string|int $acf_field ): string {
	if ( is_array( $acf_field ) ) {
		return $acf_field['title'];
	} elseif ( is_int( $acf_field ) ) {
		return bi_get_attachment_image_title( $acf_field );
	}

	return '';
}

/**
 * Get the URL of the image from ACF image field.
 * Getting attachment ID by it's URL is uncommon and tricky, so this is not implemented.
 *
 * @param array|string|int $acf_field
 *
 * @return string
 */
function bi_get_acf_field_image_id( array|string|int $acf_field ): string {
	if ( is_array( $acf_field ) ) {
		// The field returns an array. Take the field with ID out of it.
		return $acf_field['id'];
	} elseif ( is_int( $acf_field ) ) {
		// The field returns an ID of the image, return that as it is.
		return $acf_field;
	}

	return 0;
}

/**
 * Get alt text from attachment image by it's ID
 *
 * @param $attachment_id
 *
 * @return mixed
 */
function bi_get_attachment_image_alt( $attachment_id ): string {
	return get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ?: '';
}

/**
 * Get title text from attachment image by it's ID
 *
 * @param $attachment_id
 *
 * @return mixed
 */
function bi_get_attachment_image_title( $attachment_id ): string {
	$attachment = get_post( $attachment_id );

	if ( ! $attachment ) {
		return '';
	}

	if ( $attachment->post_type !== 'attachment' ) {
		return '';
	}

	return $attachment->post_title;
}

/**
 * Get image dimensions
 *
 * @param $attachment_id
 * @param $size
 *
 * @return array|false
 */
function bi_get_image_dimensions( int|string $attachment_id, string $size = 'full' ): bool|array {
	if ( ! wp_attachment_is_image( $attachment_id ) || ! is_numeric( $attachment_id ) ) {
		return false;
	}
	$image_url = wp_get_attachment_url( $attachment_id, $size );

	return wp_image_src_get_dimensions(
		$image_url,
		wp_get_attachment_metadata( $attachment_id )
	);
}

add_filter( 'jpeg_quality', function ( $quality ) {
	return 100;
} );