<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Решаем задачи");
$APPLICATION->AddChainItem("Продукция");
?> <?$APPLICATION->IncludeComponent(
	"custom:view_production",
	"",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "5",
		"SECTION_CODE" => $_GET["section_code"],
		"SORT_BY" => "SORT",
		"SORT_ORDER" => "ASC",
		"PROPERTY_CODE" => array("hide_name", "advantages", "advantages_descriptions", "splitter_line", "non_break_advantages"),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N"
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>