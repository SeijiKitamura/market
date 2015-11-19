<?php
//カレンダーリスト

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

//カレンダーリストをゲット
$endday=date("Y-m-t",strtotime("+7 day",strtotime($saleday)));
$itemlist=viewGetCalendar($strcode,$saleday,$endday);
$filename="c".date("Ym01",strtotime($saleday));

//タイトル決定
if(count($itemlist)){
 $title="カレンダー|".date("Y年m月",strtotime($saleday));
 $discription=$title."をご紹介。ほぼ毎日実施されるカテゴリー別セールです。";
 $discription.="カレンダーを有効に活用して毎日のお買い物を楽しくしましょう。";
 $discription.="特に、普段特売にならない商品を定期的にご購入のお客様にはお得な情報です。";
}
else{
 $title="カレンダー|申し訳ございません。".date("Y年m月",strtotime($saleday))."のカレンダーはご案内できません";
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
 echo "<h1>".date("Y年m月",strtotime($saleday))."お買得情報カレンダー</h1>";
 echo "<div class='col2'>";
 $path=realpath("./").IMG."/".$filename;
 if(file_exists($path.".pdf")){
  echo "<a href='.".IMG."/".$filename.".pdf'>";
  if(file_exists($path.".jpg")){
   echo "<img src='.".IMG."/".$filename.".jpg'>";
  }
  echo "</a>";
 }
 echo "</div>";
 echo "<div class='clr'></div>";
 echo "<p>ほぼ毎日、実施されているカテゴリー別セール実施中です。特に、普段セール対象にならない商品(お茶、コーヒー豆、お味噌、はちみつなど)を定期的にご購入の場合はお買得となりますよ！</p>";
}
else{
 echo $title;
}
?>
   </div><!--div class="col1"-->

   <div class="col1">
<?php 
htmlCalendarTable($itemlist);
?>
   </div><!--div class="col1"-->

<?php
htmlSNSButton();
?>

   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->

  </div><!--div id="wrapper"-->


