<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/solutions/production/([^/]+)/([^/]+)/(index.php)?(\\?.*)?\$#",
		"RULE" => "section_code=\$2&",
		"ID" => "",
		"PATH" => "/solutions/view_compare.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/solutions/production/([^/]+)/(index.php)?(\\?.*)?\$#",
		"RULE" => "section_code=\$1&",
		"ID" => "",
		"PATH" => "/solutions/view_production.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/solutions/services/([^/]+)/(index.php)?(\\?.*)?\$#",
		"RULE" => "section_code=\$1&",
		"ID" => "",
		"PATH" => "/solutions/view_service.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/content/([^/]+)/(index.php)?(\\?.*)?\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/content/detail.php",
	),
	array(
		"CONDITION" => "#^/robots.txt(\\?|\$)#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/robots.php",
		"SORT" => "100",
	),
);

?>