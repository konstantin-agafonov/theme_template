<?php

//Disable emojis in WordPress
add_action( 'init', 'bi_disable_emojis' );

function bi_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/**
 * Callback function that returns true if the current page is a WooCommerce page or false if otherwise.
 *
 * @return boolean true for WC pages and false for non WC pages
 */
function bi_is_wc_page() {
    return class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
}

add_action( 'template_redirect', 'bi_remove_wc_assets' );
function bi_remove_wc_assets() {
    // remove WC generator tag
    remove_filter( 'get_the_generator_html', 'wc_generator_tag', 10, 2 );
    remove_filter( 'get_the_generator_xhtml', 'wc_generator_tag', 10, 2 );

    // unload WC scripts
    //remove_action( 'wp_enqueue_scripts', [ WC_Frontend_Scripts::class, 'load_scripts' ] );
    //remove_action( 'wp_print_scripts', [ WC_Frontend_Scripts::class, 'localize_printed_scripts' ], 5 );
    //remove_action( 'wp_print_footer_scripts', [ WC_Frontend_Scripts::class, 'localize_printed_scripts' ], 5 );

    // remove "Show the gallery if JS is disabled"
    remove_action( 'wp_head', 'wc_gallery_noscript' );
}

add_filter( 'woocommerce_enqueue_styles', 'bi_woocommerce_enqueue_styles' );
function bi_woocommerce_enqueue_styles( $enqueue_styles ) {
    return array();
}

add_action( 'wp_enqueue_scripts', 'bi_wp_enqueue_scripts' );
function bi_wp_enqueue_scripts() {
    wp_dequeue_style( 'woocommerce-inline' );
}

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

remove_action( 'wp_head', 'wp_generator' );

add_action( 'wp_enqueue_scripts', 'bi_unplug_woocommerce_resources', 9999 ) ;
function bi_unplug_woocommerce_resources() {
    wp_deregister_style( 'wc-blocks-vendors-style' );
    wp_dequeue_script( 'wc-add-to-cart' );
}
