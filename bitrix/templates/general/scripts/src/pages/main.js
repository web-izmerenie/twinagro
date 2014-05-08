/**
 * Main page
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery'], function ($) {
$(function domReady() {
$('html.page-main #main').each(function () {

	var $mainBlock = $(this);
	var headerHeight = $('header').height();
	var $bitrix = $('#bitrix_panel');

	var adminMode = ($bitrix.html() !== '');

	function correctCardHeight() {
		$mainBlock.find('.card .background').each(function () {
			if ($(this).hasClass('card-elevator_tour')) return;
			if ( $(this).closest('.card').hasClass('card-1') ) {
				$(this).css('height',
					$(window).height() - 35 - ((adminMode) ? $bitrix.height() : 0)
				);
			} else {
				$(this).css('height', $(window).height() - headerHeight );
			}
		});
	}

	correctCardHeight();
	$(window).on('resize', correctCardHeight);
	if (adminMode) setInterval(correctCardHeight, 500);

	/** scroll to card text by click on .title in .background */
	$mainBlock.find('.card .background .title'+
	', .card-1 .background .scroll-arrow a').click(function () {
		$('html,body').animate({
			scrollTop: $(this).closest('.card').find('.info').offset().top -
			((adminMode) ? $bitrix.height() : 0)
		});

		return false;
	});

	$mainBlock.find('.tour-3d').click(function () {
		$('html,body').animate({
			scrollTop: $mainBlock.find('.card-elevator_tour').offset().top -
			headerHeight - ((adminMode) ? $bitrix.height() : 0)
		});
		return false;
	});

	require(['pages/main_header']);
	require(['elevator_tour_map']);

}); // .each()
}); // domReady()
}); // define()

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
