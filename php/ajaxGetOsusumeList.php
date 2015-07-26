<?php
require_once("view.function.php");
require_once("html.function.php");

//引数チェック
if(! preg_match("/^[0-9]+$/",$_GET["strcode"])){
 echo "店舗番号が不正です".$_GET["strcode"];
 return false;
}
else{
 $strcode=$_GET["strcode"];
}

//データゲット
$list=viewGetSaleList($strcode,2);

//html表示
htmlOsusumeList($list);

?>


