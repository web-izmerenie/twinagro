<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="contacts">
	<nav class="buttons">
		<ul>
			<li>
				<a
					href="/oprosnyy-list/"
					class="order_services_button call_form_button">
					Опросный лист</a>
			</li>
			<li>
				<a
					href="#call-me-later-form"
					class="call_me_button call_form_button">
					Заказать звонок</a>
			</li>
		</ul>
	</nav>

	<div class="call_me_later" id="call-me-later-form">
		<?$APPLICATION->IncludeFile(
			$APPLICATION->GetCurDir()."form.call_me_later.inc.php",
			Array(),
			Array("MODE" => "php", "SHOW_BORDER" => false)
		);?>
	</div>

	<?$APPLICATION->IncludeComponent("bitrix:news.list", "addresses", Array(
	"AJAX_MODE" => "N",	// Включить режим AJAX
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "14",	// Код информационного блока
		"NEWS_COUNT" => "10000",	// Количество новостей на странице
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "",	// Направление для второй сортировки новостей
		"FILTER_NAME" => "",	// Фильтр
		"FIELD_CODE" => "",	// Поля
		"PROPERTY_CODE" => array(	// Свойства
			0 => "NO_NAME",
		),
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"ACTIVE_DATE_FORMAT" => "",	// Формат показа даты
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"PAGER_TITLE" => "",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	),
	false
);?>

<!--
<a style="cursor:pointer" onclick="toggle_show('hideText')" >Реквизиты</a>
<p style="display: none;" id="hideText"> Юридический адрес: 344011, Россия, г. Ростов-на-Дону, ул. Варфоломеева, 150, офис 401
<br />
ОГРН 1116195011096
<br />
ИНН 6163110057
<br />
КПП 616401001
<br />
р/с 40702810652090003669
<br />
в ОАО &laquo;Юго-Западный банк Сбербанка России&raquo;, г. Ростов-на-Дону
<br />
БИК 046015602
<br />
к/сч 30101810600000000602
<br />
ген. директор Долгополов Михаил Александрович, действует на основании Устава
<br />
факс 8(863) 2011-840
<br />
тел. 8(863) 2011-850, 279-53-18, 279-53-19
<br />
e-mail: twinagro@yandex.ru
<br />
</p>
-->

</div>
