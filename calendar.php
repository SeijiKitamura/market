<?php
require_once("php/html.function.php");
require_once("php/view.function.php");

//店舗番号
if(! $_GET["strcode"]) $strcode=1;

//販売日
if(! $_GET["saleday"]) $saleday=date("Y-m-d");
else{
 $saleday=$_GET["saleday"];
}
if($_GET["saleday"] && ! chkDate($_GET["saleday"])){
 wLog("tirasi.php 日付無効のため本日日付をセット({$_GET["saleday"]})");
 $saleday=date("Y-m-d");
}


//当日データ取得
$item=viewGetCalendar($strcode,$saleday,$saleday);

//当月データ取得
$startday=date("Y-m-1",strtotime($saleday));
$endday=date("Y-m-t",strtotime($saleday));
$items=viewGetCalendar($strcode,$startday,$endday);

//タイトル決定
if(count($item)){
 $title=date("Y年m月d日",strtotime($saleday))."カレンダー情報";
}
else{
 $title="申し訳ございません。本日はご案内できるセールがありません";
}

//
htmlHeader($title);
?>

  <div id="wrapper">
   <div class="calendar">
<?php 
if(! $item){
 echo "<h2>{$title}</h2>";
 echo "<p>";
 echo "毎日のお買い得情報をカレンダーにして配布中です。ぜひご利用くださいませ";
 echo "</p>";
}


if($item){
 htmlCalendarItem($item);
}

if($items){
 htmlCalendar($items);
}
?>
   </div><!--div class="calendar"-->
   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->
  </div><!--div id="wrapper"-->
 </body>
<script>
</script>
</html>

