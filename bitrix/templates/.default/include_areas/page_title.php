<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
if (defined('ERROR_404')) :
    if (LANGUAGE_ID == 'ru'):
        ?>Ошибка 404 / <?
    else:
        ?>Error 404 / <?
    endif;
else :
    ?><?$APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "page_title",
        Array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "s1"
        ),
        $component,
        Array("HIDE_ICONS" => "Y")
    );?><?
endif;
?>
