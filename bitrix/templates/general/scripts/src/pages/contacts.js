/*!
 * Contacts page
 *
 * @author Viacheslav Lotsmanov
 */

define(  [ 'get_val', 'jquery', 'get_height_sum', 'webkit_bug_fix_wrapper', 'animation_img_block' ],
function (  getVal,    $,        getHeightSum,     webkitBugFixWrapper,      AnimationImgBlock    ) {
$(function domReady() {
$('.contacts').each(function () {

    var $contacts = $(this);
    var $map = $contacts.find('.interactive_map');
    var $callBtn = $contacts.find('.call_me_button');
    var $form = $contacts.find('.info form');
    var process = false;
    var subjectsListVisible = false;
    var $subjectsList = null;

    var minHeight = parseInt($map.css('min-height'), 10);

    var mapId = 'interactive_yandex_map';
    $map.attr('id', mapId);

    function resizeMap() {
        var heightSum = getHeightSum();
        var newHeight = $(window).height() - (heightSum - $map.height());

        if ($(window).height() > heightSum || newHeight >= minHeight) {
            $map.css('height', newHeight + 'px');
        } else if ($(window).height() < heightSum) {
            $map.css('height', minHeight + 'px');
        }

        if ($map.data('yamap')) {
            $map.data('yamap').container.fitToViewport();
        }
    }

    function formShowHideHandler(event) {
        if (subjectsListVisible) return;

        if ($(this).hasClass('call_me_button')) {
            if ($form.is(':hidden')) $form.stop().fadeIn();
            else $form.stop().fadeOut();
            return false;
        } else {
            if ($form.is(':hidden')) return;
        }

        if (event.pageX < 1 && event.pageY < 1) return;

        var bWidth = $form.width() + parseInt($form.css('padding-left'), 10) + parseInt($form.css('padding-right'), 10);
        var bHeight = $form.height() + parseInt($form.css('padding-top'), 10) + parseInt($form.css('padding-bottom'), 10);
        var bTop = $form.offset().top;
        var bLeft = $form.offset().left;

        if (
            event.pageY < bTop || event.pageY > bTop + bHeight ||
            event.pageX < bLeft || event.pageX > bLeft + bWidth
        ) {
            $form.stop().fadeOut();
        }
    }

    function subjectsListShowHideHandler(event) {
        if ($(this).hasClass('show_list')) {
            if ($subjectsList.is(':hidden')) {
                $form.find('.call_subjects .show_list').addClass('active');
                $form.find('.call_subjects').closest('dd').addClass('active');
                $subjectsList.stop().slideDown(function () {
                    subjectsListVisible = true;
                });
            } else {
                $form.find('.call_subjects .show_list').removeClass('active');
                $form.find('.call_subjects').closest('dd').removeClass('active');
                $subjectsList.stop().slideUp(function () {
                    subjectsListVisible = false;
                });
            }
            return false;
        } else {
            if ($subjectsList.is(':hidden')) return;
        }

        if (event.pageX < 1 && event.pageY < 1) return;

        var bWidth = $subjectsList.width() + parseInt($subjectsList.css('padding-left'), 10) + parseInt($subjectsList.css('padding-right'), 10);
        var bHeight = $subjectsList.height() + parseInt($subjectsList.css('padding-top'), 10) + parseInt($subjectsList.css('padding-bottom'), 10);
        var bTop = $subjectsList.offset().top;
        var bLeft = $subjectsList.offset().left;

        if (
            event.pageY < bTop || event.pageY > bTop + bHeight ||
            event.pageX < bLeft || event.pageX > bLeft + bWidth
        ) {
            $form.find('.call_subjects .show_list').removeClass('active');
            $form.find('.call_subjects').closest('dd').removeClass('active');
            $subjectsList.stop().slideUp(function () {
                subjectsListVisible = false;
            });
        }
    }

    function placeholderInit() {
        var animationSpeed = 200;
        $form.find('dl.text').each(function () {
            var $dl = $(this);
            var $label = $dl.find('label');

            function blurHandler() {
                if ($(this).attr('name') === 'subject') {
                    if ($(this).val() === '') {
                        $label.stop().show();
                    } else if ($(this).val() !== '') {
                        $label.stop().hide();
                    }
                } else {
                    if ($(this).val() === '') {
                        $label.stop().fadeIn(animationSpeed);
                    } else if ($(this).val() !== '') {
                        $label.stop().fadeOut(animationSpeed);
                    }
                }
            }

            function focusHandler() {
                if ($(this).attr('name') !== 'subject') {
                    $label.stop().fadeOut(animationSpeed);
                }
            }

            $dl.find('input').focus(focusHandler).blur(blurHandler).trigger('blur');
        });
    }

    function submitHandler() {
        if (process) return false;
        else process = true;

        var responseTpl = '<h4 class="#STATUS#">#TITLE#</h4>#LIST#';
        var responseListTpl = '<ul class="#STATUS#">#MESSAGES#</ul>';
        var responseMessageTpl = '<li>#MESSAGE#</li>';

        var $fields = $form.find('.fields');
        var $response = $form.find('.ajax_response');
        if ($response.size() < 1) {
            $response = $('<div/>', { 'class': 'ajax_response' });
            $fields.before( $response );
        } else {
            $response.slideUp(function () { $response.html(''); });
        }
        var $loader = $('<div/>', { 'class': 'ajax_loader' });
        $fields.before( $loader );

        var anim = new AnimationImgBlock(function () {
            function backToForm(response, clearFields, callback) {
                if (response) {
                    $response.html( response );
                    $response.slideDown();
                } else {
                    $response.slideUp(function () { $response.html(''); });
                }
                $loader.slideUp(function () {
                    $loader.remove();
                    anim.kill();
                    anim = void(0);

                    if (callback) {
                        setTimeout(function () {
                            callback();
                            process = false;
                        }, 1);
                    } else {
                        process = false;
                    }
                });
                if (clearFields) {
                    $form.find('dl.text').each(function () {
                        $(this).find('input').val('').trigger('blur');
                    });
                }
                $fields.slideDown();
            }

            function ajaxError(msg) {
                var html = responseTpl
                    .replace(/#STATUS#/g, 'error')
                    .replace(/#TITLE#/g, msg)
                    .replace(/#LIST#/g, '')
                    ;
                backToForm(html);
            }

            $loader.html( this.$img );
            $fields.slideUp();
            $loader.slideDown(function () {
                $.ajax({
                    url: '/contacts/ajax_post.php?ajax=Y&post=Y',
                    data: $form.serialize(),
                    cache: false,
                    type: 'POST',
                    timeout: 15000
                }).success(function (data) {
                    var json = null;
                    try {
                        json = JSON.parse(data);
                    } catch (e) {
                        return ajaxError('Parse AJAX-response error');
                    }

                    if (
                        !('status' in json) || !('success_title' in json) || !('error_title' in json) ||
                        !('success_messages' in json) || !('error_messages' in json)
                    ) {
                        return ajaxError('Not enough data in AJAX response');
                    }

                    var messages = '';
                    var list = '';
                    var array;
                    if (json.status === 'success' && json.success_messages.length > 0) {
                        array = json.success_messages;
                    } else if (json.status === 'error' && json.error_messages.length > 0) {
                        array = json.error_messages;
                    }

                    if (array) {
                        $.each(array, function (i, val) {
                            list += responseMessageTpl.replace(/#MESSAGE#/g, val);
                        });
                    }
                    if (list !== '') {
                        messages = responseListTpl
                            .replace(/#STATUS#/g, json.status)
                            .replace(/#MESSAGES#/g, list)
                            ;
                    }

                    var html = responseTpl
                        .replace(/#STATUS#/g, json.status)
                        .replace(/#TITLE#/g, ((json.status === 'success') ? json.success_title : json.error_title))
                        .replace(/#LIST#/g, messages)
                        ;
                    backToForm( html, ((json.status === 'success') ? true : false) );
                }).error(function () {
                    return ajaxError('AJAX error');
                });
            });
        });

        return false;
    }

    $form.submit(submitHandler);
    $form.find('dl.submit dt').click(function () { $form.submit(); });

    $(document).click(formShowHideHandler);
    $callBtn.click(formShowHideHandler);
    $form.find('.close').click(function () {
        $form.stop().fadeOut();
    });

    function showSubjectsList() {
        if ($subjectsList.is(':hidden')) {
            $form.find('.call_subjects .show_list').addClass('active');
            $form.find('.call_subjects').closest('dd').addClass('active');
            $subjectsList.stop().slideDown(function () {
                subjectsListVisible = true;
            });
        }
    }

    function hideSubjectsList() {
        if ($subjectsList.is(':visible')) {
            $form.find('.call_subjects .show_list').removeClass('active');
            $form.find('.call_subjects').closest('dd').removeClass('active');
            $subjectsList.stop().slideUp(function () {
                subjectsListVisible = false;
            });
        }
    }

    $form.find('.call_subjects').each(function () {
        $subjectsList = $(this).find('ul');
        $(document).click(subjectsListShowHideHandler);
        $(this).find('.show_list').each(function () {
            var $showList = $(this);
            $showList.click(subjectsListShowHideHandler);
            $showList.closest('dd').find('input').focus(function () {
                showSubjectsList();
                return false;
            }).blur(function () {
                hideSubjectsList();
                return false;
            }).click(function () {
                $(this).focus();
                return false;
            }).css('cursor', 'pointer');
            $showList.closest('dl').find('dt label').css('cursor', 'pointer');
        });
        $subjectsList.find('li').click(function () {
            $(this).closest('dl.text').find('input').val( $(this).text() ).trigger('blur').focus();
            $form.find('.call_subjects .show_list').removeClass('active');
            $form.find('.call_subjects').closest('dd').removeClass('active');
            $subjectsList.stop().slideUp(function () {
                subjectsListVisible = false;
            });
            return false;
        });
    });

    placeholderInit();

    webkitBugFixWrapper(resizeMap);
    $(window).on('resize', resizeMap);

    require(['dynamic_api'], function (dynamicLoadApi) {

        var mapLang = (getVal('lang') === 'ru') ? 'ru-RU' : 'en-US';

        dynamicLoadApi(
            'http://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU',
            'ymaps',
            function (err, ymaps) {

                if (err) throw err;

                ymaps.ready(function () {

                    var map = new ymaps.Map(mapId, {
                        center: [
                            parseFloat($map.attr('data-coord-y')),
                            parseFloat($map.attr('data-coord-x'))
                        ],
                        zoom: parseInt($map.attr('data-zoom'), 10)
                    });

                    map.controls
                        .add('zoomControl', { left: 15, top: 15 })
                        .add('typeSelector', { right: 15, top: 15 });

                    var mark = new ymaps.Placemark([
                        $map.attr('data-coord-y'),
                        $map.attr('data-coord-x')
                    ], {
                        hintContent: $contacts.find('address_text').text()
                    });

                    map.geoObjects.add(mark);
                    $map.data('yamap', map);

                    $(window).trigger('resize');

                }); // ymaps.ready()

            }
        ); // dynamicLoadApi()

    });

}); // .each()
}); // domReady()
}); // define()
