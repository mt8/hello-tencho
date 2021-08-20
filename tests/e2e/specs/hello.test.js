import { visitAdminPage } from '@wordpress/e2e-test-utils';

describe( 'Hello Tencho', () => {
	it('Exists Tencho words on admin page', async () => {
		await visitAdminPage( '/' );
		const text = await page.$eval('#tencho', item => item.textContent);
		expect( text.length ).not.toEqual( 0 );
	});
} );
