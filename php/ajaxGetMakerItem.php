<?php
//メーカー未登録商品一覧
require_once("view.function.php");
require_once("html.function.php");

try{
 //ログインチェック
 session_start();
 if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
  throw new exception("ログインしてください");
 }
 
 //引数チェック
 if($_GET["strcode"]){
  if(preg_match("/^[0-9]+$/",$_GET["strcode"])){
   $strcode=$_GET["strcode"];
  }
  else{
   $strcode=1;
  }
 }
 else{
  $strcode=1;
 }
 
 if($_GET["saleday"]){
  if(chkDate($_GET["saleday"])){
   $saleday=$_GET["saleday"];
  }
  else{
   $saleday=date("Y-m-d",strtotime("-1day"));
  }
 }
 else{
  $saleday=date("Y-m-d",strtotime("-1day"));
 }

 //データゲット
 $data=viewGetMakerNull($strcode,$saleday);
 foreach($data as $key=>$val){
  $html ="<tr>";
  $html.="<td>{$val["linname"]}</td>";
  $html.="<td>{$val["clsname"]}</td>";
  $html.="<td>{$val["jcode"]}</td>";
  $html.="<td>{$val["sname"]}</td>";
  $html.="<td>{$val["tani"]}</td>";
  $html.="<td>{$val["price"]}</td>";
  $html.="<td>{$val["firstsale"]}</td>";
  $html.="<td>{$val["lastsale"]}</td>";
  $html.="<tr>";
  echo $html;
 }

}
catch(Exception $e){
 wLog("error:".$mname." ".$e->getMessage());
 return false;
}
?>
