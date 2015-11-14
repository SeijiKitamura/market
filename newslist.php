<?php
//ニュースリスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="newslist.php";
wLog("pagecount ".$me);

//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付 [推奨] ない場合は当日になる
// 最小引数 ?strcode=1&saleday=yyyy-mm-dd

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}

//日付確定
if($_GET["saleday"] &&chkDate($_GET["saleday"])){
 $saleday=$_GET["saleday"];
} 
else{
 $saleday=date("Y-m-d");
}

//ニュースリストゲット
$itemlist=viewGetNews($strcode,$saleday);

//タイトル決定
if(count($itemlist)){
 $title="ニュース一覧";
 $description ="このページはスーパーキタムラの最新ニュース一覧をご案内するページです。";
}
else{
 $title="申し訳ございません。ご案内するニュースがございません。";
 $description =$title;
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
    <h1>ニュース一覧</h1>
<?php
if($itemlist){
 htmlNewsListAll($itemlist);
}
else{
 echo $title;
}
?>
   </div><!--div class="col1"-->
   
   <div class="clr"></div>

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
</script>
</html>


