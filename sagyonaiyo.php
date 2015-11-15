<?php
//作業内容
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
$title="作業内容";

//ページ説明文
$description=<<<EOF
新入社員が入社してからの1年間の仕事内容について説明します。
主に生鮮とレジについての作業内容を3ヶ月毎に区切ってご案内しております。
最も大事なことはモチベーションです。
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
    <h1>作業内容について</h1>
    <p>
入社してから1年目までの仕事の内容について説明していきます。当店では新入社員は「生鮮・惣菜」と「レジ」に配属されますので、
それぞれについて説明いたします。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>生鮮・惣菜</h2>
    <blockquote>
入社から〜3ヶ月<br>
まずは商品名を覚えることからはじまります。具体的には商品に値段をつける作業をすることで、商品名を覚えることになります。
あわせて、簡単な商品化の作業を覚えていき、徐々に仕事に、会社に、そして社会に慣れていきます。<br>
<br>
<span style="color:blue;">アドバイス</span><br>
"「ほうれん草」と「小松菜」の区別がつかなくても大丈夫です。あっという間に覚えることができます。"
    </blockquote>
    <blockquote>
3ヶ月〜6ヶ月<br>
ある程度、慣れてきたところで少し難易度の高い商品化の作業へと移行していきます。1つの作業はそれほど量は多くありませんので、
毎日少しずつ目標をもって作業を行うことが大事です。<br>
<br>
<span style="color:blue;">アドバイス</span><br>
"部門によっては、包丁を使用するのもこの時期からとなります。包丁を使う本人よりも周りの人の方が見ていてハラハラする時期です。"
    </blockquote>
    <blockquote>
6ヶ月から9ヶ月<br>
商品化の作業は継続して行っていますが、それ以外のことも除々に学んでいきます。
まずは、仕入のことを学びます。「この商品はどこから仕入れたのか？」
「取引先はどんな会社か？」などを知ることからはじまり、その商品の生産方法や代表的な産地、メーカーはどこかなどを学んでいきます。
まだまだできない仕事はたくさんありますがあせあず着実にこなしてください。<br>
<br>
<span style="color:blue;">アドバイス</span><br>
"生鮮では「市場見学」がもっとも効果的です。小学校の社会科見学以来という方がほとんどですが、大人になってから見る市場は全然違うものに見えます。"
    </blockquote>
    <blockquote>
9ヶ月〜12ヶ月<br>
仕入、販売、棚卸、粗利などより専門的な知識をみにつけていきます。市場動向、他店調査、販売計画などの重要性について学んでいき今後に活かします。
季節と連動して扱う商品が変動します。それに伴い作業も変化します。まだまだできない仕事もありますが、ここを超えてやっと1周目ということなので
実際に慣れてくるにはこの後からとなります。<br>
<br>
<span style="color:blue;">アドバイス</span><br>
"そして、4月に入社する新しい社員の受け入れ準備も大事な仕事となります。"
    </blockquote>

   </div><!--div class="col1"-->

   <div class="col1">
    <h2>レジ</h2>
    <blockquote>
入社から〜3ヶ月<br>
レジ操作を覚えることから始めます。今はずいぶん簡単になりましたので操作自体はすぐに覚えられます。
生鮮同様、商品名もあわせて覚えていきます。たくさんあって大変そうに見えますが、実際にはほとんどの方がすぐに覚えてしまいます。<br>
<br>
<span style="color:blue;">アドバイス</span><br>
"「コロッケ」と「メンチ」の違いを見分ける、商品名が書いてあるボタンを瞬時に押すなど見ていてすごいと感じてしまいます。このレベルまで皆さんあっという間です。"
    </blockquote>
    <blockquote>
3ヶ月〜6ヶ月<br>
接客方法、トラブルケースなどを学んでいきます。レジはお客様と直接接するので対応が難しい時もありますが、「心がけ」さえしっかりしていれば
ほとんどのケースは対応可能です。その「心がけ」についてゆっくりと学んでいきます。<br>
<br>
<span style="color:blue;">アドバイス</span><br>
"「言葉使い」も大切ですが、それよりも「ハート」です。簡単なようで難しい。でもここがわかると楽しいです。"
    </blockquote>
    <blockquote>
6ヶ月から9ヶ月<br>
レジ以外の運営について学んでいきます。レシピカード、売価変更チェック、包装業務など覚えなければならない業務はたくさんあります。
あせらず着実にこなしていきましょう。<br>
<br>
<span style="color:blue;">アドバイス</span><br>
"ほとんど「裏方(うらかた）業務」なんですが、店舗を支える大事な仕事ばかりです。レジとは違った接し方でお客様と対応しなければなりませんが、レジでは経験できない感動ややりがいもあります。"
    </blockquote>
    <blockquote>
9ヶ月から12ヶ月<br>
ほぼ基礎的なことをマスターしたら次のステップはスピードです。ただスピードを上げるのではなく、お客様に雑と思われないようにスピードを上げるには
ある程度の経験と工夫が必要です。これまでの経験と工夫を共有して、さらにどうしたらレベルを上げていけるかを学んでいきます。<br>
<br>
<span style="color:blue;">アドバイス</span><br>
"そして、4月に入社する新しい社員の受け入れ準備も大事な仕事となります。"
    </blockquote>
   </div><!--div class="col1"-->

   <div class="col1">
    <ul class="SinsotuNavi">
     <li><a href="saiyohousin.php">戻る</a></li>
     <li><a href="sinsotu.php">目次</a></li>
     <li><a href="stepup.php">次へ</a></li>
    </ul>
   </div><!--div class="col1"-->

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





