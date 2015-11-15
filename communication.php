<?php
//コミュニケーション 
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="communication.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="コミュニケーション";

//ページ説明文
$description=<<<EOF
コミュニケーションはお仕事をしていく上で大事なことです。難しい面もありますが、
会社も全力でサポートしています。仲間がいれば仕事がより一層楽しくなります。
まずは簡単な挨拶から始めてみましょう。
EOF;
htmlHeader($title,$description);

aLog($_SERVER["REQUEST_URI"]);
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
    <h1>コミュニケーション</h1>
    <img class="backimage" src="img/comm_1.jpg" alt="コミュニケーション|スーパーキタムラ">
    <p>
1人でやる仕事はどんなに頑張っても1人分です。ですがそれを仲間同士協力し合えると、ものすごい効果を発揮します。
ここでは、スーパーキタムラが実際に行っているコニュニケーション強化方法をご案内します。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>新入社員歓迎会</h2>
    <img class="backimage" src="img/comm_2.jpg" alt="新入社員歓迎会|スーパーキタムラ">
    <p>
もうスーパーキタムラの恒例行事と言っても過言ではありません。
入ってくる新入社員よりも緊張している先輩社員が見れます。(残念ながらほとんどの新入社員の方は他の方を
気にする余裕がないのですが)<br>
「歓迎会に出す料理」、「司会・進行」などを先輩社員と一緒に相談しながら決めていきます。
合言葉は「去年よりも」です。前例にとらわれないいつも新しいことにチャレンジすることをみんなで学んでいきます。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>山中湖保養所</h2>
    <img class="backimage" src="img/comm_3.jpg" alt="山中湖保養所|スーパーキタムラ">
    <p>
25歳以下の社員限定で、山中湖保養所に1泊2日にて実施します。
ただ、山中湖に行くだけではなくそのための準備としてさまざまなことをしていただきます。
「当日の天候・気温の予測」から「食事について」までそれぞれに出された課題をこなしながら
チームで仕事をする難しさを学びます。学校で行く「修学旅行」や友達といく「旅行」とは違う
「難しさ」と「楽しさ」が待っています。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <ul class="SinsotuNavi">
     <li><a href="stepup.php">戻る</a></li>
     <li><a href="sinsotu.php">目次</a></li>
     <li><a href="interview.php">次へ</a></li>
    </ul>
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






