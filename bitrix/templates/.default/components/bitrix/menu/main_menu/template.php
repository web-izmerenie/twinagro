<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <nav class="menu">
        <?foreach ($arResult as $i=>$arItem) :?>
            <?if ($arItem["PERMISSION"] > "D"):?>
                <?if ($APPLICATION->GetCurPage(0) == $arItem["LINK"]) :?>
                    <span><?=$arItem["TEXT"]?></span>
                <?elseif ($arItem["SELECTED"]) :?>
                    <a href="<?=$arItem["LINK"]?>" class="active"><?=$arItem["TEXT"]?></a>
                <?else :?>
                    <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                <?endif?>
            <?endif?>
        <?endforeach?>
    </nav>
<?endif?>
