<?php
require_once("php/html.function.php");
require_once("php/view.function.php");

$mname="tirasiitem.php";

$flg=1;

//引数チェック
if(! $_GET["strcode"] || ! preg_match("/^[0-9]+$/",$_GET["strcode"])){
 wLog("error:".$mname.": 店舗番号 不正({$_GET["strcode"]})");
 $flg=0;
}

if(! $_GET["adnum"] || ! preg_match("/^[0-9]+$/",$_GET["adnum"])){
 wLog("error:".$mname.": チラシ番号 不正({$_GET["adnum"]})");
 $flg=0;
}

if(! $_GET["dpscode"] || ! preg_match("/^[0-9]+$/",$_GET["dpscode"])){
 wLog("error:".$mname.": メジャー番号 不正({$_GET["dpscode"]})");
 $flg=0;
}

if(! $_GET["jcode"] || ! preg_match("/^[0-9]+$/",$_GET["jcode"])){
 wLog("error:".$mname.": JAN 不正({$_GET["jcode"]})");
 $flg=0;
}

$strcode=$_GET["strcode"];
$adnum=$_GET["adnum"];
$dpscode=$_GET["dpscode"];
$jcode=$_GET["jcode"];

//アイテム存在確認
if($flg){
 $items=viewGetFlyersItemDps($strcode,$adnum,null,$dpscode);


 if(! count($items)){
  wLog("error:".$mname.": チラシ商品リスト該当なしdpscode({$_GET["dpscode"]})");
  $flg=0;
 }

 //アイテムゲット
 foreach($items as $key=>$val){
  if($val["jcode"]==$jcode){
   $item[]=$val;
   break;
  }
 }

 if(!count($item)){
  wLog("error:".$mname.": チラシ商品該当なし jcode({$_GET["jcode"]})");
  $flg=0;
 }
}

//タイトル
if(! $flg){
 $title="該当商品は現在表示できません";
}
else{
 $title="チラシ商品　{$item["maker"]} {$item["sname"]} {$item["tani"]} {$item["price"]}{$item["yen"]}";
}

//ヘッダー表示
htmlHeader($title);
?>
  <div id="wrapper">
   <div class="items">
<?php
if(! $flg){
?>
    <h1>この商品は現在、ご案内できません。</h1>
    <p>誠に申し訳ございません。</p>
<?php
 return false;
}

htmlItem($item);
?>
   </div><!--div class="items"-->
   <div class="items">
<?php
if($flg){
 htmlContents($items);
}
?>
   </div><!--div class="items"-->
  </div><!--div id="wrapper"-->
 </body>
<script>
$(function(){
 slideImg();
});
</script>
</html>
