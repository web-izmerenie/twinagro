/**
 * Error 404 page
 *
 * @author Viacheslav Lotsmanov
 */

define(  [ 'jquery', 'get_height_sum', 'webkit_bug_fix_wrapper' ],
function (  $,        getHeightSum,     webkitBugFixWrapper     ) {
$(function domReady() {
$('html.error-page .error_404').each(function () {

    var $error = $(this);

    function resizeArea() {
        var heightSum = getHeightSum();

        if ( ! $error.data('init_height')) {
            $error.data('init_height', $error.height());
        }
        var newHeight = $(window).height() - (heightSum - ($error.height() + parseInt($error.css('margin-top'), 10)));

        if ($(window).height() > heightSum || newHeight >= $error.data('init_height')) {
            var margin = ((newHeight / 2) - ($error.data('init_height') / 2));
            $error.css('height', (newHeight - margin) + 'px');
            $error.css('margin-top', margin + 'px');
        } else if ($(window).height() < heightSum) {
            $error.css('height', $error.data('init_height'));
            $error.css('margin-top', 0);
        }
    }

    webkitBugFixWrapper(resizeArea);
    $(window).on('resize', resizeArea);

}); // .each()
}); // domReady()
}); // define()
