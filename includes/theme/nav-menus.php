<?php

add_action( 'after_setup_theme', 'bi_register_menus' );
function bi_register_menus() {
    $locations = [
        'bi_main_menu'      => 'Основное навигационное меню',
        'bi_footer_menu'    => 'Меню в футере',
    ];
    register_nav_menus( $locations );
}

function bi_get_menu_items( string $menu_location ): array {
	if ( ( $menu_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_location ] ) ) {
		$menu = get_term( $locations[ $menu_location ], 'nav_menu' );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );
		return $menu_items ?: [];
	}
	return [];
}

function bi_output_menu( string $menu_location ): void {
	$menu_items = bi_get_menu_items( $menu_location );
    ?>
		<?php foreach ( $menu_items as $item ): ?>
			<li>
				<a href="<?= esc_url( $item->url );?>">
					<?= esc_html( $item->title );?>
                </a>
			</li>
		<?php endforeach; ?>
	<?php
}
