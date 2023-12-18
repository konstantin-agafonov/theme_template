<?php

add_action('wp_enqueue_scripts', 'bi_load_resources', 12);
function bi_load_resources() {
    $theme_styles_filemane =  '/_dist/css/style.min.css';
    $theme_styles_url = THEME_URL . $theme_styles_filemane;
    $theme_styles_path = THEME_DIR . $theme_styles_filemane;

    $theme_scripts_filename = '/_dist/js/app.min.js';
    $theme_scripts_url = THEME_URL . $theme_scripts_filename;
    $theme_scripts_path = THEME_DIR . $theme_scripts_filename;

	wp_enqueue_style( 'select2' );
    wp_enqueue_style(
        handle: 'bi',
        src: $theme_styles_url,
        ver: filemtime($theme_styles_path)
    );

    wp_enqueue_script(
        handle: 'bi',
        src: $theme_scripts_url,
	    deps: ['jquery','select2'],
        ver: filemtime($theme_scripts_path),
        args: [
			'in_footer' => true,
	    ],
    );

	wp_enqueue_script(
		handle: 'grecaptcha',
		src: 'https://www.google.com/recaptcha/api.js',
		deps: ['bi'],
		args: [
			'in_footer' => true,
		],
	);

	global $bi_current_user_has_purchased;
    $backend_data = [
		/* trailing slash */
		'siteUrl'               => SITE_URL,
		/* no trailing slash */
		'themeUrl'            => THEME_URL,
		'ajaxUrl'             => admin_url( 'admin-ajax.php' ),
		'nonces'              => [
			'product_filters'   => wp_create_nonce( 'product_filters' ),
			'minicart'          => wp_create_nonce( 'minicart' ),
			'myaccount_address' => wp_create_nonce( 'myaccount_address' ),
			'myaccount_order'   => wp_create_nonce( 'myaccount_order' ),
		],
		'authTimeout'           => SMSC_AUTH_TIMEOUT,
		'userID'                => BI_CURRENT_USER_ID,
		'googleCaptchaKey'      => BI_GOOGLE_CAPTCHA_KEY,
		'userProductRelTypes'   => BI_USER_PRODUCT_REL_TYPES,
	    'userHasPurchases'      => $bi_current_user_has_purchased ? '1' : '0',
	    'volumeSlug'            => BI_PRODUCT_ATTR_VOLUME_SLUG,
	    'colorSlug'             => BI_PRODUCT_ATTR_COLOR_SLUG,
	    'isShopPage'            => is_shop(),
	    'cityList'              => array_map( function( $city ) {
            return $city['name'];
        }, BI_CITY_LIST ),
	];

	$product_filters = ProductFilters::getInstance();
    if ( bi_is_product_filters_page() ) {
	    global $wp_query;
		$backend_data['productFiltersData'] = array_values( $product_filters->filters_data );
		$backend_data['globalTaxSlug']      = $product_filters->tax_slug;
	    $backend_data['globalTermSlug']     = $product_filters->term_slug;
	    $backend_data['numPages']           = $wp_query->max_num_pages;
	    $backend_data['total']              = $wp_query->found_posts;
    }

    wp_localize_script('bi','backendData', $backend_data );
}


/**
 * Enqueues tinyMCE styles
 */
add_action( 'after_setup_theme', 'bi_add_styles_to_tinymce' );
function bi_add_styles_to_tinymce() {
	add_theme_support( 'editor-styles' );
	add_editor_style( '_dist/css/style.min.css' );
	add_editor_style( '_dist/css/editor-style.min.css' );
}


/**
 * Enqueues block editor resources
 */
add_action( 'enqueue_block_editor_assets', 'bi_editor_resources' );
function bi_editor_resources() {
	wp_enqueue_script(
		handle: 'bi',
		src: THEME_URL . '/_dist/js/app.min.js',
		ver: filemtime( THEME_DIR . '/_dist/js/app.min.js' ),
		args: [
			'in_footer' => true,
		],
	);

	wp_enqueue_script(
		'bi-editor',
		THEME_URL . '/_dist/js/editor.min.js',
		ver: filemtime( THEME_DIR . '/_dist/js/editor.min.js' ),
		args: [
			'in_footer' => true,
		],
	);
}


/**
 * Register and enqueue a custom stylesheet and a script in the WordPress admin.
 */
add_action( 'admin_enqueue_scripts', 'bi_enqueue_custom_admin_resources' );
function bi_enqueue_custom_admin_resources() {
	wp_enqueue_style(
		handle: 'bi-admin',
		src: THEME_URL . '/_dist/css/admin.min.css',
		ver: filemtime( THEME_DIR . '/_dist/css/admin.min.css' )
	);

	wp_enqueue_script(
		handle: 'bi-admin',
		src: THEME_URL . '/_dist/js/admin.min.js',
		ver: filemtime( THEME_DIR . '/_dist/js/admin.min.js' ),
		args: [
			'in_footer' => true,
		],
	);
}
