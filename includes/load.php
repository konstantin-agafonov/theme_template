<?php

foreach(glob(THEME_DIR . '/includes/theme/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/utils/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/utils/taxonomies/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/geo/*.php') as $file){
	require_once $file;
}

foreach(glob(THEME_DIR . '/includes/ajax/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/user-product-relation/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/auth/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/woo-utils/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/woo-utils/menu/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/product-filters/*.php') as $file){
    require_once $file;
}

foreach(glob(THEME_DIR . '/includes/cart/*.php') as $file){
	require_once $file;
}
