/**
 * Get height sum
 * Calculating page-elements height sum
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery'], function ($) { return function getHeightSum() {
    return ( parseInt($('body section.content').css('padding-top'), 10)
        + $('body section.content').height() + $('body footer').height()
        + $('#bitrix_panel').height() );
}; });
