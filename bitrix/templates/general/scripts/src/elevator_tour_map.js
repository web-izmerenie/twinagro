/**
 * Elevator tour map initializer
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery', 'get_local_text'], function ($, getLocalText) {
$(function domReady() {
$('html.page-main #main .card-elevator_tour').each(function () {

	var headerHeight = $('header').height();
	$tour = $(this);
	var popupTpl = '<div class="elevator_tour_popup" style="display:none;">'+
			'<a class="close">'+ getLocalText('CLOSE') +'</a>'+
			'<div class="panorama"></div>'+
		'</div>';
	var $bitrix = $('#bitrix_panel');

	var adminMode = ($bitrix.html() !== '');

	var panorama; // {Panorama}
	var documentClickHandler; // {function}
	var popupResizeWindowHandler; // {function}

	function getPopupSize() {
		var h = $(window).height() - (
			((adminMode) ? $bitrix.height() : 0) + headerHeight + 40 + 80
		);
		var w = h * 12 / 5;

		var $popup = $('.elevator_tour_popup');
		if ($popup.size() > 0) {
			var offsetW = document.body.clientWidth - (
				80 +
				parseFloat($popup.css('padding-left')) +
				parseFloat($popup.css('padding-right'))
			);

			if (w > offsetW) {
				w = (offsetW * h / w)  * 12 / 5;
				if (h > w) h = w;
			}
		}

		if (w < 130) w = 130;
		if (h < 70) h = 70;

		return [ w, h ];
	}

	function markerClick() {
		var panoramaCode = $(this).attr('href').substr(1);

		if ($('.elevator_tour_popup').size() > 0) return; // already opened
		$('body').append(popupTpl);
		var size = getPopupSize();
		var $popup = $('.elevator_tour_popup');

		$popup.css({
			'height': size[1] + 'px',
			'width': size[0] + 'px',
			'opacity': 0,
			'display': 'block'
		});

		size = getPopupSize();

		$popup.css({
			'height': size[1] + 'px',
			'width': size[0] + 'px'
		});

		$popup.stop().animate({opacity: 1}, function () {
			$(document).bind('click.elevator_tour_popup', documentClickHandler);
			$(window).bind('resize.elevator_tour_popup', popupResizeWindowHandler);

			require(['3d_panorama'], function (Panorama) {
				new Panorama($('.elevator_tour_popup .panorama'), {
					panoramaCode: panoramaCode,
					imgPathMask: '/upload/elevator_tour/#PANORAMA_CODE#/#SIDE#.jpg',
					mouseWheelRequired: true
				}, function callback(err) {
					if (err) throw err;

					panorama = this;
					panorama.animationLoop();
					$('.elevator_tour_popup .close').click(function () {
						$(document).unbind('click.elevator_tour_popup');
						$(window).unbind('resize.elevator_tour_popup');

						$('.elevator_tour_popup').stop().fadeOut(function () {
							panorama.destroy();
							panorama = null;
							$(this).remove();
						});

						return false;
					});
				});
			});
		});

		return false;
	}

	documentClickHandler = function documentClickHandler(event) {
		var $popup = $('.elevator_tour_popup');
		var width = $popup.width() + parseFloat($popup.css('padding-left')) +
			parseFloat($popup.css('padding-right'));
		var height = $popup.height() + parseFloat($popup.css('padding-top')) +
			parseFloat($popup.css('padding-bottom'));
		var x = $popup.offset().left;
		var y = $popup.offset().top;

		if (
			event.pageY < y || event.pageY > y + height ||
			event.pageX < x || event.pageX > x + width
		) {
			$(document).unbind('click.elevator_tour_popup');
			$(window).unbind('resize.elevator_tour_popup');

			$popup.stop().fadeOut(function () {
				panorama.destroy();
				panorama = null;
				$(this).remove();
			});

			return false;
		}
	};

	popupResizeWindowHandler = function popupResizeWindowHandler() {
		$('.elevator_tour_popup').each(function () {
			var size = getPopupSize();
			$(this).css({
				'height': size[1] + 'px',
				'width': size[0] + 'px'
			});
		});
	};

	$tour.find('ul li').each(function () {
		var x = parseFloat($(this).attr('data-x'));
		var y = parseFloat($(this).attr('data-y'));
		$(this).css({ left: x + '%', top: y + '%' });
		$(this).addClass('active');
		$(this).find('a').click(markerClick);
	});

}); // .each()
}); // domReady()
}); // define()

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
