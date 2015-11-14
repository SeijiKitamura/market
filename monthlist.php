<?php
//月間お買得品リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="monthlist.php";
wLog("pagecount ".$me);

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

//月間お買得品データゲット
$itemlist=viewGetSaleItem($strcode,6,$saleday);

//タイトル決定
if(count($itemlist)){
 $title=date("Y年m月",strtotime($saleday))."の月間お買得品";
 $description=<<<EOF
月間お買得品のお知らせ！今月末までいつ来てもこのお値段。
どれも当店おすすめの1品です。この機会にぜひお買い求めください。
EOF;
}
else{
 $title="申し訳ございません。本日はご案内する月間お買得品がございません。";
}

htmlHeader($title,$description);
?>
  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
    <div class="MailDetail">
     <h2>月間お買得品とは?</h2>
     <p>
      毎月1日から月末までの1ヶ月間、通常価格よりも割引された価格で販売される商品です。
      これから「必要になる」、「あったらいいな」という商品を中心にセレクトしました。
      今月はいつ来てもこのお値段にて販売しております。ぜひ、お買い求めくださいませ。
     </p>
    
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if(! $itemlist){
 echo "<h1>{$title}</h1>";
}
?>
   
   </div><!--div class="col1"-->
<?php
if(count($itemlist)){
 $d="";
 foreach($itemlist as $key=>$val){
  if($d!==$val["saleday"]){
   $endday=date("Y年m月");
   echo "<div class='clr'></div>";
   echo "<h2 style='line-height:1.5em'>{$endday}の月間お買得品</h2>";
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
  $d=$val["saleday"];
 }
?>
   <div class="clr"></div>
<?php 
}
?>

<?php
htmlSNSButton();
?>
   <div class="clr"></div>


   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->


  </div><!--div id="wrapper"-->
 </body>
<script>
</script>
</html>


