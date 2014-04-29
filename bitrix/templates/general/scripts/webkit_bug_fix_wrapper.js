/**
 * Webkit start sizes bug fix wrapper
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery'], function ($) { return function webkitBugFixWrapper(callback) {
    /** webkit detected */
    if ('webkitRequestAnimationFrame' in window) {
        $('body').append('<div class="webkit_bugfix"></div>');
        setTimeout(function () {
            $('body .webkit_bugfix').remove();
            setTimeout(callback, 1);
        }, 1);
    } else callback();
}; });
