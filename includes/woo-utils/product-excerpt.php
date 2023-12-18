<?php

/*add_filter( 'the_excerpt', 'bi_product_excerpt', 10, 1 );
add_filter( 'get_the_excerpt', 'bi_product_excerpt', 10, 1 );

function bi_product_excerpt( string $post_excerpt ): string {
	if ( !bi_is_product_filters_page() ) {
		return $post_excerpt;
	}
	$exploded_excerpt = explode( '.', $post_excerpt );
	if ( count( $exploded_excerpt ) > 2 ) {
		// берём только первые два предложения
		return $exploded_excerpt[0] . '.' . $exploded_excerpt[1] . '.';
	}

	return $post_excerpt;
}*/

add_filter( 'excerpt_length', 'bi_excerpt_length' );
function bi_excerpt_length(): int {
	return 20;
}
