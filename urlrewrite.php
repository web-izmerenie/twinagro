<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/solutions/production/([^/]+)/([^/]+)/(index.php)?(\\?.*)?\$#",
		"RULE" => "section_code=\$2&",
		"ID" => "",
		"PATH" => "/solutions/view_compare.php",
	),
	array(
		"CONDITION" => "#^/solutions/production/([^/]+)/(index.php)?(\\?.*)?\$#",
		"RULE" => "section_code=\$1&",
		"ID" => "",
		"PATH" => "/solutions/view_production.php",
	),
	array(
		"CONDITION" => "#^/solutions/services/([^/]+)/(index.php)?(\\?.*)?\$#",
		"RULE" => "section_code=\$1&",
		"ID" => "",
		"PATH" => "/solutions/view_service.php",
	),
);

?>