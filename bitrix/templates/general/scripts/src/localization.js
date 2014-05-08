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

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
