<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?><?$APPLICATION->IncludeComponent("custom:advanced_form", "order_services", array(
	"IBLOCK_TYPE" => "forms",
	"IBLOCK_CODE" => "zakaz_uslug",
	"SAVE_RESULTS_TO_IBLOCK" => "Y",
	"EMAIL_FROM" => "TWIN AGRO <noreply@twinagro.ru>",
	"ADMIN_EMAIL" => "twinagro@yandex.ru",
	"HIDDEN_COPY_ADMIN" => "sindicat61@yandex.ru, vialot@web-izmerenie.ru",
	"HIDDEN_COPY_USER" => "",
	"MANY_USER_EMAILS" => "N",
	"EMAIL_TEMPLATES_IBLOCK_TYPE" => "forms",
	"EMAIL_TEMPLATES_IBLOCK_CODE" => "email_templates",
	"ADMIN_EMAIL_TEMPLATE" => "form_zakaz_uslug",
	"USER_EMAIL_TEMPLATE" => "-",
	"HIDE_SUCCESS_FORM" => "N",
	"USE_CAPTCHA" => "N",
	"FORM_SALT" => "form_from_pay_uslugi"
	),
	false
);?>
