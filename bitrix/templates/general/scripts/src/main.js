/**
 * Twin Agro main module
 *
 * @author Fedor Pudeyan
 * @author Viacheslav Lotsmanov
 */

define(['get_val', 'jquery'], function (getVal, $) {

    require.config({
        map: {
            '*': {

                /* short name aliases */

                'threejs': 'libs/three',
                'jquery.mousewheel': 'libs/jquery.mousewheel',
                'modernizr': 'libs/modernizr-2.7.2',
                '3d_panorama': 'libs/3d_panorama'

            }
        }
    });

    require(['modernizr']);

    /** menu scroll to up by click on current page */
    $(function () {

        $('.menu > span').click(function () {

            $('html,body').animate({ scrollTop: 0 });
            return false;

        });

    });

    // preload sub-pages sprite
    //$('<img/>').attr('src', tplDirPrefix + '/assets/sprite.png');
    // TODO to styles

    // for fixing opera bugs
    if (Object.prototype.toString.call(window.opera) == '[object Opera]') {
        $('html').addClass('ugly_opera');
    }

    require(['header']);

    require(['sticky_footer']);

    /** numbers for num-lists */
    $(function domReady() {

        $('body .page_content ol').each(function () {
            $(this).find('li').each(function (i) {
                $(this).addClass('ol_num_'+(i+1));
            });
        });

    }); // domReady()

    /** page-specific */

    /** cards on main */
    require(['pages/main']);

    /** /objects/ page */
    require(['pages/objects']);

    require(['pages/error_404']);

    require(['pages/contacts']);

    require(['pages/service_and_guaranty']);

    require(['pages/solutions']);

}); // define

/* vim: set fenc=utf-8 ts=4 sw=4 expandtab : */
