<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<div class="contacts">
  <div class="info">
    <address> <?$APPLICATION->IncludeFile("/index.map_address.inc.php", Array(), Array("MODE" => "html"));?> </address>

    <div class="call_me_later"> <a class="call_me_button call_form_button" >Заказать звонок</a> <?$APPLICATION->IncludeFile(
                $APPLICATION->GetCurDir()."form.inc.php",
                Array(),
                Array("MODE" => "php", "SHOW_BORDER" => false)
            );?> </div>
   </div>

  <p>
    <br />
   </p>

  <table cellspacing="1" cellpadding="1" width="100%" height="100%" border="0">
    <tbody>
      <tr><td> Липецк
          <br />
         Липецкая обл., Липецкий р-н, Подгорное с., ул. Москва, 36
          <br />
         т. +7 (495) 729-12-41
          <br />

          <br />
         </td><td>Ставрополь
          <br />
         Ставрополь, ул. Мира, 278д
          <br />
         т. (8652) 65-94-10
          <br />

          <br />
         </td></tr>

      <tr><td>Тамбов
          <br />
         Тамбов, ул. Студенецкая Набережная, 20
          <br />
         +7 (960) 670-04-13
          <br />

          <br />
         </td><td>Орел
          <br />
         Орел, ул. Ломоносова, 6, корп.4
          <br />
         т. +7 (920) 280-95-19
          <br />

          <br />
         </td></tr>

      <tr><td>Пенза
          <br />
         Пенза, ул. Суворова, 65/67
          <br />
         т. +7 (8412) 68-48-32
          <br />

          <br />
         </td><td></td></tr>
     </tbody>
   </table>
 <a style="cursor:pointer" onclick="toggle_show('hideText')" >Реквизиты</a>
  <p id="hideText" style="display: none;"> Юридический адрес: 344011, Россия, г. Ростов-на-Дону, ул. Варфоломеева, 150, офис 401
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

<script type="text/javascript">

function toggle_show(id) {

	document.getElementById(id).style.display = document.getElementById(id).style.display == 'none' ? 'block' : 'none';

}

</script>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
