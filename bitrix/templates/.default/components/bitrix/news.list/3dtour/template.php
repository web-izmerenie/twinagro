<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="card card-elevator_tour">
    <div class="title"><?=GetMessage("3D_TOUR")?></div>
    <img alt="<?=GetMessage("3D_TOUR_ALT")?>" src="/upload/3dtour_model.png" width="1600" height="1003" />
    <ul class="points">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <li data-x="<?=$arItem["DISPLAY_PROPERTIES"]["pos_x"]["VALUE"]
                ?>" data-y="<?=$arItem["DISPLAY_PROPERTIES"]["pos_y"]["VALUE"]
                ?>"><a href="#<?=$arItem["CODE"]?>"></a></li>
        <?endforeach;?>
    </ul>
</div>
