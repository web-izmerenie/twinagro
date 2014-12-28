<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

if ($this->StartResultCache(false)) {
	$arResult["LIST"] = array();

	$res = CIBlockSection::GetList(
		array($arParams["SORT_BY"] => $arParams["SORT_ORDER"]),
		array(
			"ACTIVE" => "Y",
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"DEPTH_LEVEL" => 1,
		),
		false,
		array("UF_*")
	);

	while ($arSection = $res->GetNext()) {
		if ($arSection["UF_PUBLIC_IN_LIST"] == 0) continue;
		$arSection["CHILDREN"] = array();

		$res2 = CIBlockSection::GetList(
			array($arParams["SORT_BY"] => $arParams["SORT_ORDER"]),
			array(
				"ACTIVE" => "Y",
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"DEPTH_LEVEL" => 2,
				"SECTION_ID" => $arSection["ID"],
			),
			false,
			array("UF_*")
		);
		while ($arItem = $res2->GetNext()) {
			if ($arSection["UF_PUBLIC_IN_LIST"] == 0) continue;

			$arItem["SECTION_PAGE_URL"] = str_replace("#SECTION_1_CODE#", $arSection["CODE"], $arItem["SECTION_PAGE_URL"]);
			$arItem["SECTION_PAGE_URL"] = str_replace("#SECTION_2_CODE#", $arItem["CODE"], $arItem["SECTION_PAGE_URL"]);

			$arItem["PREVIEW_PICTURE"] = array();
			$picture = CFile::GetByID($arItem["PICTURE"]);
			$picPath = CFile::GetPath($arItem["PICTURE"]);
			$arItem["PREVIEW_PICTURE"] = $picture->GetNext();
			if ( ! empty($arItem["PREVIEW_PICTURE"])) {
				$arItem["PREVIEW_PICTURE"]["SRC"] = $picPath;
			}

			$arSection["CHILDREN"][] = $arItem;
		}

		$arResult["LIST"][] = $arSection;
	}

	//$this->AbortResultCache();
	$this->IncludeComponentTemplate();
}
