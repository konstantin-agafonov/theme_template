<?php
/**
 * Merges user defined arguments into defaults array.
 * TODO: support for object syntax.
 *
 * @param object|array|string $args Value to merge with $defaults.
 * @param array $defaults Optional. Array that serves as the defaults. Default empty array.
 *
 * @return array Merged user defined values with defaults.
 */
function bi_parse_args( object|array|string $args, array $defaults = array() ): array {
	// Fill all non-existing keys of primitive type with defaults.
	$args = wp_parse_args( $args, $defaults );

	foreach ( $defaults as $defaults_key => $defaults_value ) {

		// The type of this default parameter is either array or an array of arrays
		if ( ! is_array( $defaults_value ) ) {
			continue;
		}

		// If an array in defaults is empty...
		if ( empty( $defaults_value ) ) {

			// And a value in `$args` is falsy, assign empty array.
			if ( empty( $args[ $defaults_key ] ) ) {
				$args[ $defaults_key ] = [];
			}

			// Otherwise, leave the value in `$args` as it is and proceed to next default.
			continue;
		}

		// We know that `$defaults_value` is an array and is not empty.

		// If there is a falsy value in `$args` when there should be an associative array, assign defaults directly.
		// However, if there should be an array of arrays, just leave an empty array.
		if ( empty( $args[ $defaults_key ] ) ) {

			if ( bi_is_array_assoc( $defaults_value ) ) {
				$args[ $defaults_key ] = $defaults_value;
			} else {
				$args[ $defaults_key ] = [];
			}

			continue;
		}

		// If an array is associative, then it is a simple array of parameters.
		// Call this function recursively, in case `$defaults_value` has nested arrays.
		if ( bi_is_array_assoc( $defaults_value ) ) {

			// If the value specified still isn't an array, skip it.
			if ( ! is_array( $args[ $defaults_key ] ) ) {
				continue;
			}

			// If a respective value in `$args` array is not an associative array, throw an error.
			if ( ! bi_is_array_assoc( $args[ $defaults_key ] ) ) {
				throw new InvalidArgumentException(
					sprintf(
						"Expecting an associative array inside '%s' parameter, '%s' was given.",
						$defaults_key,
						gettype( $args[ $defaults_key ] ),
					),
				);
			}

			// If the value is an associative array and not a scalar value, pass it further.
			$args[ $defaults_key ] = bi_parse_args( $args[ $defaults_key ], $defaults_value );

			continue;
		}

		// We know that this default value is an array of arrays, based on the checks before.
		// Just need to make sure, that the same key in `$args` is also an array of arrays.
		// If a respective value in `$args` array is not an array of arrays, throw an error.
		// If an array of arrays in `$args` has no items, skip this step.
		if ( bi_is_array_assoc( $args[ $defaults_key ] ) ) {

			throw new InvalidArgumentException(
				sprintf(
					"Expecting an array of arrays inside '%s' parameter, '%s' was given.",
					$defaults_key,
					gettype( $args[ $defaults_key ] ),
				),
			);

		}

		// All checks are done, let's apply defaults to an array of arrays.
		// Iterate through every row inside `$args[ $defaults_key ]` and apply defaults.
		foreach ( $args[ $defaults_key ] as &$row ) {
			$row = bi_parse_args( $row, $defaults_value[0] );
		}
		// Unset `$row` because we used a pointer (`&`) in a loop
		unset( $row );

	}

	return $args;
}

/**
 * Checks if the given array is associative.
 *
 * @param array $array
 *
 * @return bool
 */
function bi_is_array_assoc( array $array ): bool {
	if ( count( $array ) === 0 ) {
		return false;
	}

	return array_key_first( $array ) !== 0;
}
