<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

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

        for ($i=1; $i<=2; $i++) {
            if (!empty($arResult["UF_CMP_${i}"])) {
                $rsFile = CFile::GetByID($arResult["UF_CMP_${i}"]);
                $arFile = $rsFile->GetNext();
                $arFile["PATH"] = CFile::GetPath($arResult["UF_CMP_${i}"]);
                $arResult["UF_CMP_${i}_FILE"] = $arFile;
            }
        }

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
                $arItem[$prop] = null;
                while ($ob = $res3->GetNext()) {
                    if (!empty($ob["VALUE"])) {
                        if ($ob["PROPERTY_TYPE"] == "F"
                        && (string)intval($ob["VALUE"]) == (string)$ob["VALUE"] ) {
                            $rsFile = CFile::GetByID($ob["VALUE"]);
                            $arFile = $rsFile->GetNext();
                            $arFile["PATH"] = CFile::GetPath($ob["VALUE"]);
                            $ob["FILE"] = $arFile;
                        }
                        $arItem[$prop] = $ob;
                    }
                }
            }
            $arResult["ITEMS"][] = $arItem;
        }

        $APPLICATION->AddChainItem($arResult["NAME"]);
        $this->SetResultCacheKeys(array("NAME"));
        $this->IncludeComponentTemplate();
    }

} else {
    $APPLICATION->AddChainItem($arResult["NAME"]);
}
