<?php
require_once("view.function.php");
require_once("html.function.php");
try{
 //引数チェック
 $cname=null;
 if($_GET["cname"]){
  $cname=$_GET["cname"];
 }
 $data=viewGetMakerList($cname);

 foreach($data as $key=>$val){
  $html.="<tr>";
  $html.="<td><button data-jcode='{$val["jcode"]}'>削除</button></td>";
  $html.="<td>{$val["cname"]}</td>";
  $html.="<td>{$val["maker"]}</td>";
  $html.="<td>{$val["jcode"]}</td>";
  $html.="</tr>";
 }

 echo $html;
}
catch(Exception $e){
 wLog("error:".$mname." ".$e->getMessage());
 return false;
}
?>

