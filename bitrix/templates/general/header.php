<?
	$rsSite = CSite::GetByID(SITE_ID);
	$arSite = $rsSite->Fetch();

	if ($APPLICATION->GetCurPage(false) == '/') :
		define('MAIN_PAGE', 'Y');
	endif;

	$delayedCallback = function () {
		if (defined('ERROR_404')) :
			CHTTP::SetStatus("404 Not Found");
		endif;
	};

	$APPLICATION->AddBufferContent($delayedCallback);

	$revision = 18;
	if ($USER->IsAdmin()) $revision = $revision . 'dev' . 11;
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
		array("MODE" => "PHP", "SHOW_BORDER" => false));?></title>
	<?$APPLICATION->ShowMeta("description")?>
	<?$APPLICATION->ShowMeta("keywords")?>

	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/styles/build/build.css?v=<?=$revision?>" />

	<script src="<?=SITE_TEMPLATE_PATH?>/scripts/build/build.js?v=<?=$revision?>"></script>
	<script>
		//<![CDATA[
			require(['basics/get_val'], function (getVal) {

				getVal.set('tplPath', '<?=SITE_TEMPLATE_PATH?>');
				getVal.set('lang', '<?=LANGUAGE_ID?>');
				getVal.set('revision', '<?=$revision?>');

				require(['main']);

			});
		//]]>
	</script>

	<?if($USER->IsAuthorized()):?>
		<?$APPLICATION->ShowCSS()?>
		<?$APPLICATION->ShowHeadStrings()?>
		<?$APPLICATION->ShowHeadScripts()?>
	<?endif?>
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
		<div style="display:none;">
			<ul>
				<li><h3>в Липецке</h3></li>
				<li><h3>в Тамбове</h3></li>
				<li><h3>в Пензе</h3></li>
				<li><h3>в Ставрополе</h3></li>
				<li><h3>в Орле</h3></li>
				<li><h3>в Ростове-на-Дону</h3></li>
			</ul>
		</div>
		<?if (!defined('MAIN_PAGE') && !defined('ERROR_404')) :?>
			<h1 class="page_title"><span></span><span><?$APPLICATION->AddBufferContent(array(&$APPLICATION, 'GetTitle'))?></span><span></span></h1>
		<?endif?>
		<div class="page_content" <?if (defined('MAIN_PAGE')) :?> id="main"<?endif?>>

