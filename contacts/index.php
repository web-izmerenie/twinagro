<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?> 
<div class="contacts"> 
  <div class="info"> 
    <address> <?$APPLICATION->IncludeFile("/index.map_address.inc.php", Array(), Array("MODE" => "html"));?> </address>
   
    <div class="call_me_later"> <a class="call_me_button" >Заказать звонок</a> <?$APPLICATION->IncludeFile(
                $APPLICATION->GetCurDir()."form.inc.php",
                Array(),
                Array("MODE" => "php", "SHOW_BORDER" => false)
            );?> </div>
   </div>
 
  <div class="interactive_map" data-zoom="16" data-coord-x="39.705383" data-coord-y="47.212353"></div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>