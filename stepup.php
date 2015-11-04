<?php
//作業内容
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="sagyonaiyo.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="採用方針";

//ページ説明文
$description="";
htmlHeader($title,$description);

//print_r($item);
?>

  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="clr"></div>

   <div class="col1">
    <h1>ステップアップ</h1>
    <p>
入社後のキャリアアップについて説明します。スーパーキタムラは1店舗しかないため、他のスーパーに比べると
キャリアアップ期間が長めですが、その分より専門的な知識を得ることができます。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>1〜3年目</h1>
    <p>
担当<br>
その部門の基礎的な内容をすべて把握する期間となります。さらに狭い範囲で任されるようになり、
発注や販売計画などを行う場合もあります。<br>
<br>
「小売業とは?」 というところを学んでいただきます。同業他社との違いなどを感じてもらえればと思っています。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>4〜5年目</h1>
    <p>
サブチーフ<br>
チーフがお休みの時などに代理として部門を運営していきます。技術的な作業はほぼできる方が１つの目安となります。
部門全体の販売計画や取引先との交渉なども順次行っていきます。
<br>
<br>
「これが小売業だ」ということを学んでいただきます。
また「やりがい」を最も感じられる期間だと思います。業界のこともある程度、把握し売り場をコントロールする楽しさを
感じていただければと思います。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>6年目〜</h1>
    <p>
チーフ<br>
部門全体のマネジメントを行います。売上や売場、商品の管理が主な仕事となってきます。部下の休日をコントロールするのも
大事な仕事の1つです。最も難しい仕事「販売計画」という作業を行っていきます。
<br>
<br>
「小売業の難しさ」ということを学んでいただきます。
仮説、検証、反省からの次に向けてを繰り返します。ほとんどが失敗の連続で新しいことにチャレンジできなる時でも
ありますが、たまに成功すると「やめられない快感」を感じることができます。
    </p>

    <a href="communication.php">次ページ　コミュニケーション</a>
   </div><!--div class="col1"-->


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






