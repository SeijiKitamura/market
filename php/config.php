<?php
require_once("server.conf.php");

//---------------------------------------------------//
// DBEngin 選択
//---------------------------------------------------//
//define("DBENGIN","mysql");
define("DBENGIN","postgres");

//---------------------------------------------------//
// ディレクトリ名定数
//---------------------------------------------------//
define("IMG"     ,"/img"     ); //777
define("JS"      ,"/js"      ); //705
define("CSS"     ,"/css"     ); //705 
define("DATA"    ,"/data"    ); //705 
define("LOG"     ,"/log"     ); //707 
define("PHP"     ,"/php"     ); //705 
define("SKELETON","/skeleton"); //705 

//---------------------------------------------------//
// ファイル定数
//---------------------------------------------------//
define("LOGO"    ,".".IMG."/logo.jpg"   );
define("FAV"     ,".".IMG."/favicon.ico");
define("JQNAME"  ,".".JS."/jquery.js"   );
define("TOPIMAGE" ,".".IMG."/topimage.jpg");

//---------------------------------------------------//
// テーブル名定数
//---------------------------------------------------//
define("JANMAS" ,"janmas");
define("JANSALE","jansale");

//---------------------------------------------------//
// テーブル列名定数
//---------------------------------------------------//
 define("IDCOL","id"   ); //ID列
 define("IDATE","idate"); //作成日時
 define("CDATE","cdate"); //更新日時

 if(DBENGIN=="mysql"){
  define("IDSQL"," ".IDCOL." int auto_increment primary key");//MySQL
 }
 else if(DBENGIN=="postgres"){
  define("IDSQL"," ".IDCOL." serial not null primary key");//Postgres
 }
 define("IDATESQL"," ".IDATE." timestamp not null default current_timestamp");
 define("CDATESQL"," ".CDATE." timestamp null");


//---------------------------------------------------//
// パラメーター系
//---------------------------------------------------//
define("NEWLIST","-3days") ;
define("RANKLIMIT",5);
define("BROTHERLIMIT",4);
define("SITEHELP","");
define("SITEABOUT","");

//---------------------------------------------------//
// ページ情報
//---------------------------------------------------//
$PAGES=array(
            );

$PAGEARY=array( 
              );

$NAVI  =array(
              );

$MININAVI=array(
               );

//未使用
$INFO=array    (
               );

$SITECONTENTS=array(
                   );
//未使用
$BIGNAVI=array(
              );


//------------------------------------------------------------//
// テーブル情報(テーブル作成時に「id」列などが自動で付加される
// indexに数字をセットするとテーブル作成時にCreate Indexが実行される
//
//     "table_a"=>array( 
//       "col_a"=>array(  "type"   =>"[int|float|varchar(x)|date|etc..]"
//                       ,"null"   =>"[null | not null]"
//                       ,"default"=>"defalut value"
//                       ,"local"  =>"local column name"
//                       ,"index"  =>"[0-xx]"
//                     ) // colA
//                    ) // "table_a"
//
//------------------------------------------------------------//
$TABLES=array(
 JANSALE=>array(
     "saleday"   =>array("type"=>"date"   ,"null"=>"not null","defalut"=>"'1970/1/1'","local"=>"日付"          ,"index"=>"1")
   , "saletype"  =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"特売番号"      ,"index"=>"2")
   , "clscode"   =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"クラスコード"  ,"index"=>"3")
   , "jcode"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"'0'"       ,"local"=>"JANコード"     ,"index"=>"4")
   , "sname"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"商品名"        ,"index"=>"" )
   , "maker"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"メーカー"      ,"index"=>"" )
   , "tani"      =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"単位"          ,"index"=>"" )
   , "stdprice"  =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"通常売価"      ,"index"=>"" )
   , "price"     =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"売価"          ,"index"=>"" )
   , "yen"       =>array("type"=>"varchar","null"=>"not null","defalut"=>"'円'"      ,"local"=>"通貨単位"      ,"index"=>"" )
   , "comment"   =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"単位"          ,"index"=>"" )
   , "grpnum"    =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"特売グループ"  ,"index"=>"" )
   , "grpname"   =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"特売グループ名","index"=>"" )
   , "specialflg"=>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"目玉フラグ"    ,"index"=>"" )
   , "adnum"     =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"広告番号"      ,"index"=>"" )
             )
);//$TABLES

function wLog($comment){
 //ログディレクトリセット
 $LOGDIR=dirname(__FILE__)."/..".LOG;
 //ディレクトリ存在チェック
 if(!file_exists($LOGDIR)){
 echo "ログディレクトリが存在しません。".$LOGDIR;
  return false;
 }

 //ファイルパスセット
 $filepath=$LOGDIR."/".date("Ymd").".log";
 
 //ログコメントセット
 $c=date("Y-m-d H:i:s")." ".$comment."\n";
 
 //ファイル書き込み
 if(! $fp=fopen($filepath,"a")){
  echo "ログファイルが開けません。".$filepath;
  return false;
 }

 if(DEBUG && preg_match("/error:/",$c)) echo $c."<br>";

 fwrite($fp,$c);
 fclose($fp);
}

function showTables(){
 global $TABLES;
 foreach($TABLES as $tablename=>$rows){
  echo "<h2>".$tablename."</h2>";
  echo "<table><thead><tr>";
  echo "<th>列名</th>";
  echo "<th>日本語列名</th>";
  echo "<th>type</th>";
  echo "<th>null</th>";
  echo "<th>default</th>";
  echo "<th>index</th>";
  echo "</tr></thead><tbody>";
  foreach($rows as $fld=>$detail){
   echo "<tr>";
   echo "<td>".$fld."</td>";
   echo "<td>".$detail["local"]."</td>";
   echo "<td>".$detail["type"]."</td>";
   echo "<td>".$detail["null"]."</td>";
   echo "<td>".$detail["default"]."</td>";
   echo "<td>".$detail["index"]."</td>";
   echo "</tr>";
  }
  echo "</tbody></table>";
 }
}

?>
