<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="article">
	<div id="detail-article">
        <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
            <span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
        <?endif;?>
        <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
            <div class="title"><h1><?=$arResult["NAME"]?></h1>
            <div id="back"><a href="<?=$arResult['LIST_PAGE_URL'];?>"><span>К списку</span> &rarr;</a></div>
            </div>
        <div style="clear:both"></div>
        <?endif;?>
        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
            <p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
        <?endif;?>
        <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
            <div class="prewiev_text"><?echo $arResult["PREVIEW_TEXT"];?></div>
        <?endif?>
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
            <div class="detail_picture"><img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" /></div>
        <?endif?>
        <?if($arResult["NAV_RESULT"]):?>
            <?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
            <?echo $arResult["NAV_TEXT"];?>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>

        <?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
            <div class="detail_text"><?echo $arResult["DETAIL_TEXT"];?></div>
        <?else:?>
            <?echo $arResult["PREVIEW_TEXT"];?>
        <?endif?>

 
        <?foreach($arResult["FIELDS"] as $code=>$value):
            if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
            {
                ?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
                if (!empty($value) && is_array($value))
                {
                    ?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
                }
            }
            else
            {
                ?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
            }
            ?>
        <?endforeach;
        foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

            <?=$arProperty["NAME"]?>:&nbsp;
            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
            <?else:?>
                <?=$arProperty["DISPLAY_VALUE"];?>
            <?endif?>
            <br />
        <?endforeach;
        if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
        {
            ?>
            <div class="news-detail-share">
                <noindex>
                <?
                $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                        "HANDLERS" => $arParams["SHARE_HANDLERS"],
                        "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                        "PAGE_TITLE" => $arResult["~NAME"],
                        "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                        "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                        "HIDE" => $arParams["SHARE_HIDE"],
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
                </noindex>
            </div>
            <?
        }
        ?>
        <div id="back-bottom">
          <div id="back"><a href="<?=$arResult['LIST_PAGE_URL'];?>"><span>К списку</span> &rarr;</a></div>  
        </div>
    </div>
</div>