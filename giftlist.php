<?php
//ギフトリスト

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

//ギフトアイテムリストをゲット
$itemlist=viewGetSaleItem($strcode,8,$saleday);

//タイトル決定
if(count($itemlist)){
 $title="ギフト一覧|".date("Y年m月d日",strtotime($itemlist[0]["saleday"]));
 $discription=$title." 大切なあの人への贈り物はスーパーキタムラで。ただいま取扱中のギフト商品を";
 $discription.="ご案内中です。掲載中のギフト商品は全国送料です。（北海道、沖縄、離島を除く）";
 $discription.="ハム・お菓子・サラダ油・コーヒーセット・飲料・ビールなど各種取り揃えました。";
}
else{
 $title="ギフト一覧|申し訳ございません。現在ギフト商品は取り扱っておりません。";
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
 echo "<h1>ギフト商品一覧 (".date("Y年m月d日",strtotime($itemlist[0]["saleday"]))."現在)</h1>";
 echo "<p>大切なあの人への贈り物はスーパーキタムラで。ただいまギフト商品取扱中です。</p>";
 
 //画像パス
 $fname="/gift".date("Ym",strtotime($saleday));
 $path=realpath("./").IMG.$fname;
 
 //A面
 echo "<div class='col2'>";
 if(file_exists($path."_a.jpg")){
  echo "<a href='.".IMG.$fname."_a.pdf'>";
  echo "<img src='.".IMG.$fname."_a.jpg'>";
  echo "</a>";
 }
 echo "</div>";
 
 //B面
 echo "<div class='col2'>";
 if(file_exists($path."_b.jpg")){
  echo "<a href='.".IMG.$fname."_b.pdf'>";
  echo "<img src='.".IMG.$fname."_b.jpg'>";
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

//echo "<pre>";
//print_r($itemlist);
//echo "</pre>";
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


