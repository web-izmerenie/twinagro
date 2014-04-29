<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (empty($arResult["ITEMS"])) return;?>

<div class="instructions">
    <h3><?=GetMessage("INSTRUCTIONS")?></h3>
    <ul>
        <?foreach ($arResult["ITEMS"] as $arItem) :?>
            <li>
                <a href="<?=$arItem["DISPLAY_PROPERTIES"]["file"]["FILE_VALUE"]["SRC"]
                    ?>" title="<?=$arItem["PREVIEW_PICTURE"]["DESCRIPTION"]?>">
                        <img alt="<?=$arItem["PREVIEW_PICTURE"]["DESCRIPTION"]
                            ?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]
                            ?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]
                            ?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" />
                </a>
            </li>
        <?endforeach?>
    </ul>
</div>
