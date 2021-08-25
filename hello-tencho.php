<?php
/*
Plugin Name:       Hello Tencho
Plugin URI:        https://github.com/mt8/hello-tencho/
Description:       This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words said most famously by Motohachi Tencho: Hello, Tencho. When activated you will randomly see a word from <cite>Hello, Tencho</cite> in the upper right of your admin screen on every page.
Author:            mt8
Author URI:        https://mt8.biz/
Version:           1.0.0
Requires at least: 5.8
Requires PHP:      7.4
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:       hello-tencho
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_file( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	require_once __DIR__ . '/includes/Core.php';
	require_once __DIR__ . '/includes/WP_CLI.php';
}

if ( class_exists( '\mt8\Hello_Tencho\Core' ) ) {
	\mt8\Hello_Tencho\Core::get_instance()->register_hooks();
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	if ( class_exists( '\mt8\Hello_Tencho\WP_CLI' ) ) {
		\WP_CLI::add_command( 'tencho', \mt8\Hello_Tencho\WP_CLI::class );
	}
}
