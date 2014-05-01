<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule("iblock")) return;

$arIBlockTypes = CIBlockParameters::GetIBlockTypes(array("-"=>""));

$arIBlockList = array();
$res = CIBlock::GetList(
    array("SORT" => "ASC"),
    array(
        "ACTIVE" => "Y",
        "TYPE" => $arCurrentValues["IBLOCK_TYPE"],
    )
);
while ($arRes = $res->Fetch()) {
    if (empty($arRes["CODE"])) continue;
    $arIBlockList[$arRes["ID"]] = $arRes["NAME"];
}

$arSorts = Array(
    "ASC" => GetMessage("FV_SORT_ASC"),
    "DESC" => GetMessage("FV_SORT_DESC"),
);
$arSortFields = Array(
    "ID" => GetMessage("FV_SORT_BY_ID"),
    "NAME" => GetMessage("FV_SORT_BY_NAME"),
    "SORT" => GetMessage("FV_SORT_BY_SORT"),
);

$arComponentParameters = array(
    "GROUPS" => array(
        "IBLOCK" => array(
            "SORT" => 100,
            "NAME" => GetMessage("G_IBLOCK"),
        ),
    ),
    "PARAMETERS" => array(

        /** iblock */

        "IBLOCK_TYPE" => array(
            "PARENT" => "IBLOCK",
            "NAME" => GetMessage("F_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockTypes,
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => array(
            "PARENT" => "IBLOCK",
            "NAME" => GetMessage("F_IBLOCK_ID"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockList,
            "REFRESH" => "Y",
        ),

        /** sort */

        "SORT_BY" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("F_SORT_BY"),
            "TYPE" => "LIST",
            "DEFAULT" => "SORT",
            "VALUES" => $arSortFields,
            "ADDITIONAL_VALUES" => "Y",
        ),
        "SORT_ORDER" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("F_SORT_ORDER"),
            "TYPE" => "LIST",
            "DEFAULT" => "ASC",
            "VALUES" => $arSorts,
            "ADDITIONAL_VALUES" => "Y",
        ),

        /** cache */

        "CACHE_TIME" => array("DEFAULT" => 36000000),
        "CACHE_FILTER" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("F_CACHE_FILTER"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ),

    ),
);
