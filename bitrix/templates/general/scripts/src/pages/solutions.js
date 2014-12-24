/**
 * Behavior on solutions pages
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery'], function ($) {

	/** 1x1 px blank png */
	var blankPNG = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEA'+
		'AAABCAYAAAAfFcSJAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAAL'+
		'EwEAmpwYAAAAB3RJTUUH3gISDgwCLBUYoQAAAB1pVFh0Q29tbWVudAAAAAAA'+
		'Q3JlYXRlZCB3aXRoIEdJTVBkLmUHAAAADUlEQVQI12NgYGBgAAAABQABXvMq'+
		'OgAAAABJRU5ErkJggg==';

	/**
	 * @this {DOM}
	 */
	function handler() {

		/**
		 * Limiting size of images in top of "view production" pages
		 *
		 * @this {DOM}
		 */
		$(this).find('> .description > img').each(function () {
			var $img = $(this);
			var absPath = $img.get(0).src;

			$('<img/>').load(function () {
				$img.data('src_width', this.width);
				$img.data('src_height', this.height);
				$img.attr('src', blankPNG).css({
					'display': 'block',
					'width': '100%',
					'height': $img.data('src_height') + 'px',
					'background-image': 'url("'+ absPath +'")',
					'background-repeat': 'no-repeat',
					'background-position': 'center 0',
					'padding-left': '35px',
					'padding-right': '35px',
					'position': 'relative',
					'left': '-35px'
				});
			}).attr('src', absPath);
		});

	}

	$(function domReady() {
		$('.solutions.view_production').each(handler);
		$('.solutions.view_compare').each(handler);
	});

}); // define()
