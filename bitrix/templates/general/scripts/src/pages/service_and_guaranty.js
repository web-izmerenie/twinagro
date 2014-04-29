/**
 * Service And Guaranty page
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery'], function ($) {
$(function domReady() {
$('.service_and_guaranty').each(function () {

    $(this).find('.instructions').each(function () {

        $(this).find('li a').attr('target', '_blank');

    });

}); // define()
}); // domReady()
}); // define()
