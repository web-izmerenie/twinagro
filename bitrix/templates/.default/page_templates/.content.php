<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

IncludeTemplateLangFile(__FILE__);
if (LANGUAGE_ID == 'ru') {
    $TEMPLATE[LANGUAGE_ID."_standard.php"] = Array("name"=>GetMessage("standard"), "sort"=>1);
}
