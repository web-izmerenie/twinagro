<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$titleCallback = function ($APPLICATION) {
	if (defined('ERROR_404')) :
		if (LANGUAGE_ID == 'ru'):
			return 'Ошибка 404';
		else:
			return 'Error 404';
		endif;
	else :
		$title = $APPLICATION->GetPageProperty('title');

		if (empty($title)) :
			return $APPLICATION->GetTitle();
		else :
			return $title;
		endif;
	endif;
};

$APPLICATION->AddBufferContent(&$titleCallback, $APPLICATION);
