<?php
//こだわり
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="kodawari.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="キタムラのこだわり";

//ページ説明文
$description=<<<EOF
当店のこだわりをご紹介してます。高級スーパーのようなこだわりはございませんが、
「お客様のために」という思いは強い方だと自負しています。こちらでご紹介していること
以外にも、お弁当、お肉、お魚にもこだわり商品を販売しています。
ぜひ、店内にて「こだわり商品」を探してみてください。
あわせてTVCMもご案内中。そうです、当店もTVCM流していたんです。
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
    <h1>スーパーキタムラのこだわり</h1>
    <img class="backimage" src="img/kodawari_1.jpg" alt="こだわり商品|スーパーキタムラ">
    <p>
     最大のこだわりは<br>
    <strong>「創業以来一度も休んだことがない」</strong><br>
     ことです。
     そしてこれはこれからも続きます。<br>
    「いつ来ても開いている」その安心感を地域のお客様に持ってもらいえるようこれからも頑張っていきます。<br>
     もちろん、商品にもこだわりを持っています。その中でも特に力を入れている商品についてご案内いたします。
    </p>
   </div><!--div class="col1"-->
    
   <div class="col1">
    <h2>惣菜コーナー</h2>
    <img class="backimage" src="img/kodawari_2.jpg" alt="惣菜こだわり商品|スーパーキタムラ">
    <p>
     「よい品をまごころこめて」をモットーに可能な限り手作り商品を品揃えできるよう、毎日工夫しています。
      特に、「シックレス惣菜」と「お寿司」はその考えをしっかりと踏まえた商品となっております。
     <blockquote>
      シックレスとは？<br>
      <img class="backimage" src="img/kodawari_3.jpg" alt="こだわりのシックレス商品|スーパーキタムラ">
      <br>
      化学調味料、合成着色料、保存料をいっさい使用していない特別な調味料を使って作ったお惣菜です。<br>
      「食べ続けることで病気を遠ざける」＝「病気なし」という願いを込めて「シックレス」と名づけました。
      煮物が中心のお惣菜ですが、味付けは「どこか懐かしいおふくろの味」となっています。ぜひ一度、ご賞味くださいませ。<br>
      <span style="color:red">ワンポイント！</span><br>
      特に「シックレス弁当」が人気です。
     </blockquote>
     <p>
     </p>

     <blockquote>
      こだわりのお寿司</br>
      <img class="backimage" src="img/kodawari_4.jpg" alt="こだわりのお寿司|スーパーキタムラ">
      <br>
      スーパーマーケットにあるお寿司といえばロボットを使用したものがほとんどですが、キタムラでは寿司職人が
      まごころ込めてすべて手作りしています。さらにネタも既成品をほとんど使用せず、築地市場から厳選したものを
      仕入れ店内にて職人がさばいています。だから、鮮度が違います。そして美味しい！当店こだわりの商品です。<br>
      <span style="color:red">ワンポイント！</span><br>
      なかでも、「バッテラ寿司」と「穴子押し寿司」がおすすめですよ！
     </blockquote>
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>シェノール（パン工場）</h2>
    <img class="backimage" src="img/kodawari_5.jpg" alt="こだわりのシェノール（パン工場)|スーパーキタムラ">
    <p>
     こちらも手作りパンです。店内で「焼きたてパン」を販売しているスーパーはたくさんありますが、シェノールが他のスーパーに
     ある「焼きたてパン」と違うのは、「冷凍生地」を一切使用していないことです。パン職人が小麦粉から生地を作って、焼いています。
     そしてできたてをそのまま販売。これが本当の「焼きたてパン」ですよ！冷凍生地と比べて、風味が格別に違うおいしいパン。
     ぜひ1度ご賞味ください。<br>
     <span style="color:red">ワンポイント！</span><br>
     特に「フランスパン」がおすすめです。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>野菜コーナー</h2>
    <img class="backimage" src="img/kodawari_6.jpg" alt="キタムラの原点　青果|スーパーキタムラ">
    <p>
     キタムラはこの場所で八百屋さんとして創業しました。だから、自力が違います。日本一の「大田市場」が近くにあるこの場所を活かして
     取引先と細かい連携をしながら毎日鮮度抜群の野菜を販売するよう心がけています。<br>
     <span style="color:red">ワンポイント！</span><br>
     特におすすめは「自家製ぬか漬け」です。創業からずっと続く昔ながらの製法で作っているまごころこもった漬物。日によって味がかわるのが
     玉にキズですがそこが手作りらしさを表しています。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>お酒コーナー</h2>
    <img class="backimage" src="img/kodawari_7.jpg" alt="キタムラの原点　お酒|スーパーキタムラ">
    <p>
     キタムラは八百屋さんだったと同時に酒屋でもあったんです。その伝統を活かしお酒の品揃えも充実しています。<br>
     特にワイン、焼酎は豊富に商品をご用意。ぜひ1度こちらもお立ち寄りください。<br>
     <span style="color:red">ワンポイント！</span><br>
     「馬込文士村」という日本酒もあります。お土産にどうぞ！
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>TVCM</h2>
    <iframe width="375" height="315" src="https://www.youtube.com/embed/Zxn8IO6jLzQ" frameborder="0" allowfullscreen></iframe>
    <p>
     2014年10月から2015年3月までJ:COM　大田にて放送されたいたTVCMです。
    </p>
   </div><!--div class="TopImageZone"-->


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



