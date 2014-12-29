<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="addresses">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<li>
		<?if($arItem['DISPLAY_PROPERTIES']['NO_NAME']['VALUE_XML_ID'] !== 'YES'):?>
			<h3><?=$arItem["NAME"]?></h3>
		<?endif?>
		<address><?=$arItem["PREVIEW_TEXT"]?></address>
	</li>
<?endforeach?>
</ul>
