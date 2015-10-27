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

?>

  <div id="wrapper">
   <!--トップイメージ-->
   <div class="TopImageZone">
     <img src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
   </div><!--div class="TopImageZone"-->

   <div class="col1">
    <h2>チラシ商品<span><a href="tirasilist.php">一覧</a></span></h2>
    <div id="TirasiZone" class="owl-carousel">
<?php
//チラシ番号確定
$ary=viewGetAdnum($strcode,$saleday);
$adnum=$ary[0]["adnum"];


//チラシアイテム
$data=viewGetFlyersItemCls($strcode,$adnum,$saleday,null);

if(count($data)){
 htmlItemList($data);
}
?>
    </div><!--div id="TirasiZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>メール商品 <span><a href="maillist.php">一覧</a></span></h2>
    <div id="MailZone" class="owl-carousel">
<?php
$data=array();

//メールアイテム
$data=viewGetSaleItem($strcode,1,$saleday);

if(count($data)){
 htmlItemList($data);
}

?>
    </div><!--div id="MailZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>おすすめ商品</h2>
    <div id="OsusumeZone" class="owl-carousel">
<?php
$data=array();

//おすすめ
$data=viewGetSaleItem($strcode,2,$saleday);

if(count($data)){
 htmlItemList($data);
}
?>
    </div><!--div id="OsusumeZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>ご予約商品</h2>
    <div id="GoyoyakuZone" class="owl-carousel">
<?php
$data=array();

//ご予約
$data=viewGetSaleItem($strcode,5,$saleday);

if(count($data)){
 htmlItemList($data);
}
?>
    </div><!--div id="GoyoyakuZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>月間お買得品</h2>
    <div id="GekkanZone" class="owl-carousel">
<?php
$data=array();

//ご予約
$data=viewGetSaleItem($strcode,6,$saleday);

if(count($data)){
 htmlItemList($data);
}
?>
    </div><!--div id="GekkanZone" class="owl-carousel"-->
   </div><!--div class="col1"-->
   <div class="col1">
    <h2>カレンダー</h2>
    <div id="CalendarZone" class="owl-carousel">
<?php
$data=array();
//終了日をゲット
$endday=date("Y-m-d",strtotime("+7 day",strtotime($saleday)));

$data=viewGetCalendar($strcode,$saleday,$endday);
if(count($data)){
 htmlCalendarList2($data);
}

?>
    </div><!--div id="CalendarZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div id="footer">
<?php
//htmlFooter();
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

 $("#GekkanZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

});
</script>
</html>
