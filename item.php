<?php
//単品
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// jcode JANコード  [必須]
// 最小引数 ?strcode=1&jcode=0123456789012

//配列
//$item     単品データ
//$itemlist 同じクラスの商品リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}

//JANコードゲット
if($_GET["jcode"] && preg_match("/^[0-9]+$/",$_GET["jcode"])){
 $jcode=$_GET["jcode"];
}

//商品マスタゲット
$item=viewGetItem($strcode,$jcode);

//同じクラスのアイテムリストゲット
if($item){
 $itemlist=viewGetItemCls($strcode,$item[0]["clscode"]);
}

//タイトル決定
if(! $item ){
 $title="申し訳ございません。ご案内できる商品が見当たりません";
 $descirption="ご案内できる商品が見当たりません。";
}
else{
 $title=$item[0]["maker"].$item[0]["sname"].$item[0]["tani"]." ".$item[0]["jcode"];
 $description=$item[0]["maker"].$item[0]["sname"].$item[0]["tani"].$item[0]["price"]."円のご案内ページです。";
 $description.="JANコード:".$item[0]["jcode"]." ".$item[0]["linname"]."コーナーにある".$item[0]["clsname"]."カテゴリーにて販売されています。";
 $description.="このページは".CORPNAME."にて取扱中の商品をご案内しております。";
 $description.="その他にも".$item[0]["clsname"]."の商品もご紹介中です";
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
<?php
if($item){
 htmlItem($item);
}
?>

   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($itemlist){
?>
    <h2>こちらも商品もおすすめです</h2>
<?php
}
?>
    <div id="TirasiZone" class="owl-carousel">
<!--同じクラスの商品-->
<?php
if($itemlist){
 htmlItemList($itemlist);
}
?>
    </div><!--div id="TirasiZone" class="owl-carousel"-->
   </div><!--div class="col1"-->
<?php
htmlSNSButton();
?>
   <div class="clr"></div>

<!--店舗イベントを表示-->

<!--カレンダー表示-->

<!--ここに注釈を入れる（写真はイメージ、商品は豊富に、予告なく変更、店頭とページ上の価格に差異が、etc-->

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
 $("#TanpinZone").owlCarousel({
  items:5,
  itemsMobile:[400,1],
  pagination:false
 });
 $("#CalendarZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 delimg();
});
</script>
</html>



