<?php
use Behat\Behat\Context\Context;

class FeatureContext implements Context
{

	public $output = null;
	public $result_code = null;

    /**
     * @When I try `wp tencho hello`
     */
    public function iTryWpTenchoHello() {
		if ( '1' === getenv( 'IS_WP_ENV' ) ) {
			exec( escapeshellcmd( 'wp-env run cli tencho hello' ), $this->output, $this->result_code );
		} else {
			exec( 'wp tencho hello --path=/tmp/wordpress', $this->output, $this->result_code );
		}
    }

    /**
     * @Then the return code should be :arg1
     */
    public function theReturnCodeShouldBe( $arg1 ){
		if ( (int)$arg1 !== $this->result_code ) {
			throw new \Exception( "exit code expect {$arg1} but returned {$this->result_code}" );
		}
    }

    /**
     * @Then the output should not be empty
     */
    public function theOutputShouldNotBeEmpty()
    {
		if ( empty( $this->output ) ) {
			throw new \Exception( "output is empty" );
		}
    }

    /**
     * @Then the output contain in the tencho words
     */
    public function theOutputContainInTheTenchoWords()
    {
		require_once
			dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) )
			. '/vendor/autoload.php'
		;
		$out = str_replace( PHP_EOL, '', $this->output[0] );
		if ( false === strpos( \mt8\Hello_Tencho\Core::TENCHO_WORDS, $out ) ) {
			throw new \Exception( "output isn't exist in tencho words:  {$out}" );
		}
    }
}
