<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="content_detail">
	<div class="title">
		<a href="/content/" class="go_to_list"><span></span><?=GetMessage("BACK_TO_LIST")?></a>
		<h2><?=$arResult["NAME"]?></h2>
	</div>
	<?if (!empty($arResult["PREVIEW_TEXT"])) :?>
		<div class="preview_text"><?=$arResult["PREVIEW_TEXT"]?></div>
	<?endif?>
	<?if (is_array($arResult["DETAIL_PICTURE"]) && !empty($arResult["DETAIL_PICTURE"])) :?>
		<img class="detail_picture" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]
			?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]
			?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]
			?>" alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" />
	<?endif?>
	<?if (!empty($arResult["DETAIL_TEXT"])) :?>
		<div class="detail_text"><?=$arResult["DETAIL_TEXT"]?></div>
	<?endif?>
	<div class="back_to_the_future">
		<div class="sprite-ico ico-hr"></div>
		<a href="/content/" class="go_to_list"><span></span><?=GetMessage("BACK_TO_LIST")?></a>
	</div>
</div>
