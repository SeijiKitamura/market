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
 if(strlen($_GET["cname"])==0){
  throw new exception("正式名称が空欄です");
 }
 if(strlen($_GET["maker"])==0){
  throw new exception("略称が空欄です");
 }
 if(! preg_match("/^[0-9]+$/",$_GET["jcode"])){
  throw new exception("企業コードが数字ではありません");
 }
 
 $cname=$_GET["cname"];
 $maker=$_GET["maker"];
 $jcode=$_GET["jcode"];
 
 //DB登録
 $db=new DB();

 //メーカーマスタ
 $db->updatecol=array( "cname"=>$cname
                      ,"maker"=>$maker
                      ,"jcode"=>$jcode);
 $db->from=TABLE_PREFIX.MAKERMAS;
 $db->where="jcode='{$jcode}'";
 $db->update();

 //商品マスタ
 $db->updatecol=array("maker"=>$maker);
 $db->from=TABLE_PREFIX.JANMAS;
 $db->where="jcode like '{$jcode}%'";
 $db->update();
}
catch(Exception $e){
 wLog("error:".$mname." ".$e->getMessage());
 return false;
}
?>
