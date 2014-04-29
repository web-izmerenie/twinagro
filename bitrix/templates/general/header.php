<?
    $rsSite = CSite::GetByID(SITE_ID);
    $arSite = $rsSite->Fetch();

    if ($APPLICATION->GetCurPage(false) == '/') :
        define('MAIN_PAGE', 'Y');
    endif;

    $revision = 29;
    if ($USER->IsAdmin()) $revision = 'dev' . time();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID
?>" lang="<?=LANGUAGE_ID?>" class="no-js<?
    defined('MAIN_PAGE') && print(' page-main');
    defined('ERROR_404') && print(' error-page');
?>">
<head>
    <meta charset="<?=LANG_CHARSET?>" />
    <title><?$APPLICATION->IncludeFile(
        $APPLICATION->GetTemplatePath("include_areas/page_title.php"),
        array(),
        array("MODE" => "PHP", "SHOW_BORDER" => false)
    );?><?=$arSite["SITE_NAME"]?></title>
    <?$APPLICATION->ShowMeta("keywords")?>
    <?$APPLICATION->ShowMeta("description")?>

    <script>
        window.SITE_TEMPLATE_PATH = '<?=SITE_TEMPLATE_PATH?>';
        window.LANGUAGE_ID = '<?=LANGUAGE_ID?>';
        <?if ($USER->IsAdmin()) :?>
            window.less = { env: 'development' };
            window.developmentMode = true;
        <?endif?>
        window.revision = '<?=$revision?>';
    </script>

    <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/styles/compiled_styles.css?v=<?=$revision?>" />

    <script src="<?=SITE_TEMPLATE_PATH?>/scripts/libs/modernizr.custom.87787.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/scripts/libs/require.js"></script>

    <script src="<?=SITE_TEMPLATE_PATH?>/scripts/behavior.js?v=<?=$revision?>"></script>

    <?$APPLICATION->ShowCSS()?>
    <?$APPLICATION->ShowHeadStrings()?>
    <?$APPLICATION->ShowHeadScripts()?>
</head>

<body>
    <div id="bitrix_panel"><?$APPLICATION->ShowPanel()?></div>

    <header>
        <div class="logo" title="<?=$arSite["SITE_NAME"]?>">
            <?if ( ! defined("MAIN_PAGE")) :?><a href="/"><?endif?>
                <img alt="<?=$arSite["SITE_NAME"]?>" src="<?=SITE_TEMPLATE_PATH?>/images/twinagro_logo_white_on_dark.png" class="white" />
                <img alt="<?=$arSite["SITE_NAME"]?>" src="<?=SITE_TEMPLATE_PATH?>/images/twinagro_logo_dark_on_white.png" class="dark" />
            <?if ( ! defined("MAIN_PAGE")) :?></a><?endif?>
        </div>

        <?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "",
	"USE_EXT" => "N",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>

    </header>

    <section class="content">
        <?if (!defined('MAIN_PAGE') && !defined('ERROR_404')) :?>
            <h1 class="page_title"><span></span><span><?=$APPLICATION->ShowTitle()?></span><span></span></h1>
        <?endif?>
        <div class="page_content" <?if (defined('MAIN_PAGE')) :?> id="main"<?endif?>>

