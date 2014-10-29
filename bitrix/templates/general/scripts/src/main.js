/**
 * Twin Agro main module
 *
 * @author Fedor Pudeyan
 * @author Viacheslav Lotsmanov
 */

define(['basics/get_val', 'jquery'], function (getVal, $) {

	require.config({

		baseUrl: getVal('tplPath') + '/scripts',

		paths: {
			'threejs': 'libs_not_build/three.min'
		},

		map: {
			'*': {

				/* short name aliases */

				// outsource modules
				'jquery.mousewheel': 'libs/jquery.mousewheel',
				'jquery.formstyler': 'libs/jquery.formstyler',
				'modernizr': 'libs/modernizr-2.7.2',
				'box_panorama': 'libs/box_panorama',

				// basics aliases
				'dynamic_api': 'basics/dynamic_api',
				'get_local_text': 'basics/get_local_text',
				'get_val': 'basics/get_val',
				'load_img': 'basics/load_img',
				'modernizr.apng': 'basics/modernizr.apng'

			}
		},

		urlArgs: 'v=' + getVal('revision'),

		waitSeconds: getVal('requireTimeout')

	});

	require(['modernizr']);

	/** menu scroll to up by click on current page */
	$(function domReady() {

		var $page = $('html,body');

		$('.menu > span').click(function () {

			$page.animate({ scrollTop: 0 }, getVal('animationSpeed')*6);
			return false;

		});

	}); // domReady()

	// preload sub-pages sprite
	//$('<img/>').attr('src', tplDirPrefix + '/assets/sprite.png');
	// TODO to styles

	// for fixing opera bugs
	if (Object.prototype.toString.call(window.opera) == '[object Opera]') {
		$('html').addClass('ugly_opera');
	}

	require(['header']);

	require(['sticky_footer']);

	/** numbers for num-lists */
	$(function domReady() {

		$('body .page_content ol').each(function () {
			$(this).find('li').each(function (i) {
				$(this).addClass('ol_num_'+(i+1));
			});
		});

	}); // domReady()

	/** page-specific */

	/** cards on main */
	require(['pages/main']);

	/** /objects/ page */
	require(['pages/objects']);

	require(['pages/error_404']);

	require(['pages/contacts']);

	require(['pages/service_and_guaranty']);

	require(['pages/solutions']);

}); // define()

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
