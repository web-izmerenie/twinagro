<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="content_list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<li>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="title">
			<?=$arItem["NAME"]?>
		</a>
		<?if(!empty($arItem["PREVIEW_TEXT"])):?>
			<div class="preview_text"><?=$arItem["PREVIEW_TEXT"]?></div>
		<?endif?>
	</li>
<?endforeach?>
</ul>
