/**
 * Objects page
 *
 * @author Viacheslav Lotsmanov
 */

define(['get_val', 'get_local_text', 'jquery', 'get_height_sum', 'webkit_bug_fix_wrapper', 'animation_img_block'],
function (getVal, getLocalText, $, getHeightSum, webkitBugFixWrapper, AnimationImgBlock) {
$(function domReady() {
$('section.content .objects').each(function () {

	var $objects = $(this);
	var resetSizesCss = {
		'height': 'auto',
		'max-height': 'none'
	};
	var minHeight = parseInt($objects.css('min-height'), 10);
	var resizeCallback;

	$objects.data('loading_process', false);

	function nod(w, h) {
		if (h === 0) return w;
		else return nod(h, (w % h));
	}

	function aspect(w, h) {
		return [w/nod(w, h), h/nod(w, h)];
	}

	function fillSize(scopeWidth, scopeHeight, srcWidth, srcHeight) { // {{{1
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
	} // fillSize() }}}1

	function recalcImgSize() { // {{{1
		$objects.find('ul li img').each(function () {
			var $img = $(this);

			if ($img.hasClass('photo')) {
				$img.css({ 'width': 'auto', 'height': 'auto', 'min-width': 'none', 'min-height': 'none' });
				var newSize = fillSize($objects.width(), $objects.height(), $img.width(), $img.height());
				$img.css({
					'width': newSize[0] + 'px', 'height': newSize[1] + 'px',
					'margin-left': newSize[2] + 'px', 'margin-top': newSize[3] + 'px'
				});
			} else if ($img.hasClass('loader')) {
				$img.css({
					'margin-right': - ($img.width() / 2) + 'px',
					'margin-top': - ($img.height() / 2) + 'px'
				});
			}
		});
	} // recalcImgSize() }}}1

	function initHeight() { // {{{1
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

		recalcImgSize();
	} // initHeight() }}}1

	function setActive() { // {{{1
		var $item = $(this);

		// do nothing if loading started before this time
		if ($item.data('loading_started')) return;
		else $item.data('loading_started', true);

		var $p = $item.find('p');
		var $loader = null;

		function loadedCallback(img) { // {{{2
			var $img = $('<img/>', {
					src: img.src,
					width: img.width,
					height: img.height,
					class: 'photo'
				});

			$p.append($img);
			recalcImgSize();
			$img.css({ opacity: 0 }).animate(
				{ opacity: 1 },
				getVal('animationSpeed'),
				function () {
					recalcImgSize();

					// preloading next and prev elements {{{3

					var $ul = $item.closest('ul');
					var $elems = $ul.find('li');
					var $prev = $item.prev();
					var $next = $item.next();

					if ($prev.size() < 1) $prev = $elems.eq(-1);
					if ($next.size() < 1) $next = $elems.eq(0);

					if (!$prev.data('loading_started')) {
						$('<img/>')
							.on('load', function () { $(this).remove(); })
							.attr('src', $prev.attr('data-img-src'));
					}

					if (!$next.data('loading_started')) {
						$('<img/>')
							.on('load', function () { $(this).remove(); })
							.attr('src', $next.attr('data-img-src'));
					}

					// preloading next and prev elements }}}3
				}
			);
		} // loadedCallback }}}2

		function startLoad() { // {{{2
			require(['loadimg'], function (loadImg) {
				loadImg($item.attr('data-img-src'), function (err, img) {
					if (err) {
						console.log(err);
						if (err instanceof loadImg.exceptions.Timeout) {
							alert(getLocalText('ERR', 'LOAD_IMG_TIMEOUT_RE'));
							startLoad();
						} else alert( getLocalText('ERR', 'LOAD_IMG') );
						return;
					}

					$loader.animate(
						{ opacity: 0 },
						getVal('animationSpeed'),
						function () {
							$loader.remove();
							loadedCallback(img);
						}
					);
				});
			});
		} // startLoad }}}2

		$item.data(
			'loader_animation',
			new AnimationImgBlock(function () {
				$loader = this.$img.addClass('loader').css('opacity', 0);
				$p.append( $loader );
				setTimeout(function () {
					recalcImgSize();
					$loader.animate(
						{ opacity: 1 },
						getVal('animationSpeed'),
						startLoad
					);
				}, 1);
			})
		);
	} // setActive() }}}1

	function initScrolling() { // {{{1
		var $controls = $objects.find('.controls');
		var $prev = $controls.find('.previous');
		var $next = $controls.find('.next');
		var $ul = $objects.find('ul');
		var $elems = $ul.find('li');
		var $offset = $elems;

		var liCount = $elems.size();
		var slowMotion = false;

		if ($objects.data('no_scrolling')) return;

		if (liCount > 0) $elems.eq(0).each(setActive);

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

		function letsGo() { // {{{2
			var animationSpeed;

			if (slowMotion) {
				animationSpeed = getVal('animationSpeed') * 4;
				slowMotion = false;
			} else {
				animationSpeed = getVal('animationSpeed') * 2;
			}

			$elems
				.removeClass('active')
				.eq( $objects.data('scrolling_active_index') )
				.addClass('active')
				.each(setActive);

			$offset.stop().animate(
				{
					left: calcXOffset($objects.data('scrolling_active_index')) + 'px'
				},
				animationSpeed,
				function callback() {
					$objects.data('scrolling_animating', false);
				}
			);
		} // letsGo }}}2

		// $prev and $next click handlers {{{2

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

		// $prev and $next click handlers }}}2

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
	} // initScrolling }}}1

	webkitBugFixWrapper(function initObjects() { // {{{1
		$(window)
			.on('resize', function () {
				initHeight();
				if (resizeCallback) resizeCallback();
			})
			.trigger('resize');

		initScrolling();
		$(window).trigger('resize');
	}); // webkitBugFixWrapper() }}}1

}); // .each()
}); // domReady()
}); // define()

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
