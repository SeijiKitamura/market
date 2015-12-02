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

 if(preg_match("/^[0-9]+$/",$_GET["saletype"])){
  $saletype=$_GET["saletype"];
 }
 else{
  throw new exception ("セール番号を確認してください".$_GET["saletype"]);
 }

 if(chkDate($_GET["saleday"])){
  $saleday=$_GET["saleday"];
 }
 else{
  throw new exception ("セール日を確認してください".$_GET["saleday"]);
 }

 //ログイン判定
 session_start();
 if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
  $loginflg=true;
 }

 $w="";
 if($saletype==0){
  if(! $loginflg){
   $w.=" t1.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  $itemlist=viewGetFlyersDayList2($strcode,$saleday,$w);
 }

 if($saletype==1||$saletype==2){
  if(! $loginflg){
   $w.=" and t.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  //開始日、終了日
  $startday=date("Y-m-01",strtotime($saleday));
  $endday  =date("Y-m-t" ,strtotime($saleday));
  
  //データ取得
  $w.=" and t.saleday between '{$startday}' and '{$endday}'";
  $itemlist=viewGetSaleList($strcode,$saletype,$w);
 }

 if($saletype==3){
  if(! $loginflg){
   $w.=" and t.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  //開始日、終了日
  $startday=date("Y-m-01",strtotime($saleday));
  $endday  =date("Y-m-t" ,strtotime($saleday));
  
  //データ取得
  $w.=" and t.saleday between '{$startday}' and '{$endday}'";
  $itemlist=viewGetCalendar($strcode,$startday,$endday,$w);
 }

 if($saletype==5||$saletype==6||$saletype==7||$saletype==8||$saletype==9){
  if(! $loginflg){
   $w.=" and t.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  //開始日、終了日
  $startday=date("Y-m-01",strtotime($saleday));
  $endday  =date("Y-m-t" ,strtotime($saleday));
  
  //データ取得
  $w.=" and t.saleday between '{$startday}' and '{$endday}'";
  $itemlist=viewGetSaleSummry($strcode,$saletype,$w);
 }


 if($loginflg){
  $html=<<<EOF
   <div class='buttonarea'>
    <button class='checkall'>全選択</button>
    <button class='checkoff'>全解除</button>
    <button class='checkdel'>チェックを削除</button>
   </div>
EOF;
 }

 //画像パス
 $fullpath=realpath("..");
 $imgpath=IMG;
 $fname=date("Ymd",strtotime($saleday));

 //テーブルヘッダー
 if($saletype==0){
  $html.=<<<EOF
   <table class="ItemData">
    <colgroup span="1" width="5%">
    <colgroup span="1" width="10%">
    <colgroup span="2" width="40%">
    <thead>
     <tr>
      <th></th>
      <th>投函日</th>
      <th>A面</th>
      <th>B面</th>
     </tr>
    </thead>
    <tbody>
EOF;
 }

 if($saletype==1 || $saletype==2){
  $html.=<<<EOF
   <table class="ItemData">
    <colgroup span="1" width="5%">
    <colgroup span="1" width="10%">
    <thead>
     <tr>
      <th></th>
      <th>日付</th>
      <th>アイテム数</th>
     </tr>
    </thead>
    <tbody>
EOF;
 }

 if($saletype==3){
  //画像表示
  $html.=<<<EOF
   <div class="col2">
   <table class="ItemData">
    <thead>
     <tr>
      <th>日付</th>
      <th>カレンダー画像</th>
     </tr>
    </thead>
    <tbody>
     <tr>
      <td>{$saleday}</td>
      <td>
EOF;
   if(file_exists($fullpath.$imgpath."/c{$fname}.jpg")){
    $html.="<div><img src='.{$imgpath}/c{$fname}.jpg'></div>";
    if($loginflg){
     $html.="<button class='delall' data-strcode='{$strcode}' data-saletype='{$saletype}' data-saleday='{$saleday}'>画像を削除</button>";
    }
   }
  $html.=<<<EOF
      </td>
     </tr>
    </tbody>
   </table>
   </div><!--div class="col2"-->
EOF;
  
  //データ表示
  $html.=<<<EOF
   <div class="col2">
   <table class="ItemData">
    <colgroup span="2" width="10%">
    <colgroup span="1" width="20%">
    <colgroup span="2" width="10%">
    <thead>
     <tr>
      <th> </th>
      <th>日付</th>
      <th>カテゴリー名</th>
      <th>単位</th>
      <th>価格</th>
     </tr>
    </thead>
    <tbody>
EOF;
 }

 if($saletype==5||$saletype==6||$saletype==8||$saletype==9){
  //データ表示
  $html.=<<<EOF
   <table class="ItemData">
    <colgroup span="1" width="10%">
    <colgroup span="2" width="10%">
    <colgroup span="1" width="40%">
    <colgroup span="2" width="15%">
    <thead>
     <tr>
      <th> </th>
      <th>開始日</th>
      <th>終了日</th>
      <th>商品名</th>
      <th>単位</th>
      <th>価格</th>
     </tr>
    </thead>
    <tbody>
EOF;
 }

 if($saletype==7){
  //データ表示
  $html.=<<<EOF
   <table class="ItemData">
    <colgroup span="1" width="10%">
    <colgroup span="2" width="10%">
    <colgroup span="1" width="30%">
    <colgroup span="1" width="40%">
    <thead>
     <tr>
      <th> </th>
      <th>画像</th>
      <th>日付</th>
      <th>タイトル</th>
      <th>コメント</th>
     </tr>
    </thead>
    <tbody>
EOF;
 }

 foreach($itemlist as $key=>$val){
  if($saletype==0){
   //リンク
   $link="<a href='tirasilist.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}' target='_blank'>";
   
   //画像ファイル名
   $fname=date("Ymd",strtotime($val["saleday"]));

   $html.="<tr>";
   //チェックボックス
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode='{$val["strcode"]}' data-adnum='{$val["adnum"]}' data-saleday='{$val["saleday"]}' data-saletype='{$val["saletype"]}'>";
   }
   $html.="</td>";
   $html.="<td>{$link}{$val["saleday"]}</a></td>";
   $html.="<td>";
   if(file_exists($fullpath.$imgpath."/".$fname."a.jpg")){
   $html.="<div>{$link}<img src='.{$imgpath}/{$fname}a.jpg'></a></div>";
   }
   $html.="</td>";
   $html.="<td>";
   if(file_exists($fullpath.$imgpath."/".$fname."b.jpg")){
   $html.="<div>{$link}<img src='.{$imgpath}/{$fname}b.jpg'></a></div>";
   }
   $html.="</td>";
   $html.="</tr>";
  }

  if($saletype==1){
   $link="<a href='maillist.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}' target='_blank'>";
   $html.="<tr>";
   //チェックボックス
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode={$val["strcode"]} data-saleday={$val["saleday"]} data-saletype={$val["saletype"]}>";
   }
   $html.="</td>";
   //日付
   $html.="<td>{$link}{$val["saleday"]}</a></td>";
   //アイテム数
   $html.="<td>{$link}{$val["itemcnt"]}</a></td>";
   $html.="</tr>";
  }

  if($saletype==2){
   $html.="<tr>";
   //チェックボックス
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode='{$val["strcode"]}' data-saleday='{$val["saleday"]}' data-saletype='{$val["saletype"]}'>";
   }
   $html.="</td>";
   //日付
   $html.="<td>{$link}{$val["saleday"]}</a></td>";
   //アイテム数
   $html.="<td>{$link}{$val["itemcnt"]}</a></td>";
   $html.="</tr>";
  }

  if($saletype==3){
   $link="<a href='calendaritem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}' target='_blank'>";
   $html.="<tr>";
   //チェックボックス
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode='{$val["strcode"]}' data-saleday='{$val["saleday"]}' data-saletype='{$val["saletype"]}'>";
   }
   $html.="</td>";
   //日付
   $html.="<td>{$link}";
   $html.=date("m月d日",strtotime($val["saleday"]));
   $html.="</a></td>";
   //カテゴリー名
   $html.="<td>{$link}";
   $html.="{$val["grpname"]}";
   $html.="</a></td>";
   //単位
   $html.="<td>{$link}";
   $html.="{$val["tani"]}";
   $html.="</a></td>";
   //価格
   $html.="<td>{$link}";
   $html.="{$val["price"]}{$val["yen"]}";
   $html.="</a></td>";

   $html.="</tr>";
  }

  if($saletype==5||$saletype==6||$saletype==8||$saletype==9){
   if($saletype==5){
    //リンク
    $link="<a href='goyoyakuitem.php?strcode={$val["strcode"]}&saleday={$val["startday"]}&jcode={$val["jcode"]}' target='_blank'>";
   }
   if($saletype==6){
    //リンク
    $link="<a href='monthitem.php?strcode={$val["strcode"]}&saleday={$val["startday"]}&jcode={$val["jcode"]}' target='_blank'>";
   }
   if($saletype==8){
    //リンク
    $link="<a href='giftitem.php?strcode={$val["strcode"]}&saleday={$val["startday"]}&jcode={$val["jcode"]}' target='_blank'>";
   }
   if($saletype==9){
    //リンク
    $link="<a href='soukiitem.php?strcode={$val["strcode"]}&saleday={$val["startday"]}&jcode={$val["jcode"]}' target='_blank'>";
   }

   $html.="<tr>";
   //チェックボックス
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode='{$val["strcode"]}' data-startday='{$val["startday"]}' data-endday='{$val["endday"]}' data-saletype='{$val["saletype"]}' data-jcode='{$val["jcode"]}'>";
   }
   $html.="</td>";
   //開始日
   $html.="<td>{$link}{$val["startday"]}</a></td>";
   //終了日
   $html.="<td>{$link}{$val["endday"]}</a></td>";
   //商品名
   $html.="<td>{$link}{$val["maker"]} {$val["sname"]}</a></td>";
   //単位
   $html.="<td>{$link}{$val["tani"]}</a></td>";
   //価格
   $html.="<td>{$link}{$val["price"]}{$val["yen"]}</a></td>";
   $html.="</tr>";
  }

  if($saletype==7){
   //リンク
   $link="<a href='newsitem.php?strcode={$val["strcode"]}&newsid={$val["id"]}' target='_blank'>";
   
   $html.="<tr>";
   //チェックボックス
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode='{$val["strcode"]}' data-saletype='{$val["saletype"]}' data-newsid='{$val["id"]}'>";
   }
   $html.="</td>";
   //画像
   $html.="<td>{$link}";
   if($val["grpname"]){
    foreach(glob($fullpath.$imgpath."/{$val["grpname"]}*.jpg") as $imgfile){
     $fpath=basename($imgfile);
     $html.="<div><img src='.{$imgpath}/{$fpath}'></div>";
    }
   }
   $html.="</a></td>";
   //日付
   $html.="<td>{$link}{$val["saleday"]}</a></td>";
   //タイトル
   $html.="<td>{$link}{$val["sname"]}</a></td>";
   //コメント
   $html.="<td>{$link}{$val["comment"]}</a></td>";
   $html.="</tr>";
  }
 }
 $html.=<<<EOF
   </tbody>
  </table>
EOF;
 if($saletype==3){
  $html.="</div>";
  $html.="<div class='clr'></div>";
 }
 echo $html;

 echo "<pre>";
 print_r($itemlist);
 echo "</pre>";
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}

?>
