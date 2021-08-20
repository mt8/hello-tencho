<?php

namespace mt8\Hello_Tencho;

/**
 * Tencho Core
 */
class Core {

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
		add_action( 'admin_notices', [ $this, 'admin_notices' ] );
	}

	/**
	 * Action for `admi_head`
	 *
	 * @return void
	 */
	public function admin_head() {
		$chosen = $this->get_chosen_words();
		$lang   = '';
		if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
			$lang = ' lang="en"';
		}
		printf(
			'<p id="tencho"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
			__( 'Quote from Hello Tencho wards, by Motohachi:', 'hello-tencho' ),
			$lang,
			$chosen
		);
	}

	/**
	 * Action for `admin_notices`
	 *
	 * @return void
	 */
	public function admin_notices() {
		echo "
		<style type='text/css'>
		#tencho {
			float: right;
			padding: 5px 10px;
			margin: 0;
			font-size: 12px;
			line-height: 1.6666;
		}
		.rtl #tencho {
			float: left;
		}
		.block-editor-page #tencho {
			display: none;
		}
		@media screen and (max-width: 782px) {
			#tencho,
			.rtl #tencho {
				float: none;
				padding-left: 0;
				padding-right: 0;
			}
		}
		</style>
		";
	}

	/**
	 * Get Tencho words
	 *
	 * @return string Tencho words.
	 */
	public function get_words() {
		return "Hi Tencho, I'm Tencho and I'm always selling mangoes.
Do you like red mangoes? Or do you like green mangoes?
Mangoes can only be harvested in the summer.
I take good care of the mangoes I harvest.
Do not put the mangoes in the refrigerator right away.
The ripening process is very important for mangoes.
When they change color and smell sweet, it is a sign that they are fully ripe.
If you suddenly put them in the refrigerator, the ripening process will stop.
After eating a delicious mango, try planting the seeds.
Ah, mangoes. Ah, mangoes.";

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
