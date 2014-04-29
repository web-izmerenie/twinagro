<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (empty($arResult["ITEMS"])) return;?>

<div class="call_subjects">
    <a class="show_list"></a>
    <ul>
        <?foreach ($arResult["ITEMS"] as $arItem) :?>
            <li><?=$arItem["DISPLAY_PROPERTIES"]["subject"]["VALUE"]?></li>
        <?endforeach?>
    </ul>
</div>
