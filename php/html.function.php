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
  
  //タイトルスケルトン読み込み
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
   
   //チラシ
   if($val["saletype"]==0){
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
   }

   //メール、おすすめ
   if($val["saletype"]==1||$val["saletype"]==2){
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
    $replace="通常".$val["stdprice"]."円のところ";
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
  
  //タイトルスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemheader.html");
  $grp=file_get_contents($path);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/item.html");
  $item=file_get_contents($path);
  
  //画像ディレクトリセット
  $imgdir=realpath(__DIR__."/..".IMG);

  $html="";
  foreach($data as $key=>$val){
   if($val["saletype"]==0){
    if($startday!==$val["startday"] || $endday!==$val["endday"] ||$grpname!==$val["grpname"]){
     $replace ="広告の品 ";
     if(strtotime($val["startday"])==strtotime($val["endday"])){
      $replace.=date("n月j日",strtotime($val["startday"]))."限り ";
     }
     else{
      $replace.=date("n月j日",strtotime($val["startday"]))."から";
      $replace.=date("n月j日",strtotime($val["endday"]))."まで ";
     }
     $replace.=$val["grpname"];

     $title=preg_replace("/<!--grpname-->/",$replace,$grp);
     $html.=$title;
    }
   }

   if($val["saletype"]==1||$val["saletype"]==2){
    if(strtotime($saleday)!=strtotime($val["saleday"])){
     if($val["saletype"]==1){
      $replace =date("n月j日",strtotime($val["saleday"]))."のメール商品";
     }
     elseif($val["saletype"]==2){
      $replace =date("n月j日",strtotime($val["saleday"]))."のおすすめ商品";
     }
     $title=preg_replace("/<!--grpname-->/",$replace,$grp);
     $html.=$title;
    }
   }
   
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
// カレンダーアイテム表示
//-------------------------------------------------------//
function htmlCalendarItem($data){
 try{
  $mname="htmlCalendarItem(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //タイトルスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemheader.html");
  $grp=file_get_contents($path);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/calendaritem.html");
  $item=file_get_contents($path);

  $html="";

  foreach($data as $key=>$val){
   $i=$item;
   
   //タイトルヘッダー
   $replace =date("Y年m月d日",strtotime($val["saleday"]));
   $replace.="のお買得情報";
   $html.=preg_replace("/<!--grpname-->/",$replace,$grp);

   //メーカー
   $replace="本日限り".$val["maker"];
   $i=preg_replace("/<!--maker-->/",$replace,$i);
   
   //商品名
   $replace=$val["grpname"];
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
// カレンダーアイテム表示
//-------------------------------------------------------//
function htmlCalendar($data){
 try{
  $mname="htmlCalendar(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/calendar.html");
  $item=file_get_contents($path);

  $html=$item;

  foreach($data as $key=>$val){
   $nen= date("Y",strtotime($val["saleday"]));
   $tuki=date("m",strtotime($val["saleday"]));
   $matu=date("t",strtotime($val["saleday"]));
   break;
  }

  $replace="{$nen}年{$tuki}月のお買得情報";
  $html=preg_replace("/<!--hiduke-->/",$replace,$html);

  $tr="";
  for($hi=1;$hi<=$matu;$hi++){
   $kyo=strtotime("{$nen}-{$tuki}-{$hi}");
   $y=date("w",$kyo);

   //1日の曜日合わせ
   if($hi==1 && $y){
    $tr.="<tr>";
    for($i=0;$i<$y;$i++){
     $tr.="<td></td>";
    }
   }
   
   //日曜なら行を追加
   if(! $y){
    $tr.="<tr>";
   }

   //アイテム追加
   $tr.="<td>";
   $tr.="<span class='hi'>{$hi}</span>";
   foreach($data as $key=>$val){
    if(strtotime($val["saleday"])==$kyo){
     $tr.="<span class='dgrpname'>{$val["grpname"]}</span>";
     $tr.="<span class='dtani'>{$val["tani"]}</span>";
     $tr.="<span class='dprice'>{$val["price"]}</span>";
     $tr.="<span class='dyen'>{$val["yen"]}</span>";
     break;
    }
   }
   $tr.="</td>";


   //土曜日なら行終了
   if($y==6){
    $tr.="</tr>";
   }

  }

  $html=preg_replace("/<!--calendar-->/",$tr,$html);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// チラシ投函日リスト表示
//-------------------------------------------------------//
function htmlTirasiList($data){
 try{
  $mname="htmlTirasiList(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/table.html");
  $html=file_get_contents($path);

  //タイトルセット
  $replace="チラシリスト";
  $html=preg_replace("/<!--title-->/",$replace,$html);

  //列名セット
  $replace="チラシ番号";
  $html=preg_replace("/<!--col1-->/",$replace,$html);

  $replace="投函日";
  $html=preg_replace("/<!--col2-->/",$replace,$html);

  $replace="削除";
  $html=preg_replace("/<!--col3-->/",$replace,$html);
   
  //リスト作成
  $tr="";
  foreach($data as $key=>$val){
   $tr.="<tr>";
   $hiduke=date('Y年m月d日',strtotime($val["saleday"]));
   $tr.="<td>{$val["adnum"]}</td>";
   $tr.="<td>{$hiduke}</td>";
   $tr.="<td><span data-strcode={$val["strcode"]} data-saletype=0 data-adnum={$val["adnum"]}>削除</span></td>";
   $tr.="</tr>";
  }

  $html=preg_replace("/<!--list-->/",$tr,$html);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// メール投函日リスト表示
//-------------------------------------------------------//
function htmlMailList($data){
 try{
  $mname="htmlMailList(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/table.html");
  $html=file_get_contents($path);

  //タイトルセット
  $replace="メールリスト";
  $html=preg_replace("/<!--title-->/",$replace,$html);

  //列名セット
  $replace="日付";
  $html=preg_replace("/<!--col1-->/",$replace,$html);

  $replace="アイテム数";
  $html=preg_replace("/<!--col2-->/",$replace,$html);

  $replace="削除";
  $html=preg_replace("/<!--col3-->/",$replace,$html);
   
  //リスト作成
  $tr="";
  foreach($data as $key=>$val){
   $tr.="<tr>";
   $hiduke=date('Y年m月d日',strtotime($val["saleday"]));
   $tr.="<td>{$hiduke}</td>";
   $tr.="<td>{$val["itemcnt"]}</td>";
   $tr.="<td><span data-strcode={$val["strcode"]} data-saletype=1 data-saleday={$val["saleday"]}>削除</span></td>";
   $tr.="</tr>";
  }

  $html=preg_replace("/<!--list-->/",$tr,$html);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// カレンダーリスト表示
//-------------------------------------------------------//
function htmlCalendarList($data){
 try{
  $mname="htmlCalendarList(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //アイテムスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/table.html");
  $html=file_get_contents($path);

  //タイトルセット
  $replace="カレンダーリスト";
  $html=preg_replace("/<!--title-->/",$replace,$html);

  //列名セット
  $replace="年月";
  $html=preg_replace("/<!--col1-->/",$replace,$html);

  $replace="アイテム数";
  $html=preg_replace("/<!--col2-->/",$replace,$html);

  $replace="削除";
  $html=preg_replace("/<!--col3-->/",$replace,$html);
   
  //リスト作成
  $tr="";
  foreach($data as $key=>$val){
   $tr.="<tr>";
   $hiduke=$val["nen"]."年".$val["tuki"]."月";
   $tr.="<td>{$hiduke}</td>";
   $tr.="<td>{$val["itemcnt"]}</td>";
   $tr.="<td><span data-strcode={$val["strcode"]} data-saletype=3 data-year={$val["nen"]} date-month={$val["tuki"]}>削除</span></td>";
   $tr.="</tr>";
  }

  $html=preg_replace("/<!--list-->/",$tr,$html);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

?>
