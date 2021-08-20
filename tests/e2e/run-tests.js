const { execSync } = require( 'child_process' );

// Run the tests, passing additional arguments through to the test script.
execSync(
	'wp-scripts test-e2e --config tests/e2e/jest.config.js ' +
		process.argv.slice( 2 ).join( ' ' ),
	{ stdio: 'inherit' }
);
