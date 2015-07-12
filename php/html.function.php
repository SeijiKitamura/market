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
// チラシ商品一覧表示
//-------------------------------------------------------//
function htmlContents($data){
 try{
  $mname="htmlContents(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //コメントスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemheader.html");
  $grp=file_get_contents($path);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemlist.html");
  $item=file_get_contents($path);

  //画像ディレクトリセット
  $imgdir=realpath(__DIR__."/..".IMG);

  $html="";
  $grpname="";
  $startday="";$endday="";
  foreach($data as $key=>$val){
   //リンク生成
   $link="saleitem.php?strcode={$val["strcode"]}&adnum={$val["adnum"]}&dpscode={$val["dpscode"]}&jcode={$val["jcode"]}&saletype={$val["saletype"]}";
   
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

//-------------------------------------------------------//
// 単品表示
//-------------------------------------------------------//
function htmlItem($data){
 try{
  $mname="htmlItem(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/item.html");
  $item=file_get_contents($path);
  
  //画像ディレクトリセット
  $imgdir=realpath(__DIR__."/..".IMG);

  $html="";
  foreach($data as $key=>$val){
   
   $i=$item;
   $replace="";
   
   //画像リスト(大サイズ)
   //;$imgpath=$imgdir."/".$val["clscode"]."/".$val["jcode"].".jpg";
   $imgpath=$imgdir."/".$val["jcode"]."*.jpg";
   foreach(glob($imgpath) as $filename){
    $f=basename($filename);
    $replace.="<div class='sp-slide'>";
    $replace.="<img src='.".IMG."/{$f}' alt='{$val["maker"]} {$val["sname"]} {$val["tani"]} {$val["price"]}{$val["yen"]} {$filename}' class='sp-image'>";
    $replace.="</div>";
   }
   $i=preg_replace("/<!--bigPhoto-->/",$replace,$i);

   //画像リスト(小サイズ)
   $replace="";
   foreach(glob($imgpath) as $filename){
    $f=basename($filename);
    $replace.="<img src='.".IMG."/{$f}' alt='{$val["maker"]} {$val["sname"]} {$val["tani"]} {$val["price"]}{$val["yen"]} {$filename}' class='sp-thumbnail'>";
   }
   $i=preg_replace("/<!--imgtag-->/",$replace,$i);

   
   if($val["saletype"]==0){
    //開始日
    $replace=date("Y年n月j日",strtotime($val["startday"]));
    $i=preg_replace("/<!--startday-->/",$replace,$i);

    //終了日
    if(strtotime($val["startday"])==strtotime($val["endday"])){
     $replace="限り";
    }
    else{
     $replace="から".date("Y年n月j日",strtotime($val["endday"]));
    }
    $i=preg_replace("/<!--endday-->/",$replace,$i);
   }

   if($val["saletype"]==1 || $val["saletype"]==2){
    //開始日
    $replace=date("Y年n月j日",strtotime($val["saleday"]));
    $i=preg_replace("/<!--startday-->/",$replace,$i);

    //終了日
    $replace="";
    $i=preg_replace("/<!--endday-->/",$replace,$i);
   }


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
    $replace=$val["stdprice"]."円のところ";
    $i=preg_replace("/<!--stdprice-->/",$replace,$i);
   }
   
   //コメント
   $replace=$val["comment"];
   $i=preg_replace("/<!--comment-->/",$replace,$i);
   
   //イベント名
   $replace=$val["grpname"];
   $i=preg_replace("/<!--grpname-->/",$replace,$i);

   $html.=$i;

  }

  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// メール商品、おすすめ商品一覧表示
//-------------------------------------------------------//
function htmlMailContents($data){
 try{
  $mname="htmlContents(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //コメントスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemheader.html");
  $grp=file_get_contents($path);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemlist.html");
  $item=file_get_contents($path);

  //画像ディレクトリセット
  $imgdir=realpath(__DIR__."/..".IMG);

  $html="";
  $saleday="";
  foreach($data as $key=>$val){
   //リンク生成
   $link="saleitem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}&jcode={$val["jcode"]}&saletype={$val["saletype"]}";
   
   //イベントタイトル
   if(strtotime($saleday)!=strtotime($val["saleday"])){
    if($val["saletype"]==1){
     $replace =date("n月j日",strtotime($val["saleday"]))."のメール商品";
    }
    elseif($val["saletype"]==2){
     $replace =date("n月j日",strtotime($val["saleday"]))."のおすすめ商品";
    }
    $title=preg_replace("/<!--grpname-->/",$replace,$grp);
    $html.=$title;
    $saleday=$val["saleday"];
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
//   if($val["stdprice"]){
//    $replace="通常{$val["stdprice"]}円のところ";
//    $i=preg_replace("/<!--stdprice-->/",$replace,$i);
//   }
   
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
