<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="solutions view_production <?=$arResult["CODE"]?>">
    <div class="title">
        <a href="/solutions/" class="go_to_list"><span></span><?=GetMessage("GO_TO_LIST")?></a>
        <h2><?=$arResult["NAME"]?></h2>
    </div>
    <?if (!empty($arResult["DESCRIPTION"])) :?>
        <div class="description">
            <?=$arResult["DESCRIPTION"]?>
        </div>
    <?endif?>
    <?if (!empty($arResult["UF_COMPARE_LINK"]) && !empty($arResult["UF_COMPARE_HOOK_CODE"])) :?>
        <div class="compare">
            <a href="/solutions/production/<?=$arResult["CODE"]
                ?>/<?=$arResult["UF_COMPARE_HOOK_CODE"]
                ?>/"><?=$arResult["UF_COMPARE_LINK"]?></a>
        </div>
    <?endif?>
    <div class="items">
        <?foreach ($arResult["ITEMS"] as $arItem) :?>
            <div class="item">
                <div class="note_column<?=(!empty($arItem["non_break_advantages"]["VALUE"]))?" non_break":""?>">
                    <?foreach ($arItem["advantages"] as $i=>$advantage) :?>
                        <figure>
                            <p><img alt="<?=$advantage["FILE"]["DESCRIPTION"]
                                ?>" src="<?=$advantage["FILE"]["PATH"]
                                ?>" width="<?=$advantage["FILE"]["WIDTH"]
                                ?>" height="<?=$advantage["FILE"]["HEIGHT"]
                                ?>" /></p>
                            <?if (!empty($advantage["FILE"]["DESCRIPTION"])
                            || is_array($arItem["advantages_descriptions"][$i])) :?>
                                <figcaption><?
                                    if (is_array($arItem["advantages_descriptions"][$i])):
                                        echo $arItem["advantages_descriptions"][$i]["~VALUE"];
                                    else:
                                        echo $advantage["FILE"]["DESCRIPTION"];
                                    endif;
                                ?></figcaption>
                            <?endif?>
                        </figure>
                    <?endforeach?>
                </div>
                <?if (empty($arItem["hide_name"]["VALUE"])) :?>
                    <h3><?=$arItem["NAME"]?></h3>
                <?endif?>
                <div class="description">
                    <?=$arItem["DETAIL_TEXT"]?>
                </div>
                <?if (!empty($arItem["splitter_line"]["VALUE"])) :?>
                    <div class="splitter_line"></div>
                <?endif?>
            </div>
        <?endforeach?>
    </div>
    <div class="back_to_the_future">
        <div class="sprite-ico ico-hr"></div>
        <a href="/solutions/" class="go_to_list"><span></span><?=GetMessage("GO_TO_LIST")?></a>
    </div>
</div>
