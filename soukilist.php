<?php
//早期ご予約リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="soukilist.php";
aLog($_SERVER["REQUEST_URI"]);

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

//早期ご予約アイテムリストをゲット
$itemlist=viewGetSaleItem($strcode,9,$saleday);

//タイトル決定
if(count($itemlist)){
 $title=date("Y年m月d日",strtotime($itemlist[0]["saleday"]))."の早期ご予約商品";
 $discription =$title." 特典満載の当店の早期ご予約商品。限定品や早期にご予約することで";
 $discription.="価格が安くなる商品など多数ご用意しました。ぜひこの機会をお見逃しなく!";
}
else{
 $title="申し訳ございません。現在早期ご予約商品は取り扱っておりません。";
 $discpription=$title;
}

htmlHeader($title,$discription);
?>
  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($itemlist){
 echo "<h1>早期ご予約商品一覧 (".date("Y年m月d日",strtotime($itemlist[0]["saleday"]))."現在)</h1>";
 echo "<p>年末に「あったらうれしい」商品を取り揃えました。数量に限りがある商品もございます。ご予約はサービスカウンターにて承り中です。</p>";
 echo "<div class='col2'>";
 $path=realpath("./").IMG."/souki_a.jpg";
 if(file_exists($path)){
  echo "<a href='.".IMG."/souki_a.pdf'>";
  echo "<img src='.".IMG."/souki_a.jpg'>";
  echo "</a>";
 }
 echo "</div>";
 echo "<div class='col2'>";
 $path=realpath("./").IMG."/souki_b.jpg";
 if(file_exists($path)){
  echo "<a href='.".IMG."/souki_b.pdf'>";
  echo "<img src='.".IMG."/souki_b.jpg'>";
  echo "</a>";
 }
 echo "</div>";
 echo "<div class='clr'></div>";
}
else{
 echo $title;
}
?>
   </div><!--div class="col1"-->

<?php
if(count($itemlist)){
 $linname="";
 foreach($itemlist as $key=>$val){
  if($linname!==$val["linname"]){
   echo "<div class='clr'></div>";
   echo "<h2>{$val["linname"]}</h2>";
   $linname=$val["linname"];
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


