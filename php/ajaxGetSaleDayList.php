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

 $w="";

 $html ="<select id='day'>";
 $html.="<option value='99'>選択..</option>";
 if($saletype==0){
  if(! $loginflg){
   $w.=" t1.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  $itemlist=viewGetFlyersDayList2($strcode,$saleday,$w);
  foreach($itemlist as $key=>$val){
   $html.="<option value='".$val["saleday"]."'>";
   $html.=date("m月d日",strtotime($val["saleday"]))."(".$val["itemcnt"]."アイテム)";
   $html.="</option>";
  }
 }

 if($saletype==1||$saletype==2){
  if(! $loginflg){
   $w.=" and t.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  //開始日と終了日をセット
  $startday=date("Y-m-01",strtotime($saleday));
  $endday  =date("Y-m-t" ,strtotime($saleday));
  $w.=" and t.saleday between '{$startday}' and '{$endday}' ";
  $itemlist=viewGetSaleList($strcode,$saletype,$w);
  foreach($itemlist as $key=>$val){
   $html.="<option value='".$val["saleday"]."'>";
   $html.=date("m月d日",strtotime($val["saleday"]))."(".$val["itemcnt"]."アイテム)";
   $html.="</option>";
  }
 }
 $html.="</select>";

 if($saletype==3||$saletype==5||$saletype==7||$saletype==6||$saletype==8||$saletype==9){
  $html="";
 }
 echo $html;
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}
?>

