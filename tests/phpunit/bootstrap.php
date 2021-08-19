<?php

	if ( ! is_dir( __DIR__ .'/tmp' ) ) {
		die(
			'------------------------------' . PHP_EOL .
			' There is no test suite.' . PHP_EOL .
			' Please install test suite at first. ' . PHP_EOL .
			' run `sh tests/phpunit/install-wp-tests-for-wp-env.sh` on this plugin directly.' . PHP_EOL .
			'------------------------------' . PHP_EOL
		);
		exit;
	}

	define( 'WP_TESTS_CONFIG_FILE_PATH', __DIR__ . '/tmp/wp-tests-config.php' );
	require 'tmp/includes/functions.php';
	require 'tmp/includes/bootstrap.php';

	require dirname( dirname( dirname( __FILE__ ) ) ) . '/hello-tencho.php';
