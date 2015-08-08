<?php
require_once("php/html.function.php");
require_once("php/import.function.php");

echo "success";
$mname="updatejanmas.php";
try{
 $dname=dirname(__FILE__)."/data";
 $fname=JANMAS.".csv";
 $fpath=$dname."/".$fname;
 
 //ファイルの確認
 if(! file_exists($fpath)){
  throw new exception(JANMAS.".csvがありません");
 }

 //単品マスタ更新
 impFile2DB(JANMAS,$fpath);

 echo "success";

}
catch(Exception $e){
 wLog($mname." ".$e->getMessage());
}
?>
