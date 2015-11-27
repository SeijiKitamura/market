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


 //ログイン判定
 session_start();
 if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
  $loginflg=true;
 }

 if($loginflg){
  $w="";
 }
 else{
  $w=" saleday<='".date("Y-m-d",strtotime("-1days"))."'";
 }

 $data=viewGetAdnumList($strcode,$w);
 $itemlist=viewGetAdnumYearList($data);

 $html ="<select class='nenlist'>";
 foreach($itemlist as $key=>$val){
  $html.="<option value='".$val."'>";
  $html.=date("Y",strtotime($val))."年".date("m",strtotime($val))."月";
  $html.="</option>";
 }
 $html.="</select>";
 echo $html;
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}
?>
