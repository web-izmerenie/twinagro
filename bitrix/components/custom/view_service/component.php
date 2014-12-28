<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

$noCacheCallback = function ($APPLICATION, $arResult) {
	$APPLICATION->AddChainItem($arResult["NAME"]);

	$meta = $arResult['IPROPERTY_VALUES'];

	if (!empty($meta['SECTION_META_TITLE']))
		$APPLICATION->SetPageProperty("title", $meta['SECTION_META_TITLE']);
	if (!empty($meta['SECTION_META_DESCRIPTION']))
		$APPLICATION->SetPageProperty("description", $meta['SECTION_META_DESCRIPTION']);
	if (!empty($meta['SECTION_META_KEYWORDS']))
		$APPLICATION->SetPageProperty("keywords", $meta['SECTION_META_KEYWORDS']);

	if (!empty($meta['SECTION_PAGE_TITLE']))
		$APPLICATION->SetTitle($meta['SECTION_PAGE_TITLE']);
	else
		$APPLICATION->SetTitle($arResult["NAME"]);
};

if ($this->StartResultCache(false)) {

	$res = CIBlockSection::GetList(
		array(),
		array(
			"ACTIVE" => "Y",
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"DEPTH_LEVEL" => 2,
			"CODE" => $arParams["SECTION_CODE"],
		),
		false,
		array("UF_*")
	);
	$arSection = $res->GetNext();
	if (!$arSection || $arSection["CODE"] != $arParams["SECTION_CODE"]) {
		ShowError(GetMessage("E_SECTION_NOT_FOUND"));
		CHTTP::SetStatus("404 Not Found");
		$APPLICATION->SetTitle(GetMessage("E_404"));
		$APPLICATION->AddChainItem(GetMessage("E_404"));
		LocalRedirect("/404.php");
		$this->AbortResultCache();
	} else {
		$arResult = $arSection;

		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["IBLOCK_ID"], $arResult["ID"]);
		$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();

		$noCacheCallback(&$APPLICATION, &$arResult);
		$this->SetResultCacheKeys(array("NAME", "IPROPERTY_VALUES"));
		$this->IncludeComponentTemplate();
	}

} else {
	$noCacheCallback(&$APPLICATION, &$arResult);
}
