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


 //ログイン判定
 session_start();
 if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
  $loginflg=true;
 }

 //データ取得
 if($saletype==0){
  if(! $loginflg){
   $w=" t1.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  $itemlist=viewGetFlyersYearList($strcode,$w);
 }

 if($saletype==1||$saletype==2||$saletype==3||$saletype==5||$saletype==6||$saletype==7||$saletype==8||$saletype==9){
  if(! $loginflg){
   $w=" and t.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  $monthlist=viewGetMonthList($strcode,$saletype,$w);
  $yearlist=array();
  $year="";
  foreach($monthlist as $key=>$val){
   if($year!=$val["nen"]){
    $yearlist[]=array("year"=>$val["nen"]);
    $year=$val["nen"];
   }
  }
 }

 $html="";
 $html ="<select id='year'>";
 $html.="<option value='99'>選択..</option>";
 if($saletype==0){
  foreach($itemlist as $key=>$val){
   $html.="<option value='".$val["year"]."-01-01'>";
   $html.=$val["year"]."年(".$val["cnt"]."回発行)";
   $html.="</option>";
  }
 }

 if($saletype==1||$saletype==2||$saletype==3||$saletype==5||$saletype==6||$saletype==7||$saletype==8||$saletype==9){
  foreach($yearlist as $key=>$val){
   $html.="<option value='".$val["year"]."-01-01'>";
   $html.=$val["year"]."年";
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
