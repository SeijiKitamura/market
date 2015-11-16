<?php
require_once("view.function.php");
require_once("html.function.php");

//引数
//strcode  店番       必須
//saletype セール番号 必須

//引数チェック
if(! preg_match("/^[0-9]+$/",$_GET["strcode"])){
 echo "店舗番号が不正です".$_GET["strcode"];
 return false;
}
else{
 $strcode=$_GET["strcode"];
}

if(! preg_match("/^[0-9]+$/",$_GET["saletype"])){
 echo "セールタイプが不正です".$_GET["saletype"];
 return false;
}
else{
 $saletype=$_GET["saletype"];
}

if($_GET["saleday"] && ! chkDate($_GET["saleday"])){
 echo "日付が不正です".$_GET["saleday"];
 return false;
}
else{
 $saleday=$_GET["saleday"];
}

//セールタイプごとに表示するデータを日別か月別か分ける
switch($saletype){
 //チラシ別
 case 0:
  $data=viewGetAdnum($strcode,null);
  break;
 //日別データ
 case 1:
 case 2:
 case 7:
  $data=viewGetSaleList($strcode,$saletype);
  break;
 //月別データ
 case 3:
 case 5:
 case 6:
 case 8:
 case 9:
  $data=viewGetMonthList($strcode,$saletype);
  break;
}

htmlSaleList($data,$SALETYPE[$saletype]);
?>

