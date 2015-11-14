<?php
require_once("php/html.function.php");
require_once("php/view.function.php");

//ファイル名
$me="gotyumon.php";

//店舗番号
if(! $_GET["strcode"]) $strcode=1;

//販売日
if(! $_GET["saleday"]) $saleday=date("Y-m-d");
else{
 $saleday=$_GET["saleday"];
}

if($_GET["saleday"] && ! chkDate($_GET["saleday"])){
 wLog("gotyumon.php 日付無効のため本日日付をセット({$_GET["saleday"]})");
 $saleday=date("Y-m-d");
}

$w="saleday>='{$saleday}'";
$grplist=viewGetGroupList($strcode,5,$saleday);
$monthlist=viewGetMonthList($strcode,5,$w);
$item=viewGetSaleItem($strcode,5,$saleday);

if(! $item || ! isset($item) ||! is_array($item)){
 $title="申し訳ございません。本日はご案内できる商品がございません";
}
else{
 $title="ご注文商品一覧";
}
htmlHeader($title);
?>
  <div id="wrapper">
   <div class="daylist">
    <ul>
<?php
//年月リストの表示
if($monthlist){
 foreach($monthlist as $key=>$val){
  $d=$val["nen"]."年".$val["tuki"]."月";
  echo "<li data-strcode={$strcode} data-year={$val["nen"]} data-month={$val["tuki"]}>{$d}</li>";
 }
}
?>
    </ul>
   </div><!--div class="daylist"-->
   <div class="grplist">
    <ul>
<?php
//グループ表示
if($grplist){
 foreach($grplist as $key=>$val){
  echo "<li data-strcode={$strcode} data-saleday={$saleday} data-grpnum={$val["grpnum"]}>{$val["grpname"]}</li>";
 }
}
?>
    </ul>
   </div><!--div class="grplist"-->
   <div class="items">
<?php
if($item){
 htmlContents($item);
}
else{
?>
    <h1>申し訳ございません。本日はチラシ商品はございません。</h1>
    <p>次回の広告をご期待くださいませ。</p>

<?php
}

?>
   </div><!--div class="items"-->
   <div class="notice">
    <ul>
     <li>ご注文はお渡し日の2日前午後5時までとさせていただきます。</li>
     <li>数量が10個以上になる場合はお渡し日の1週間前までにご注文くださいませ。</li>
     <li>商品は季節により内容が変更となる場合がございます。</li>
     <li>価格はすべて税抜きとなっております。お会計時に消費税を別途加算させていただきます。</li>
    </ul>
   </div><!--div class="notice"-->
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
 G_DayEvent();
 G_LinEvent();
});

</script>
</html>
    
