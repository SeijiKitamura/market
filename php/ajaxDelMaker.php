<?php
require_once("view.function.php");
require_once("html.function.php");
try{
 //引数チェック
 if($_GET["jcode"] && preg_match("/^[0-9]+$/",$_GET["jcode"])){
  $jcode=$_GET["jcode"];
 }
 else{
  throw new exception("企業コードを確認してください");
 }

 $db=new DB();
 //メーカーマスタ削除
 $db->from=TABLE_PREFIX.MAKERMAS;
 $db->where="jcode='{$jcode}'";
 $db->delete();

 //商品マスタクリア
 $db->updatecol=array("maker"=>"");
 $db->from=TABLE_PREFIX.JANMAS;
 $db->where="jcode like '{$jcode}%'";
 $db->update();
}
catch(Exception $e){
 wLog("error:".$mname." ".$e->getMessage());
 return false;
}
?>


