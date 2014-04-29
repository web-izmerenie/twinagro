/**
 * Header for main page
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery'], function ($) { $(function () { // dom ready
$('html.page-main #main .card-1').each(function () {
    var tplDirPrefix = (typeof window.SITE_TEMPLATE_PATH === 'string')
        ? window.SITE_TEMPLATE_PATH : './';

    var $card1 = $(this);
    var $bitrix = $('#bitrix_panel');
    var $header = $('body > header');
    var headerHeight = $('header').height();

    function watchToBitrixPanel() {
        if (!$bitrix.find('#bx-panel').hasClass('bx-panel-fixed')) {
            if ($('html').hasClass('header_follow')) {
                $header.css('top', 0);
            } else {
                $header.css('top', $bitrix.height());
            }
        }
    }

    function headerFollow() {
        if ($(document).scrollTop() > $card1.find('.background').height() - headerHeight) {
            if ($('html').hasClass('header_follow')) {
                $header.css('left', -($(document).scrollLeft()) + 'px');
                return;
            }
            $header.css({
                height: 0,
                opacity: 0
            });
            $('html').addClass('header_follow');
            $header.stop().css('left', -($(document).scrollLeft()) + 'px').animate({
                height: headerHeight,
                opacity: 1
            }, headerFollow);
        } else {
            if ( ! $('html').hasClass('header_follow')) return;
            $header.stop().animate({
                height: 0,
                opacity: 0
            }, function () {
                $('html').removeClass('header_follow');
                $(this).css({
                    height: headerHeight,
                    opacity: 1,
                    left: ''
                });
                headerFollow();
            });
        }

        /** scrolled to top of page before fade-out animation finished */
        if ($(document).scrollTop() < headerHeight) {
            $('html').removeClass('header_follow');
            $header.stop().css({
                height: headerHeight,
                opacity: 1,
                left: ''
            });
        }
    }

    headerFollow();
    $(window).on('resize scroll', headerFollow);

    ($bitrix.html() != '') && $bitrix.each(function () {
        watchToBitrixPanel();
        setInterval(watchToBitrixPanel, 500);
    });
});
}); });
