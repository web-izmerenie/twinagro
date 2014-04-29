<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>

<?$APPLICATION->IncludeFile(
    $APPLICATION->GetCurDir()."index.inc.php",
    Array(),
    Array("MODE" => "php", "SHOW_BORDER" => false)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
