<?php
//メール単品
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付     [推奨] ない場合は当日になる
// jcode JANコード  [必須]
// 最小引数 ?strcode=1&jcode=0123456789012

//配列
//$item     単品データ
//$itemlist 同日のメール商品リスト
//$itemary  単品販売履歴

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="mailitem.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}

//日付確定(指定なければ今日の日付）
if($_GET["saleday"] &&chkDate($_GET["saleday"])){
 $saleday=$_GET["saleday"];
} 
else{
 $saleday=date("Y-m-d");
}

//JANコードゲット
if($_GET["jcode"] && preg_match("/^[0-9]+$/",$_GET["jcode"])){
 $jcode=$_GET["jcode"];
}

//同じ日のアイテムリストゲット
$itemlist=viewGetMailList($strcode,$saleday);
foreach($itemlist as $key=>$val){
 if(strtotime($saleday)==strtotime($val["saleday"])){
  $ary[]=$val;
 }
}
$itemlist=array();
$itemlist=$ary;

//アイテム履歴データゲット
if($jcode){
 $itemary=viewGetSaleItemDayResult($strcode,1,$saleday,$jcode);
}

if($itemary){
 foreach($itemary as $key=>$val){
  if(strtotime($saleday)==strtotime($val["saleday"])){
   $title ="メール商品 ";
   $title.=$val["sname"]."(".$val["maker"].")";
   $title.=$val["tani"]." ".$val["price"].$val["yen"];
   $title.=$val["comment"]." ".$val["grpname"];
   $title.=$val["startday"];
   if(strtotime($val["startday"])==strtotime($val["endday"])){
    $title.="限り";
   }
   else{
    $title.="から".$val["endday"]."まで";
   }
   $title.="JANコード:".$val["jcode"];
   $title.=" ".$val["dpsname"]." ".$val["clsname"];

   $description =" 本日の".$title."のご案内。";
   $description.="毎日のお買い得情報をメールでお知らせ！メール画面をレジ係員にお見せください。";
   $description.="表示している価格に値引きさせていただきます。";
   $description.="当店は東京都大田区の食品スーパーマーケット、スーパーキタムラ";
   $description.="のメール商品ご案内ページです。年中無休、朝9:30から";
   $description.="夜10:00まで営業。";

   //当日メール商品データをゲット
   $item[]=$itemary[$key];
   break;
  }
 }
}

//カレンダー情報
$calendarlist=array();
$endday=date("Y-m-d",strtotime("+7 day",strtotime($saleday)));
$calendarlist=viewGetCalendar($strcode,$saleday,$endday);

//タイトル決定
if(! $itemary ||! $itemlist){
 $title="申し訳ございません。ご案内できる商品が見当たりません";
 $descirption="ご案内できる商品が見当たりません。";
}


htmlHeader($title,$description);

//print_r($item);
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

<?php
htmlSNSButton();
?>
   <div class="clr"></div>



   <div class="col1">
<?php
if($itemary){
 htmlItemDayTable($itemary);
}
?>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($itemlist){
?>
    <h3>こちらもメール商品です</h3>
<?php
}
?>
    <div id="TirasiZone" class="owl-carousel">
<!--同じ日のメール商品-->
<?php
if($itemlist){
 htmlItemList($itemlist);
}
?>
    </div><!--div id="TirasiZone" class="owl-carousel"-->
   </div><!--div class="col1"-->
<!--店舗イベントを表示-->

<!--カレンダー表示-->
   <div class="col1">
<?php
if(count($calendarlist)){
 echo "<h2>カレンダー情報</h2>";
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

<!--ここに注釈を入れる（写真はイメージ、商品は豊富に、予告なく変更、店頭とページ上の価格に差異が、etc-->

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
});
</script>
</html>



