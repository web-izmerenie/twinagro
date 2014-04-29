/*!
 * Localization module
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery'], function ($) {
    var local = {
        'ru': {
            'Close': 'Закрыть'
        }
    };

    /**
     * @constructor
     * @public
     */
    function Localization(lang) {
        if (typeof lang === 'undefined') {
            if (!window.LANGUAGE_ID) {
                throw new this.exceptions.NoLanguage();
            }

            lang = window.LANGUAGE_ID;
        }

        this.lang = lang.toLowerCase();
        if (!(this.lang in local)) {
            throw new this.exceptions.UnknownLanguage();
        }
    }

    /**
     * @public
     */
    Localization.prototype.getMessage
    = function getMessage(key, replaceList) {
        var result = local[this.lang][key];
        if (typeof replaceList !== 'undefined') {
            if (!$.isPlainObject(replaceList)) {
                throw new this.exceptions.IncorrectReplaceList();
            }
        }
        for (var reg in replaceList) {
            result = result.replace(new RegExp(reg, 'g'), replaceList[reg]);
        }
        return result;
    };

    var exceptions = {};

    function baseException() {
        this.constructor.prototype.__proto__ = Error.prototype;
        Error.call(this);
        this.name = this.constructor.name;
    }

    exceptions.NoLanguage = function NoLanguage(message) {
        baseException.call(this);
        this.message = message || 'No language.';
    };

    exceptions.UnknownLanguage = function UnknownLanguage(message) {
        baseException.call(this);
        this.message = message || 'Unknown language.';
    };

    exceptions.IncorrectReplaceList = function IncorrectReplaceList(message) {
        baseException.call(this);
        this.message = message || 'Incorrect replace list type.';
    };

    /** provide exceptions to constructor */
    Localization.exceptions = exceptions;
    Localization.prototype.exceptions = exceptions;

    /** this module is a constructor */
    return Localization;
});
