<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?><?$APPLICATION->IncludeComponent("custom:advanced_form", "call_me_later", array(
	"IBLOCK_TYPE" => "forms",
	"IBLOCK_CODE" => "call_me_later",
	"SAVE_RESULTS_TO_IBLOCK" => "Y",
	"EMAIL_FROM" => "Твин Агро <noreply@twinagro.ru>",
	"ADMIN_EMAIL" => "twinagro@yandex.ru",
	"HIDDEN_COPY_ADMIN" => "vialot@web-izmerenie.ru, epriganova@web-izmerenie.ru",
	"HIDDEN_COPY_USER" => "",
	"MANY_USER_EMAILS" => "N",
	"EMAIL_TEMPLATES_IBLOCK_TYPE" => "forms",
	"EMAIL_TEMPLATES_IBLOCK_CODE" => "email_templates",
	"ADMIN_EMAIL_TEMPLATE" => "call_me_later_admin_notify",
	"USER_EMAIL_TEMPLATE" => "-",
	"HIDE_SUCCESS_FORM" => "N",
	"USE_CAPTCHA" => "N",
	"FORM_SALT" => "call_me_later"
	),
	false
);?>
