<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?><?
    if (array_key_exists('ajax', $_REQUEST)) :
        $json = array('status' => 'error');
        $json['error_title'] = GetMessage('ERROR');
        $json['error_messages'] = array();
        if (is_array($arResult['ERROR_MESSAGES'])) :
            $json['status'] = 'error';
            foreach ($arResult['ERROR_MESSAGES'] as $message) :
                $json['error_messages'][] = $message;
            endforeach;
        endif;
        $json['success_title'] = GetMessage('SUCCESS');
        $json['success_messages'] = array();
        if (is_array($arResult['SUCCESS_MESSAGES'])) :
            $json['status'] = 'success';
            foreach ($arResult['SUCCESS_MESSAGES'] as $message) :
                $json['success_messages'][] = $message;
            endforeach;
        endif;
        echo json_encode($json);
        return;
    endif;
?>
<?$uid = $arResult['FORM_UID']?>

<form method="post" action="<?=$arResult['POST_PATHNAME']
    ?>" class="advanced_form" id="advanced_form_<?=$uid?>">
    <dl class="hidden">
        <dd><input type="hidden" name="form_uid" value="<?=$uid?>" /></dd>
    </dl>

    <h3><?=GetMessage('HEADER')?></h3>
    <a class="close" title="<?=GetMessage('CLOSE')?>"></a>

    <?if (is_array($arResult['ERROR_MESSAGES'])) :?>
        <dl class="error">
            <dt><?=GetMessage('ERROR')?></dt>
            <?if ( ! empty($arResult['ERROR_MESSAGES'])) :?>
            <dd><ul>
                <?foreach ($arResult['ERROR_MESSAGES'] as $message) :?>
                <li><?=$message?></li>
                <?endforeach?>
            </ul></dd>
            <?endif?>
        </dl>
    <?endif?>

    <?if (is_array($arResult['SUCCESS_MESSAGES'])) :?>
        <dl class="success">
            <dt><?=GetMessage('SUCCESS')?></dt>
            <?if ( ! empty($arResult['SUCCESS_MESSAGES'])) :?>
            <dd><ul>
                <?foreach ($arResult['SUCCESS_MESSAGES'] as $message) :?>
                <li><?=$message?></li>
                <?endforeach?>
            </ul></dd>
            <?endif?>
        </dl>
    <?endif?>

    <div class="fields">
    <?if (!$arResult['FORM_HIDE']) :?>
        <?foreach ($arResult['FIELDS_LIST'] as $arItem) :?>
            <?$name = $arItem['CODE']?>
            <?$id = $arItem['CODE'] .'_'. $uid?>
            <?$title = $arItem['NAME']?>
            <?$required = ''?>
            <?$requiredTag = ''?>
            <?if ($arItem['IS_REQUIRED'] == 'Y') :?>
                <?$required = ' required="required"'?>
                <?$requiredTag = '<span class="required"></span>'?>
            <?endif?>

            <?if ($arItem['FIELD_TYPE'] == 'TEXT' || $arItem['FIELD_TYPE'] == 'NUMBER') :?>
                <dl class="text">
                    <dt><label for="<?=$id?>"><?=$title?><?=$requiredTag?></label></dt>
                    <dd><input type="text" name="<?=$name?>" id="<?=$id
                        ?>" value="<?=$arResult['POST_DATA'][$name]
                        ?>"<?=($name == 'subject') ? ' readonly="readonly"' : ''
                        ?><?=$required?> /><?
                        ?><?if ($name == 'subject') :?><?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "call_subjects",
                            Array(
                                "IBLOCK_TYPE" => "forms",
                                "IBLOCK_ID" => "2",
                                "NEWS_COUNT" => "",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "",
                                "SORT_ORDER2" => "",
                                "FILTER_NAME" => "",
                                "FIELD_CODE" => array(0=>"",1=>"",),
                                "PROPERTY_CODE" => array(0=>"subject",1=>"",),
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "N",
                                "AJAX_OPTION_HISTORY" => "N",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "36000000",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "N",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "",
                                "SET_TITLE" => "N",
                                "SET_STATUS_404" => "N",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "call_subjects",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "PAGER_TEMPLATE" => "",
                                "DISPLAY_TOP_PAGER" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "PAGER_TITLE" => "",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "",
                                "PAGER_SHOW_ALL" => "N",
                                "AJAX_OPTION_ADDITIONAL" => ""
                            )
                        );?><?endif?><?
                    ?></dd>
                </dl>
            <?elseif ($arItem['FIELD_TYPE'] == 'TEXTAREA') :?>
                <dl class="textarea">
                    <dt><label for="<?=$id?>"><?=$title?><?=$requiredTag?></label></dt>
                    <dd><textarea name="<?=$name?>" id="<?=$id
                        ?>"<?=$required
                        ?>><?=$arResult['POST_DATA'][$name]?></textarea></dd>
                </dl>
            <?elseif ($arItem['FIELD_TYPE'] == 'LIST') :?>
                <?$enum = ''?>
                <?foreach ($arItem['LIST_ENUM'] as $item) :?>
                    <?$selected = ''?>
                    <?if ($arResult['POST_DATA'][$name] == $item['XML_ID']) :?>
                        <?$selected = ' selected="selected"'?>
                    <?endif?>
                    <?ob_start()?>
                        <option value="<?=$item['XML_ID']?>"<?=$selected?>><?=$item['VALUE']?></option>
                    <?$enum .= ob_get_clean()?>
                <?endforeach?>

                <dl class="list">
                    <dt><label for="<?=$id?>"><?=$title?><?=$requiredTag?></label></dt>
                    <dd><select name="<?=$name?>" id="<?=$id?>"<?=$required?>><?=$enum?></select></dd>
                </dl>
            <?endif?>
        <?endforeach?>

        <?if ($arParams['USE_CAPTCHA'] == 'Y') :?>
        <dl class="captcha">
            <dt><label for="<?=$arResult['CAPTCHA']['INPUT_FIELD_NAME']
                ?>"><?=GetMessage('CAPTCHA')
                ?>:<span class="required"></span></label></dt>
            <dd><?=$arResult['CAPTCHA']['VIEW_HTML_CODE']
                ?><input type="text" name="<?=$arResult['CAPTCHA']['INPUT_FIELD_NAME']
                    ?>" value="" id="<?=$arResult['CAPTCHA']['INPUT_FIELD_NAME']
                    ?>" required="required" /></dd>
        </dl>
        <?endif?>

        <dl class="submit">
            <dt><?=GetMessage('SUBMIT_BUTTON')?></dt>
            <dd><input type="submit" value="<?=GetMessage('SUBMIT_BUTTON')?>" /></dd>
        </dl>
    <?endif?>
    </div>
</form>
