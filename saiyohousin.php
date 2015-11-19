<?php
//採用方針
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

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
$description=<<<EOF
弊社新入社員を採用するにあたってどういった点を重視しているかをご案内しています。
「基礎となる考え方」と仕事をする上で大事なマインドについて共通の認識を持ってい
ただければと思っています。
EOF;

htmlHeader($title,$description);
?>

  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
    <h1>採用方針</h1>
    <img class="backimage" src="img/saiyo_1.jpg" alt="採用方針|スーパーキタムラ">
    <p>
     スーパーキタムラが採用する際に、基準としている考え方、方針をご説明します。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>基礎となる考え方</h2>
    <p>
     「みんな仲良く」<br />
     「まじめにやりな」<br />
      創業より言い伝えられてきたこの言葉に当社の考え方全てが凝縮されています。<br />

     <blockquote>
     「みんな仲良く」とは？<br>
      みんな仲良くとは慣れ合いになることではありません。<br />
      相手を人として尊重し、でも自分の意見も述べる。<br />
      仕事という共通した目標にむかって、表面上のなかよしではなく本当のなかよしになろうという意味です。
     </blockquote>
     <blockquote>
      「まじめにやりな」とは？<br>
      これはこの言葉どおりです。<br />
      「決めたらすぐに実行する」、「あきらめずに物事をやり通す」、「皆で助けあう。」です。<br />
      たとえ結果がでなくてもあきらめない。これが当社の基本となる考え方です。<br />
     </blockquote>
    </p>
   </div><!--div class="col1"-->

   <div class="pageBreak"></div>
   <div class="col1">
    <h2>仕事は楽しく</h2>
    <img class="backimage" src="img/saiyo_2.jpg" alt="仕事は楽しく|スーパーキタムラ">
    <p>
     「仕事は楽しくやろう」というのが当社の合言葉です。<br />
     これが簡単なようで実はすごく難しいんです。<br />
     初めは戸惑う仕事内容も慣れてくると単調に感じてしまいます。そして楽しくなくなります。<br />

     そんなときに必要になってくるのが向上心です。「昨日よりも今日」、「今日よりも明日」。常に目標をもつことが「仕事を楽しくやる」大事な条件となってきます。
    </p>
    <p>
     採用はこの2点の考え方に協調できるかに重点をおいています。設定した目標にむかって努力し、達成できたときの喜びに共感できる方を当社は求めています。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <ul class="SinsotuNavi">
     <li><a href="kyujinriyu.php">戻る</a></li>
     <li><a href="sinsotu.php">目次</a></li>
     <li><a href="sagyonaiyo.php">次へ</a></li>
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




