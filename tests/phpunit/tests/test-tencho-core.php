<?php

use mt8\Hello_Tencho\Tencho_Core;

class Tencho_Core_Test extends \WP_UnitTestCase {

	public function test_tencho_words() {

		$words = Tencho_Core::get_instance()->get_words();

		$this->assertNotEmpty( $words );

		$chosen_words = Tencho_Core::get_instance()->get_chosen_words();

		$this->assertNotEmpty( $chosen_words );

		$this->assertStringContainsString( $chosen_words, $words );

	}
}
