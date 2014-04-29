/**
 * @overview Twin Agro main module
 * @author Fedor Pudeyan
 * @author Viacheslav Lotsmanov
 */

(function() {
    var tplDirPrefix = (typeof window.SITE_TEMPLATE_PATH === 'string')
        ? window.SITE_TEMPLATE_PATH : './';

    var revision = (window.revision && !window.developmentMode)
        ? window.revision : (new Date()).getTime();

    require.config({
        baseUrl: tplDirPrefix + '/scripts',
        paths: {
            'threejs': 'libs/three.min',
            'jquery': 'libs/jquery-2.1.0.min',
            'jquery.mousewheel': 'libs/jquery.mousewheel'
        },
        shim: {
            'threejs': { exports: 'THREE' }
        },
        urlArgs: 'bust=v' + revision,
        enforceDefine: true,
        waitSeconds: 30
    });

    require(['jquery'], function ($) {

        /** menu scroll to up by click on current page */
        $(function () {
            $('.menu > span').click(function () {
                $('html,body').animate({ scrollTop: 0 });
                return false;
            });
        });

        // preload sub-pages sprite
        $('<img/>').attr('src', tplDirPrefix + '/assets/sprite.png');

        // for fixing opera bugs
        if (Object.prototype.toString.call(window.opera) == '[object Opera]')
            $('html').addClass('ugly_opera');

        require(['header']);

        require(['sticky_footer']);

        /** numbers for num-lists */
        $(function () {
            $('body .page_content ol').each(function () {
                $(this).find('li').each(function (i) {
                    $(this).addClass('ol_num_'+(i+1));
                });
            });
        });

        /** page-specific */

        /** cards on main */
        require(['pages/main']);

        /** /objects/ page */
        require(['pages/objects']);

        require(['pages/error_404']);

        require(['pages/contacts']);

        require(['pages/service_and_guaranty']);

        require(['pages/solutions']);

    });
})();

/* vim: set fenc=utf-8 ts=4 sw=4 expandtab : */
