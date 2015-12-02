<?php
//該当するセールアイテムを表示する
require_once("view.function.php");
require_once("html.function.php");

try{
 //引数チェック
 if(preg_match("/^[0-9]+$/",$_GET["strcode"])){
  $strcode=$_GET["strcode"];
 }
 else{
  throw new exception("strcodeが不正です".$_GET["strcode"]);
 }

 if(preg_match("/^[0-9]+$/",$_GET["saletype"])){
  $saletype=$_GET["saletype"];
 }
 else{
  throw new exception("saletypeが不正です".$_GET["saletype"]);
 }

 if(chkDate($_GET["saleday"])){
  $saleday=$_GET["saleday"];
 }
 else{
  throw new exception("saledayが不正です".$_GET["saleday"]);
 }
 
 //ログイン判定
 session_start();
 if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
  $loginflg=true;
 }
 
 //データ取得
 if($saletype==0){
  $adnum=viewGetAdnum($strcode,$saleday);
  $itemlist=viewGetFlyersItemCls($strcode,$adnum[0]["adnum"]);
 }

 if($saletype==1 || $saletype==2){
  $itemlist=viewGetSaleItem($strcode,$saletype,$saleday);
 }
 
 if($saletype==3){
  $itemlist=viewGetCalendar($strcode,$saleday,$saleday);
 }
 
 //画像パス
 $realpath=realpath("..");
 $fullpath=$realpath.IMG."/";
 $fname=date("Ymd",strtotime($saleday)); 
 
 //画像リンク
 $link="<a href='tirasiimg.php?strcode={$strcode}&saleday={$saleday}' target='_blank'>";
 
 //HTML生成
 $html="";

 if($loginflg){
  $html=<<<EOF
   <div class='buttonarea'>
    <button class='checkall'>全選択</button>
    <button class='checkoff'>全解除</button>
    <button class='checkdel'>チェックを削除</button>
   </div>
EOF;
 }

 if($saletype==0){
  $html.=<<<EOF
   <table class='ItemData'>
    <thead>
     <tr>
      <th>A面</th>
      <th>B面</th>
     </tr>
    </thead>
    <tbody>
EOF;
  $html.="<tr>";
  $html.="<td><div class='col1'>";
  if(file_exists($fullpath.$fname."a.jpg")){
   $html.=$link;
   $html.="<img src='.".IMG."/{$fname}a.jpg'>";
   $html.="</a>";
   if($loginflg){
    $html.="<button class='deltirasi' data-fname='{$fname}a.jpg'>画像を削除</button>";
   }
  }
  $html.="</div></td>";
  $html.="<td><div class='col1'>";
  if(file_exists($fullpath.$fname."b.jpg")){
   $html.=$link;
   $html.="<img src='.".IMG."/{$fname}b.jpg'>";
   $html.="</a>";
   if($loginflg){
    $html.="<button class='deltirasi' data-fname='{$fname}b.jpg'>画像を削除</button>";
   }
  }
  $html.="</div></td>";
  $html.="</tr>";
  $html.="</tbody></table>";
 }

 $html.="<table class='ItemData'><thead>";
 if($saletype==0){
  $html.=<<<EOF
   <tr>
    <th> </th>
    <th>開始日</th>
    <th>終了日</th>
    <th>商品名</th>
    <th>単位</th>
    <th>売価</th>
    <th>備考</th>
   </tr>
  </thead>
  <tbody>
EOF;
 }

 if($saletype==1){
  $html.=<<<EOF
   <tr>
    <th> </th>
    <th>日付</th>
    <th>商品名</th>
    <th>単位</th>
    <th>通常売価</th>
    <th>メール売価</th>
   </tr>
  </thead>
  <tbody>
EOF;
 }

 if($saletype==2){
  $html.=<<<EOF
   <tr>
    <th> </th>
    <th>日付</th>
    <th>商品名</th>
    <th>単位</th>
    <th>通常売価</th>
    <th>特売売価</th>
   </tr>
  </thead>
  <tbody>
EOF;
 }

 if($saletype==3){
  $html.=<<<EOF
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

 foreach($itemlist as $key=>$val){
  $html.="<tr>";
  if($saletype==0){
   //リンク
   $link="<a href='./tirasiitem.php?strcode={$val["strcode"]}&saletype={$val["saletype"]}&adnum={$val["adnum"]}&jcode={$val["jcode"]}' target='_blank'>";
   //チェック
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode={$val["strcode"]} data-saletype='{$val["saletype"]}' data-adnum={$val["adnum"]} data-jcode={$val["jcode"]}>";
   }
   $html.="</td>";
   //開始日
   $html.="<td>{$link}";
   $html.=date("m月d日",strtotime($val["startday"]));
   $html.="</a></td>";
   //終了日
   $html.="<td>{$link}";
   $html.=date("m月d日",strtotime($val["endday"]));
   $html.="</a></td>";
   //商品名
   $html.="<td>{$link}";
   $html.="{$val["maker"]} {$val["sname"]}";
   $html.="</a></td>";
   //単位
   $html.="<td>{$link}";
   $html.="{$val["tani"]}";
   $html.="</a></td>";
   //売価
   $html.="<td>{$link}";
   $html.="{$val["price"]}";
   $html.="</a></td>";
   //備考
   $html.="<td>{$link}";
   $html.="{$val["grpname"]} {$val["comment"]}";
   $html.="</a></td>";
  }

  if($saletype==1 || $saletype==2){
   //リンク
   $link="<a href='./mailitem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]}&jcode={$val["jcode"]}' target='_blank'>";
   //チェック
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode={$val["strcode"]} data-saletype={$val["saletype"]} data-saleday={$val["saleday"]} data-jcode={$val["jcode"]}>";
   }
   $html.="</td>";
   //日付
   $html.="<td>{$link}";
   $html.=date("m月d日",strtotime($val["saleday"]));
   $html.="</a></td>";
   //商品名
   $html.="<td>{$link}";
   $html.="{$val["maker"]} {$val["sname"]}";
   $html.="</a></td>";
   //単位
   $html.="<td>{$link}";
   $html.="{$val["tani"]}";
   $html.="</a></td>";
   //通常売価
   $html.="<td>{$link}";
   $html.="{$val["stdprice"]}";
   $html.="</a></td>";
   //メール売価
   $html.="<td>{$link}";
   $html.="{$val["price"]}";
   $html.="</a></td>";
  }

  if($saletype==3){
   //リンク
   $link="<a href='./calendaritem.php?strcode={$val["strcode"]}&saleday={$val["saleday"]} target='_blank'>";
   //チェックボックス
   $html.="<td>";
   if($loginflg){
    $html.="<input type='checkbox' data-strcode={$val["strcode"]} data-saletype={$val["saletype"]} data-saleday={$val["saleday"]}>";
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
  }
  $html.="</tr>";
 }
 $html.="</tbody></table>";
 echo $html;
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}
?>
