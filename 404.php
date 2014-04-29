<?
define('ERROR_404', 'Y');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка 404");
CHTTP::SetStatus("404 Not Found");
?>

<div class="error_404">
    <h1>Ошибка 404</h1>
    <section class="help_message">
        Введён неверный адрес, или такой страницы больше нет.<br/>
        Вернитесь на <a href="/">главную</a>
    </section>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
