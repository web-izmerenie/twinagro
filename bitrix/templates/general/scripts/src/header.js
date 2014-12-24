/**
 * Header
 *
 * @author Viacheslav Lotsmanov
 */

define(['get_val', 'jquery'], function (getVal, $) {
$(function domReady() {
var $document = $(document);
var $window = $(window);
$('body > header').each(function () {

	var $header = $(this);
	var $bitrix = $('#bitrix_panel');
	var main = ($('html').hasClass('page-main'));
	var v = 0;

	function fixedHorizontalScroll() {
		if (!main) $header.css('left', -($document.scrollLeft()) + 'px');
	}

	/** header support bitrix panel */
	function watchToBitrixPanel() {
		if ($bitrix.find('#bx-panel').hasClass('bx-panel-fixed')) {
			$header.css('top', $bitrix.height() + 'px');
		} else if (!main) {
			var v = $bitrix.height() - $document.scrollTop();
			if (v < 0) v = 0;
			$header.css('top', v);
		}
	}

	function pointerCursorForCurrentPage() {
		if ($document.scrollTop() > 0)
			$header.find('.menu span').css('cursor', 'pointer');
		else
			$header.find('.menu span').css('cursor', '');
	}

	fixedHorizontalScroll();
	pointerCursorForCurrentPage();
	$window.on('resize scroll', fixedHorizontalScroll);
	$window.on('resize scroll', pointerCursorForCurrentPage);

	if ($bitrix.html() !== '') {
		$bitrix.each(function () {
			watchToBitrixPanel();
			setInterval(watchToBitrixPanel, getVal('bitrixCorrectionInterval'));
		});
	}

}); // .each()
}); // domReady()
}); // define()
