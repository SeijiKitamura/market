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
  throw new exception("店番号を確認してください");
 }

 if(! preg_match("/^[0-9]+$/",$_GET["saletype"])){
  throw new exception("セール番号を確認してください");
 }

 $strcode=$_GET["strcode"];
 $saletype=$_GET["saletype"];

 if($saletype==0){
  //adnumチェック
  if(! preg_match("/^[0-9]+$/",$_GET["adnum"])){
   throw new exception("広告番号を確認してください".$_GET["adnum"]);
  }
  $adnum=$_GET["adnum"];

  //掲載号まるごと削除
  if($_GET["saleday"]){
   $where="strcode={$strcode} and adnum={$adnum} and saletype={$saletype}";
  }

  //単品削除
  if($_GET["jcode"]){
   if(! preg_match("/^[0-9]+$/",$_GET["jcode"])){
    throw new exception("JANコードを確認してください".$_GET["jcode"]);
   }
   $jcode=$_GET["jcode"];
   $where="strcode={$strcode} and adnum={$adnum} and saletype={$saletype} and jcode='{$jcode}'";
  }
 }

 if($saletype==1||$saletype==2){
  //販売日チェック
  if(! chkDate($_GET["saleday"])){
   throw new exception("販売日を確認してください".$_GET["saleday"]);
  }
  $saleday=$_GET["saleday"];
  //掲載日まるごと削除
  if(! $_GET["jcode"]){
   $where="strcode={$strcode} and saletype={$saletype} and saleday='{$saleday}'";
  }

  //単品削除
  if($_GET["jcode"]){
   if(! preg_match("/^[0-9]+$/",$_GET["jcode"])){
    throw new exception("JANコードを確認してください".$_GET["jcode"]);
   }
   $jcode=$_GET["jcode"];
   $where="strcode={$strcode} and saletype={$saletype} and saleday='{$saleday}' and jcode='{$jcode}'";
  }
 }
 
 if($saletype==3){
  //日付チェック
  if(! chkDate($_GET["saleday"])){
   throw new exception("日付を確認してください".$_GET["saleday"]);
  }
  $saleday=$_GET["saleday"];
  
  //月ごと削除
  if($_GET["summry"]){
   $startday=date("Y-m-01",strtotime($saleday));
   $endday  =date("Y-m-t" ,strtotime($saleday));
   $where="strcode={$strcode} and saletype={$saletype} and saleday between '{$startday}' and '{$endday}'";
  }

  //日を削除
  if(! $_GET["summry"]){
   $where="strcode={$strcode} and saletype={$saletype} and saleday='{$saleday}'";
  }
 }

 if($saletype==5||$saletype==6||$saletype==8||$saletype==9){
  //月ごと削除
  if($_GET["summry"]){
   if(! chkDate($_GET["saleday"])){
    throw new exception("日付を確認してください".$_GET["saleday"]);
   }
   $saleday=$_GET["saleday"];
   $startday=date("Y-m-01",strtotime($saleday));
   $endday  =date("Y-m-t" ,strtotime($saleday));
   $where="strcode={$strcode} and saletype={$saletype} and saleday between '{$startday}' and '{$endday}'";
  }

  if($_GET["jcode"]){
   if(! preg_match("/^[0-9]+$/",$_GET["jcode"])){
    throw new exception("JANコードを確認してください".$_GET["jcode"]);
   }
   $jcode=$_GET["jcode"];
   if(! chkdate($_GET["startday"])){
    throw new exception("開始日を確認してください".$_GET["startday"]);
   }
   $startday=$_GET["startday"];
   if(! chkdate($_GET["endday"])){
    throw new exception("終了日を確認してください".$_GET["endday"]);
   }
   $endday=$_GET["endday"];

   $where="strcode={$strcode} and saletype={$saletype} and jcode='{$jcode}' and saleday between '{$startday}' and '{$endday}'";
  }
 }
 
 if($saletype==7){
  //月ごと削除
  if($_GET["summry"]){
   if(! chkDate($_GET["saleday"])){
    throw new exception("日付を確認してください".$_GET["saleday"]);
   }
   $saleday=$_GET["saleday"];
   $startday=date("Y-m-01",strtotime($saleday));
   $endday  =date("Y-m-t" ,strtotime($saleday));
   $where="strcode={$strcode} and saletype={$saletype} and saleday between '{$startday}' and '{$endday}'";
  }
  
  //日を削除
  if($_GET["newsid"]){
   if(! preg_match("/^[0-9]+$/",$_GET["newsid"])){
    throw new exception("ニュース番号を確認してください".$_GET["newsid"]);
   }
   $newsid=$_GET["newsid"];
   $where="strcode={$strcode} and id={$newsid} and saletype={$saletype}";
  }
 }
 
 $db=new DB();
 $db->from=TABLE_PREFIX.JANSALE;
 $db->where=$where;
 $db->delete();
}
catch(Exception $e){
 wLog("error:".$mname." ".$e->getMessage());
 return false;
}
?>
