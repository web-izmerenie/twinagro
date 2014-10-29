/**
 * Contacts page
 *
 * @author Viacheslav Lotsmanov
 * @author Andrey Chechkin
 */

define(['get_val', 'jquery', 'get_height_sum', 'webkit_bug_fix_wrapper'],
function (getVal, $, getHeightSum, webkitBugFixWrapper) {
$(function domReady() {
var $window = $(window);
$('.contacts').each(function () {

	var $contacts = $(this);
	var $maps = $contacts.find('.interactive_map');

	$contacts.find('form').each(function () {
		var _this = this;
		var $callBtn, postURL;

		if ($(this).hasClass('order_services')) {
			$callBtn = $contacts.find('.order_services_button');
			postURL = '/contacts/ajax_post.order_services.php?ajax=Y&post=Y';
		} else if ($(this).hasClass('call_me_later_form')) {
			$callBtn = $contacts.find('.call_me_button');
			postURL = '/contacts/ajax_post.call_me_later.php?ajax=Y&post=Y';
		} else {
			throw new Error('Unknown <form>!');
		}

		require(['form'], function (handler) {
			handler.call(_this, $callBtn, postURL);
		});
	});

	$maps.each(function (i) {
		var $map = $(this);

		var minHeight = parseInt($map.css('min-height'), 10);

		var mapId = 'interactive_yandex_map_'+i;
		$map.attr('id', mapId);

		function resizeMap() {
			var heightSum = getHeightSum();
			var newHeight = $window.height() - (heightSum - $map.height());

			if ($window.height() > heightSum || newHeight >= minHeight) {
				$map.css('height', newHeight + 'px');
			} else if ($window.height() < heightSum) {
				$map.css('height', minHeight + 'px');
			}

			if ($map.data('yamap')) {
				$map.data('yamap').container.fitToViewport();
			}
		}

		webkitBugFixWrapper(resizeMap);
		$window.on('resize', resizeMap);

		require(['dynamic_api'], function (dynamicLoadApi) {

			var mapLang = (getVal('lang') === 'ru') ? 'ru-RU' : 'en-US';

			dynamicLoadApi(
				'http://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU',
				'ymaps',
				function (err, ymaps) {

					if (err) throw err;

					ymaps.ready(function () {

						var map = new ymaps.Map(mapId, {
							center: [
								parseFloat($map.attr('data-coord-y')),
								parseFloat($map.attr('data-coord-x'))
							],
							zoom: parseInt($map.attr('data-zoom'), 10)
						});

						map.controls
							.add('zoomControl', { left: 15, top: 15 })
							.add('typeSelector', { right: 15, top: 15 });

						var mark = new ymaps.Placemark([
							$map.attr('data-coord-y'),
							$map.attr('data-coord-x')
						], {
							hintContent: $contacts.find('address .address_text').text()
						});

						map.geoObjects.add(mark);
						$map.data('yamap', map);

						$window.trigger('resize');

					}); // ymaps.ready()

				}
			); // dynamicLoadApi()

		});
	});

}); // .each()
}); // domReady()
}); // define()

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
