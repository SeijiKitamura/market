<?php
//メール商品リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

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

//メールデータゲット
$itemlist=viewGetMailList($strcode,$saleday);


//タイトル決定
if(count($itemlist)){
 $title=date("Y年m月d日",strtotime($saleday))."のメール商品";
 $description=<<<EOF
毎日のお買得品をメールでお知らせいたします。さらにメール会員特別価格商品もご案内中。
ポイント5倍や10%引きその他、朝市などのスペシャルサービスデーもメールにてお知らせいたします。
会員登録は簡単！0873@14142.comにメールするだけです。この機会にぜひご登録くださいませ。
EOF;
}
else{
 $title="申し訳ございません。本日はご案内するメール商品がございません。";
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
<?php
if(! $itemlist){
 echo "<h1>申し訳ございません。本日、ご案内するメール商品がございません。</h1>";
}
?>
    <div class="NaviDiv" style="margin:0 0 0 35%;">
     <a class="grad" href="#MailHead">メール会員とは?</a>   
     <a class="grad" href="mailto:0873@14142.com?body=このまま送信してください。このメールを送信すると登録完了のお知らせがメールで届きます。もし届かない場合は、「ドメイン指定」をご確認していただき「14142.com」からのメールを許可するよう設定をお願いいたします。">今すぐ登録！</a>
     <div class="clr"></div>
    </div>
   
   </div><!--div class="col1"-->
<?php
if(count($itemlist)){
 $d="";
 foreach($itemlist as $key=>$val){
  if($d!==$val["saleday"]){
   echo "<div class='clr'></div>";
   echo "<h2 style='line-height:1.5em'>".date("Y年m月d日",strtotime($val["saleday"]))."限り</h2>";
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

<?php
htmlSNSButton();
?>
   <div class="clr"></div>

   <div class="col1">
    <div id="MailHead"></div>
    <div class="MailDetail">
     <h2>メール会員とは?</h2>
     <p>
      当店からのお買い得情報をメールでお知らせします。チラシ商品はもちろん、「カレンダー情報」、「ポイント5倍デー」、「朝市」、「ほぼ全品10%OFF」などスペシャルサービスデーももれなくご案内中！<br>
      会費はもちろん無料です。
      登録方法は簡単！「<a href="mailto:0873@14142.com?body=このまま送信してください。このメールを送信すると登録完了のお知らせがメールで届きます。もし届かない場合は、「ドメイン指定」をご確認していただき「14142.com」からのメールを許可するよう設定をお願いいたします。"><span>0873@14142.com</span></a>」にメールするだけです。
     </p>

     <h2>メール会員特別価格</h2>
     <p>
      さらにメール会員様限定「特別価格商品」もご案内中！レジにてメール画面を係員にお見せください。対象商品を値引きさせていただきます。
     </p>
     
     <h2>メールが届かない・・・</h2>
     <p>
      登録したにも関わらずメールが届かない場合は、「ドメイン指定」をご確認し「14142.com」からのメールを許可してください。
     </p>

     <h2>退会方法</h2>
     <p>
      退会方法も簡単です。当店から送信されたメールをご返信ください。
     </p>
    </div><!--div class="MailDetail"-->
   </div><!--div class="col1"-->

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


