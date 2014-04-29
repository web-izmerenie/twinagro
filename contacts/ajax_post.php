<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?><?

$APPLICATION->IncludeFile(
    $APPLICATION->GetCurDir()."form.inc.php",
    Array(),
    Array("MODE" => "php", "SHOW_BORDER" => false)
);

?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
