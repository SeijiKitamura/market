<?php
require_once("view.function.php");
require_once("html.function.php");

//引数チェック
if(! preg_match("/^[0-9]+$/",$_GET["strcode"])){
 echo "店舗番号が不正です".$_GET["strcode"];
 return false;
}
else{
 $strcode=$_GET["strcode"];
}

if(! preg_match("/^[0-9]+$/",$_GET["adnum"])){
 echo "チラシ番号が不正です".$_GET["adnum"];
 return false;
}
else{
 $adnum=$_GET["adnum"];
}

if($_GET["dpscode"] && !preg_match("/^[0-9]+$/",$_GET["dpscode"])){
 echo "メジャーが不正です".$_GET["dpscode"];
 return false;
}
else{
 $dpscode=$_GET["dpscode"];
}

if($_GET["saleday"] && ! chkDate($_GET["saleday"])){
 echo "日付が不正です".$_GET["saleday"];
 return false;
}
else{
 $saleday=$_GET["saleday"];
}

//データゲット
$data=viewGetFlyersItemDps($strcode,$adnum,$saleday,$dpscode);

//html表示
htmlContents($data);
?>
