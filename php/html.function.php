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
// カレンダーリスト表示
//-------------------------------------------------------//
function htmlCalendarList2($data){
 try{
  $mname="htmlCalendarList2(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //カレンダースケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/calendarlist.html");
  $item=file_get_contents($path);

  $html="";

  foreach($data as $key=>$val){
   //スケルトン代入
   $i=$item;

   //リンク
   $replace="calendaritem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}";
   $i=preg_replace("/<!--link-->/",$replace,$i);

   //月
   $replace=date("m",strtotime($val["saleday"]));
   $i=preg_replace("/<!--month-->/",$replace,$i);
   
   //日
   $replace=date("d",strtotime($val["saleday"]));
   $i=preg_replace("/<!--day-->/",$replace,$i);
   
   //グループ
   $replace=$val["grpname"];
   $i=preg_replace("/<!--grpname-->/",$replace,$i);
   
   //商品名
   $replace=$val["sname"];
   $i=preg_replace("/<!--sname-->/",$replace,$i);
   
   //単位
   $replace=$val["tani"];
   $i=preg_replace("/<!--tani-->/",$replace,$i);

   //売価
   $replace=$val["price"];
   $i=preg_replace("/<!--price-->/",$replace,$i);

   //通貨単位
   $replace=$val["yen"];
   $i=preg_replace("/<!--yen-->/",$replace,$i);

   $html.=$i;

  }//foreach($data as $key=>$val){

  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}


//-------------------------------------------------------//
// カレンダーテーブル表示
//-------------------------------------------------------//
function htmlCalendarTable($data){
 try{
  $mname="htmlCalendarTable(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //イベントスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/newstable.html");
  $html=file_get_contents($path);

  $replace="";
  foreach($data as $key=>$val){
   $link="<a href='calendaritem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}'>";
   $replace.="<tr>";
   $replace.="<td>".$link.date("m月d日",strtotime($val["saleday"]))."</a></td>";
   $replace.="<td>".$link;
   $replace.="{$val["grpname"]} {$val["tani"]} {$val["price"]}{$val["yen"]}</td>";
   $replace.="</a></tr>";
  }

  $html=preg_replace("/<!--event-->/",$replace,$html);
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
 global $INFO;
 global $SITECONTENTS;
 try{
  $mname="htmlFooter(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //現在ページ取得
  $nowpage=basename($_SERVER["PHP_SELF"]);
  
  //スケルトン読み込み
  $path=realpath("./").SKELETON."/footer.html";
  $html=file_get_contents($path);

  //CorpInfo
  $replace="";
  $replace.="<li>".CORPNAME."</li>";
  $replace.="<li>".CORPADDRESS."</li>";
  $replace.="<li>".CORPTEL." ".CORPFAX."</li>";
  $replace.="<li>".TEIKYUBI." ".EIGYOJIKAN."</li>";
  $replace.="<li>最寄駅:".STATION."</li>";
  $replace.="<li><a href='map.php'>アクセス</a></li>";

  $html=preg_replace("/<!--CorpInfo-->/",$replace,$html);

  //Gaiyo
  $replace="";
  foreach($INFO as $key=>$val){
   $replace.="<li><a href='{$val}'>{$key}</a></li>";
  }
  $html=preg_replace("/<!--Gaiyo-->/",$replace,$html);
  
  //Contents
  $replace="";
  foreach($SITECONTENTS as $key=>$val){
   $replace.="<li><a href='{$val}'>{$key}</a></li>";
  }
  $html=preg_replace("/<!--Contents-->/",$replace,$html);
  echo $html;

  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
//  ページヘッダーを表示
//-------------------------------------------------------//
function htmlHeader($title,$description=null){
 global $PAGEARY;
 global $NAVI;
 global $PCNAVI;
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
  $description=preg_replace("/\n/","",$description);
  $html=preg_replace("/<!--description-->/",$description,$html);
  
//  //キャッチワード
//  $html=preg_replace("/<!--catchword-->/",CATCHWORD,$html);
//
//  //ロゴ
  $logo=htmlLogo();
  $html=preg_replace("/<!--logo-->/",$logo,$html);
//  
//  //イベント（未対応）
//  
//  //会社名
//  $html=preg_replace("/<!--corpname-->/",CORPNAME,$html);
//
//  //会社住所
//  $html=preg_replace("/<!--corpaddress-->/",CORPADDRESS,$html);
//  
//  //電話
//  $html=preg_replace("/<!--corptel-->/",CORPTEL,$html);
//  
//  //FAX
//  $html=preg_replace("/<!--corpfax-->/",CORPFAX,$html);
//  
//  //メールリンク
//  $html=preg_replace("/<!--mailto-->/",MAILADDRESS,$html);
//
//  //ソーシャル
//  $html=preg_replace("/<!--TWITTER-->/",TWITTER,$html);
//  $html=preg_replace("/<!--LINE-->/",LINE,$html);
//  
  
  //ミニナビ
  $eventbar="";
  foreach($MININAVI as $key=>$val){
   $eventbar.="<li><a href='".$val."'";
   $eventbar.=">".$key."</a></li>";
  }
  $html=preg_replace("/<!--mininavi-->/",$eventbar,$html);
  
  //ナビ
  $eventbar="";
  foreach($PCNAVI as $key=>$val){
   $eventbar.="<li><a href='".$val."'";
   $eventbar.=">".$key."</a></li>";
  }
  $html=preg_replace("/<!--navi-->/",$eventbar,$html);
  
  aLog($title);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// アイテムリスト表示
//-------------------------------------------------------//
function htmlItemList($data){
 try{
  $mname="htmlItemList(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //リストスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemlist.html");
  $item=file_get_contents($path);
  
  //画像ディレクトリセット
  $imgdir=realpath(__DIR__."/..".IMG);

  $html="";
  $grpname="";
  $startday="";$endday="";
  foreach($data as $key=>$val){
   //スケルトン代入
   $i=$item;
   
   //リンク
   if($val["saletype"]===0){
    $replace="tirasiitem.php?strcode={$val["strcode"]}&saleday={$val["startday"]}&jcode={$val["jcode"]}&adnum={$val["adnum"]}";
   }

   if($val["saletype"]==1){
    $replace="mailitem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}&jcode={$val["jcode"]}";
   }

   if($val["saletype"]==2){
    $replace="test2.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}&jcode={$val["jcode"]}";
   }

   if($val["saletype"]==5){
    $replace="goyoyakuitem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}&jcode={$val["jcode"]}";
   }

   if($val["saletype"]==6){
    $replace="monthitem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}&jcode={$val["jcode"]}";
   }

   if($val["saletype"]==8){
    $replace="giftitem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}&jcode={$val["jcode"]}";
   }

   if($val["saletype"]==9){
    $replace="soukiitem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}&jcode={$val["jcode"]}";
   }

   if($val["saletype"]===null){
    $replace="item.php?strcode={$val["strcode"]}&jcode={$val["jcode"]}";
   }

   $i=preg_replace("/<!--link-->/",$replace,$i);
    
   //画像
   $imgpath=$imgdir."/".$val["jcode"].".jpg";
   if(file_exists($imgpath)){
    //$replace ="<a href='{$link}'>";
    $replace="";
    $replace.="<img src='.".IMG."/{$val["jcode"]}.jpg' alt='{$val["maker"]} {$val["sname"]} {$val["tani"]} {$val["price"]}{$val["yen"]}'>";
    //$replace.="</a>";
    $i=preg_replace("/<!--imgtag-->/",$replace,$i);
   }
   elseif($val["saletype"]===null){
    //商品マスタ画像なしは処理を飛ばす
    continue;
   }

   //終了日
   if($val["saletype"]===0){
    $replace=date("m月d日",strtotime($val["endday"]));
    if(strtotime($val["startday"])===strtotime($val["endday"])){
     $replace.="限り";
    }
    else{
     $replace.="まで";
    }
   }
   else{
    $replace=date("m月d日",strtotime($val["saleday"]));
    $replace="";
   }

   $i=preg_replace("/<!--endday-->/",$replace,$i);
   
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
   if($val["price"]){
    if($val["specialflg"]>=9999){
     $replace="<del>".$val["price"]."</del>";
    }
    else{
     $replace=$val["price"];
    }
    $i=preg_replace("/<!--price-->/",$replace,$i);

    //通貨単位
    $replace=$val["yen"];
    if($val["saletype"]===null){
     $replace="円";
    }
    $i=preg_replace("/<!--yen-->/",$replace,$i);
   }

   $html.=$i;
  }//foreach($data as $key=>$val){

  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// 単品履歴(日別)
//-------------------------------------------------------//
function htmlItemDayTable($data){
 try{
  $mname="htmlItemDayTable(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //アイテムテーブルスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemtable2.html");
  $item=file_get_contents($path);

  $html="";
  $i="";
  foreach($data as $key=>$val){
   $i.="<tr>";
   $i.="<td>".date("y年m月d日",strtotime($val["saleday"]))."</td>";
   $i.="<td>".$val["tani"]."</td>";
   $i.="<td>".$val["price"].$val["yen"]."</td>";
   $i.="<td>".$val["comment"]."</td>";
   $i.="</tr>";
  }
  $html=preg_replace("/<!--itemdata-->/",$i,$item);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// 単品履歴(月別)
//-------------------------------------------------------//
function htmlItemMonthTable($data){
 try{
  $mname="htmlItemMonthTable(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //アイテムテーブルスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemtable2.html");
  $item=file_get_contents($path);

  $html="";
  $i="";
  $m="";
  foreach($data as $key=>$val){
   if(date("Y-m",strtotime($val["saleday"]))!==$m){
    $i.="<tr>";
    $i.="<td>".date("y年m月",strtotime($val["saleday"]))."</td>";
    $i.="<td>".$val["tani"]."</td>";
    $i.="<td>".$val["price"].$val["yen"]."</td>";
    $i.="<td>".$val["comment"]."</td>";
    $i.="</tr>";
    $m=date("Y-m",strtotime($val["saleday"]));
   }
  }
  $html=preg_replace("/<!--itemdata-->/",$i,$item);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// 単品販売履歴(日別)
//-------------------------------------------------------//
function htmlItemDayResult($data){
 global $YOUBI;
 try{
  $mname="htmlItemDayResult(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //アイテムテーブルスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemtable3.html");
  $item=file_get_contents($path);

  $html="";
  $i="";
  $saleitem=0;
  $saleamt =0;
  $disitem=0;
  $disamt =0;
  $dispitem=0;
  $dispamt =0;
  foreach($data as $key=>$val){
   $saleday =date("Y年m月d日",strtotime($val["saleday"]));
   $saleday.="(".$YOUBI[date("w",strtotime($val["saleday"]))].")";
   $i.="<tr>";
   $i.="<td class='right'>{$saleday}</td>";
   $i.="<td class='right'>".number_format($val["saleitem"])."</td>";
   $i.="<td class='right'>".number_format($val["saleamt"])."</td>";
   $i.="<td class='right'>".number_format($val["disitem"])."</td>";
   $i.="<td class='right'>".number_format($val["disamt"])."</td>";
   $i.="<td class='right'>".number_format($val["dispitem"])."</td>";
   $i.="<td class='right'>".number_format($val["dispamt"])."</td>";
   $i.="</tr>";
   $saleitem+=$val["saleitem"];
   $saleamt +=$val["saleamt"];
   $disitem+=$val["saleitem"];
   $disamt +=$val["saleamt"];
   $dispitem+=$val["saleitem"];
   $dispamt +=$val["saleamt"];
  }
  $i.="<tr>";
  $i.="<td>合計</td>";
  $i.="<td class='right'>".number_format($saleitem)."</td>";
  $i.="<td class='right'>".number_format($saleamt)."</td>";
  $i.="<td class='right'>".number_format($disitem)."</td>";
  $i.="<td class='right'>".number_format($disamt)."</td>";
  $i.="<td class='right'>".number_format($dispitem)."</td>";
  $i.="<td class='right'>".number_format($dispamt)."</td>";
  $i.="</tr>";

  $html=preg_replace("/<!--itemdata-->/",$i,$item);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// 単品販売履歴(月別)
//-------------------------------------------------------//
function htmlItemMonthResult($data){
 global $YOUBI;
 try{
  $mname="htmlItemMonthResult(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //アイテムテーブルスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemtable4.html");
  $item=file_get_contents($path);

  $html="";
  $i="";
  $saleitem=0;
  $saleamt =0;
  $disitem=0;
  $disamt =0;
  $dispitem=0;
  $dispamt =0;
  foreach($data as $key=>$val){
   $saleday =$val["nen"]."年".$val["tuki"]."月";
   $i.="<tr>";
   $i.="<td class='right'>{$saleday}</td>";
   $i.="<td class='right'>".number_format($val["saleitem"])."</td>";
   $i.="<td class='right'>".number_format($val["saleamt"])."</td>";
   $i.="<td class='right'>".number_format($val["disitem"])."</td>";
   $i.="<td class='right'>".number_format($val["disamt"])."</td>";
   $i.="<td class='right'>".number_format($val["dispitem"])."</td>";
   $i.="<td class='right'>".number_format($val["dispamt"])."</td>";
   $i.="</tr>";
   $saleitem+=$val["saleitem"];
   $saleamt +=$val["saleamt"];
   $disitem+=$val["saleitem"];
   $disamt +=$val["saleamt"];
   $dispitem+=$val["saleitem"];
   $dispamt +=$val["saleamt"];
  }
  $i.="<tr>";
  $i.="<td>合計</td>";
  $i.="<td class='right'>".number_format($saleitem)."</td>";
  $i.="<td class='right'>".number_format($saleamt)."</td>";
  $i.="<td class='right'>".number_format($disitem)."</td>";
  $i.="<td class='right'>".number_format($disamt)."</td>";
  $i.="<td class='right'>".number_format($dispitem)."</td>";
  $i.="<td class='right'>".number_format($dispamt)."</td>";
  $i.="</tr>";

  $html=preg_replace("/<!--itemdata-->/",$i,$item);
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
  
  //ログイン判定
  session_start();
  if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
   $loginflg=true;
  }
 
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
   if($val["saletype"]===0){
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

   if($val["saletype"]==5){
    $replace =date("Y年n月",strtotime($val["saleday"]))."のご予約商品";
    $title=preg_replace("/<!--grpname-->/",$replace,$grp);
    $html.=$title;
   }

   if($val["saletype"]==6){
    $replace =date("Y年n月",strtotime($val["saleday"]))."の月間お買得品";
    $title=preg_replace("/<!--grpname-->/",$replace,$grp);
    $html.=$title;
   }

   if($val["saletype"]===null){
    $replace ="取扱商品のご案内";
    $title=preg_replace("/<!--grpname-->/",$replace,$grp);
    $html.=$title;
   }
   
   $i=$item;
   $replace="";
   
   //画像リスト(小サイズ)
   $imgpath=$imgdir."/".$val["jcode"]."*.jpg";
   $replace="";$filename="";
   foreach(glob($imgpath) as $filename){
    $f=basename($filename);
    $replace.="<div class='Tanpin'>";
    $replace.="<img src='.".IMG."/{$f}' alt='{$val["maker"]} {$val["sname"]} {$val["tani"]} {$val["price"]}{$val["yen"]}'>";
    $replace.="</div>";
   }
   $i=preg_replace("/<!--imgtag-->/",$replace,$i);

   //画像があってログイン中なら削除ボタンをセット
   if($replace && $_SESSION["USERID"]==md5(USERID)){
    $replace="<button id='delimg'>すべての画像を削除</button>";
    $i=preg_replace("/<!--delbutton-->/",$replace,$i);
   }

   
   if($val["saletype"]===0){
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

   if($val["saletype"]===null){
    //開始日
    //$replace="登録日:".date("Y年n月j日",strtotime($val["firstsale"]));
    //$i=preg_replace("/<!--startday-->/",$replace,$i);

    //終了日
    if(strtotime($val["lastsale"])==strtotime("1970/1/1")){
     if(! $filename){
      $replace="取り扱いしていない場合もございます。詳しくは係員までお尋ねください";
     }
     else{
      $replace="登録日:".date("Y年n月j日",strtotime($val["firstsale"]));
     }
    }
    else{
     $replace="最終販売日:".date("Y年n月j日",strtotime($val["lastsale"]));
    }
    $i=preg_replace("/<!--endday-->/",$replace,$i);
   }

   //メーカー
   $replace=$val["maker"];
   $i=preg_replace("/<!--maker-->/",$replace,$i);
   
   //JANコード
   $replace=$val["jcode"];
   $i=preg_replace("/<!--jcode-->/",$replace,$i);
   
   
   //商品名
   $replace=$val["sname"];
   $i=preg_replace("/<!--sname-->/",$replace,$i);

   //単位
   $replace=$val["tani"];
   $i=preg_replace("/<!--tani-->/",$replace,$i);

   //売価
   if($val["price"]){
    if($val["specialflg"]>=9999){
     $replace="<del>".$val["price"]."</del>";
    }
    else{
     $replace=$val["price"];
    }
    $i=preg_replace("/<!--price-->/",$replace,$i);

    //通過単位
    $replace=$val["yen"];
    if($val["saletype"]===null){
     $replace="円";
    }
   }
   $i=preg_replace("/<!--yen-->/",$replace,$i);

   //通常売価
   if($val["stdprice"] && $val["saletype"]){
    if($val["stdprice"] !== $val["price"]){
     $replace=$val["stdprice"]."円のところ";
     $i=preg_replace("/<!--stdprice-->/",$replace,$i);
    }
   }
   
   //コメント
   $replace="";
   if($val["specialflg"]>=9999){
    $replace="申し訳ございません。売切れました。";
   }
   $replace.=$val["comment"];
   
   $i=preg_replace("/<!--comment-->/",$replace,$i);
   
   //イベント名
   $replace=$val["grpname"];
   $i=preg_replace("/<!--grpname-->/",$replace,$i);
   
   //売り切れボタン
   if($loginflg){
    if($val["saletype"]==0||$val["saletype"]==1||$$val["saletype"]==2||
       $val["saletype"]==5||$val["saletype"]==6){
     if($val["specialflg"]<9999){
      $replace ="<button id='saleout' ";
      $replace.=" data-strcode ='{$val["strcode"]}'";
      $replace.=" data-saletype='{$val["saletype"]}'";
      $replace.=" data-adnum   ='{$val["adnum"]}'";
      $replace.=" data-saleday ='{$val["saleday"]}'";
      $replace.=" data-jcode   ='{$val["jcode"]}'";
      $replace.=">売切</button>";
     }
     else{
      $replace.="<button id='salein'";
      $replace.=" data-strcode ='{$val["strcode"]}'";
      $replace.=" data-saletype='{$val["saletype"]}'";
      $replace.=" data-adnum   ='{$val["adnum"]}'";
      $replace.=" data-saleday ='{$val["saleday"]}'";
      $replace.=" data-jcode   ='{$val["jcode"]}'";
      $replace.=">売切解除</button>";
     }
     $i=preg_replace("/<!--button-->/",$replace,$i);
    }
   }
   $html.=$i;
  }
  echo $html;

  //デバッグ用
//  echo "<pre>";
//  print_r($data);
//  echo "</pre>";
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// Navi
//-------------------------------------------------------//
function htmlNaviBar($data){
 global $NAVI;
 try{
  $mname="htmlNaviBar(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //スケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/navi.html");
  $html=file_get_contents($path);

  $replace="";
  foreach($NAVI as $key=>$val){
   $replace.="<li><a href='{$val}'>{$key}</a></li>";
  }

  $html=preg_replace("/<!--Navi-->/",$replace,$html);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// ニュース単体表示
//-------------------------------------------------------//
function htmlNewsItem($data){
 try{
  $mname="htmlNewsItem(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  
  //タイトルスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemheader.html");
  $grp=file_get_contents($path);
  
  //ニューススケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/newsitem.html");
  $i=file_get_contents($path);
  
  //画像ディレクトリセット
  $imgdir=realpath(__DIR__."/..".IMG);

  $html="";
  foreach($data as $key=>$val){
   //日付セット
   $replace="";
   $replace=date("Y年m月d日",strtotime($val["saleday"]));
   $replace.="配信";
   $html.=preg_replace("/<!--grpname-->/",$replace,$grp);
   
   $item=$i;
   //画像リスト(小サイズ)
   if($val["grpname"]){
    $imgpath=$imgdir."/".$val["grpname"]."*.jpg";
    $replace="";
    foreach(glob($imgpath) as $filename){
     $f=basename($filename);
     $replace.="<div class='Tanpin'>";
     $replace.="<img src='.".IMG."/{$f}' alt='{$val["sname"]}'>";
     $replace.="</div>";
    }
    $item=preg_replace("/<!--imgtag-->/",$replace,$item);
   }

   //タイトルセット
   $replace =$val["sname"];
   $item=preg_replace("/<!--sname-->/",$replace,$item);

   //内容をセット
   $replace =$val["comment"];
   $item=preg_replace("/<!--comment-->/",$replace,$item);

   $html.=$item;
  }

  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// ニュースリスト表示(index.php用)
//-------------------------------------------------------//
function htmlNewsList($data){
 try{
  $mname="htmlNewsList(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //イベントスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/newstable.html");
  $html=file_get_contents($path);

  $replace="";
  foreach($data as $key=>$val){
   $replace.="<tr>";
   $replace.="<td>".date("Y.m.d",strtotime($val["saleday"]))."</td>";
   $replace.="<td><a href='newsitem.php?newsid={$val["id"]}'>".$val["sname"]."</a></td>";
   $replace.="</tr>";

   if($key>MAXNEWS) break;
   
  }

  $html=preg_replace("/<!--event-->/",$replace,$html);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// ニュースリスト一覧表示
//-------------------------------------------------------//
function htmlNewsListAll($data){
 try{
  $mname="htmlNewsListAll(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //ニューススケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/newslist.html");
  $i=file_get_contents($path);
  
  //画像ディレクトリセット
  $imgdir=realpath(__DIR__."/..".IMG);

  $html="";$replace="";
  foreach($data as $key=>$val){
   $item=$i;
   //画像リスト(小サイズ)
   if($val["grpname"]){
    $imgpath=$imgdir."/".$val["grpname"]."*.jpg";
    $replace="";
    foreach(glob($imgpath) as $filename){
     $f=basename($filename);
     $replace.="<img src='.".IMG."/{$f}' alt='{$val["sname"]}'>";
    }
    $item=preg_replace("/<!--imgtag-->/",$replace,$item);
   }

   //日付
   $replace="";
   $replace=date("Y年m月d日",strtotime($val["saleday"]));
   $item=preg_replace("/<!--saleday-->/",$replace,$item);

   //タイトル
   $replace="";
   $replace=$val["sname"];
   $item=preg_replace("/<!--sname-->/",$replace,$item);
   
   //リンク
   $replace="";
   $replace="<a href='newsitem.php?newsid={$val["id"]}&saleday={$val["saleday"]}'>";
   $item=preg_replace("/<!--linkstart-->/",$replace,$item);

   $replace="";
   $replace="</a>";
   $item=preg_replace("/<!--linkend-->/",$replace,$item);
   $html.=$item;
  }

  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

//-------------------------------------------------------//
// SNSボタン
//-------------------------------------------------------//
function htmlSNSButton(){
 try{
  $mname="htmlSNSButton(html.function.php) ";
  $c="start ".$mname;wLog($c);
  
  //スケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/sns.html");
  $html=file_get_contents($path);
  $url=$_SERVER["HTTPS"] ? "https://" : "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

  $html=preg_replace("/<!--pageurl-->/",$url,$html);

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
// 単品履歴(サマリー)
//-------------------------------------------------------//
function htmlItemTable($data){
 try{
  $mname="htmlItemTable(html.function.php) ";
  $c="start ".$mname;wLog($c);
  //アイテムテーブルスケルトン読み込み
  $path=realpath(__DIR__."/..".SKELETON."/itemtable.html");
  $item=file_get_contents($path);

  $html="";
  $i="";
  foreach($data as $key=>$val){
   $i.="<tr>";
   $i.="<td>".date("y年m月d日",strtotime($val["startday"]))."</td>";
   $i.="<td>".date("y年m月d日",strtotime($val["endday"]))."</td>";
   $i.="<td>".$val["tani"]."</td>";
   $i.="<td>".$val["price"].$val["yen"]."</td>";
   $i.="</tr>";
  }
  $html=preg_replace("/<!--itemdata-->/",$i,$item);
  echo $html;
  $c="end ".$mname;wLog($c);
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessge();wLog($c);
 }
}

?>
