<?php
//最新ニュース
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付     [必須] ない場合は当日になる
// newsid  id       [必須］ニュース識別番号

//配列
//$item     ニュースデータ
//$itemlist ニュース全リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="newsitem.php";
aLog($_SERVER["REQUEST_URI"]);

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
$link="newslist.php?strcode={$strcode}&saleday={$saleday}";

//ニュース番号
if($_GET["newsid"] && preg_match("/^[0-9]+$/",$_GET["newsid"])){
 $newsid=$_GET["newsid"];
}
else{
 $newsid=null;
}

//ニュースリスト（全アイテム)
$itemlist=viewGetNews($strcode,$saleday);

//ニュースゲット
if($itemlist){
 foreach($itemlist as $key=>$val){
  if($val["id"]==$newsid){
   $item[]=$itemlist[$key];
  }
 }
}

//タイトル決定
if(! $item){
 $title="申し訳ございません。ご案内できるニュースがございません";
 $descirption=$title;
}
else{
 $title =date("Y年m月d日",strtotime($item[0]["saleday"]))."配信 ";
 $title.=$item[0]["sname"];

 $description =$title.$item[0]["comment"];
 $description.="　このページはスーパーキタムラの最新ニュースをご案内するページです。";
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
    <ul>
    <li><a href="<?php echo $link; ?>">ニュース一覧へ戻る</a></li>
    </ul>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($item){
 htmlNewsItem($item);
}
else{
 echo $title;
}
?>

   </div><!--div class="col1"-->
<?php
htmlSNSButton();
?>
   <div class="clr"></div>

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
});
</script>
</html>




