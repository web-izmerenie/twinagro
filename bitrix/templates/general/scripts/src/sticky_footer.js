/**
 * Sticky footer
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery', 'get_height_sum', 'webkit_bug_fix_wrapper'],
function ($, getHeightSum, webkitBugFixWrapper) {

	$(function domReady() {

		var $html = $('html');
		var $window = $(window);

		function stickyFooter() {
			var heightSum = getHeightSum();

			if (heightSum < $window.height()) {
				$html.addClass('sticky_footer');
			} else {
				$html.removeClass('sticky_footer');
			}
		}

		$window.on('scroll resize', stickyFooter);
		webkitBugFixWrapper(stickyFooter);

	}); // domReady()

}); // define()

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
