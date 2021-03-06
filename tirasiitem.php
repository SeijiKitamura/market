<?php
//チラシ単品ページ
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// adnum 広告番号　[推奨]  なくても日付から判定する
// jcode JANコード [必須]
// saleday 日付 [オプション] ない場合は当日になる
// 最小引数 ?strcode=1&adnum=xxx&jcode=0123456789012

//配列
//$item     単品データ
//$itemlist 同日、同部門の単品リスト
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
$link="tirasilist.php?strcode={$strcode}&saleday={$saleday}";

//チラシ番号をゲット(追い打ちチラシは非表示)
if(! $_GET["adnum"] || ! preg_match("/^[0-9]+$/",$_GET["adnum"])){
 wLog($me." チラシ番号無効のため検索開始");
 $adnumary=viewGetAdnum($strcode,$saleday);
 if(count($adnumary)){
  $adnum=$adnumary[0]["adnum"];
  wLog($me." チラシ番号確定".$adnum);
 }
 else{
  wLog($me." チラシなし");
 }
}
else{
 $adnum=$_GET["adnum"];
}

//チラシ最終日をゲット
$endday=$saleday;
$saledayary=viewGetFlyersDayCls($strcode,$adnum,null);
foreach($saledayary as $key=>$val){
 if(strtotime($endday)<strtotime($val["saleday"])){
  $endday=$val["saleday"];
  }
}

//JANコードゲット
if($_GET["jcode"] && preg_match("/^[0-9]+$/",$_GET["jcode"])){
 $jcode=$_GET["jcode"];
}

//アイテム履歴データゲット
if($adnum && $jcode){
 $itemary=viewGetSaleItemResult($strcode,0,$endday,$jcode);
}

if($itemary){
 foreach($itemary as $key=>$val){
  if($adnum==$val["adnum"]){
   $title ="チラシ商品|";
   $title.=$val["sname"]."(".$val["maker"].")";
   $title.=$val["tani"]."/".$val["price"].$val["yen"];
   $title.=$val["comment"]."|".$val["grpname"];
   $title.=$val["startday"];
   if(strtotime($val["startday"])==strtotime($val["endday"])){
    $title.="限り";
   }
   else{
    $title.="から".$val["endday"]."まで";
   }
   $title.="JANコード:".$val["jcode"];
   $title.="|".$val["dpsname"]."|".$val["clsname"];

   $description ="本日の".$title."。";
   $description.="あわせて過去のチラシ掲載履歴もご案内中です。";

   //当日チラシ商品データをゲット
   $item[]=$itemary[$key];
   break;
  }
 }
}

//同じ部門のアイテムリストゲット
if($item){
 $dpscode=$item[0]["dpscode"];
 $itemlist=viewGetFlyersItemDps($strcode,$adnum,$saleday,$dpscode);
}

//ログイン判定
session_start();
if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
 $loginflg=true;
}

//販売履歴データ
if($loginflg && $jcode){
 $w=" and t.saleday <='{$saleday}' and t.jcode='{$jcode}'";
 $result=viewGetSaleResult($strcode,0,$w);
}

//タイトル決定
if(! $adnum || ! $jcode || ! $itemary ||! $item){
 $title="チラシ商品|申し訳ございません。ご案内できる商品が見当たりません";
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
    <li><a href="<?php echo $link; ?>">チラシ一覧へ戻る</a></li>
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
if($itemary){
 htmlItemTable($itemary);
}
?>
   </div><!--div class="col2"-->
   <div class="clr"></div>

   <div class="col1">
<?php
if($result){
 htmlItemDayResult($result);
}
?>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($itemlist){
?>
    <h2>こちらもおすすめです</h2>
<?php
}
?>
    <div id="TirasiZone" class="owl-carousel">
<!--同じ部門の商品-->
<?php
if($itemlist){
 htmlItemList($itemlist);
}
?>
    </div><!--div id="TirasiZone" class="owl-carousel"-->
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
 $("#TanpinZone").owlCarousel({
  items:2,
  itemsMobile:[400,2],
  pagination:false
 });

 $("#TirasiZone").owlCarousel({
  items:5,
  itemsMobile:[400,3],
  pagination:false
 });

 delimg();
 saleout();
});
</script>
</html>



