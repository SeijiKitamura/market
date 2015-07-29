<?php
require_once("php/html.function.php");
require_once("php/view.function.php");

$mname="saleitem.php";

$saletype=$_GET["saletype"];
$flg=1;

//チラシ商品 引数チェック
if($saletype==0){
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
  $title="チラシ商品　{$item[0]["maker"]} {$item[0]["sname"]} {$item[0]["tani"]} {$item[0]["price"]}{$item[0]["yen"]}";
 }
}

//メール商品 引数チェック
if($saletype==1||$saletype==2||$saletype==5){
 if(! $_GET["strcode"] || ! preg_match("/^[0-9]+$/",$_GET["strcode"])){
  wLog("error:".$mname.": 店舗番号 不正({$_GET["strcode"]})");
  $flg=0;
 }

 if(! $_GET["saleday"] || ! chkDate($_GET["saleday"])){
  wLog("error:".$mname.": 日付 不正({$_GET["saleday"]})");
  $flg=0;
 }

 if(! $_GET["jcode"] || ! preg_match("/^[0-9]+$/",$_GET["jcode"])){
  wLog("error:".$mname.": JAN 不正({$_GET["jcode"]})");
  $flg=0;
 }

 $strcode=$_GET["strcode"];
 $jcode=$_GET["jcode"];
 $saleday=$_GET["saleday"];

 
 //アイテム存在確認
 if($flg){
  $items=viewGetSaleItem($strcode,$saletype,$saleday);
 
 
  if(! count($items)){
   wLog("error:".$mname.": 商品リスト該当なしsaleday({$_GET["saleday"]})");
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
   wLog("error:".$mname.": 商品該当なし jcode({$_GET["jcode"]})");
   $flg=0;
  }
 }

 //アイテムリスト再構築(同じgrpnumだけ抽出)
 if($saletype==5){
  $items=array();
  $grpnum=$item[0]["grpnum"];
  $items=viewGetGotyumonGrpItem($strcode,$saleday,$grpnum);
 }
 
 //タイトル
 if(! $flg){
  $title="該当商品は現在表示できません";
 }
 else{
  if($saletype==1){
   $title="メール商品";
  }
  elseif($saletype==2){
   $title="おすすめ商品";
  }
  elseif($saletype==5){
   $title="ご注文商品";
  }

  $title.=" {$item[0]["maker"]} {$item[0]["sname"]} {$item[0]["tani"]} {$item[0]["price"]}{$item[0]["yen"]}";
 }

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

