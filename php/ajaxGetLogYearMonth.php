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

 if($_GET["year"] && preg_match("/^[0-9]+$/",$_GET["year"])){
  $stryear=$_GET["year"];
 }
 else{
  $stryear="";
 }

 $data=array();
 $year=0;
 //ログディレクトリをゲット
 $logpath=realpath("..").LOG;
 
 foreach(glob($logpath."/access{$stryear}*.html") as $val){
  preg_match("/access([0-9]{4})([0-9]{2})\.html$/",$val,$match);
  if($year!=$match[1]){
   $data[]=array( "year" =>$match[1]
                 ,"month"=>$match[2]
                );
   $year=$match[1];
  }
  else{
   $flg=0;
   foreach($data as $key1=>$val1){
    if($val1["month"]==$match[2]){
     $flg=1;
    }
   }
   if(! $flg){
    $data[]=array( "year" =>$match[1]
                  ,"month"=>$match[2]
                 );
    }
  }
 }
 //JSON形式で返す
 echo json_encode($data);
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}


?>
