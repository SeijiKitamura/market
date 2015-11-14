<?php
//ご予約リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="goyoyakulist.php";
wLog("pagecount ".$me);

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
 $description =$title."のご案内。";
 $description.="今月末までのご案内となっております。";
 $description ="当店が自信を持っておすすめする特別商品。どれも店頭にならばない特別な商品ばかりです。";
 $description.="法事、ホームパーティなどにご利用できるオードブル、お寿司、お刺身盛合せ、お赤飯、サンドイッチ等各種取り揃えました。";
}
else{
 $title="申し訳ございません。本日はご案内するご予約商品がございません。";
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
echo "<h1>{$title}</h1>";

if(! count($itemlist)){
 echo "<p>".$title."</p>";
}
else{
 $comment=<<<EOF
<p>
ご家族が揃った時やホームパーティ、法事などにぜひご利用くださいませ。
</p>
EOF;
 echo $comment;
}
?>
   </div><!--div class="col1"-->
<?php
if(count($itemlist)){
 $grpname="";
 foreach($itemlist as $key=>$val){
  if($grpname!==$val["grpname"]){
   echo "<div class='clr'></div>";
   echo "<h2>{$val["grpname"]}</h2>";
   $grpname=$val["grpname"];
  }
  echo "<div class='col3'>";
  $ary=array();
  $ary[]=$itemlist[$key];
  htmlItemList($ary);
  echo "</div>";
 }
}

htmlSNSButton();
?>
   <div class="clr"></div>

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
      特別な商品ばかりですので、ご利用になる3日前(1つの商品で10個を超える数量をご注文の場合は1週間前)までにご予約ください。 
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

