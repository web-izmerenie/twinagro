/**
 * Values for "get_val" module
 *
 * @module values
 * @author Viacheslav Lotsmanov
 */

define(function () {

    /** @public */ var exports = {};

    exports.values = {
        dynamicApiLoadInterval: 100, // ms
        requireTimeout: 60 // sec
    };

    /** Required set before "getVal" */
    exports.required = [
        'lang',
        'revision',
        'tplPath'
    ];

    return exports;

}); // define

// vim: set sw=4 ts=4 et foldmethod=marker :
