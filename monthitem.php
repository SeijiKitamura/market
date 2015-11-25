<?php
//月間お買得品単品
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付     [推奨] ない場合は当日になる
// jcode JANコード  [必須]
// 最小引数 ?strcode=1&jcode=0123456789012

//配列
//$item     単品データ
//$itemlist 月間お買得品全リスト
//$itemary  単品販売履歴
//$linitem  単品と同じ部門の商品リスト
//$clsitem  単品と同じクラスの商品リスト
//$calendarlist カレンダーリスト(saleday+7日)

require_once("php/view.function.php");
require_once("php/html.function.php");

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

//リスト用リンク作成
$link="monthlist.php?strcode={$strcode}&saleday={$saleday}";

//JANコードゲット
if($_GET["jcode"] && preg_match("/^[0-9]+$/",$_GET["jcode"])){
 $jcode=$_GET["jcode"];
}

//アイテム履歴データゲット
if($jcode){
 $itemary=viewGetSaleItemDayResult($strcode,6,$saleday,$jcode);
}

if($itemary){
 foreach($itemary as $key=>$val){
  if(strtotime($saleday)==strtotime($val["saleday"])){
   $title ="月間お買得品|";
   $title.=$val["sname"]."(".$val["maker"].")";
   $title.=$val["tani"]."/".$val["price"].$val["yen"];
   $title.=$val["comment"]."|".$val["grpname"];
   $title.=date("Y年m月",strtotime($val["saleday"]));
   $title.="JANコード:".$val["jcode"];
   $title.="|".$val["dpsname"]."|".$val["clsname"];

   $description =$title."のご案内。";
   $description.="今月の月間お買得品のお知らせ！今月末までいつ来てもこのお値段。";
   $description.="どれも当店おすすめの1品です。この機会にぜひお買い求めください";

   //当日月間商品データをゲット
   $item[]=$itemary[$key];

   //部門番号をゲット
   $lincode=$val["lincode"];

   //クラスをゲット
   $clscode=$val["clscode"];
   break;
  }
 }
}

//月間お買得品リスト（全アイテム)
$itemlist=viewGetSaleItem($strcode,6,$saleday);

//同じ部門のアイテムリストゲット
if($itemlist){
 foreach($itemlist as $key=>$val){
  if($val["lincode"]==$lincode && $val["jcode"]!==$jcode){
   $linitem[]=$itemlist[$key];
  }
 }
}

//同じクラスのアイテムリストゲット
if($itemlist){
 foreach($itemlist as $key=>$val){
  if($val["clscode"]==$clscode && $val["jcode"]!==$jcode){
   $clsitem[]=$itemlist[$key];
  }
 }
}

//カレンダー情報
$calendarlist=array();
$endday=date("Y-m-d",strtotime("+7 day",strtotime($saleday)));
$calendarlist=viewGetCalendar($strcode,$saleday,$endday);

//タイトル決定
if(! $itemary ||! $itemlist){
 $title="月間お買得品|申し訳ございません。ご案内できる商品が見当たりません";
 $descirption="ご案内できる商品が見当たりません。";
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
    <ul>
     <li><a href="<?php echo $link; ?>">月間おすすめ一覧へ戻る</a></li>
    </ul>
   </div><!--div class="col1"-->

   <div class="col2">
<?php
if($item){
 htmlItem($item);
}
?>
   </div><!--div class="col2"-->

   <div class="col2">
<?php
//月別データ履歴テーブル
if($itemary){
 htmlItemMonthTable($itemary);
}
?>
   </div><!--div class="col2"-->
   <div class="clr"></div>

   <div class="col1">
<?php
if($clsitem){
?>
    <h2>こちらも月間お買得品商品です</h2>
<?php
}
?>
    <div id="TirasiZone" class="owl-carousel">
<!--同じ部門の月間お買得商品-->
<?php
if($clsitem){
 htmlItemList($clsitem);
}
?>
    </div><!--div id="TirasiZone" class="owl-carousel"-->
   </div><!--div class="col1"-->
<!--店舗イベントを表示-->
<?php
htmlSNSButton();
?>
   <div class="clr"></div>

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
  items:2,
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



