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

function hello_tencho_get_words() {
	/** These are the words to Hello Tencho */
	$words = "Hi Tencho, I'm Tencho and I'm always selling mangoes. 
	Do you like red mangoes? Or do you like green mangoes? 
	Mangoes can only be harvested in the summer. 
	I take good care of the mangoes I harvest. 
	Do not put the mangoes in the refrigerator right away. 
	The ripening process is very important for mangoes. 
	When they change color and smell sweet, it is a sign that they are fully ripe. 
	If you suddenly put them in the refrigerator, the ripening process will stop. 
	After eating a delicious mango, try planting the seeds. 
	Ah, mangoes. Ah, mangoes.";

	// Here we split it into lines.
	$words = explode( "\n", $words );

	// And then randomly choose a line.
	return wptexturize( $words[ mt_rand( 0, count( $words ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_tencho() {
	$chosen = hello_tencho_get_words();
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

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_tencho' );

// We need some CSS to position the paragraph.
function tencho_css() {
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

add_action( 'admin_head', 'tencho_css' );
