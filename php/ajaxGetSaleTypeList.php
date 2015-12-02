<?php
require_once("view.function.php");
require_once("html.function.php");

try{
 $html="<select id='saletype'>";
 $html.="<option value='99'>選択...</option>";
 foreach($SALETYPE as $key=>$val){
  $html.="<option value='".$key."'>";
  $html.=$val;
  $html.="</option>";
 }
 $html.="</select>";
 echo $html;
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}
?>
