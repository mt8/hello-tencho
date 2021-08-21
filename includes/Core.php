<?php

namespace mt8\Hello_Tencho;

/**
 * Tencho Core
 */
class Core {

	/**
	 * Tencho Words
	 */
	public const TENCHO_WORDS = 'Hi Tencho, I\'m Tencho and I\'m always selling mangoes.
Do you like red mangoes? Or do you like green mangoes?
Mangoes can only be harvested in the summer.
I take good care of the mangoes I harvest.
Do not put the mangoes in the refrigerator right away.
The ripening process is very important for mangoes.
When they change color and smell sweet, it is a sign that they are fully ripe.
If you suddenly put them in the refrigerator, the ripening process will stop.
After eating a delicious mango, try planting the seeds.
Ah, mangoes. Ah, mangoes.';

	private static $singleton;

	/**
	 * Get instance
	 *
	 * @return Core
	 */
	public static function get_instance() {
		if ( ! isset( self::$singleton ) ) {
			self::$singleton = new Core();
		}
		return self::$singleton;
	}

	/**
	 * Register action hooks
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'admin_head', [ $this, 'admin_head' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
	}

	/**
	 * Action for `admi_head`
	 *
	 * @return void
	 */
	public function admin_head() {
		$chosen = $this->get_chosen_words();
		printf(
			'<p id="tencho">%s</p>',
			$chosen
		);
	}

	/**
	 * Action for `admin_enqueue_scripts`
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'hello-tencho-style', plugins_url( '/assets/css/style.css', dirname( __FILE__ ) ) );
	}

	/**
	 * Get Tencho words
	 *
	 * @return string Tencho words.
	 */
	public function get_words() {
		return self::TENCHO_WORDS;
	}

	/**
	 * Get Tencho words
	 *
	 * @return string Chosen Tencho words.
	 */
	public function get_chosen_words() {
		$words = $this->get_words();
		// Here we split it into lines.
		$words = explode( "\n", $words );
		// And then randomly choose a line.
		return wptexturize( $words[ mt_rand( 0, count( $words ) - 1 ) ] );
	}

}
