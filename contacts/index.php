<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

<div class="contacts">
    <div class="info">
        <address>
            <?$APPLICATION->IncludeFile("/index.map_address.inc.php", Array(), Array("MODE" => "html"));?>
        </address>
        <div class="call_me_later">
            <a class="call_me_button">Заказать звонок</a>
            <?$APPLICATION->IncludeFile(
                $APPLICATION->GetCurDir()."form.inc.php",
                Array(),
                Array("MODE" => "php", "SHOW_BORDER" => false)
            );?>
        </div>
    </div>
    <div class="map">
        <script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=ocvofeEputww8Dbml4zC_PiCRIiC1Vkm"></script>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
