<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Опросный лист");
?><?$APPLICATION->IncludeComponent("api:main.feedback", "quest_list", array(
	"IBLOCK_TYPE" => "forms",
	"IBLOCK_ID" => "11",
	"INSTALL_IBLOCK" => "N",
	"REPLACE_FIELD_FROM" => "Y",
	"UNIQUE_FORM_ID" => "546c9ba1ddeac",
	"OK_TEXT" => "Спасибо, ваш опросный лист принят.",
	"EMAIL_TO" => "twin@twinagro.ru",
	"DISPLAY_FIELDS" => array(
	),
	"REQUIRED_FIELDS" => array(
	),
	"CUSTOM_FIELDS" => array(
		0 => "Название предприятия@input@text",
		1 => "Имя@input@text@required",
		2 => "Телефон@input@text@required",
		3 => "E-mail@input@text",
		4 => "Объем хранения@input@number@required",
		5 => "Количество силосов @input@number",
		6 => "Культура@input@checkbox@values=Пшеница#Ячмень#Кукуруза#Подсолнечник#Соя#Рис#Другое",
		7 => "Культура, другое@input@text",
		8 => "Сушка@input@radio@values=Нет#Да",
		9 => "Очистка@input@radio@values=Нет#Да",
		10 => "Прием@input@checkbox@values=С авто#С ж/д",
		11 => "Отгрузка@input@checkbox@values=На авто#На ж/д#На воду",
		12 => "Реализация проекта@input@radio@values=Нужно вчера#В этом году#Перспектива",
		13 => "",
	),
	"ADMIN_EVENT_MESSAGE_ID" => array(
		0 => "8",
	),
	"USER_EVENT_MESSAGE_ID" => array(
		0 => "8",
	),
	"HIDE_FIELD_NAME" => "N",
	"TITLE_DISPLAY" => "N",
	"FORM_TITLE" => "",
	"FORM_TITLE_LEVEL" => "1",
	"FORM_STYLE_TITLE" => "",
	"FORM_STYLE" => "",
	"FORM_STYLE_DIV" => "",
	"FORM_STYLE_LABEL" => "",
	"FORM_STYLE_TEXTAREA" => "",
	"FORM_STYLE_INPUT" => "",
	"FORM_STYLE_SELECT" => "",
	"FORM_STYLE_SUBMIT" => "",
	"FORM_SUBMIT_CLASS" => "",
	"FORM_SUBMIT_ID" => "",
	"FORM_SUBMIT_VALUE" => "Отправить",
	"USE_CAPTCHA" => "N",
	"USE_HIDDEN_PROTECTION" => "Y",
	"USE_PHP_ANTISPAM" => "N",
	"PHP_ANTISPAM_LEVEL" => "1",
	"INCLUDE_JQUERY" => "N",
	"VALIDTE_REQUIRED_FIELDS" => "N",
	"INCLUDE_PLACEHOLDER" => "N",
	"INCLUDE_PRETTY_COMMENTS" => "N",
	"INCLUDE_FORM_STYLER" => "Y",
	"HIDE_FORM_AFTER_SEND" => "N",
	"SCROLL_TO_FORM_IF_MESSAGES" => "N",
	"SCROLL_TO_FORM_SPEED" => "1000",
	"BRANCH_ACTIVE" => "N",
	"SHOW_FILES" => "N",
	"UUID_LENGTH" => "10",
	"UUID_PREFIX" => "",
	"USER_AUTHOR_FIO" => "",
	"USER_AUTHOR_NAME" => "",
	"USER_AUTHOR_LAST_NAME" => "",
	"USER_AUTHOR_SECOND_NAME" => "",
	"USER_AUTHOR_EMAIL" => "",
	"USER_AUTHOR_PERSONAL_MOBILE" => "",
	"USER_AUTHOR_WORK_COMPANY" => "",
	"USER_AUTHOR_POSITION" => "",
	"USER_AUTHOR_PROFESSION" => "",
	"USER_AUTHOR_STATE" => "",
	"USER_AUTHOR_CITY" => "",
	"USER_AUTHOR_WORK_CITY" => "",
	"USER_AUTHOR_STREET" => "",
	"USER_AUTHOR_ADRESS" => "",
	"USER_AUTHOR_PERSONAL_PHONE" => "",
	"USER_AUTHOR_WORK_PHONE" => "",
	"USER_AUTHOR_FAX" => "",
	"USER_AUTHOR_MAILBOX" => "",
	"USER_AUTHOR_WORK_MAILBOX" => "",
	"USER_AUTHOR_SKYPE" => "",
	"USER_AUTHOR_ICQ" => "",
	"USER_AUTHOR_WWW" => "",
	"USER_AUTHOR_WORK_WWW" => "",
	"USER_AUTHOR_MESSAGE_THEME" => "",
	"USER_AUTHOR_MESSAGE" => "",
	"USER_AUTHOR_NOTES" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"SHOW_CSS_MODAL_AFTER_SEND" => "N",
	"CSS_MODAL_HEADER" => "Информация",
	"CSS_MODAL_FOOTER" => "<a id=\"bxid_648986\" >Разработка модуля</a> - Тюнинг Софт",
	"CSS_MODAL_CONTENT" => "<p>Модуль <b>расширенная форма обратной связи битрикс с вложением</b> предназначен для отправки сообщений с сайта, включая код CAPTCHA и скрытую защиту от спама, и отличается от стандартной формы Битрикс:
<br> - <b>отправкой файлов вложениями или ссылками на файл</b>,
<br> - <b>встроенным конструктором форм,</b>
<br> - скрытой защитой от спама,
<br> - работой нескольких форм на одной странице,
<br> - встроенным фирменным валидатором форм,
<br> - 4 встроенными WEB 2.0 шаблонами,
<br> - дополнительными полями со своим именованием,
<br> - и многими другими функциями...
<br>подробнее читайте на странице модуля <a id=\"bxid_720329\" >Расширенная форма обратной связи</a>
</p>",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> 
<br />
 
<br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>