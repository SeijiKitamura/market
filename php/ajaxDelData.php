<?php
require_once("view.function.php");
require_once("html.function.php");
session_start();
if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
 echo "再度、ログインしてください";
 return false;
}

try{
 //引数チェック
 if(! preg_match("/^[0-9]+$/",$_GET["strcode"])){
  throw new exception("店舗番号が数字ではありません");
 }

 if(! preg_match("/^[0-9]+$/",$_GET["saletype"])){
  throw new exception("セール番号が数字ではありません");
 }

 if($_GET["saletype"]==3|| $_GET["saletype"]==5){
  if(! preg_match("/^20[0-9]{2}$/",$_GET["nen"])){
   throw new exception("年が正しくありません");
  }

  if(! preg_match("/^[0-1]?[0-9]{1}$/",$_GET["tuki"])){
   throw new exception("月が正しくありません");
  }
 }
 else{
  if(! chkDate($_GET["saleday"])){
   throw new exception("日付が正しくありません");
  }
 }

 $strcode =$_GET["strcode"];
 $saletype=$_GET["saletype"];
 $saleday =$_GET["saleday"];
 $nen=$_GET["nen"];
 $tuki=$_GET["tuki"];

 $db=new DB();
 $db->from=TABLE_PREFIX.JANSALE;
 $db->where="strcode={$strcode} and saletype={$saletype}";
 if($saletype==3 || $saletype==5){
  $kaisi=date("Y-m-d",strtotime($nen."-".$tuki."-1"));
  $owari=date("Y-m-t",strtotime($nen."-".$tuki."-1"));

  $db->where.=" and saleday between '{$kaisi}' and '{$owari}'";
 }
 else{
  $db->where.=" and saleday='{$saleday}'";
 }

 $db->delete();
}
catch(Exception $e){
 wLog("error:".$mname." ".$e->getMessage());
 return false;
}
?>
