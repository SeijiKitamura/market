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
$link="maillist.php?strcode={$strcode}&saleday={$saleday}";

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
   $title.=date("Y年m月d日",strtotime($val["saleday"]))."限り ";
   $title.=$val["sname"]."(".$val["maker"].")";
   $title.=$val["tani"]." ".$val["price"].$val["yen"];
   $title.=$val["comment"]." ".$val["grpname"];
   $title.="JANコード:".$val["jcode"];
   $title.=" ".$val["dpsname"]." ".$val["clsname"];

   $description =" 本日の".$title."のご案内。";
   $description.="毎日のお買い得情報をメールでお知らせ！メール画面をレジ係員にお見せください。";
   $description.="表示している価格で販売させていただきます。";
   $description.="さらに過去のメール商品販売履歴もあわせてご案内中";
   $description.="その他にもポイント5倍デーや10%引きデー、更に朝市などもお知らせいたします。";
   $description.="メール会員は随時募集しており年会費無料です。お申し込みはページ下部を";
   $description.="ご参照くださいませ";

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
?>

  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
    <ul>
    <li><a href="<?php echo $link; ?>">メール一覧へ戻る</a></li>
    </ul>
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
if($itemary){
 htmlItemDayTable($itemary);
}
?>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($itemlist){
?>
    <h2>こちらもメール商品です</h2>
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



