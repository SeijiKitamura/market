<?php
//メール単品
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

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="goyoyakuitem.php";

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

//アイテム履歴データゲット
if($jcode){
 $itemary=viewGetSaleItemDayResult($strcode,5,$saleday,$jcode);
}

if($itemary){
 foreach($itemary as $key=>$val){
  if(strtotime($saleday)==strtotime($val["saleday"])){
   $title ="ご予約商品 ";
   $title.=$val["sname"]."(".$val["maker"].")";
   $title.=$val["tani"]." ".$val["price"].$val["yen"];
   $title.=$val["comment"]." ".$val["grpname"];
   $title.=date("Y年m月",strtotime($val["saleday"]));
   $title.="JANコード:".$val["jcode"];
   $title.=" ".$val["dpsname"]." ".$val["clsname"];

   $description =" 今月の".$title."のご案内。";
   $description.="今月末までのご案内となっております。";
   $description.="当店は東京都大田区の食品スーパーマーケット、スーパーキタムラ";
   $description.="の月間お買得品ご案内ページです。年中無休、朝9:30から";
   $description.="夜10:00まで営業。";

   //当日ご予約商品データをゲット
   $item[]=$itemary[$key];

   //部門番号をゲット
   $lincode=$val["lincode"];

   //クラスをゲット
   $clscode=$val["clscode"];
   break;
  }
 }
}

//ご予約商品リスト（全アイテム)
$itemlist=viewGetSaleItem($strcode,5,$saleday);

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
if($item){
 htmlItem($item);
}
?>

<!--あとでここにSNSを追加-->
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($clsitem){
?>
    <h3>こちらもおすすめです</h3>
<?php
}
?>
    <div id="TirasiZone" class="owl-carousel">
<!--同じクラスのご予約商品-->
<?php
if($clsitem){
 htmlItemList($clsitem);
}
?>
    </div><!--div id="TirasiZone" class="owl-carousel"-->
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




