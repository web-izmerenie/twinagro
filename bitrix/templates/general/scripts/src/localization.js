/**
 * Localization values
 *
 * @author Viacheslav Lotsmanov
 * @encoding utf-8
 */

define(['get_val'],
function (getVal) {

	var locals = {

		'ru': {

			'CLOSE': 'Закрыть',

			'ERR': {
				'LOAD_IMG': 'Произошла ошибка загрузка изображения.',
				'LOAD_IMG_TIMEOUT_RE': 'Истекло время ожидания загрузки изображения, будет произведена повторная попытка.'
			}

		},

		'defaultLocal': getVal('lang')

	};

	return locals;

}); // define()
