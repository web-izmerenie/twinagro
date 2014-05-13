<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="solutions view_compare <?=$arResult["CODE"]?>">
    <div class="title">
        <a href="./../" class="go_to_list"><?=$arResult["UF_COMPARE_BACK_LINK"]?></a>
        <h2><?=$arResult["NAME"]?></h2>
    </div>
    <div class="top_variants">
        <?for ($i=1; $i<=2; $i++) :?>
            <div class="variant_<?=$i?>">
                <h3><?=GetMessage("VARIANT_N", array("#N#" => $i))?></h3>
                <figure>
                    <?if (!empty($arResult["UF_CMP_${i}_FILE"])) :?>
                        <p><img alt="<?=$arResult["UF_CMP_${i}_FILE"]["DESCRIPTION"]
                            ?>" src="<?=$arResult["UF_CMP_${i}_FILE"]["PATH"]
                            ?>" width="<?=$arResult["UF_CMP_${i}_FILE"]["WIDTH"]
                            ?>" height="<?=$arResult["UF_CMP_${i}_FILE"]["HEIGHT"]
                            ?>" /></p>
                    <?endif?>
                    <figcaption><?=$arResult["~UF_CMP_${i}_DESC"]?></figcaption>
                </figure>
            </div>
        <?endfor?>
    </div>
    <div class="description">
        <?=$arResult["DESCRIPTION"]?>
    </div>
    <div class="items">
        <?foreach ($arResult["ITEMS"] as $arItem) :?>
            <div class="item">
                <h4><?=str_replace("*", "<span class=\"footnote_mark\">*</span>", $arItem["NAME"])?></h4>
                <?for ($i=1; $i<=2; $i++) :?>
                    <div class="variant_<?=$i?>">
                        <figure>
                            <?if (!empty($arItem["cmp_${i}_pic"]["FILE"])) :?>
                            <p><img alt="<?=$arItem["cmp_${i}_pic"]["FILE"]["DESCRIPTION"]
                                ?>" src="<?=$arItem["cmp_${i}_pic"]["FILE"]["PATH"]
                                ?>" width="<?=$arItem["cmp_${i}_pic"]["FILE"]["WIDTH"]
                                ?>" height="<?=$arItem["cmp_${i}_pic"]["FILE"]["HEIGHT"]
                                ?>" /></p>
                            <?endif?>
                            <?if (!empty($arItem["cmp_${i}_desc"]["VALUE"])) :?>
                                <figcaption><?=$arItem["cmp_${i}_desc"]["~VALUE"]?></figcaption>
                            <?endif?>
                        </figure>
                    </div>
                <?endfor?>
                <?if (!empty($arItem["DETAIL_TEXT"])):?>
                    <div class="detail"><?=$arItem["DETAIL_TEXT"]?></div>
                <?endif?>
            </div>
        <?endforeach?>
    </div>
    <div class="back_to_the_future">
        <div class="sprite-ico ico-hr"></div>
        <a href="./../" class="go_to_list"><?=$arResult["UF_COMPARE_BACK_LINK"]?></a>
    </div>
</div>
