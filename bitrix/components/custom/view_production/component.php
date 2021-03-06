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
		$APPLICATION->AddChainItem(GetMessage("E_404"));
		$APPLICATION->SetTitle(GetMessage("E_404"));
		LocalRedirect("/404.php");
		$this->AbortResultCache();
	} else {
		$arResult = $arSection;

		if (!empty($arResult["UF_COMPARE_HOOK"])) {
			$resCmp = CIBlockSection::GetByID($arResult["UF_COMPARE_HOOK"]);
			$cmp = $resCmp->Fetch();
			$arResult["UF_COMPARE_HOOK_CODE"] = $cmp["CODE"];
		}

		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["IBLOCK_ID"], $arResult["ID"]);
		$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();

		$arResult["ITEMS"] = array();

		$res2 = CIBlockElement::GetList(
			array($arParams["SORT_BY"] => $arParams["SORT_ORDER"]),
			array(
				"ACTIVE" => "Y",
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => $arResult["ID"],
			),
			false,
			false
		);
		while ($arItem = $res2->GetNext()) {
			foreach ($arParams["PROPERTY_CODE"] as $prop) {
				$res3 = CIBlockElement::GetProperty(
					$arParams["IBLOCK_ID"],
					$arItem["ID"],
					array("SORT" => "ASC"),
					array("CODE" => $prop)
				);
				$arItem[$prop] = array();
				while ($ob = $res3->GetNext()) {
					if ($ob["MULTIPLE"] != "Y") {
						$arItem[$prop] = $ob;
						break;
					}
					if (!empty($ob["VALUE"])) {
						if ($ob["PROPERTY_TYPE"] == "F"
						&& (string)intval($ob["VALUE"]) == (string)$ob["VALUE"] ) {
							$rsFile = CFile::GetByID($ob["VALUE"]);
							$arFile = $rsFile->GetNext();
							$arFile["PATH"] = CFile::GetPath($ob["VALUE"]);
							$ob["FILE"] = $arFile;
						}
						$arItem[$prop][] = $ob;
					}
				}
			}
			$arResult["ITEMS"][] = $arItem;
		}

		$noCacheCallback(&$APPLICATION, &$arResult);
		$this->SetResultCacheKeys(array("NAME", "IPROPERTY_VALUES"));
		$this->IncludeComponentTemplate();
	}

} else {
	$noCacheCallback(&$APPLICATION, &$arResult);
}
