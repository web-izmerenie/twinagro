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
        $APPLICATION->SetTitle(GetMessage("E_404"));
        $APPLICATION->AddChainItem(GetMessage("E_404"));
        LocalRedirect("/404.php");
        $this->AbortResultCache();
    } else {
        $arResult = $arSection;
        $APPLICATION->SetTitle($arResult["NAME"]);
        $APPLICATION->AddChainItem($arResult["NAME"]);
        $this->SetResultCacheKeys(array(
            "NAME",
        ));
        $this->IncludeComponentTemplate();
    }

} else {
    $APPLICATION->SetTitle($arResult["NAME"]);
    $APPLICATION->AddChainItem($arResult["NAME"]);
}
