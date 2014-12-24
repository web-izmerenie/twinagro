/**
 * Get height sum
 * Calculating page-elements height sum
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery'], function ($) {

	var $content;
	var $footer;
	var $bitrixPanel;

	return function getHeightSum() {
		if (!$content) {
			$content = $('body section.content');
			$footer = $('body footer');
			$bitrixPanel = $('#bitrix_panel');
		}

		return $content.innerHeight() +
			$footer.height() +
			$bitrixPanel.height();
	};

}); // define()
