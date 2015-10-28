<?php
//ご予約リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付 [推奨] ない場合は当日になる
// 最小引数 ?strcode=1&saleday=yyyy-mm-dd

//配列
//itemlist ご予約商品リスト

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

//ご予約データゲット
$itemlist=viewGetSaleItem($strcode,5,$saleday);

//タイトル決定
if(count($itemlist)){
 $title=date("Y年m月",strtotime($saleday))."のご予約商品";
}
else{
 $title="申し訳ございません。本日はご案内するご予約商品がございません。";
}

htmlHeader($title);
?>
  <div id="wrapper">
   <div class="col1">
<?php
if(! count($itemlist)){
 echo "<h1>{$title}</h1>";
}
?>
   </div><!--div class="col1"-->
<?php
if(count($itemlist)){
 $d="";
 foreach($itemlist as $key=>$val){
  if($d!==$val["saleday"]){
   echo "<div class='clr'></div>";
   echo "<h2 style='line-height:1.5em'>".date("Y年m月",strtotime($val["saleday"]))."ご予約商品一覧</h2>";
  }
?>
   <div class="col3">
<?php 
  $ary=array();
  $ary[]=$itemlist[$key];
  htmlItemList($ary);
?>
   </div><!--div class="col3"-->
<?php
  $d=$val["saleday"];
 }
?>
   <div class="clr"></div>
<?php 
}
?>

<!-- ここにSNSを追加-->
   <div class="col1">
    <div id="MailHead"></div>
    <div class="MailDetail">
     <h2>ご予約商品とは?</h2>
     <p>
      当店自慢の商品ばかりを取り揃えました。ホームパーティ、イベント、法事などにぜひご利用ください。
     </p>

     <h2>ご注文方法</h2>
     <p>
      サービスカウンターにて承っております。詳しくは03-3771-8284(朝9:00-18:00)までご連絡ください。
     </p>

     <h2>ご注意点</h2>
     <p>
      特別な商品ばかりですので、ご注文日の3日前(10個を超える数量をご注文の場合は1週間前)までにご予約ください。 
     </p>

    </div><!--div class="MailDetail"-->
   </div><!--div class="col1"-->

  </div><!--div id="wrapper"-->
 </body>
<script>
</script>
</html>

