<?php
require_once("html.function.php");
require_once("view.function.php");
//店舗番号
if(! $_GET["strcode"]) $strcode=1;
else{
 $strcode=$_GET["strcode"];
}

if(! $_GET["year"]){
 $year=date("Y");
}
elseif(! preg_match("/^[0-9]+$/",$_GET["year"])){
 echo "年が不正です";
 return false;
}
else{
 $year=$_GET["year"];
}

if(! $_GET["month"]){
 $year=date("m");
}
elseif(! preg_match("/^[0-9]+$/",$_GET["month"])){
 echo "月が不正です";
 return false;
}
else{
 $month=$_GET["month"];
}

$saleday=date("Y-m-d",strtotime("{$year}-{$month}-1"));
$grplist=viewGetGroupList($strcode,5,$saleday);

if($grplist){
 foreach($grplist as $key=>$val){
  echo "<li data-strcode={$strcode} data-saleday={$saleday} data-grpnum={$val["grpnum"]}>{$val["grpname"]}</li>";
 }
}

?>

