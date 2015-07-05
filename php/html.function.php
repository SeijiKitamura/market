<?php
require_once("db.class.php");

//-------------------------------------------------------//
// function スケルトン
//-------------------------------------------------------//

//function htmlXXXXXX(){
// try{
//  $mname="htmlXXXXXX(html.function.php) ";
//  $c="start ".$mname;wLog($c);
//  $html="";
//  echo $html;
//  $c="end ".$mname;wLog($c);
// }
// catch(Exception $e){
//  $c="error:".$mname.$e->getMessge();wLog($c);
// }
//}
//-------------------------------------------------------//


//-------------------------------------------------------//
//  ページヘッダーを表示
//-------------------------------------------------------//
function htmlHeader($title,$description=null){
 global $PAGEARY;
 global $NAVI;
 global $MININAVI;
 try{
  $mname="htmlHeader(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //現在ページ取得
  $nowpage=basename($_SERVER["PHP_SELF"]);

  //スケルトン読み込み
  $path=realpath("./").SKELETON."/header.html";
  $html=file_get_contents($path);
  
  //Googleクローラー
  $html=preg_replace("/<!--GOOGLEWEBMASTER-->/",GOOGLEWEBMASTER,$html);
  
  //タイトル
  $title.="|".CORPNAME;
  $html=preg_replace("/<!--title-->/",$title,$html);
  
  //Description 
  $description.=$PAGEARY[$nowpage]["description"];
  $html=preg_replace("/<!--description-->/",$description,$html);
  
  //キャッチワード
  $html=preg_replace("/<!--catchword-->/",CATCHWORD,$html);

  //ロゴ
  $logo=htmlLogo();
  $html=preg_replace("/<!--logo-->/",$logo,$html);
  
  //イベント（未対応）
  
  //会社名
  $html=preg_replace("/<!--corpname-->/",CORPNAME,$html);

  //会社住所
  $html=preg_replace("/<!--corpaddress-->/",CORPADDRESS,$html);
  
  //電話
  $html=preg_replace("/<!--corptel-->/",CORPTEL,$html);
  
  //FAX
  $html=preg_replace("/<!--corpfax-->/",CORPFAX,$html);
  
  //メールリンク
  $html=preg_replace("/<!--mailto-->/",MAILADDRESS,$html);

  //ログアウト
    
  //イベントバー
  $eventbar="";
  foreach($MININAVI as $key=>$val){
   $eventbar.="<li><a href='".$key."'";
   $eventbar.=">".$val."</a></li>";
  }
  $html=preg_replace("/<!--eventBar-->/",$eventbar,$html);
  
  //ナビゲーション
  $navibar="";
  $html=preg_replace("/<!--navibar-->/",$navibar,$html);

  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
//ロゴを返す（表示はしない）
//-------------------------------------------------------//
function htmlLogo(){
 try{
  $mname="htmlLogo(html.function.php) ";
  $c="start ".$mname;wLog($c);
  $html="";
  $html ="<a href='index.php'>";
  $html.="<img src='".LOGO."' alt='".CORPNAME." ".CATCHWORD."'>";
  $html.="</a>";
  $c="end ".$mname;wLog($c);
  return $html;
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// トップイメージを表示
//-------------------------------------------------------//
function htmlTopImage(){
 try{
  $mname="htmlTopImage(html.function.php) ";
  $c="start ".$mname;wLog($c);

  //スケルトン読み込み
  $path=realpath("./").SKELETON."/topimage.html";
  $html=file_get_contents($path);

  //トップイメージ
  $topimage="<img src='".TOPIMAGE."'>";
  $html=preg_replace("/<!--topimage-->/",$topimage,$html);
  
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// フッターを表示
//-------------------------------------------------------//
function htmlFooter(){
 global $NAVI;
 global $SITECONTENTS;
 try{
  $mname="htmlFooter(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //現在ページ取得
  $nowpage=basename($_SERVER["PHP_SELF"]);
  
  //スケルトン読み込み
  $path=realpath("./").SKELETON."/footer.html";
  $html=file_get_contents($path);

  //メールアドレス
  $html=preg_replace("/<!--mailto-->/",MAILADDRESS,$html);
  
  //ページ説明
  $sitehelp="このページは".CORPNAME."の";
  if($nowpage=="index.php"){
   $sitehelp.="トップページです。";
  }
  $sitehelp.=SITEHELP;
  $html=preg_replace("/<!--sitehelp-->/",$sitehelp,$html);

  //サイト説明
  $siteabout=SITEABOUT;
  $html=preg_replace("/<!--siteabout-->/",$siteabout,$html);

  //サイトコンテンツ($SITECONTENTS)
  $navibar="";
  foreach($SITECONTENTS as $key=>$val){
   $navibar.="<li><a href='".$key."'";
   $navibar.=">".$val."</a></li>";
  }
  $html=preg_replace("/<!--link01-->/",$navibar,$html);
  
  //コピーライト
  $replace="COPYRIGHT ".CORPNAME." ALL RIGHTS RESERVED";
  $html=preg_replace("/<!--copyright-->/",$replace,$html);

  $navibar="";
  $navibar.="<li><a href='index.php'><img src='".LOGO."'></a></li>";
  foreach($NAVI as $key=>$val){
   $navibar.="<li><a href='".$key."'";
   $navibar.=">".$val."</a></li>";
  }
  $html=preg_replace("/<!--shortnavi-->/",$navibar,$html);

  echo $html;

  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// 個別ページを表示
//-------------------------------------------------------//
function htmlContents($data){
 try{
  $mname="htmlContents(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //コメントスケルトン読み込み
  $path=realpath("./").SKELETON."/itemheader.html";
  $path=realpath(__DIR__."/..".SKELETON."/itemheader.html");
  $grp=file_get_contents($path);
  
  //アイテムスケルトン読み込み
  $path=realpath("./").SKELETON."/itemlist.html";
  $path=realpath(__DIR__."/..".SKELETON."/itemlist.html");
  $item=file_get_contents($path);

  //画像ディレクトリセット
  $imgdir=realpath(dirname(__FILE__)."/..".IMG);

  $html="";
  $grpname="";
  $startday="";$endday="";
  foreach($data as $key=>$val){
   //リンク生成
   $link="tirasiitem.php?adnum={$val["adnum"]}&jcode={$val["jcode"]}";
   
   //イベントタイトル
   if($startday!==$val["startday"] || $endday!==$val["endday"] ||$grpname!==$val["grpname"]){
    if(strtotime($val["startday"])==strtotime($val["endday"])){
     $replace =date("n月j日",strtotime($val["startday"]))."限り ";
    }
    else{
     $replace =date("n月j日",strtotime($val["startday"]))."から";
     $replace.=date("n月j日",strtotime($val["endday"]))."まで ";
    }
    $replace.=$val["grpname"];

    $title=preg_replace("/<!--grpname-->/",$replace,$grp);
    $html.=$title;

    $startday=$val["startday"];
    $endday  =$val["endday"];
    $grpname =$val["grpname"];
   }

   //アイテム
   $i=$item;
   
   //画像
   //;$imgpath=$imgdir."/".$val["clscode"]."/".$val["jcode"].".jpg";
   $imgpath=$imgdir."/".$val["jcode"].".jpg";
   if(file_exists($imgpath)){
    $replace ="<a href='{$link}'>";
    $replace.="<img src='.".IMG."/{$val["jcode"]}.jpg' alt='{$val["maker"]} {$val["sname"]} {$val["tani"]} {$val["price"]}{$val["yen"]}'>";
    $replace.="</a>";
    $i=preg_replace("/<!--imgtag-->/",$replace,$i);
   }
   
   //リンク
   $replace=$link;
   $i=preg_replace("/<!--link-->/",$replace,$i);

   //メーカー
   $replace=$val["maker"];
   $i=preg_replace("/<!--maker-->/",$replace,$i);
   
   //商品名
   $replace=$val["sname"];
   $i=preg_replace("/<!--sname-->/",$replace,$i);

   //単位
   $replace=$val["tani"];
   $i=preg_replace("/<!--tani-->/",$replace,$i);

   //売価
   $replace=$val["price"];
   $i=preg_replace("/<!--price-->/",$replace,$i);

   //通過単位
   $replace=$val["yen"];
   $i=preg_replace("/<!--yen-->/",$replace,$i);

   //通常売価
   if($val["stdprice"]){
    $replace=$val["stdprice"]."円";
    $i=preg_replace("/<!--stdprice-->/",$replace,$i);
   }
   
   //コメント
   $replace=$val["comment"];
   $i=preg_replace("/<!--comment-->/",$replace,$i);

   $html.=$i;
  }
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

?>
