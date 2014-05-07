<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<nav class="list_solutions">
    <ul>
        <?$i=0; foreach ($arResult["LIST"] as $arType) :?>
            <li>
                <ul>
                    <?foreach ($arType["CHILDREN"] as $arItem) :?>
                        <li>
							<?if ($i <= 0) :?>
                            <a href="<?=$arItem["SECTION_PAGE_URL"]?>">
							<?else :?>
							<span class="plug">
							<?endif?>
                                <figure>
                                    <?if (!empty($arItem["PREVIEW_PICTURE"])) :?>
                                        <p><?if (!empty($arItem["PICTURE"])) :
                                            $boxSize = ($i % 2 == 0) ? 77 : 69;?><?$APPLICATION->IncludeComponent(
	"custom:ucresizeimg",
	"",
	Array(
		"INPUT_FILE_PATH" => "",
		"INPUT_IMAGE_ID" => "$arItem[PICTURE]",
		"DESCRIPTION" => "#IMAGE_ID_DESCRIPTION#",
		"WIDTH" => "$boxSize",
		"HEIGHT" => "$boxSize",
		"RESIZE_TYPE" => "CROP",
		"CROP_POS_X" => "CENTER",
		"CROP_POS_Y" => "MIDDLE",
		"KEEP_SIZE" => "EXTEND",
		"FILL_COLOR" => "rgba(255, 255, 255, 0)",
		"FILL_ALWAYS" => "N",
		"JPEG_OUTPUT" => "SET_Q",
		"JPEG_QUALITY" => "95",
		"PNG_QUALITY" => "85",
		"RESIZED_PATH" => "/upload/ucresizeimg/",
		"FILE_PREFIX" => "#INPUT_FILE_NAME#_",
		"UNIQUE_SALT" => "71831862040920861685494428288846 $arItem[IBLOCK_TYPE_ID] $arItem[IBLOCK_ID] $arItem[ID]",
		"CACHE_ENABLE" => "Y",
		"CACHE_INTERVAL" => "3600"
	),
false
);?><?endif?></p>
                                    <?endif?>
                                    <figcaption><?=$arItem["NAME"]?></figcaption>
                                </figure>
							<?if ($i <= 0) :?>
                            </a>
							<?else :?>
							</span>
							<?endif?>
                        </li>
                    <?endforeach?>
                </ul>
            </li>
        <?$i++; endforeach?>
    </ul>
</nav>
