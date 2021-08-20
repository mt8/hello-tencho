<?php
/**
 * @package Hello_Tencho
 * @version 1.0.0
 */
/*
Plugin Name: Hello Tencho
Plugin URI: https://github.com/mt8/hello-tencho/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words said most famously by Motohachi Tencho: Hello, Tencho. When activated you will randomly see a lyric from <cite>Hello, Tencho</cite> in the upper right of your admin screen on every page.
Author: mt8
Version: 1.0.0
Author URI: https://mt8.biz/
*/


require_once __DIR__ . '/vendor/autoload.php';

if ( class_exists( '\mt8\Hello_Tencho\Tencho_Core' ) ) {
	\mt8\Hello_Tencho\Tencho_Core::get_instance()->register_hooks();
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	\WP_CLI::add_command( 'tencho', \mt8\Hello_Tencho\Tencho_CLI::class );
}
