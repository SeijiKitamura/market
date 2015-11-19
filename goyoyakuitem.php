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
$link="goyoyakulist.php?strcode={$strcode}&saleday={$saleday}";

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
   $title ="ご予約商品|";
   $title.=$val["sname"]."(".$val["maker"].")";
   $title.=$val["tani"]."/".$val["price"].$val["yen"];
   $title.=$val["comment"]."|".$val["grpname"];
   $title.=date("Y年m月",strtotime($val["saleday"]));
   $title.="JANコード:".$val["jcode"];
   $title.="|".$val["dpsname"]."|".$val["clsname"];

   $description =" 今月の".$title."のご案内。";
   $description.="今月末までのご案内となっております。";
   $description.="当店が自信を持っておすすめする特別商品。どれも店頭にならばない特別な商品ばかりです。";
   $description.="ホームパーティ用オードブル、お寿司、お刺身盛合せ等各種取り揃えました。";

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
 $title="ご予約商品|申し訳ございません。ご案内できる商品が見当たりません";
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
     <li><a href="<?php echo $link; ?>">ご予約一覧へ戻る</a></li>
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
if($clsitem){
?>
    <h2>こちらもおすすめです</h2>
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
   <div class="col1">
    <div id="MailHead"></div>
    <div class="MailDetail">
     <h2>内容について</h2>
     <p>
      季節によって内容が変化する場合がございます。
     </p>

     <h2>ご注文方法</h2>
     <p>
      サービスカウンターにて承っております。詳しくは03-3771-8284(朝9:00-18:00)までご連絡ください。
     </p>

     <h2>ご注意点</h2>
     <p>
      ご利用になる3日前(10個を超える数量をご注文の場合は1週間前)までにご予約ください。 
     </p>

    </div><!--div class="MailDetail"-->
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




