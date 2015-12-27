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
define("STRMAS" ,"strmas");
define("DPSMAS" ,"dpsmas");
define("LINMAS" ,"linmas");
define("CLSMAS" ,"clsmas");
define("JANMAS" ,"janmas");
define("JANSALE","jansale");
define("MAKERMAS","makermas");

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
define("SITEHELP","当店は青果、精肉、鮮魚、惣菜、お酒、タバコなどを扱う食品スーパーマーケットです。");
define("SITEABOUT","");

//---------------------------------------------------//
// セールタイプ
// (追加した場合はphp/ajaxGetSaleList.phpも見直すこと)
//---------------------------------------------------//
$SALETYPE=array(
                 0=>"チラシ"
                ,1=>"メール"
                ,2=>"おすすめ"
                ,3=>"カレンダー"
                ,5=>"ご予約"
                ,6=>"月間お買得品"
                ,7=>"ニュース"
                ,8=>"ギフト"
                ,9=>"早期ご予約"
               );
//---------------------------------------------------//
// ページ情報
//---------------------------------------------------//
$PAGES=array(
            );

$PAGEARY=array( 
              );

$NAVI  =array(
                     "チラシ"=>"tirasilist.php"
                    ,"メール"=>"maillist.php"
                    ,"ご予約"=>"goyoyakulist.php"
                    ,"月間"  =>"monthlist.php"
              );

$PCNAVI =array (
                     "チラシ"=>"tirasilist.php"
                    ,"メール"=>"maillist.php"
                    ,"ご予約"=>"goyoyakulist.php"
                    ,"月間"  =>"monthlist.php"
                    ,"キタムラとは?"=>"kodawari.php"
               );
$MININAVI=array(
                     "新卒採用"=>"sinsotu.php"
                    ,"会社概要"=>"gaiyo.php"
                    ,"最新ニュース"=>"newslist.php"
                    ,"アクセス"=>"map.php"
                    ,"お問い合せ"=>"contactus.php"
               );

$INFO=array    (
                 "会社概要"=>"gaiyo.php"
                ,"キタムラとは?"=>"kodawari.php"
                ,"募集事項"=>"bosyu.php"
                ,"新卒採用"=>"sinsotu.php"
                ,"このサイトについて"=>"siteabout.php"
                ,"プライバシーポリシー"=>"privacy.php"
                ,"お問い合せ"=>"contactus.php"
               );

$SITECONTENTS=array(
                     "チラシ"=>"tirasilist.php"
                    ,"メール会員"=>"maillist.php"
                    ,"ご予約商品"=>"goyoyakulist.php"
                    ,"月間お買得品"  =>"monthlist.php"
                    ,"新商品"  =>"newitemlist.php"
                    ,"カレンダー"  =>"calendarlist.php"
                    ,"最新ニュース"=>"newslist.php"
                    ,"商品検索"=>"searchlist.php"
                    ,"ギフト商品"  =>"giftlist.php"
                    ,"早期ご予約商品"=>"soukilist.php"
                    ,"商品について"=>"aboutitem.php"
                    ,"配達サービス"=>"haitatu.php"
                    ,"過去のセール商品"=>"salearchive.php"
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
  STRMAS =>array(
     "strcode"      =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"店舗番号"  ,"index"=>"1")
   , "strname"      =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"店舗名"    ,"index"=>"")
   , "straddress"   =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"住所"      ,"index"=>"")
   , "strtel"       =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"電話番号"  ,"index"=>"")
   , "strfax"       =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"FAX"       ,"index"=>"")
   , "stremail"     =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"Eメール"   ,"index"=>"")
   , "stropen"      =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"営業時間"  ,"index"=>"")
   , "strcomment1"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント1" ,"index"=>"")
   , "strcomment2"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント2" ,"index"=>"")
   , "strcomment3"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント3" ,"index"=>"")
   , "strcomment4"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント4" ,"index"=>"")
   , "strcomment5"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント5" ,"index"=>"")
   , "strcomment6"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント6" ,"index"=>"")
   , "strcomment7"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント7" ,"index"=>"")
   , "strcomment8"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント8" ,"index"=>"")
   , "strcomment9"  =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント9" ,"index"=>"")
   , "strcomment10" =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"コメント10","index"=>"")
  )
 ,DPSMAS =>array(
     "strcode"      =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"店舗番号","index"=>"1")
   , "dpscode"      =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"部門番号","index"=>"2")
   , "dpsname"      =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"部門名"  ,"index"=>"")
 )
 ,LINMAS =>array(
    "strcode"       =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"店舗番号"    ,"index"=>"1")
  , "lincode"       =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"部門番号"    ,"index"=>"2")
  , "linname"       =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"部門名"      ,"index"=>"")
  , "dpscode"       =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"メジャー番号","index"=>"3")
 )
 ,CLSMAS =>array(
    "strcode"       =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"店舗番号"    ,"index"=>"1")
  , "clscode"       =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"クラスコード","index"=>"2")
  , "clsname"       =>array("type"=>"varchar ","null"=>"not null","defalut"=>"''","local"=>"クラス名"    ,"index"=>"")
  , "lincode"       =>array("type"=>"int "    ,"null"=>"not null","defalut"=>"0" ,"local"=>"部門番号"    ,"index"=>"3")
 )
 ,JANMAS=>array(
     "strcode"   =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"店舗番号"      ,"index"=>"1")
   , "clscode"   =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"クラスコード"  ,"index"=>"2")
   , "jcode"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"'0'"       ,"local"=>"JANコード"     ,"index"=>"3")
   , "sname"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"商品名"        ,"index"=>"" )
   , "maker"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"メーカー"      ,"index"=>"" )
   , "tani"      =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"単位"          ,"index"=>"" )
   , "stdprice"  =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"通常売価"      ,"index"=>"" )
   , "price"     =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"売価"          ,"index"=>"" )
   , "comment"   =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"単位"          ,"index"=>"" )
   , "firstsale" =>array("type"=>"date"   ,"null"=>"not null","defalut"=>"'1970/1/1'","local"=>"登録日"        ,"index"=>"")
   , "lastsale"  =>array("type"=>"date"   ,"null"=>"not null","defalut"=>"'1970/1/1'","local"=>"最終販売日"    ,"index"=>"")
             )
 ,MAKERMAS =>array(
     "jcode"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"'0'"       ,"local"=>"JANコード"     ,"index"=>"1")
   , "cname"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"企業名"        ,"index"=>"2" )
   , "maker"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"''"        ,"local"=>"メーカー"      ,"index"=>"3" )
 )
 ,JANSALE=>array(
     "strcode"   =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"店舗番号"      ,"index"=>"1")
   , "saleday"   =>array("type"=>"date"   ,"null"=>"not null","defalut"=>"'1970/1/1'","local"=>"日付"          ,"index"=>"2")
   , "saletype"  =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"特売番号"      ,"index"=>"3")
   , "clscode"   =>array("type"=>"int "   ,"null"=>"not null","defalut"=>"0"         ,"local"=>"クラスコード"  ,"index"=>"4")
   , "jcode"     =>array("type"=>"varchar","null"=>"not null","defalut"=>"'0'"       ,"local"=>"JANコード"     ,"index"=>"5")
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

function aLog($comment){
 //ログディレクトリセット
 $LOGDIR=dirname(__FILE__)."/..".LOG;
 //ディレクトリ存在チェック
 if(!file_exists($LOGDIR)){
 echo "ログディレクトリが存在しません。".$LOGDIR;
  return false;
 }

 //ファイルパスセット
 $filepath=$LOGDIR."/access".date("Ymd").".log";
 
 //日時セット
 $c=date("Y-m-d H:i:s");
 
 //ファイル書き込み
 if(! $fp=fopen($filepath,"a")){
  echo "ログファイルが開けません。".$filepath;
  return false;
 }

 if(DEBUG && preg_match("/error:/",$c)) echo $c."<br>";

 if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
  session_start();
  $c.=" ".$_SERVER["REQUEST_URI"]." \"".str_replace(" ","",$comment)."\" ".$_SERVER["HTTP_REFERER"]." ".$_COOKIE["PHPSESSID"]."\n";
  fwrite($fp,$c);
 }
 fclose($fp);
}
$YOUBI=array("日","月","火","水","木","金","土");
//---------------------------------------------//
// 日付チェック関数
//---------------------------------------------//
// 以下の形式で渡された日付の正否をチェック
// YYYYMD   YYYYMMDD
// YYYY.M.D YYYY.MM.DD
// YYYY-M-D YYYY-MM-DD
// YYYY/M/D YYYY/MM/DD
//---------------------------------------------//

function chkDate($hiduke){
 $reg="/^(20[0-9]{2})[-\/\.]?([0-1]?[0-9]{1})[-\/\.]?([0-3]?[0-9]{1})$/";
 preg_match($reg,$hiduke,$match);
 if(! is_array($match)) return false;
 $moto=strtotime($match[1]."-".$match[2]."-".$match[3]);
 $saki=mktime(0,0,0,$match[2],$match[3],$match[1]);
 if($moto!=$saki) return false;
 return true;
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
