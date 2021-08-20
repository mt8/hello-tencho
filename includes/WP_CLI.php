<?php

namespace mt8\Hello_Tencho;

/**
 * Tencho Core
 */
class Tencho_CLI extends \WP_CLI_Command {

	public function hello() {

		\WP_CLI::line( Core::get_instance()->get_chosen_words() );

	}

}
