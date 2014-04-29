/**
 * Sticky footer
 *
 * @author Viacheslav Lotsmanov
 */

define(  [ 'jquery', 'get_height_sum', 'webkit_bug_fix_wrapper' ],
function (  $,        getHeightSum,     webkitBugFixWrapper     ) {

    $(function domReady() {

        function stickyFooter() {
            var heightSum = getHeightSum();

            if (heightSum < $(window).height()) {
                $('html').addClass('sticky_footer');
            } else {
                $('html').removeClass('sticky_footer');
            }
        }

        $(window).on('scroll resize', stickyFooter);
        webkitBugFixWrapper(stickyFooter);

    }); // domReady()

}); // define()
