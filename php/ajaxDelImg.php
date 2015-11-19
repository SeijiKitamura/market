<?php
require_once("config.php");
try{
 session_start();
 if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
  throw new exception("再度、ログインしてください");
 }

 
 //引数チェック
 if(! $_GET["imgpath"]){
  throw new exception("画像ファイル名が指定されていません");
 }

 //ファイル存在チェック
 $imgpath=realpath("../".$_GET["imgpath"]);
 if(! file_exists($imgpath)){
  throw new exception("画像ファイルが存在しません");
 }

 //ファイル削除
 if(! unlink($imgpath)){
  throw new exception("ファイル削除に失敗しました");
 }
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}
?>

