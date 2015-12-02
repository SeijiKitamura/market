<?php
require_once("view.function.php");
require_once("html.function.php");

try{
 //引数チェック
 if(preg_match("/^[0-9]+$/",$_GET["strcode"])){
  $strcode=$_GET["strcode"];
 }
 else{
  throw new exception ("店舗番号を確認してください".$_GET["strcode"]);
 }

 if(preg_match("/^[0-9]+$/",$_GET["saletype"])){
  $saletype=$_GET["saletype"];
 }
 else{
  throw new exception ("セール番号を確認してください".$_GET["saletype"]);
 }

 if(chkDate($_GET["saleday"])){
  $saleday=$_GET["saleday"];
 }
 else{
  throw new exception ("セール日を確認してください".$_GET["saleday"]);
 }

 //ログイン判定
 session_start();
 if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
  $loginflg=true;
 }

 if(! $loginflg){
  if($saletype==0){
   $w=" t1.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }

  if($saletype==1||$saletype==2||$saletype==3||$saletype==5||$saletype==6||$saletype==7||$saletype==8||$saletype==9){
   $w=" and t.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }

 }

 $html ="<select id='month'>";
 $html.="<option value='99'>選択..</option>";
 if($saletype==0){
  $itemlist=viewGetFlyersMonthList($strcode,$saleday,$w);
  foreach($itemlist as $key=>$val){
   $hiduke=date("Y-",strtotime($saleday)).$val["month"]."-01";
   $html.="<option value='".$hiduke."'>";
   $html.=$val["month"]."月(".$val["cnt"]."回発行)";
   $html.="</option>";
  }
 }

 if($saletype==1||$saletype==2||$saletype==3||$saletype==5||$saletype==6||$saletype==7||$saletype==8||$saletype==9){
  $itemlist=viewGetMonthList($strcode,$saletype,$w);
  foreach($itemlist as $key=>$val){
   $hiduke="{$val["nen"]}-{$val["tuki"]}-01";
   $html.="<option value='".$hiduke."'>";
   if($saletype==1||$saletype==2){
    $html.=$val["tuki"]."月(".$val["itemcnt"].")";
   }
   if($saletype==3||$saletype==5||$saletype==6||$saletype==7||$saletype==8||$saletype==9){
    $html.=$val["tuki"]."月";
   }

   $html.="</option>";
  }
 }

 $html.="</select>";
 echo $html;
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}
?>
