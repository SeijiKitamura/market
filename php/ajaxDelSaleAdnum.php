<?php
//チラシデータ削除

require_once("view.function.php");
require_once("html.function.php");
try{
 //ログイン判定
 session_start();
 if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
  $loginflg=true;
 }
 else{
  throw new exception("削除できません。");
 }
 
 //引数判定
 if(! preg_match("/^[0-9]+$/",$_GET["strcode"])){
  throw new exception("店番号を確認してください".$_GET["strcode"]);
 }
 if(! preg_match("/^[0-9]+$/",$_GET["adnum"])){
  throw new exception("チラシ番号を確認してください".$_GET["adnum"]);
 }
 $strcode=$_GET["strcode"];
 $adnum=$_GET["adnum"];

 //チラシ番号から投函日をゲット
 $daylist=viewGetFlyersDayCls($strcode,$adnum);
 if($daylist){
  $saleday=$daylist[0]["saleday"];
 }
 
 //画像ディレクトリゲット
 $imgdir=realpath("../").IMG."/";

 if($saleday){
  //画像パスセット
  $imgpath=$imgdir.date("Ymd",strtotime($saleday))."*.jpg";
  //データ削除
  $db=new DB();
  $db->from=TABLE_PREFIX.JANSALE;
  $db->where="strcode={$strcode} and adnum={$adnum}";
  //$db->delete();

  //画像削除
  foreach(glob($imgpath) as $val){
   //unlink($val);
  }
 }
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}
?>

