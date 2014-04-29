<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

if (empty($arResult)) return "";

$pageTitleNav = "";

foreach ($arResult as $arItem) {
	$pageTitleNav = htmlspecialcharsex($arItem["TITLE"]) ." / ". $pageTitleNav;
}

return $pageTitleNav;
