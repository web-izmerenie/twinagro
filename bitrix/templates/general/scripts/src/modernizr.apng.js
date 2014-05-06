/*!
 * APNG Modernizr Test Workaround
 *
 * @author Viacheslav Lotsmanov
 */

define(['modernizr'], function (Modernizr) {

    var testImage = new Image();
    var canvasContext = document.createElement('canvas').getContext('2d');
    var isApngSupported = false;

    testImage.onload = function () {

        canvasContext.drawImage(testImage, 0, 0);
        isApngSupported = canvasContext.getImageData(0, 0, 1, 1).data[3] === 0;

        if (typeof isApngSupported !== "boolean") {
            isApngSupported = false;
        }

        Modernizr.addTest('apng', function() {
            return isApngSupported;
        });

    };

    testImage.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAY'+
        'AAAAfFcSJAAAACGFjVEwAAAABAAAAAcMq2TYAAAANSURBVAiZY2BgYPgPAAEEAQB9ssj'+
        'fAAAAGmZjVEwAAAAAAAAAAQAAAAEAAAAAAAAAAAD6A+gBAbNU+2sAAAARZmRBVAAAAAE'+
        'ImWNgYGBgAAAABQAB6MzFdgAAAABJRU5ErkJggg==';

});
