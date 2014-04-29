<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Решаем задачи");
?> <?$APPLICATION->IncludeComponent(
	"custom:list_solutions",
	"",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "5",
		"SORT_BY" => "SORT",
		"SORT_ORDER" => "ASC",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N"
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>