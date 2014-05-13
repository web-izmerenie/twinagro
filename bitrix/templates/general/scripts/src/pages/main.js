/**
 * Main page
 *
 * @author Viacheslav Lotsmanov
 */

define(['get_val', 'jquery'], function (getVal, $) {
$(function domReady() {
var $window = $(window);
var $page = $('html,body');
$('html.page-main #main').each(function () {

	var $mainBlock = $(this);
	var headerHeight = $('header').height();
	var $bitrix = $('#bitrix_panel');

	var adminMode = ($bitrix.html() !== '');

	function correctCardHeight() {
		$mainBlock.find('.card .background').each(function () {

			var $bg = $(this);

			if ($bg.hasClass('card-elevator_tour')) return;

			if ( $bg.closest('.card').hasClass('card-1') ) {
				$bg.css(
					'height',
					$window.height() - 35 - ((adminMode) ? $bitrix.height() : 0)
				);
			} else {
				$bg.css('height', $window.height() - headerHeight );
			}

		});
	}

	correctCardHeight();
	$window.on('resize', correctCardHeight);
	if (adminMode) setInterval(correctCardHeight, getVal('bitrixCorrectionInterval'));

	/** scroll to card text by click on .title in .background */
	$mainBlock.find('.card .background .title'+
	', .card-1 .background .scroll-arrow a').click(function () {

		$page.animate({
			scrollTop: $(this).closest('.card').find('.info').offset().top -
			((adminMode) ? $bitrix.height() : 0)
		}, getVal('animationSpeed')*2);

		return false;

	});

	$mainBlock.find('.tour-3d').click(function () {

		$page.animate({
			scrollTop: $mainBlock.find('.card-elevator_tour').offset().top -
			headerHeight - ((adminMode) ? $bitrix.height() : 0)
		}, getVal('animationSpeed')*6);

		return false;

	});

	require(['pages/main_header']);
	require(['elevator_tour_map']);

}); // .each()
}); // domReady()
}); // define()

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
