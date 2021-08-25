<?php

namespace mt8\Hello_Tencho;

/**
 * Tencho CLI
 */
class WP_CLI extends \WP_CLI_Command {

	public function hello() {
		$cli = \WP_CLI::class;
		$cli::line( Core::get_instance()->get_chosen_words() );
	}

}
