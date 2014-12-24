/**
 * quest-list page
 *
 * @author Andrey Chechkin
 */

define(['jquery'],
function ($) {
$(function domReady(){
	function switchTrig(){
		$('#546c9ba1ddeac_FIELD_9_0').attr("checked", "checked");
			$('#tpl_white_grey_custom_field_9').find('#switch-off').click(function(){
				$('#tpl_white_grey_custom_field_9').find('#switch-off').hide();
				$('#tpl_white_grey_custom_field_9').find('#switch-on').show();
				$('#546c9ba1ddeac_FIELD_9_1')[0].checked = true;
			});
			$('#tpl_white_grey_custom_field_9').find('#switch-on').click(function(){
				$('#tpl_white_grey_custom_field_9').find('#switch-on').hide();
				$('#tpl_white_grey_custom_field_9').find('#switch-off').show();
				$('#tpl_white_grey_custom_field_9').find('input[type=radio]').removeAttr("checked");
				$('#546c9ba1ddeac_FIELD_9_0')[0].checked = true;
			});
		}
	function switchTrig1(){
		$('#546c9ba1ddeac_FIELD_8_0').attr("checked", "checked");
			$('#tpl_white_grey_custom_field_8').find('#switch-off').click(function(){
				$('#tpl_white_grey_custom_field_8').find('#switch-off').hide();
				$('#tpl_white_grey_custom_field_8').find('#switch-on').show();
				$('#546c9ba1ddeac_FIELD_8_1')[0].checked = true;
			});
			$('#tpl_white_grey_custom_field_8').find('#switch-on').click(function(){
				$('#tpl_white_grey_custom_field_8').find('#switch-on').hide();
				$('#tpl_white_grey_custom_field_8').find('#switch-off').show();
				$('#tpl_white_grey_custom_field_8').find('input[type=radio]').removeAttr("checked");
				$('#546c9ba1ddeac_FIELD_8_0')[0].checked = true;
			});
		}

	switchTrig();
	switchTrig1();
}); // domReady()
}); // define()
