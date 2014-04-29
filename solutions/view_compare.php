<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Решаем задачи");
?><?$APPLICATION->IncludeComponent(
	"custom:view_compare",
	"",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "5",
		"SECTION_CODE" => $_GET["section_code"],
		"SORT_BY" => "SORT",
		"SORT_ORDER" => "ASC",
		"PROPERTY_CODE" => array("cmp_1_pic", "cmp_1_desc", "cmp_2_pic", "cmp_2_desc"),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N"
	),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>