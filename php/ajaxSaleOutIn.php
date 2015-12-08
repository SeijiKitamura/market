<?php
require_once("view.function.php");
require_once("html.function.php");
try{
 session_start();
 if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
  throw new exception("再度、ログインしてください");
  return false;
 }
 
 //引数チェック
 if(! preg_match("/^[0-9]+$/",$_GET["strcode"])){
  throw new exception("店番号を確認してください");
 }
 else{
  $strcode=$_GET["strcode"];
 }
 
 if($_GET["adnum"] && ! preg_match("/^[0-9]+$/",$_GET["adnum"])){
  throw new exception("チラシ番号を確認してください");
 }
 else{
  $adnum=$_GET["adnum"];
 }

 if(! preg_match("/^[0-9]+$/",$_GET["saletype"])){
  throw new exception("セールタイプを確認してください");
 }
 else{
  $saletype=$_GET["saletype"];
 }

 if(! $adnum && ! chkDate($_GET["saleday"])){
  throw new exception("販売日を確認してください");
 }
 else{
  $saleday=$_GET["saleday"];
 }

 if(! preg_match("/^[0-9]+$/",$_GET["jcode"])){
  throw new exception("JANコードを確認してください");
 }
 else{
  $jcode=$_GET["jcode"];
 }

 $db=new DB();
 //where句をセット
 $where =" strcode={$strcode}";
 $where.=" and saletype={$saletype}";
 if($adnum){
  $where.=" and adnum={$adnum}";
 }
 else{
  if($saletype==5||$saletype==6){
   $endday=date("Y-m-t",strtotime($saleday));
   $where.=" and saleday between '{$saleday}' and '{$endday}'";
  }
  else{
   $where.=" and saleday='{$saleday}'";
  }
 }
 $where.=" and jcode='{$jcode}'";
 
 //既存データのspecialflgをゲット
 $db->select="specialflg";
 $db->from=TABLE_PREFIX.JANSALE;
 $db->where=$where;
 $ary=$db->getArray();
 $specialflg=null;
 foreach($ary as $key=>$val){
  $specialflg=$val["specialflg"];
 }

 if($specialflg===null){
  throw new exception("データが存在しません");
 }
 
 //データ更新
 if($_GET["flg"]=="out"||$_GET["flg"]=="Out"||$_GET["flg"]=="OUT"){
  $specialflg+=9999;
  $db->updatecol=array("specialflg"=>$specialflg);
 }
 else{
  $specialflg-=9999;
  $db->updatecol=array("specialflg"=>$specialflg);
 }

 $db->from=TABLE_PREFIX.JANSALE;
 $db->where=$where;
 $db->update();
}
catch(Exception $e){
 wLog("error:".$mname." ".$e->getMessage());
 return false;
}
?>

