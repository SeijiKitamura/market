<?php
//新商品リスト

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

//新商品リストゲット
$itemlist=viewGetNewItem($strcode,$saleday);

//タイトル決定
if(count($itemlist)){
 $title=date("Y年m月d日")."現在の新商品リスト";
}
else{
 $title="申し訳ございません。ただいまご案内できる新商品がございません";
}

htmlHeader($title);
?>
  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>新商品のご案内</h2>
    <p>当店で新しく取り扱いを始めた商品のご案内です。</p>
   </div><!--div class="col1"-->
<?php
if(count($itemlist)){
 $linname="";
 foreach($itemlist as $key=>$val){
  if($linname!=$val["linname"]){
   echo "<div class='clr'></div>";
   echo "<h2>{$val["linname"]}</h2>";
  }
?>
   <div class="col3">
<?php 
  $ary=array();
  $ary[]=$itemlist[$key];
  htmlItemList($ary);
?>
   </div><!--div class="col3"-->
<?php
  $linname=$val["linname"];
 }
}
?>

<?php
htmlSNSButton();
?>

   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->

  </div><!--div id="wrapper"-->


