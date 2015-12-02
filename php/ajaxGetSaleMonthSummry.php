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
 
 $html="";
 
 //ログイン判定
 session_start();
 if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
  $loginflg=true;
 }
 
 if($loginflg){
  $html.=<<<EOF
   <div class='buttonarea'>
    <button class='checkall'>全選択</button>
    <button class='checkoff'>全解除</button>
    <button class='checkdel'>チェックを削除</button>
   </div>
EOF;
 }
 
 //画像ファイル
 $fullpath=realpath("..");
 $imgpath=IMG;

 //データゲット
 $w="";
 if($saletype==3||$saletype==5||$saletype==6||$saletype==7||$saletype==8||$saletype==9){
  if(! $loginflg){
   $w.=" and t.saleday<='".date("Y-m-d",strtotime("-1days"))."'";
  }
  //開始日、終了日
  $startday=date("Y-01-01",strtotime($saleday));
  $endday  =date("Y-12-31" ,strtotime($saleday));
  $w.=" and t.saleday between '{$startday}' and '{$endday}'";
  $itemlist=viewGetMonthList($strcode,$saletype,$w);
 }

 if($saletype==3){
  $html.=<<<EOF
   <div class="col2">
    <table class="ItemData">
     <colgroup span="1" width="10%">
     <colgroup span="2" width="45%">
     <thead>
      <tr>
       <th></th>
       <th>画像</th>
       <th>月</th>
      </tr>
     </thead>
     <tbody>
EOF;
  foreach($itemlist as $key=>$val){
   //日付
   $calendarday=$val["nen"]."-".$val["tuki"]."-".$val["hi"];
   
   //画像ファイル名
   $fname="c".date("Ymd",strtotime($calendarday)).".jpg";
   
   //リンク
   $link="<a href='calendarlist.php?strcode={$strcode}&saleday={$calendarday}' target='_blank'>";
   
   $html.="<tr>";
   //チェックボックス
   $html.="<td><input type='checkbox' data-strcode='{$strcode}' data-saletype='{$saletype}' data-saleday='{$calendarday}' data-summry='month'></td>";
   //画像
   $html.="<td><div>{$link}";
   if(file_exists($fullpath.$imgpath."/".$fname)){
    $html.="<img src='.{$imgpath}/{$fname}'>";
   }
   $html.="</a></div></td>";
   //月
   $html.="<td>{$link}".$val["tuki"]."月"."</a></td>";
   $html.="</tr>";
  }
  $html.="</tbody></table></div>";
 }
 
 if($saletype==5||$saletype==6||$saletype==7){
  $html.=<<<EOF
   <div class="col2">
    <table class="ItemData">
     <thead>
      <tr>
       <th></th>
       <th>月</th>
      </tr>
     </thead>
     <tbody>
EOF;
  foreach($itemlist as $key=>$val){
   //日付
   $calendarday=$val["nen"]."-".$val["tuki"]."-".$val["hi"];
   
   if($saletype==6){
    //リンク
    $link="<a href='monthlist.php?strcode={$strcode}&saleday={$calendarday}' target='_blank'>";
   }
   
   $html.="<tr>";
   //チェックボックス
   $html.="<td><input type='checkbox' data-strcode='{$strcode}' data-saletype='{$saletype}' data-saleday='{$calendarday}' data-summry='month'></td>";
   //月
   $html.="<td>{$link}".$val["tuki"]."月"."</a></td>";
   $html.="</tr>";
  }
  $html.="</tbody></table></div>";
 }

 if($saletype==8||$saletype==9){
  $html.=<<<EOF
   <table class="ItemData">
    <colgroup span="2" width="10%">
    <colgroup span="3" width="40%">
    <thead>
     <tr>
      <th></th>
      <th>月</th>
      <th>A面</th>
      <th>B面</th>
     </tr>
    </thead>
    <tbody>
EOF;
  foreach($itemlist as $key=>$val){
   //日付
   $calendarday=$val["nen"]."-".$val["tuki"]."-".$val["hi"];

   //リンク
   if($saletype==5){
    $link="<a href='goyoyakulist.php?strcode={$strcode}&saleday={$calendarday}' target='_blank'>";
   }
   if($saletype==8){
    $link="<a href='giftlist.php?strcode={$strcode}&saleday={$calendarday}' target='_blank'>";
   }
   if($saletype==9){
    $link="<a href='soukilist.php?strcode={$strcode}&saleday={$calendarday}' target='_blank'>";
   }

   if($saletype==8){
    $a=$imgpath."/gift".$val["nen"].$val["tuki"]."_a.jpg";
    $b=$imgpath."/gift".$val["nen"].$val["tuki"]."_b.jpg";
   }
   if($saletype==9){
    $a=$imgpath."/souki".$val["nen"].$val["tuki"]."_a.jpg";
    $b=$imgpath."/souki".$val["nen"].$val["tuki"]."_b.jpg";
   }

   
   $html.="<tr>";
   //チェックボックス
   $html.="<td><input type='checkbox' data-strcode='{$strcode}' data-saletype='{$saletype}' data-saleday='{$calendarday}' data-summry='month'></td>";
   //月
   $html.="<td>{$link}".$val["tuki"]."月"."</a></td>";
   
   //A面
   $html.="<td><div>{$link}";
   if(file_exists($fullpath.$a)){
    $html.="<img src='.{$a}'>";
   }
   $html.="</a></div></td>";
   
   //B面
   $html.="<td><div>{$link}";
   if(file_exists($fullpath.$b)){
    $html.="<img src='.{$b}'>";
   }
   $html.="</a></div></td>";
   $html.="</tr>";
  }
  $html.="</tbody></table>";
 }
 echo $html;
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}

?>

