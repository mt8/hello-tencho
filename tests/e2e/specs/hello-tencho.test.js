import { visitAdminPage,createURL } from '@wordpress/e2e-test-utils';

describe( 'Hello Tencho', () => {

	it('Exists Tencho words on admin page', async () => {
		await visitAdminPage( '/' );
		const adminText = await page.$eval('#tencho', item => item.textContent);
		expect( adminText.length ).not.toEqual( 0 );
	});

	it('Not exists Tencho words on front page', async () => {
		await page.goto(createURL('/'));
		let frontText = await page.evaluate(() => {
			let el = document.querySelector("#tencho");
			return el ? el.innerText : "";
		})
		expect( frontText.length ).toEqual( 0 );
	});

} );
