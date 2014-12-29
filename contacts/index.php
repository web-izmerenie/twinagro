<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<?$APPLICATION->IncludeFile(
	$APPLICATION->GetCurDir()."/markup.inc.php",
	array(),
	array("MODE" => "PHP", "SHOW_BORDER" => false));?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
