/**
 * Objects page
 *
 * @author Viacheslav Lotsmanov
 */

define(['get_val', 'jquery', 'get_height_sum', 'webkit_bug_fix_wrapper'],
function (getVal, $, getHeightSum, webkitBugFixWrapper) {
$(function domReady() {
$('section.content .objects').each(function () {

	var $objects = $(this);
	var resetSizesCss = {
		'height': 'auto',
		'max-height': 'none'
	};
	var minHeight = parseInt($objects.css('min-height'), 10);
	var resizeCallback;

	function nod(w, h) {
		if (h === 0) return w;
		else return nod(h, (w % h));
	}

	function aspect(w, h) {
		return [w/nod(w, h), h/nod(w, h)];
	}

	function fillSize(scopeWidth, scopeHeight, srcWidth, srcHeight) {
		var width = 0, height = 0, offsetX = 0, offsetY = 0;

		var scopeAspect = aspect(scopeWidth, scopeHeight);
		var srcAspect = aspect(srcWidth, srcHeight);

		if (scopeAspect[0] == srcAspect[0] && scopeAspect[1] == srcAspect[1]) {
			width = scopeWidth;
			height = scopeHeight;
		} else {
			srcAspect[0] = srcAspect[0] * scopeAspect[1] / srcAspect[1];
			srcAspect[1] = scopeAspect[1];

			if (srcAspect[0] > scopeAspect[0]) {
				height = scopeHeight;
				width = srcWidth * height / srcHeight;
				offsetX = -((width - scopeWidth) / 2);
			} else {
				width = scopeWidth;
				height = srcHeight * width / srcWidth;
				offsetY = -((height - scopeHeight) / 2);
			}
		}

		return [width, height, offsetX, offsetY];
	}

	function initHeight() {
		var heightSum = getHeightSum();
		var newObjHeight = $(window).height() - (heightSum - $objects.height());

		if ($(window).height() > heightSum || newObjHeight >= minHeight) {
			$objects.css($.extend({}, resetSizesCss, {
				'height': newObjHeight + 'px'
			}));
		} else if ($(window).height() < heightSum) {
			$objects.css($.extend({}, resetSizesCss, {
				'height': minHeight + 'px'
			}));
		}

		var w = $objects.width();
		var h = $objects.height();
		var hByRatio = (w * getVal('objectsBlockRatio')[1]) / getVal('objectsBlockRatio')[0];

		if (hByRatio < h) {
			$objects.css('height', hByRatio + 'px');
		}

		$objects.find('ul li img').each(function () {
			$(this).css({ 'width': 'auto', 'height': 'auto', 'min-width': 'none', 'min-height': 'none' });
			var newSize = fillSize($objects.width(), $objects.height(), $(this).width(), $(this).height());
			$(this).css({
				'width': newSize[0] + 'px', 'height': newSize[1] + 'px',
				'margin-left': newSize[2] + 'px', 'margin-top': newSize[3] + 'px'
			});
		});
	}

	function initScrolling() {
		var $controls = $objects.find('.controls');
		var $prev = $controls.find('.previous');
		var $next = $controls.find('.next');
		var $ul = $objects.find('ul');
		var $elems = $ul.find('li');
		var $offset = $elems;

		var liCount = $elems.size();
		var slowMotion = false;

		if ($objects.data('no_scrolling')) return;

		if (liCount < 2) {
			$controls.hide();
			$objects.data('no_scrolling', true);
			return;
		} else {
			$controls.show();
		}

		/** already initialized */
		if ($objects.data('scrolling_activated')) {
			return;
		} else {
			$objects.data('scrolling_activated', true);
		}

		$elems.removeClass('active').eq(0).addClass('active');
		$objects.data('scrolling_active_index', 0);

		function calcXOffset(index) {
			return -($ul.width() * index);
		}

		function letsGo() {
			var animationSpeed;

			if (slowMotion) {
				animationSpeed = getVal('animationSpeed') * liCount;
				slowMotion = false;
			} else {
				animationSpeed = getVal('animationSpeed') * 2;
			}

			$elems.removeClass('active').eq( $objects.data('scrolling_active_index') ).addClass('active');
			$offset.stop().animate(
				{
					left: calcXOffset($objects.data('scrolling_active_index')) + 'px'
				},
				animationSpeed,
				function callback() {
					$objects.data('scrolling_animating', false);
				}
			);
		}

		$prev.unbind('click').click(function () {
			if ($objects.data('scrolling_animating')) return; // wait for animation finished
			$objects.data('scrolling_animating', true);

			if ($objects.data('scrolling_active_index') - 1 >= 0) {
				$objects.data('scrolling_active_index', $objects.data('scrolling_active_index') - 1);
			} else {
				$objects.data('scrolling_active_index', liCount - 1);
				slowMotion = true;
			}

			letsGo();

			return false;
		});

		$next.unbind('click').click(function () {
			if ($objects.data('scrolling_animating')) return; // wait for animation finished
			$objects.data('scrolling_animating', true);

			if ($objects.data('scrolling_active_index') + 1 < liCount) {
				$objects.data('scrolling_active_index', $objects.data('scrolling_active_index') + 1);
			} else {
				$objects.data('scrolling_active_index', 0);
				slowMotion = true;
			}

			letsGo();

			return false;
		});

		resizeCallback = function resizeCallback() {
			setTimeout(function () {
				$offset.stop().css(
					{
						left: calcXOffset($objects.data('scrolling_active_index')) + 'px'
					}
				);
				$objects.data('scrolling_animating', false);
			}, 1);
		};
	}

	webkitBugFixWrapper(function initObjects() {
		$(window)
			.on('resize', function () {
				initHeight();
				if (resizeCallback) resizeCallback();
			})
			.trigger('resize');

		initScrolling();
		$(window).trigger('resize');
	});

}); // .each()
}); // domReady()
}); // define()

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
