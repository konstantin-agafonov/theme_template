<?php
foreach(glob(THEME_DIR . '/components/*/functions.php') as $file){
	require_once $file;
}