<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="objects">
    <div class="controls">
        <a class="previous"></a>
        <a class="next"></a>
    </div>
    <ul>
        <?foreach ($arResult["ITEMS"] as $arItem) :?>
            <li>
                <figure>
                    <p><img alt="<?=$arItem["FIELDS"]["DETAIL_PICTURE"]["DESCRIPTION"]
                        ?>" src="<?=$arItem["FIELDS"]["DETAIL_PICTURE"]["SRC"]?>" /></p>
                    <figcaption><?=$arItem["FIELDS"]["NAME"]?></figcaption>
                </figure>
            </li>
        <?endforeach?>
    </ul>
</div>
