<?php
require_once("php/html.function.php");
require_once("php/view.function.php");

//店舗番号
if(! $_GET["strcode"]) $strcode=1;

//販売日
if(! $_GET["saleday"]) $saleday=date("Y-m-d");
if($_GET["saleday"] && ! chkDate($_GET["saleday"])){
 wLog("tirasi.php 日付無効のため本日日付をセット({$_GET["saleday"]})");
 $saleday=date("Y-m-d");
}

$saleday="2015-6-20";

//メール商品データゲット
$mail=viewGetSaleItem($strcode,1,$saleday);

//おすすめ商品ゲット
$osusume=viewGetSaleItem($strcode,2,$saleday);

//タイトル
if(count($mail)){
 $title=date("Y年m月d日",strtotime($mail[0]["saleday"]))."のメール商品";
}
elseif(count($osusume)){
 $title=date("Y年m月d日",strtotime($mail[0]["saleday"]))."のおすすめ商品";
}
else{
 $title="本日はメール商品、おすすめ商品がございません";
}

htmlHeader($title);
?>

  <div id="wrapper">
   <div class="items">
<?php
//メール商品
if(count($mail)){
 htmlContents($mail);
}

//おすすめ商品
if(count($osusume)){
 htmlContents($osusume);
}

if(!count($mail) && !count($osusume)){
?>
    <h1>申し訳ございません。本日はご案内できる商品がございません。</h1>
    <p>次回をご期待くださいませ。</p>
    
<?php
}
?>


   </div><!--div class="items"-->
  </div><!--div id="wrapper"-->
 </body>
<script>
</script>
</html>

