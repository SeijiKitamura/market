<?php
require_once("php/view.function.php");
require_once("php/html.function.php");

//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付 [推奨] ない場合は当日になる
// 最小引数 ?strcode=1&saleday=yyyy-mm-dd

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}

//日付確定
if($_GET["saleday"] &&chkDate($_GET["saleday"])){
 $saleday=$_GET["saleday"];
} 
else{
 $saleday=date("Y-m-d");
}

//部門番号
if(! $_GET["lincode"]){
 $lincode=0;
}
elseif(! preg_match("/^[0-9]+$/",$_GET["lincode"])){
 $lincode=0;
}
else{
 $lincode=$_GET["lincode"];
}

//チラシ番号をゲット(追い打ちチラシは非表示)
$adnumary=viewGetAdnum($strcode,$saleday);
if(count($adnumary)){
 $adnum=$adnumary[0]["adnum"];
}

if($adnum){
 //店舗全体の日付リスト、商品リストをゲット
 $daylist=viewGetFlyersDayLin ($strcode,$adnum);
 $dpslist=viewGetSaleDpsList  ($strcode,$adnum,$saleday);
 $item=viewGetFlyersItemLin($strcode,$adnum,$saleday);
}

//タイトル決定
if(count($item)){
 $title=date("Y年m月d日",strtotime($item[0]["startday"]))."の広告商品";
}
else{
 $title="申し訳ございません。本日はチラシが入っていません";
}

htmlHeader($title);
?>
  <div id="wrapper">
   <div class="col1">
<?php
//日付リスト表示
if($daylist){
 echo "<ul class='daylist'>";
 foreach($daylist as $key=>$val){
  //$d=date("n月j日",strtotime($val["saleday"]));
  $d=date("j日",strtotime($val["saleday"]));
  $d.="({$YOUBI[date("w",strtotime($val["saleday"]))]})";
  //$d.=" {$val["itemcnt"]}点";
  echo "<li><a href='tirasilist.php?strcode={$strcode}&saleday={$val["saleday"]}'>";
  echo $d;
  echo "</a></li>";
 }
 echo "</ul>";
}

?>
   </div><!--div class="col1"-->
<?php
if(count($item)){
 foreach($item as $key=>$val){
?>
   <div class="col3">
<?php 
  $ary=array();
  $ary[]=$item[$key];
  htmlItemList($ary);
?>
   </div><!--div class="col3"-->
<?php
 }
}
?>

  </div><!--div id="wrapper"-->


