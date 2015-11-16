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
 else{
  $strcode =$_GET["strcode"];
 }

 if(! preg_match("/^[0-9]+$/",$_GET["saletype"])){
  throw new exception("セール番号が数字ではありません");
 }
 else{
  $saletype=$_GET["saletype"];
 }

 if($_GET["saleday"] && ! chkDate($_GET["saleday"])){
  throw new exception("日付が正しくありません");
 }
 else{
  $saleday =$_GET["saleday"];
 }

 if($_GET["nen"] && ! preg_match("/^20[0-9]{2}$/",$_GET["nen"])){
  throw new exception("年が正しくありません");
 }
 else{
  $nen=$_GET["nen"];
 }

 if($_GET["tuki"] && ! preg_match("/^[0-1]?[0-9]{1}$/",$_GET["tuki"])){
  throw new exception("月が正しくありません");
 }
 else{
  $tuki=$_GET["tuki"];
 }

 $db=new DB();
 $db->from=TABLE_PREFIX.JANSALE;
 $db->where="strcode={$strcode} and saletype={$saletype}";
 if($nen && $tuki){
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
