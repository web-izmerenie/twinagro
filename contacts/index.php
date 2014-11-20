<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?> 
<div class="contacts"> 
  <div class="info"> 
    <address> <?$APPLICATION->IncludeFile("/index.map_address.inc.php", Array(), Array("MODE" => "html"));?> </address>
   
    <div class="call_me_later"> <a class="call_me_button call_form_button" >Заказать звонок</a> <?$APPLICATION->IncludeFile(
                $APPLICATION->GetCurDir()."form.call_me_later.inc.php",
                Array(),
                Array("MODE" => "php", "SHOW_BORDER" => false)
            );?> </div>
   </div>
 	 
  <div class="order_services"> <a href="/oprosnyy-list/" class="order_services_button call_form_button" >Опросный лист</a> </div>
 
  <p> 
    <br />
   </p>
 
  <table width="100%" height="100%" cellspacing="1" cellpadding="1" border="0" style="border-collapse: collapse;"> 
    <tbody> 
      <tr><td> Представительство в Липецкой обл. 
          <br />
         Адрес: 398532, Липецкая обл., Липецкий р-н, с.Подгорное с., ул. Москва, 36 
          <br />
         Телефон: +7 (495) 729-12-41 
          <br />
         E-mail: <a href="mailto:lipeck@twinagro.ru" >lipeck@twinagro.ru</a> </td><td>Представительство в г. Ставрополь 
          <br />
         Адрес:355003, г.Ставрополь, ул. Мира, 278д 
          <br />
         Телефон: +7 (8652) 65-94-10 
          <br />
         E-mail: <a href="mailto:stavropol@twinagro.ru" >stavropol@twinagro.ru</a> </td></tr>
     
      <tr><td> 
          <br />
         Представительство в г. Тамбов 
          <br />
         Адрес: 392016, г.Тамбов, ул. Студенецкая Набережная, 20 
          <br />
         Телефон: +7 (960) 670-04-13 
          <br />
         E-mail: <a href="mailto:tambov@twinagro.ru" >tambov@twinagro.ru</a> 
          <br />
         
          <br />
         </td><td>Представительство в г. Орел 
          <br />
         Адрес: 302040, г.Орел, ул. Ломоносова, 6, корп.4 
          <br />
         Телефон: +7 (920) 280-95-19 
          <br />
         E-mail: <a href="mailto:orel@twinagro.ru" >orel@twinagro.ru</a> 
          <br />
         
          <br />
         </td></tr>
     
      <tr><td> Представительство в г. Пенза 
          <br />
         Адрес: 440001, г. Пенза, ул. Суворова, 65/67 
          <br />
         Телефон: +7 (8412) 68-48-32 
          <br />
         E-mail:<a href="mailto:penza@twinagro" > penza@twinagro.ru</a> 
          <br />
         
          <br />
         		 </td> 		 <td>Северо-Западное представительство 
          <br />
         <span data-params="address=г.Санкт-Петербург, Яковлевский пер., д.2, лит. А, оф.28" data-action="map-up.showAddress" class="js-extracted-address daria-action mail-message-map-link">Адрес: </span><span data-params="address=г.Санкт-Петербург, Яковлевский пер., д.2, лит. А, оф.28" data-action="map-up.showAddress" class="js-extracted-address daria-action mail-message-map-link">196105, г.Санкт-Петербург, Яковлевский пер., д.2, лит. А, <span class="mail-message-map-nobreak">оф.28<span class="mail-message-map-link-icon icon"></span></span></span> 
          <br />
         Телефоны: +7(812) <span><span class="wmi-callto">411-40-28</span></span>, +7(931) <span><span class="wmi-callto">221-78-58 
              <br />
             </span></span>E-mail: <a href="mailto:spb@twinagro.ru" >spb@twinagro.ru</a> 
          <br />
         </td></tr>
     </tbody>
   </table>
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
 
<script type="text/javascript">

function toggle_show(id) {

	document.getElementById(id).style.display = document.getElementById(id).style.display == 'none' ? 'block' : 'none';

}

</script>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>