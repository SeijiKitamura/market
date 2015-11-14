<?php
//求人理由
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="kyujinriyu.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="求人理由";

//ページ説明文
$description=<<<EOF
なぜ、新入社員を募集しているのかその理由をご説明します。
その前に当店の創業からの考え方、今挑戦していることなどをご理解していただきたいと思います。
EOF;
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
    <h1>求人理由</h1>
    <img class="backimage" src="img/kyujin_1.jpg" alt="求人理由|スーパーキタムラ">
    <p>
     スーパーキタムラがなぜ新入社員を募集しているか、そしてこれから実現したいことをご説明します。
    </p>
   </div><!--div class="col1"-->


   <div class="col1">
    <h2>創業からの考え方</h2>
    <img class="backimage" src="img/kyujin_2.jpg" alt="創業からの考え方|スーパーキタムラ">
    <p>
     1958年（昭和33年)に八百屋さんとしてこの場所で開業しました。
     当時の売場面積はおよそ30平方メートル。<br />
     近所にお住まいのお客様へ少しでもお役に立てればと、仕入、販売、ご用聞き、配達とすべてを一生懸命に取り組んできました。この気持ちはいまも当社に引き継がれています。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>今、挑戦していること</h2>
    <img class="backimage" src="img/kyujin_3.jpg" alt="挑戦していること|スーパーキタムラ">
    <p>
     大手スーパーマーケットのように何十店舗も展開しているスーパーマーケットと違い、 ここに1店舗しかない我々にとっては、自分で仕入、自分で販売することが当たり前となっています。<br />
     ご来店されるお客様のもっとも近くで仕事しているからこそ、お客様のご要望に素早く応えられるメリットがあります。
     しかし、逆にこれがデメリットとなってしまう場合もあることに気づきました。<br />
     他店との情報交換がしづらい我々は、自分の勝手な思い込みによる品揃えになりがちです。その結果、売上が減少してお客様のご要望に応えられないことがよくありました。<br />

     そこでここ数年にわたり我々がトライしているのは、単品データによる販売検証です。 担当者の思い込みによる販売実績が本当に正しいのかをデータを見ながら常に検証し次の販売機会に活かしています。<br />

     データ検証しながら、<br />
     「これはもっと売れるはずだ」、 <br />
     「この商品はここを改善すればもっと売れる」<br />
     という仮説をたてます。<br />

     そして仮説にしたがって<br />
     「自分で商品をさがし、自分で販売」します。<br>

     全部自分ですることは大変ですが、想定以上に売れたときの喜びこそ創業以来かわらない当社で働くことの醍醐味だと思っています。<br />
     この気持ちを働いている方全員と共有できるように今日も一生懸命取り組んでいます。<br />
     もちろん、会社も全力でサポートします。過去の販売データや販売経験、そして売り場権限などさまざまなツールを使用して仮説の検証をおこないます。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>実現したいこと</h2>
    <img class="backimage" src="img/kyujin_4.jpg" alt="実現したいこと|スーパーキタムラ">
    <p>
     「より地域の皆様に貢献したい」<br />
     「もっと多くのお客様のお役に立ちたい」<br />
     常々そう思っています。<br />

     しかし、現状ではまだまだそこまでの力が備わっていません。<br />
     規模を拡大するはより多くの仲間が必要です。<br />
     そこでここ数年継続して新卒採用を行なってきました。<br />
     我々の思いに共感してもらえる新しい仲間を1人ずつでも着実に増やしていきたいと思っています。
     これがキタムラが新入社員を求人している理由です。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <ul class="SinsotuNavi">
     <li><a href="sinsotu.php">目次</a></li>
     <li><a href="saiyohousin.php">次へ</a></li>
    </ul>
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
});
</script>
</html>



