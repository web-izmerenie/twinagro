<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="card card-1">
    <div class="background">
        <div class="title"><?$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."index.innovations_for_professionals.title.inc.php", Array(), Array("MODE" => "php"));?></div>
        <!--<div class="presentation"><a href="#">Скачать презентацию</a></div>-->
        <div class="scroll-arrow"><a href="#cut"></a></div>
        <a class="tour-3d"></a>
    </div>
    <div class="info" id="cut">
        <?$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."index.innovations_for_professionals.inc.php", Array(), Array("MODE" => "html"));?>
    </div>
</div>
<div class="card card-2">
    <div class="background">
        <div class="title"><?$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."index.about_brand.title.inc.php", Array(), Array("MODE" => "php"));?></div>
    </div>
    <div class="info three-column">
        <div class="column">
            <?$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."index.about_brand_1.inc.php", Array(), Array("MODE" => "html"));?>
        </div>
        <div class="column">
            <?$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."index.about_brand_2.inc.php", Array(), Array("MODE" => "html"));?>
        </div>
        <div class="column">
            <?$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."index.about_brand_3.inc.php", Array(), Array("MODE" => "html"));?>
        </div>
    </div>
</div>
<div class="card card-3">
    <div class="background">
        <div class="title"><?$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."index.development.title.inc.php", Array(), Array("MODE" => "php"));?></div>
    </div>
    <div class="info">
        <?$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."index.development.inc.php", Array(), Array("MODE" => "html"));?>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"3dtour",
	Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "6",
		"NEWS_COUNT" => "",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "",
		"SORT_ORDER2" => "",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(),
		"PROPERTY_CODE" => array("pos_x", "pos_y"),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?>
