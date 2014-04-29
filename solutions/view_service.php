<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Просмотр услуги");
$APPLICATION->AddChainItem("Услуги");
?> <?$APPLICATION->IncludeComponent(
	"custom:view_service",
	"",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "5",
		"SECTION_CODE" => $_GET["section_code"],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>