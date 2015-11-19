<?php
//カレンダー単日
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付     [推奨] ない場合は当日になる
// 最小引数 ?strcode=1&saleday=yyyy-mm-dd

//配列
//$itemlist 単日のカレンダー商品リスト

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
$link="calendarlist.php?strcode={$strcode}";

//単日のクラスリストゲット
$clslist=viewGetSaleItem($strcode,3,$saleday);


//タイトル確定
if($clslist){
 foreach($clslist as $key=>$val){
  $title ="カレンダー情報|".date("Y年m月d日",strtotime($val["saleday"]))."|";
  $description =$title."のご案内。本日のお買い得情報は";
  $description.=$val["grpname"].$val["tani"].$val["price"].$val["yen"]."です。表示されている商品が".$val["tani"].$val["price"].$val["yen"]."です。";
  break;
 }
}
else{
 $title="カレンダー情報|申し訳ございません。ご案内できるカレンダー情報が見当たりません";
 $descirption=$title;
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

   <div class="col1">
    <ul>
    <li><a href="<?php echo $link; ?>">カレンダーへ戻る</a></li>
    </ul>
   </div><!--div class="col1"-->

   <div class="col1">
    <h1>カレンダー対象商品</h1>
   </div><!--div class="col1"-->
<?php
//クラス別単品リスト作成
if($clslist){
 $itemlist=array();
 echo "<p>{$description}</p>";
 foreach($clslist as $key=>$val){
  //カテゴリー全体のものだけ単品リストを作成する
  if($val["tani"]==="全品"||$val["tani"]==="ポイント"){
   //おにぎりクラスは対象外
   if($val["grpname"]!=="おにぎり"){
    $itemlist=array();
    $itemlist=viewGetItemCls($val["strcode"],$val["clscode"]);
    foreach($itemlist as $key1=>$val1){
     //割引を反映
     if(preg_match("/%/",$val["yen"])){
      $itemlist[$key1]["tani"]=$val1["price"]."円が";
      $itemlist[$key1]["price"]=$val1["price"]-floor($val1["price"]*$val["price"]/100);
     }
     $ary=array();
     $ary[]=$itemlist[$key1];
     echo "<div class='col3'>";
     htmlItemList($ary);
     echo "</div>";
    }
   }
  }
 }
}
else{
 echo $title;
}

?>

   <div class="clr"></div>
   <div class="col1">
    <p>
ご注意点<br>
表示しております価格は本日の価格から自動で計算された価格となっております。
販売日当日には売価が変更する場合がございますので予めご了承くださいませ。
特に将来に実施される予定の割引セール商品の売価については販売日当日に改めてご確認くださいますようお願い申し上げます。
なお、掲載しております商品の詳細については<a href="aboutitem.php" style="color:blue;">こちら</a>をご覧くださいませ。
    </p>
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
  items:5,
  itemsMobile:[400,1],
  pagination:false
 });
 $("#TirasiZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

});
</script>
</html>



