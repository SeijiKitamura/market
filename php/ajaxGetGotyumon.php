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

if($_GET["year"] && ! preg_match("/^[0-9]+$/",$_GET["year"])){
 echo "年が不正です";
 return false;
}
else{
 $year=$_GET["year"];
}

if($_GET["month"] && ! preg_match("/^[0-9]+$/",$_GET["month"])){
 echo "月が不正です";
 return false;
}
else{
 $month=$_GET["month"];
}

if(! $_GET["saleday"] && $year && $month){
 $saleday=date("Y-m-d",strtotime($year."-".$month."-1"));
}

if($_GET["saleday"]){
 $saleday=$_GET["saleday"];
}

if($_GET["grpnum"]){
 $grpnum=$_GET["grpnum"];
}
else{
 $grpnum=0;
}

$items=viewGetGotyumonGrpItem($strcode,$saleday,$grpnum);

htmlContents($items);
?>

