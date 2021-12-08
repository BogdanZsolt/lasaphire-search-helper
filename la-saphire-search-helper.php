<?php

/**
 * Plugin Name: La Saphire Search Helper
 * Plugin URI: https://www.zsoltbogdan.hu/
 * Author: Shiru
 * Author URI: https://www.zsoltbogdan.hu
 * version: 1.0.0
 * Text Domain: lsq
 * Description: La Saphire Plugin for find best beauty.
*/

if ( !defined( 'ABSPATH' ) ){
	exit(); // No direct access allowed
}

/**
 * define plugin constants
*/
define( 'LSQ_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'LSQ_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );

function search_helper_plugin_init(){
	if( class_exists( 'WooCommerce' ) ) {

		/**
			* Include admin.php
		*/
		if ( is_admin() ){
			require_once LSQ_PATH . '/admin/admin.php';
		}

		/**
			* Include public.php
		*/
		if ( !is_admin() ){
			require_once LSQ_PATH . '/public/public.php';
		}

		/**
			* Include Post Types
		*/
		require_once LSQ_PATH . '/inc/post-types/quiz.php';

		/**
			* Include Meta
		*/
		require_once LSQ_PATH . '/inc/meta/quiz-meta.php';

		/**
			* Include Data Table
		*/
		require_once LSQ_PATH . '/inc/data-tables/quiz-data-table.php';

		/**
			* Include Shortcodes
		*/
		require_once LSQ_PATH . '/inc/shortcodes/shortcodes.php';

	}
}
add_action( 'plugins_loaded', 'search_helper_plugin_init' );
