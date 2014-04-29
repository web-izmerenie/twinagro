/**
 * Localization values
 *
 * @module localization
 * @author Viacheslav Lotsmanov
 * @encoding utf-8
 */

define(['get_val'],
function (getVal) {

    var locals = {

        'ru': {

            'CLOSE': 'Закрыть'

        },

        'defaultLocal': getVal('lang')

    };

    return locals;

}); // define

// vim: set sw=4 ts=4 et foldmethod=marker fenc=utf-8 :
