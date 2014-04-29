/**
 * Animation image block constructor
 *
 * @author Viacheslav Lotsmanov
 */

define(['jquery', 'modernizr.apng'], function ($) {
    var tplDirPrefix = (typeof window.SITE_TEMPLATE_PATH === 'string')
        ? window.SITE_TEMPLATE_PATH : './';

    var ajaxAnimSprite = tplDirPrefix + '/images/loading_animation_sprite.png'; 
    var ajaxAnimAPNG = tplDirPrefix + '/images/loading_animation.png';

    // preload images
    $('<img/>').attr('src', ajaxAnimSprite);
    $('<img/>').attr('src', ajaxAnimAPNG);

    /**
     * For AJAX loading (APNG or PNG sprite with frames)
     *
     * @constructor
     */
    return function Constructor(callback, srcAPNG, srcSprite, width, height, interval, startFrame) {
        var self = this;

        /** properties */
        self.$img = $('<img/>');
        self.$sprite = $('<img/>');
        self.srcAPNG = srcAPNG || ajaxAnimAPNG;
        self.srcSprite = srcSprite || ajaxAnimSprite;
        self.interval = interval || 100;
        self.frames;
        self.curFrame = startFrame || 0;
        self.timer = null;
        self.apng = false;

        /** methods */
        self.kill;

        if ($('html').hasClass('apng')) {
            self.apng = true;
        }

        self.$img.data('parent', self);

        function init() {
            if ( ! height) self.height = self.$sprite.get(0).height;
            else self.height = height;

            if ( ! width) self.width = self.height;
            else self.width = width;

            if (self.apng) {
                self.$img
                    .attr({
                        'width': self.width,
                        'height': self.height,
                        'src': self.srcAPNG
                    });
            } else {
                self.frames = Math.ceil( self.$sprite.get(0).width / self.width );

                self.$img
                    .attr({ 'width': self.width, 'height': self.height })
                    .css({
                        'background-image': 'url("'+ self.srcSprite +'")',
                        'background-position': -(self.width * self.curFrame) + 'px 0'
                    })
                    ;
            }

            setTimeout(function () {
                callback.call(self);

                if ( ! self.apng) {
                    self.timer = setInterval(function () {
                        if (++self.curFrame >= self.frames) self.curFrame = 0;
                        self.$img.css('background-position', -(self.width * self.curFrame) + 'px 0')
                    }, self.interval);
                }
            }, 1);
        }

        self.kill = function kill() {
            if ( ! self.apng) clearInterval(self.timer);
            callback = srcAPNG = srcSprite = width = height = interval = startFrame = void(0);
            for (var key in self) {try {self[key] = void(0);} catch(e) {}}
        };

        /** 1x1 px blank png */
        var blankPNG = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEA'
            +'AAABCAYAAAAfFcSJAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAAL'
            +'EwEAmpwYAAAAB3RJTUUH3gISDgwCLBUYoQAAAB1pVFh0Q29tbWVudAAAAAAA'
            +'Q3JlYXRlZCB3aXRoIEdJTVBkLmUHAAAADUlEQVQI12NgYGBgAAAABQABXvMq'
            +'OgAAAABJRU5ErkJggg==';

        self.$sprite.load(init);
        self.$img.attr('src', blankPNG);
        self.$sprite.attr('src', self.srcSprite);
    };
});
