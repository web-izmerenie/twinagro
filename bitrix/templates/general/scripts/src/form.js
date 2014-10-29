/**
 * forms logic
 *
 * @author Viacheslav Lotsmanov
 * @author Andrey Chechkin
 */

define(['jquery', 'animation_img_block', 'get_val', 'jquery.formstyler'],
function ($, AnimationImgBlock, getVal) {

	function formShowHideHandler(data, event) {
		if (data.$form.find('.jq-selectbox.opened').size() > 0) return;
		if (data.bugFixer) {
			data.bugFixer = false;
			return;
		}

		if ($(this).hasClass('call_form_button')) {
			if (data.$form.is(':hidden'))
				data.fadeIn();
			else
				data.fadeOut();

			return false;
		} else {
			if (data.$form.is(':hidden')) return;
		}

		if (event.pageX < 1 && event.pageY < 1) return;

		var bWidth = data.$form.width() +
			parseInt(data.$form.css('padding-left'), 10) +
			parseInt(data.$form.css('padding-right'), 10);
		var bHeight = data.$form.height() +
			parseInt(data.$form.css('padding-top'), 10) +
			parseInt(data.$form.css('padding-bottom'), 10);
		var bTop = data.$form.offset().top;
		var bLeft = data.$form.offset().left;

		if (
			event.pageY < bTop || event.pageY > bTop + bHeight ||
			event.pageX < bLeft || event.pageX > bLeft + bWidth
		) {
			data.fadeOut();
		}
	}

	function placeholderInit(data) {
		data.$form.find('dl.text').each(function () {
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
						$label.stop().fadeIn(getVal('animationSpeed'));
					} else if ($(this).val() !== '') {
						$label.stop().fadeOut(getVal('animationSpeed'));
					}
				}
			}

			function focusHandler() {
				if ($(this).attr('name') !== 'subject') {
					$label.stop().fadeOut(getVal('animationSpeed'));
				}
			}

			$dl.find('input').focus(focusHandler).blur(blurHandler).trigger('blur');
		});
	}

	function submitHandler(data) {
		if (data.process) return false;
		else data.process = true;

		var responseTpl = '<h4 class="#STATUS#">#TITLE#</h4>#LIST#';
		var responseListTpl = '<ul class="#STATUS#">#MESSAGES#</ul>';
		var responseMessageTpl = '<li>#MESSAGE#</li>';

		var $fields = data.$form.find('.fields');
		var $response = data.$form.find('.ajax_response');
		if ($response.size() < 1) {
			$response = $('<div/>', { 'class': 'ajax_response' });
			$fields.before( $response );
		} else {
			$response.slideUp(getVal('animationSpeed'), function () { $response.html(''); });
		}
		var $loader = $('<div/>', { 'class': 'ajax_loader' });
		$fields.before( $loader );

		var anim = new AnimationImgBlock(function () {
			function backToForm(response, clearFields, callback) {
				if (response) {
					$response.html( response );
					$response.slideDown(getVal('animationSpeed'));
				} else {
					$response.slideUp(getVal('animationSpeed'), function () { $response.html(''); });
				}
				$loader.slideUp(getVal('animationSpeed'), function () {
					$loader.remove();
					anim.kill();
					anim = void(0);

					if (callback) {
						setTimeout(function () {
							callback();
							data.process = false;
						}, 1);
					} else {
						data.process = false;
					}
				});
				if (clearFields) {
					data.$form.find('dl.text').each(function () {
						$(this).find('input').val('').trigger('blur');
					});
				}
				$fields.slideDown(getVal('animationSpeed'));
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
			$fields.slideUp(getVal('animationSpeed'));
			$loader.slideDown(getVal('animationSpeed'), function () {
				$.ajax({
					url: data.postURL,
					data: data.$form.serialize(),
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

	return function handler($callButton, postURL) {
		var $form = $(this);
		var $document = $(document);
		var $body = $('body');
		var $header = $body.find('header');
		var $footer = $body.find('footer');
		var $content = $body.find('section.content');

		var headerHeight = $header.height();
		var timerId = null;

		function onClose() {
			clearInterval(timerId);
			timerId = null;
			setTimeout(function () {
				$content.css('min-height', '');
			}, 1);
		}

		function timerIter() {
			var wh = $content.innerHeight() + $footer.height();
			var dh = $form.offset().top + $form.innerHeight();

			if (wh < dh) $content.css('min-height', dh + 'px');
		}

		function onShow() {
			if (timerId) return;

			timerIter();
			$(window).trigger('resize').trigger('scroll');
			timerIter();
			timerId = setInterval(timerIter, 300);
		}

		var data = {
			$form: $form,
			process: false,
			postURL: postURL,

			fadeIn: function () {
				$form.stop()
					.css('opacity', 0)
					.css('display', 'block')
					.animate(
						{ opacity: 1 },
						getVal('animationSpeed'));
				onShow();
			},

			fadeOut: function () {
				$form.stop()
					.animate(
						{ opacity: 0 },
						getVal('animationSpeed'),
						function () {
							$form.css('display', 'none');
							onClose();
						});
			},

			bugFixer: false
		};

		$form.submit(function () { return submitHandler.call(this, data); });
		$form.find('dl.submit dt').click(function () { $form.submit(); });

		$document.click(function (event) {
			return formShowHideHandler.call(this, data, event);
		});
		$($callButton).click(function (event) {
			return formShowHideHandler.call(this, data, event);
		});

		$form.find('.close').click(function () {
			data.fadeOut();
		});

		$form.find('dl dd select').each(function () {
			var $select = $(this);
			var $dl = $select.closest('dl');
			var $dt = $dl.find('dt');
			var $option = $('<option/>');

			$select.prepend($option).val('');
			$select.styler({
				selectPlaceholder: $dt.text(),
				onSelectOpened: function (a, b, c) {
					var $ul = $(this).find('.jq-selectbox__dropdown ul');
					var $li = $ul.find('>li');
					var heightSum = 0;
					$li.each(function () {
						heightSum += $(this).innerHeight() +
							parseInt($(this).css('border-top-width'), 10) +
							parseInt($(this).css('border-bottom-width'), 10);
					});
					$ul.css('height', heightSum + 'px');
				},
				onSelectClosed: function () {
					data.bugFixer = true;
					$(this).find('.jq-selectbox__dropdown ul').css('height', 0);
				},
				onFormStyled: function () {
					$option.remove();
				}
			});
		});

		placeholderInit(data);
	};

});
