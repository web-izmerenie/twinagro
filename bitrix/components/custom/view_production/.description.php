<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("COMP_NAME"),
	"DESCRIPTION" => GetMessage("COMP_DESC"),
	"PATH" => array(
		"ID" => "twinagro",
		"NAME" => GetMessage("COMP_PATH_NAME"),
		"CHILD" => array(
			"ID" => "solutions",
			"NAME" => GetMessage("COMP_PATH_SECTION_NAME"),
		),
	),
);
