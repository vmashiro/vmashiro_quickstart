<?php
/**
* Tracking
*/
if ( !function_exists('bi_header_tracking') ) {
	add_action('wp_head', 'bi_header_tracking');
	function bi_header_tracking() {
		if ( bi_option('tracking_header') ) {
			echo bi_option('tracking_header');
		}
	}
}

if ( !function_exists('bi_footer_tracking') ) {
	add_action('wp_footer', 'bi_footer_tracking');
	function bi_footer_tracking() {
		if ( bi_option('tracking_footer') ) {
			echo bi_option('tracking_footer');
		}
	}
}