<?php
require_once("php/view.function.php");
require_once("php/html.function.php");
htmlHeader("ホーム");

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

//チラシ
$ary=viewGetAdnum($strcode,$saleday);
$adnum=$ary[0]["adnum"];
$tirasilist=viewGetFlyersItemCls($strcode,$adnum,$saleday,null);

//メールアイテム
$maillist=viewGetSaleItem($strcode,1,$saleday);

//ご予約
$goyoyakulist=viewGetSaleItem($strcode,5,$saleday);

//月間お買得品
$gekkanlist=viewGetSaleItem($strcode,6,$saleday);

//新商品
$newitemlist=viewGetNewItem($strcode,$saleday);

//カレンダー
$endday=date("Y-m-d",strtotime("+7 day",strtotime($saleday)));
$calendarlist=viewGetCalendar($strcode,$saleday,$endday);

//店舗イベント
$newslist=viewGetNews($strcode,$saleday);
?>

  <div id="wrapper">
   <!--トップイメージ-->
   <div class="TopImageZone">
     <img class="backimage" src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
     <img class="logoimg"   src="img/kita5.jpg" alt="スーパーキタムラ ロゴ">
   </div><!--div class="TopImageZone"-->

   <div class="col1">
<?php
if(count($tirasilist)){
 echo "<h2>チラシ商品<span><a href='tirasilist.php'>一覧</a></span></h2>";
}
?>
    <div id="TirasiZone" class="owl-carousel">
<?php
if(count($tirasilist)){
 htmlItemList($tirasilist);
}
?>
    </div><!--div id="TirasiZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if(count($maillist)){
 echo "<h2>メール商品 <span><a href='maillist.php'>一覧</a></span></h2>";
}
?>
    <div id="MailZone" class="owl-carousel">
<?php
if(count($maillist)){
 htmlItemList($maillist);
}

?>
    </div><!--div id="MailZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if(count($goyoyakulist)){
 echo "<h2>ご予約商品<span><a href='goyoyakulist.php'>一覧</a></span></h2>";
}
?>
    <div id="GoyoyakuZone" class="owl-carousel">
<?php
if(count($goyoyakulist)){
 htmlItemList($goyoyakulist);
}
?>
    </div><!--div id="GoyoyakuZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($gekkanlist){
 echo "<h2>月間お買得品 <span><a href='monthlist.php'>一覧</a></span></h2>";
}
?>
    <div id="GekkanZone" class="owl-carousel">
<?php
if(count($gekkanlist)){
 htmlItemList($gekkanlist);
}
?>
    </div><!--div id="GekkanZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($newitemlist){
 echo "<h2>新商品のご案内 <span><a href='newitemlist.php'>一覧</a></span></h2>";
}
?>
    <div id="NewItemZone" class="owl-carousel">
<?php
if(count($newitemlist)){
 htmlItemList($newitemlist);
}
?>
    </div><!--div id="NewItemZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if(count($calendarlist)){
 echo "<h2>カレンダー</h2>";
}
?>
    <div id="CalendarZone" class="owl-carousel">
<?php
if(count($calendarlist)){
 htmlCalendarList2($calendarlist);
}
?>
    </div><!--div id="CalendarZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($newslist){
 echo "<h2>最新ニュース <span><a href='newslist.php'>一覧</a></span></h2>";
}
?>
    <div id="NewsZone">
<?php
if($newslist){
 htmlNewsList($newslist);
}
?>
    </div><!--div id="NewsZone"-->

   </div><!--div class="col1"-->

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
$(function(){
 $("#TirasiZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 $("#MailZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 $("#OsusumeZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 $("#GoyoyakuZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 $("#CalendarZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 $("#NewItemZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 $("#GekkanZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

});
</script>
</html>
