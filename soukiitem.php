<?php
//早期ご予約単品
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付     [推奨] ない場合は当日になる
// jcode JANコード  [必須]
// 最小引数 ?strcode=1&jcode=0123456789012

//配列
//$item     単品データ
//$itemlist 同日のギフト商品リスト

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

//JANコードゲット
if($_GET["jcode"] && preg_match("/^[0-9]+$/",$_GET["jcode"])){
 $jcode=$_GET["jcode"];
}

//同じ日のアイテムリストゲット
$itemlist=viewGetSaleItem($strcode,9,$saleday);

//単品確定
if($jcode && $itemlist){
 foreach($itemlist as $key=>$val){
  if($val["jcode"]==$jcode){ 
   $item[]=$itemlist[$key];
   break;
  }
 }
}

//同一部門のアイテムゲット(同一商品除く)
if($itemlist && $item){
 foreach($itemlist as $key=>$val){
  foreach($item as $key1=>$val1){
   if($val["lincode"]==$val1["lincode"]){
    if($val["jcode"]!=$jcode){
     $itemary[]=$itemlist[$key];
    }
   }
  }
 }
}

//タイトル確定
if($item){
 foreach($item as $key=>$val){
  $title ="早期ご予約商品|";
  $title.=$val["sname"]."(".$val["maker"].")";
  $title.=$val["tani"]."/".$val["price"].$val["yen"];
  $title.=$val["comment"]."|".$val["grpname"];
  $title.="JANコード:".$val["jcode"];
  $title.="|".$val["dpsname"]."|".$val["clsname"];

  $description ="早期ご予約".$title."のご案内。";
  $description.="数量限定、期間限定商品ばかりを取り揃えました。この機会をお見逃しなく〜！";
  break;
 }
}
else{
 $title="早期ご予約商品|申し訳ございません。ご案内できる商品が見当たりません";
 $descirption="ご案内できる商品が見当たりません。";
}

//カレンダー情報
$calendarlist=array();
$endday=date("Y-m-d",strtotime("+7 day",strtotime($saleday)));
$calendarlist=viewGetCalendar($strcode,$saleday,$endday);


htmlHeader($title,$description);
?>

  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col2">
<?php
if($item){
 echo "<h2>早期ご予約商品</h2>";
 htmlItem($item);
}
?>
   </div><!--div class="col2"-->
   <div class="clr"></div>

   <div class="col1">
<?php
if($itemary){
 echo "<h2>こちらもおすすめです</h2>";
}
?>

    <div id="TirasiZone" class="owl-carousel">
<!--同じ部門のギフト商品-->
<?php
if($itemary){
 htmlItemList($itemary);
}
?>
    </div><!--div id="TirasiZone" class="owl-carousel"-->
   </div><!--div class="col1"-->

   <div class="col1">
   </div><!--div class="col1"-->

<?php
htmlSNSButton();
?>
   <div class="clr"></div>

<!--店舗イベントを表示-->

<!--カレンダー表示-->
   <div class="col1">
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
 $("#TanpinZone").owlCarousel({
  items:2,
  itemsMobile:[400,1],
  pagination:false
 });
 $("#TirasiZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 delimg();
});
</script>
</html>



