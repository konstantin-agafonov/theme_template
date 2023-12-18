<?php

function bi_escape_array( array $arr ) : string {
	global $wpdb;
	$escaped = [];
	foreach ($arr as $v) {
		if (is_numeric($v)) {
			$escaped[] = $wpdb->prepare('%d', $v);
		} else {
			$escaped[] = $wpdb->prepare('%s', $v);
		}
	}
	return implode(',', $escaped);
}
